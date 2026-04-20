<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function initiatePayment(Request $request)
    {
        $request->validate([
            'identifiant' => 'required|string',
            'montant' => 'required|numeric|min:100',
        ]);

        $masterKey = env('PAYDUNYA_MASTER_KEY');
        $publicKey = env('PAYDUNYA_PUBLIC_KEY');
        $privateKey = env('PAYDUNYA_PRIVATE_KEY');
        $token = env('PAYDUNYA_TOKEN');
        $mode = env('PAYDUNYA_MODE', 'test');

        $baseUrl = $mode === 'live'
            ? 'https://app.paydunya.com/api/v1/checkout-invoice/create'
            : 'https://app.paydunya.com/sandbox-api/v1/checkout-invoice/create';

        $payload = [
            'invoice' => [
                'items' => [
                    'item_0' => [
                        'name' => "Dépôt 1xBet - ID: " . $request->identifiant,
                        'quantity' => 1,
                        'unit_price' => $request->montant,
                        'total_price' => $request->montant,
                    ]
                ],
                'total_amount' => $request->montant,
                'description' => "Recharge de compte 1xBet pour l'ID " . $request->identifiant
            ],
            'store' => [
                'name' => "Vackess Cash",
            ],
            'actions' => [
                'cancel_url' => route('demandedepot'),
                'return_url' => route('payment.success', [
                    'id' => $request->identifiant,
                    'amount' => $request->montant
                ]),
                'callback_url' => route('payment.ipn')
            ],
            'customer' => [
                'name' => "Client ID: " . $request->identifiant,
                'email' => "ouerahim456@gmail.com", // Email générique pour éviter que PayDunya ne le demande
            ]
        ];

        try {
            $response = Http::withHeaders([
                'PAYDUNYA-MASTER-KEY' => $masterKey,
                'PAYDUNYA-PRIVATE-KEY' => $privateKey,
                'PAYDUNYA-TOKEN' => $token,
                'Content-Type' => 'application/json',
            ])->post($baseUrl, $payload);

            if ($response->successful() && $response->json('response_code') === '00') {
                return response()->json([
                    'success' => true,
                    'redirect_url' => $response->json('response_text') // In case of standard IPN, it's invoice_url
                ]);
            }

            Log::error('PayDunya Error: ' . $response->body());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de la facture PayDunya.'
            ], 500);

        } catch (\Exception $e) {
            Log::error('Payment Initiation Failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue.'
            ], 500);
        }
    }

    public function paymentSuccess(Request $request)
    {
        $id = $request->query('id');
        $amount = $request->query('amount');

        // Logic to verify payment status with PayDunya would go here (Confirm Invoice)

        // Notify via WhatsApp
        $this->sendWhatsAppNotification($id, $amount);

        return view('landing.demandedepot', [
            'payment_status' => 'success',
            'id' => $id,
            'amount' => $amount
        ]);
    }

    private function sendWhatsAppNotification($id, $amount)
    {
        $adminNumber = env('WHATSAPP_ADMIN_NUMBER', '+22670000000');
        $instanceId = env('WHATSAPP_INSTANCE_ID');
        $token = env('WHATSAPP_TOKEN');

        $message = "🔔 *Nouvelle Demande de Recharge*\n\n"
            . "👤 *ID 1xBet:* $id\n"
            . "💰 *Montant:* $amount CFA\n"
            . "✅ *Statut:* Payé via le site Vackess cash\n\n"
            . "Merci de traiter cette demande rapidement.";

        if ($instanceId && $token) {
            $apiUrl = "https://api.ultramsg.com/{$instanceId}/messages/chat";

            try {
                $response = Http::asForm()->post($apiUrl, [
                    'token' => $token,
                    'to' => $adminNumber,
                    'body' => $message,
                ]);

                if (!$response->successful()) {
                    Log::error('UltraMsg WhatsApp Error: ' . $response->body());
                }
            } catch (\Exception $e) {
                Log::error('UltraMsg WhatsApp Exception: ' . $e->getMessage());
            }
        } else {
            Log::info("WhatsApp Notification (Simulated - No UltraMsg credentials): $message");
        }
    }

    public function handleIPN(Request $request)
    {
        Log::info('PayDunya IPN Received:', $request->all());

        // Assurez-vous que l'IPN vient de PayDunya (vous devriez valider le hash cryptographique ici si PayDunya en fournit un)
        $status = $request->input('status');

        if ($status === 'completed') {
            $amount = $request->input('invoice.total_amount');
            $customId = $request->input('invoice.items.item_0.name', 'Inconnu'); // Astuce temporaire pour récupérer l'ID
            preg_match('/ID: (\d+)/', $customId, $matches);
            $userId = $matches[1] ?? 'Client';

            Log::info("Paiement validé pour le montant de $amount. Déclenchement de l'automatisation...");

            // Calcul du transfert (Retrait des 2.5% de PayDunya et 1% pour l'appli)
            $paydunyaFee = 0.025;
            $appFee = 0.01;

            $netAmount = $amount - ($amount * $paydunyaFee) - ($amount * $appFee);
            $netAmountToTransfer = floor($netAmount);

            // Numéro du fournisseur (Ex: le grossiste ou récepteur du fond)
            $fournisseurPhoneNumber = env('FOURNISSEUR_NUMBER', '22600000000');

            Log::info("Distribution: Total=$amount, FraisAppli=" . ($amount * $appFee) . ", MontantATransférer=$netAmountToTransfer vers $fournisseurPhoneNumber");

            // Exécuter le déboursement automatique
            $this->automatedDisbursement($netAmountToTransfer, $fournisseurPhoneNumber);
        }

        return response('IPN OK', 200);
    }

    private function automatedDisbursement($amount, $accountAlias)
    {
        $masterKey = env('PAYDUNYA_MASTER_KEY');
        $privateKey = env('PAYDUNYA_PRIVATE_KEY');
        $token = env('PAYDUNYA_TOKEN');
        $mode = env('PAYDUNYA_MODE', 'test');

        // URL API Disburse de PayDunya
        $baseUrl = $mode === 'live'
            ? 'https://app.paydunya.com/api/v1/disburse/get-invoice'
            : 'https://app.paydunya.com/sandbox-api/v1/disburse/get-invoice';

        $payload = [
            'account_alias' => $accountAlias,
            'amount' => $amount,
            // 'withdraw_mode' => 'orange-money-senegal' // À préciser selon l'API exacte de déboursement BF (moov-bf, orange-bf, etc.)
        ];

        try {
            $response = Http::withHeaders([
                'PAYDUNYA-MASTER-KEY' => $masterKey,
                'PAYDUNYA-PRIVATE-KEY' => $privateKey,
                'PAYDUNYA-TOKEN' => $token,
                'Content-Type' => 'application/json',
            ])->post($baseUrl, $payload);

            if ($response->successful()) {
                Log::info('Déboursement automatique réussi:', $response->json());
                // Ici on pourrait confirmer le reversement via un envoi UltraMsg à l'administrateur
            } else {
                Log::error('Erreur lors du déboursement PayDunya:', [
                    'body' => $response->body(),
                    'payload' => $payload
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Exception - Échec du déboursement: ' . $e->getMessage());
        }
    }
}
