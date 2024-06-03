<?php

require 'vendor/autoload.php';

use Google\Client as Google_Client;

// Buat instance Google_Client
$googleClient = new Google_Client();
$googleClient->setAuthConfig(storage_path('/home/pehadirm/public_html/storage/app/pehadir-1f207-8c712bfe1daa.json'));
$googleClient->addScope('https://www.googleapis.com/auth/cloud-platform');

// Dapatkan access token
$accessToken = $googleClient->fetchAccessTokenWithAssertion()["access_token"];

// Siapkan data notifikasi
$url = "https://fcm.googleapis.com/v1/projects/YOUR_PROJECT_ID/messages:send";
$data = [
    'message' => [
        'token' => 'DEVICE_REGISTRATION_TOKEN',
        'notification' => [
            'title' => 'Hello',
            'body' => 'World'
        ],
        'data' => [
            'key1' => 'value1',
            'key2' => 'value2'
        ]
    ]
];

// Siapkan permintaan cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $accessToken,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Eksekusi permintaan dan dapatkan respons
$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

// Cetak respons
echo $response;
