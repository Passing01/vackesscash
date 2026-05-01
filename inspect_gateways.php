<?php

require __DIR__ . '/vendor/autoload.php';

$env = [];
$lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
        list($key, $value) = explode('=', $line, 2);
        $env[trim($key)] = trim($value);
    }
}

$apiKey = $env['GENIUSPAY_KEY'];
$apiSecret = $env['GENIUSPAY_SECRET'];

echo "Récupération des passerelles et fournisseurs...\n";

// Tester la récupération des gateways
$ch = curl_init('https://pay.genius.ci/api/v1/merchant/gateways');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'X-API-Key: ' . $apiKey,
    'X-API-Secret: ' . $apiSecret,
    'Content-Type: application/json'
]);

$response = curl_exec($ch);
echo "Gateways:\n" . $response . "\n\n";

// Tester la récupération des providers pour le Burkina
$ch = curl_init('https://pay.genius.ci/api/v1/merchant/pawapay/providers?country=BF');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'X-API-Key: ' . $apiKey,
    'X-API-Secret: ' . $apiSecret,
    'Content-Type: application/json'
]);

$response = curl_exec($ch);
echo "Providers BF:\n" . $response . "\n";

curl_close($ch);
