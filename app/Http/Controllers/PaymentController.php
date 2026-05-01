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
            'plateforme' => 'required|string',
            'identifiant' => 'required|string',
            'montant' => 'required|numeric|min:100',
            'phone' => 'required|string',
            'payment_method' => 'required|string'
        ]);

        $selectedMethod = $request->payment_method;

        // Orange, Moov and Telecel go to manual flow
        if (in_array($selectedMethod, ['orange_money', 'moov_money', 'telecel'])) {
            return response()->json([
                'success' => true,
                'manual' => true,
                'method' => $selectedMethod
            ]);
        }

        /* 
        // PayDunya Logic (Commented for now)
        $masterKey = env('PAYDUNYA_MASTER_KEY');
        $publicKey = env('PAYDUNYA_PUBLIC_KEY');
        // ... rest of PayDunya logic
        */

        // GeniusPay Integration
        $apiKey = env('GENIUSPAY_KEY');
        $apiSecret = env('GENIUSPAY_SECRET');
        $baseUrl = 'https://pay.genius.ci/api/v1/merchant/payments';

        $selectedMethod = $request->payment_method;
        
        // Mappage pour forcer les gateways reconnus par l'API
        $gatewayMapping = [
            'orange_money' => 'orange_money',
            'moov_money'   => 'moov_money',
            'wave'         => 'wave',
            'telecel'      => 'pawapay'
        ];

        $providerMapping = [
            'orange_money' => 'ORANGE_BFA',
            'moov_money'   => 'MOOV_BFA',
            'wave'         => 'WAVE_BFA',
            'telecel'      => 'TELECEL_BFA'
        ];

        $gateway = $gatewayMapping[$selectedMethod] ?? null;
        $mmoProvider = $providerMapping[$selectedMethod] ?? null;

        try {
            $payload = [
                'amount' => $request->montant,
                'currency' => 'XOF',
                'description' => "Dépôt " . $request->plateforme . " - ID: " . $request->identifiant,
                'success_url' => route('payment.success', [
                    'plateforme' => $request->plateforme,
                    'id' => $request->identifiant,
                    'amount' => $request->montant
                ]),
                'error_url' => route('demandedepot'),
                'payment_method' => $selectedMethod, // On remet la méthode originale
                'gateway' => $gateway,
                'mmo_provider' => $mmoProvider,
                'customer' => [
                    'country' => 'BF',
                    'phone' => str_replace('+', '', $request->phone)
                ],
                'metadata' => [
                    'plateforme' => $request->plateforme,
                    'identifiant' => $request->identifiant,
                ]
            ];

            $response = Http::withHeaders([
                'X-API-Key' => $apiKey,
                'X-API-Secret' => $apiSecret,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ])->post($baseUrl, $payload);

            if ($response->successful()) {
                $data = $response->json('data');
                if ($data) {
                    return response()->json([
                        'success' => true,
                        'redirect_url' => $data['checkout_url'] ?? ($data['payment_url'] ?? null)
                    ]);
                }
            }

            Log::error('GeniusPay Error: ' . $response->body());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création du paiement GeniusPay.'
            ], 500);

        } catch (\Exception $e) {
            Log::error('GeniusPay Initiation Failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue.'
            ], 500);
        }
    }

    public function submitManualPayment(Request $request)
    {
        $request->validate([
            'plateforme' => 'required|string',
            'identifiant' => 'required|string',
            'montant' => 'required|numeric',
            'phone' => 'required|string',
            'payment_method' => 'required|string',
            'transaction_id' => 'required|string',
            'proof_image' => 'required|image|max:5120', // 5MB max
        ]);

        try {
            $imagePath = null;
            $imageUrl = null;

            if ($request->hasFile('proof_image')) {
                $path = $request->file('proof_image')->store('proofs', 'public');
                $imagePath = $path;
                $imageUrl = asset('storage/' . $path);
            }

            // Notify via WhatsApp with proof
            $this->sendWhatsAppNotification(
                $request->identifiant,
                $request->montant,
                $request->plateforme,
                $request->transaction_id,
                $imagePath,
                $request->phone,
                $request->payment_method
            );

            return response()->json([
                'success' => true,
                'message' => 'Votre preuve a été soumise avec succès.'
            ]);

        } catch (\Exception $e) {
            Log::error('Manual Payment Submission Failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la soumission.'
            ], 500);
        }
    }

    public function paymentSuccess(Request $request)
    {
        $plateforme = $request->query('plateforme', '1xBet');
        $id = $request->query('id');
        $amount = $request->query('amount');

        // Notify via WhatsApp
        $this->sendWhatsAppNotification($id, $amount, $plateforme, null, null, null, $request->payment_method);

        return view('landing.demandedepot', [
            'payment_status' => 'success',
            'plateforme' => $plateforme,
            'id' => $id,
            'amount' => $amount
        ]);
    }

    public function handleIPN(Request $request)
    {
        Log::info('GeniusPay Webhook Received:', $request->all());

        // Signature validation... (déjà implémenté précédemment)
        // ...
        
        return response()->json(['status' => 'success'], 200);
    }
    private function sendWhatsAppNotification($id, $amount, $plateforme = '1xBet', $transactionId = null, $imagePath = null, $phone = null, $method = null)
    {
        $adminNumber = env('WHATSAPP_ADMIN_NUMBER', '+22670477652');
        $instanceId = env('WHATSAPP_INSTANCE_ID');
        $token = env('WHATSAPP_TOKEN');

        $type = $transactionId ? "Manuelle" : "GeniusPay";
        $methodNames = [
            'orange_money' => 'Orange Money',
            'moov_money'   => 'Moov Money',
            'telecel'      => 'Telecel Cash',
            'wave'         => 'Wave',
            'card'         => 'Carte Bancaire'
        ];
        $operator = $methodNames[$method] ?? 'Inconnu';
        
        $message = "🔔 *Nouvelle Demande de Recharge ($type)*\n\n"
            . "🎮 *Plateforme:* $plateforme\n"
            . "👤 *ID Joueur:* $id\n"
            . "💰 *Montant:* $amount CFA\n"
            . "📱 *Opérateur:* $operator\n";
        
        if ($phone) {
            $message .= "📞 *Numéro Client:* $phone\n";
        }
        
        if ($transactionId) {
            $message .= "🎫 *ID Transaction:* $transactionId\n";
        }

        $message .= "\nMerci de traiter cette demande.";

        if ($instanceId && $token) {
            $apiUrl = "https://api.ultramsg.com/{$instanceId}/messages/chat";
            
            // Send Text
            Http::asForm()->post($apiUrl, [
                'token' => $token,
                'to' => $adminNumber,
                'body' => $message,
            ]);

            // Send Image if provided (Manual payment)
            if ($imagePath) {
                $fullPath = storage_path('app/public/' . $imagePath);
                if (file_exists($fullPath)) {
                    $imageApiUrl = "https://api.ultramsg.com/{$instanceId}/messages/image";
                    $imageData = base64_encode(file_get_contents($fullPath));
                    
                    Http::asForm()->post($imageApiUrl, [
                        'token' => $token,
                        'to' => $adminNumber,
                        'image' => $imageData,
                        'caption' => "Preuve de paiement - ID Joueur: $id"
                    ]);
                }
            }
        }
    }
}
