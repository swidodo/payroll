<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\Message;
use Kreait\Firebase\Messaging\Notification;
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
    public function sendNotification()
    {
        $title = 'My Notification Title';
        $body = 'My Notification Body';
        $imageUrl = 'https://picsum.photos/400/200';
        
        $notification = Notification::fromArray([
            'title' => $title,
            'body' => $body,
            'image' => $imageUrl,
        ]);
        
        $notification = Notification::create($title, $body);
        
        $changedNotification = $notification
            ->withTitle('Changed title')
            ->withBody('Changed body')
            ->withImageUrl('https://picsum.photos/200/400');
            
    }
    public function sendNotification(){
        $title = 'My Notification Title';
        $body = 'My Notification Body';
    
        try{
            $fcmTokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
    
            //Notification::send(null,new SendPushNotification($request->title,$request->message,$fcmTokens));
    
            /* or */
    
            //auth()->user()->notify(new SendPushNotification($title,$message,$fcmTokens));
    
            /* or */
    
            Larafirebase::withTitle($title)
                ->withBody($body)
                ->sendMessage($fcmTokens);
    
            return redirect()->back()->with('success','Notification Sent Successfully!!');
    
        }catch(\Exception $e){
            report($e);
            return redirect()->back()->with('error','Something goes wrong while sending notification.');
        }
    }
    }

