<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Information;
use App\Models\Sys;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InformationController extends Controller
{
    public function index(Request $request){
        $user = Branch::where('id',Auth::user()->branch_id)->first();
        if(Auth::user()->initial == "HO"){
            $branch['branch'] = Branch::where('company_id',$user->company_id)->get();
        }else{
            $branch['branch'] = Branch::where('id',$user->id)->get();
        }
        $branch['data'] = $request->data;
        return view('pages.contents.announcement.index', $branch);
    }
    public function get_data(Request $request){
        $data   = Information::where('branch_id','=',$request->branch_id)->get();
        return DataTables::of($data)
                        // ->addIndexColumn()
                        // ->addColumn('content', function($row){
                        //     $content = htmlspecialchars_decode(htmlspecialchars_decode($row->content));
                        //     return  $content;
                        // })
                        ->addColumn('action', function($row){
                            $btn ='';
                            if(Auth()->user()->canany('edit announcement')){
                                $btn .= '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">';
                                if(Auth()->user()->can('edit announcement')){
                                    $btn .= '<a data-id='.$row->id.' class="dropdown-item edit-announcement" href="javascript:void(0)" ><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                }
                                if(Auth()->user()->can('delete announcement')){
                                    $btn .= '<a data-id='.$row->id.' class="dropdown-item delete-announcement" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                }
                                if(Auth()->user()->can('publish announcement')){
                                    $btn .= '<a data-id='.$row->id.' class="dropdown-item publish-announcement" href="#"><i class="fa fa-share text-success m-r-5"></i> Publish</a>';
                                }
                                    $btn .= '</div></div>';
                                }
                                return $btn;
                            })
                        ->rawColumns(['action','content'])
                        ->make(true);
    }
    public function create(){
        $user = Branch::where('id',Auth::user()->branch_id)->first();
        if(Auth::user()->initial == "HO"){
            $branch['branch'] = Branch::where('company_id',$user->company_id)->get();
        }else{
            $branch['branch'] = Branch::where('id',$user->id)->get();
        }
        return view('pages.contents.announcement.add_announcement',$branch);
    }
    public function store(Request $request){   
        $user = Branch::where('id',Auth::user()->branch_id)->first();
        if(Auth::user()->initial == "HO"){
            $branch['branch'] = Branch::where('company_id',$user->company_id)->get();
        }else{
            $branch['branch'] = Branch::where('id',$user->id)->get();
        }
        $branch['data'] = $request->branch_id;
        $save = Information::create([
                    'date'          => date('Y-m-d'),
                    'title'         => $request->title,
                    'content'       => $request->content,
                    'content'       => $request->content,
                    'branch_id'     => $request->branch_id,
                    'created_by'    => Auth::user()->id,
                    'status'        =>0
                ]);

        return redirect()->route('get-announcement',$branch)->with('success', 'Branch  successfully created.');
    }
    public function edit(Request $request){
        $data['info'] = Information::find($request->id);
        return view('pages.contents.announcement.edit_announcement',$data);
    }
    public function update(Request $request){
        $user = Branch::where('id',Auth::user()->branch_id)->first();
        if(Auth::user()->initial == "HO"){
            $branch['branch'] = Branch::where('company_id',$user->company_id)->get();
        }else{
            $branch['branch'] = Branch::where('id',$user->id)->get();
        }
        $branch['data'] = $request->branch_id;
        $data = [
            'title'         => $request->title,
            'content'       => $request->content,
        ];
        $update = Information::where('id',$request->id)->update($data);
        return redirect()->route('branches.index',$branch)->with('success', 'Branch  successfully created.');
    }
    public function publish(Request $request){
        $data = [
            'status' => 1,
        ];
        $publish = Information::where('id',$request->id)->update($data);
        if($publish){
            $res = [
                'status' => 'success',
                'msg'    => 'Data success publish!',
            ];
        }else{
            $res = [
                'status' => 'success',
                'msg'    => 'Data not success publish!',
            ];
        }
        return response()->json($res);
    }
    public function destroy(Request $request){
        $del = Information::where('id',$request->id)->delete();
        if($del){
            $res = [
                'status' => 'success',
                'msg'    => 'Data success deleted!',
            ];
        }else{
            $res = [
                'status' => 'success',
                'msg'    => 'Data not success deleted!',
            ];
        }
        return response()->json($res);
    }

    public function get_notif(){
        $read = Sys::where('user_id',Auth::user()->id)->get();
        $pesan=[];
        foreach($read as $psn){
            array_push($pesan,$psn->information_id);
        }
        
        $notif = Information::select('information.*')->leftJoin('sys','sys.information_id','=','information.id')
                        ->where('information.branch_id',Auth::user()->branch_id)
                        ->where('information.status',1)
                        ->whereNotIn('information.id', $pesan)
                        ->get();
        return response()->json($notif);
    }
    public function clear_notif(Request $request){
        $read = Sys::where('user_id',Auth::user()->id)->get();
        $ps=[];
        foreach($read as $psn){
            array_push($ps,$psn->information_id);
        }
        $notif = Information::select('information.id')->leftJoin('sys','sys.information_id','=','information.id')
                            ->where('information.branch_id',Auth::user()->branch_id)
                            ->where('information.status',1)
                            ->whereNotIn('information.id', $ps)
                            ->get();
        $notifikasi = [];
        foreach($notif as $psn){
            $data = [
                'user_id' => Auth::user()->id,
                'information_id' => $psn->id
            ];
            $check = Sys::where('user_id',Auth::user()->id)->where('information_id',$psn->id)->count();
            if ($check <= 0){
                array_push($notifikasi,$data);
            }
        }
        Sys::insert($notifikasi);

        $read = Sys::where('user_id',Auth::user()->id)->get();
        $pesan=[];
        foreach($read as $psn){
            array_push($pesan,$psn->information_id);
        }
        
        $notif = Information::leftJoin('sys','sys.information_id','=','information.id')
                        ->where('information.branch_id',Auth::user()->branch_id)
                        ->where('information.status',1)
                        ->whereNotIn('information.id', $pesan)
                        ->count();
        $request->session()->put('notif', $notif);
    }
    public function list_notif(){
        $read = Sys::where('user_id',Auth::user()->id)->get();
        $pesan=[];
        foreach($read as $psn){
            array_push($pesan,$psn->information_id);
        }
        $notif['inbox'] = Information::select('information.*')->leftJoin('sys','sys.information_id','=','information.id')
                            ->where('information.branch_id',Auth::user()->branch_id)
                            ->where('information.status',1)
                            ->whereNotIn('information.id', $pesan)
                            ->get();
        $notif['inbox_read'] = Information::select('information.*')->leftJoin('sys','sys.information_id','=','information.id')
                            ->where('information.branch_id',Auth::user()->branch_id)
                            ->where('information.status',1)
                            ->whereIn('information.id', $pesan)
                            ->get();
        return view('pages.contents.announcement.list',$notif);
    }
    public function view_notif(Request $request){
        $notif['company'] = Branch::leftJoin('companies','companies.id','branches.company_id')->where('branches.id',Auth::user()->branch_id)->first();
        $notif['data'] = Information::where('id',$request->id)->first();
        $data = [
            'user_id' => Auth::user()->id,
            'information_id' => $request->id
        ];
        $check = Sys::where('user_id',Auth::user()->id)->where('information_id',$request->id)->count();
        if ($check <= 0){
            Sys::insert($data);
        }
        $read = Sys::where('user_id',Auth::user()->id)->get();
        $pesan=[];
        foreach($read as $psn){
            array_push($pesan,$psn->information_id);
        }
        
        $notifi = Information::leftJoin('sys','sys.information_id','=','information.id')
                        ->where('information.branch_id',Auth::user()->branch_id)
                        ->where('information.status',1)
                        ->whereNotIn('information.id', $pesan)
                        ->count();
        $request->session()->put('notif', $notifi);
        return view('pages.contents.announcement.view_inbox',$notif);
    }
}
