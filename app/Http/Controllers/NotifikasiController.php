<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\Message;
use Kreait\Firebase\Messaging\Notification;

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
        }catch(\Exception $e){
            report($e);
            return response()->json([
                'success'=>false
            ],500);
        }
    }
    public function notification()
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
    
    }

