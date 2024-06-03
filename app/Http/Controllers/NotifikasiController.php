<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\Message;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\CloudMessage;

//
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Kutia\Larafirebase\Messages\FirebaseMessage;

use App\Models\User;
use GuzzleHttp\Client as Google_Client;
// use Google_Client;

class NotifikasiController extends Controller
{
    private $client;
    private $project_id;
    private $access_token;

    public function __construct()
    {
        $this->project_id = 'pehadir-1f207';

        $googleClient = new Google_Client();
        $googleClient->setAuthConfig(storage_path('app/pehadir-1f207-8c712bfe1daa.json'));
        $googleClient->addScope('https://www.googleapis.com/auth/cloud-platform');

        $this->access_token = $googleClient->fetchAccessTokenWithAssertion()["access_token"];
        $this->client = new Client();
    }


    public function index(){
        return $access_token;
    }
    public function updateToken(Request $request){
        try{
            // dd($request->token);
            User::where('branch_id',28)->update(['fcm_token'=>$request->token]);
            return response()->json([
                'success'=>$request->token
            ]);
        }catch(Exception $e){
            report($e);
            return response()->json([
                'success'=>false
            ],500);
        }
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

