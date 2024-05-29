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
class NotifikasiController extends Controller
{
    public function index(){
        return view('notifikasi');
    }
    public function updateToken(Request $request){
        try{
            User::where('branch_id',28)->update(['fcm_token'=>$request->token]);
            return response()->json([
                'success'=>true
            ]);
        }catch(Exception $e){
            report($e);
            return response()->json([
                'success'=>false
            ],500);
        }
    }
    public function notification($topic="topik",$title="sebuah toitle", $body="body")
    {
        $firebase = app('firebase.messaging');
        $message = CloudMessage::withTarget('topic', $topic)
            ->withNotification(Notification::create($title, $body));

        $firebase->send($message);
        
    }
    
    
    }

