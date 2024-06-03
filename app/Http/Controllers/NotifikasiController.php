<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Google_Client;

class NotifikasiController extends Controller
{
    private $client;
    private $project_id;
    private $access_token;

    public function __construct()
    {
        $this->project_id = env('FIREBASE_PROJECT_ID');

        $googleClient = new Google_Client();
        $googleClient->setAuthConfig(storage_path('app/pehadir-1f207-8c712bfe1daa.json'));
        $googleClient->addScope('https://www.googleapis.com/auth/cloud-platform');

        $this->access_token = $googleClient->fetchAccessTokenWithAssertion()["access_token"];
        $this->client = new Client();
    }
    public function index(){
        return $access_token;
    }
    public function sendNotification($token, $title, $body, $data = [])
    {
        $url = "https://fcm.googleapis.com/v1/projects/{$this->project_id}/messages:send";

        $message = [
            'message' => [
                'token' => $token,
                'notification' => [
                    'title' => $title,
                    'body' => $body
                ],
                'data' => $data
            ]
        ];

        $response = $this->client->post($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->access_token,
                'Content-Type' => 'application/json'
            ],
            'json' => $message
        ]);

        return json_decode($response->getBody(), true);
    }
}
