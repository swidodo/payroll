<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\Message;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\CloudMessage;
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
        }catch(\Exception $e){
            report($e);
            return response()->json([
                'success'=>false
            ],500);
        }
    }
   
public function notification(Request $request)
{
    $FcmToken = auth()->user()->fcm_token;
    $title = $request->input('title');
    $body = $request->input('body');
    $message = CloudMessage::fromArray([
      'token' => $FcmToken,
      'notification' => [
        'title' => "test",
         'body' => "body"
        ],
     ]);

   Notification::send($message);
}
    
   
    }

