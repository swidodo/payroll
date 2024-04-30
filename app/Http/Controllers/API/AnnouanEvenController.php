<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Information;
use App\Models\Even;
use App\Models\Sys;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AnnouanEvenController extends Controller
{
    public function index(){
        $annou = Information::where('branch_id',Auth::user()->branch_id)
                                ->where('status',1)
                                ->get();
        $even  = Even::where('branch_id',Auth::user()->branch_id)
                            ->where('status',1)
                            ->get();
        $announcment=[];
        // foreach($annou as $an){
        //     $announ = [
        //                 'id'    => $an->id,
        //                 'name'  => 'announcment',
        //                 'title' => 'title',
        //                 'value' => $an->title
        //             ];
            // $announ1 = [
            //             'name'  => 'announcment',
            //             'title' => 'image',
            //             'id'    => $an->id,
            //             'value' => $an->image
            //         ];
            // $announ2 = [
            //                 'name'  => 'announcment',
            //                 'title' => 'body',
            //                 'id'    => $an->id,
            //                 'value' => $an->content
            //             ];
            // array_push($announcment,$announ);
            // array_push($announcment,$announ1);
            // array_push($announcment,$announ2);
        // }
        // $event=[];
        // foreach($even as $ev){
        //     $evn =[
        //             'name'  => 'event',
        //             'title' => 'title',
        //             'id'    => $ev->id,
        //             'value' => $ev->title
        //         ];
        //     $evn1 = [
        //                 'name'  => 'event',
        //                 'title' => 'image',
        //                 'id'    => $ev->id,
        //                 'value' => $ev->image
        //             ];
        //     $evn2 = [
        //                 'name'  => 'event',
        //                 'title' => 'body',
        //                 'id'    => $ev->id,
        //                 'value' => $ev->content
        //             ];
        //     array_push($event,$evn);
        //     array_push($event,$evn1);
        //     array_push($event,$evn2);
        // }
    
        $resData = [
                'announcement' => $annou,
                'event'         => $even 
            ];
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $resData,
        ], Response::HTTP_OK);
    }
    public function detail(Request $request){
        // $notif['company'] = Branch::leftJoin('companies','companies.id','branches.company_id')->where('branches.id',Auth::user()->branch_id)->first();
        if ($request->name =='announcement'){
            $notif = Information::where('id',$request->id)->where('branch_id',Auth::user()->branch_id)->first();
            $dtl = [
                [
                    'title' => 'title',
                    'value' => $notif->title
                ],
                [
                    'title' => 'image',
                    'value' => $notif->image
                ],
                [
                    'title' => 'content',
                    'value' => $notif->content
                ]
            ];
        }
        if ($request->name =='event'){
            $notif = Even::where('id',$request->id)->where('branch_id',Auth::user()->branch_id)->first();
            $dtl = [
                [
                    'title' => 'title',
                    'value' => $notif->title
                ],
                [
                    'title' => 'image',
                    'value' => $notif->image
                ],
                [
                    'title' => 'content',
                    'value' => $notif->content
                ]
            ];
        }
        $data = [
            'user_id' => Auth::user()->id,
            'information_id' => $request->id,
            'name' => $request->name
        ];
        
        $check = Sys::where('user_id',Auth::user()->id)->where('information_id',$request->id)->where('name',$request->name)->count();
        if ($check <= 0){
            Sys::insert($data);
        }
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $dtl,
        ], Response::HTTP_OK);
    }
    public function announcement(Request $request){
        $annou = Information::where('branch_id',Auth::user()->branch_id)
                                ->where('status',1)
                                ->get();
        $resData = [
                'announcement' => $annou,
            ];
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $resData,
        ], Response::HTTP_OK);
    }
     public function event(Request $request){
       $even  = Even::where('branch_id',Auth::user()->branch_id)
                            ->where('status',1)
                            ->get();
        $resData = [
                'event' => $even,
            ];
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $resData,
        ], Response::HTTP_OK);
    }
}
