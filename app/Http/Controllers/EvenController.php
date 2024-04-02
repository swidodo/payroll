<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Even;
use App\Models\Sys;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
class EvenController extends Controller
{
    public function index(Request $request){
        $user = Branch::where('id',Auth::user()->branch_id)->first();
        if(Auth::user()->initial == "HO"){
            $branch['branch'] = Branch::where('company_id',$user->company_id)->get();
        }else{
            $branch['branch'] = Branch::where('id',$user->id)->get();
        }
        $branch['data'] = $request->data;
        return view('pages.contents.even.index', $branch);
    }
    public function get_data(Request $request){
        $data   = Even::where('branch_id','=',$request->branch_id)->get();
        return DataTables::of($data)
                        ->addColumn('action', function($row){
                            $btn ='';
                            if(Auth()->user()->canany('edit even')){
                                $btn .= '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">';
                                if(Auth()->user()->can('edit even')){
                                    $btn .= '<a data-id='.$row->id.' class="dropdown-item edit-even" href="javascript:void(0)" ><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                }
                                if(Auth()->user()->can('delete even')){
                                    $btn .= '<a data-id='.$row->id.' class="dropdown-item delete-even" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                }
                                if(Auth()->user()->can('publish even')){
                                    $btn .= '<a data-id='.$row->id.' class="dropdown-item publish-even" href="#"><i class="fa fa-share text-success m-r-5"></i> Publish</a>';
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
        return view('pages.contents.even.add_even',$branch);
    }
    public function store(Request $request){   
        $user = Branch::where('id',Auth::user()->branch_id)->first();
        if(Auth::user()->initial == "HO"){
            $branch['branch'] = Branch::where('company_id',$user->company_id)->get();
        }else{
            $branch['branch'] = Branch::where('id',$user->id)->get();
        }
        $branch['data'] = $request->branch_id;
        // upload file
        if(isset($request->image)){
            $dta = Branch::select('branches.name as branch_name','companies.name as company_name')
                        ->leftJoin('companies','companies.id','=','branches.company_id')
                        ->where('branches.id',Auth::user()->branch_id)->first();
            $company    =  $dta->branch_name;
            $branch     =  $dta->company_name;
            $tahun      =  date('Y');
            $bulan      =  date('m');
            $tanggal    =  date('d-m-Y');

            $dir        = $company.'/'.$branch.'/'.$tahun.'/'.$bulan.'/'.$tanggal.'/';
            $path = 'even/'.$dir.$request->get('image');
            if (! Storage::exists($path)) {
                Storage::makeDirectory($path,775,true);
            }

            $fileName = time() . $request->file('image')->getClientOriginalName();
            $store = $request->file('image')->storeAs('public/'.$path, $fileName);
            $pathFile_application = 'storage/app/'.$path . $fileName ?? null;
            $base = URL::to('/');
            $linkAttach = $base.'/'.$pathFile_application;
        }else{
            $linkAttach = null;
        }
        $save = Even::create([
                    'date'          => date('Y-m-d'),
                    'title'         => $request->title,
                    'image'         => $linkAttach,
                    'content'       => $request->content,
                    'branch_id'     => $request->branch_id,
                    'created_by'    => Auth::user()->id,
                    'status'        =>0
                ]);

        return redirect()->route('get-even',$branch)->with('success', 'Branch  successfully created.');
    }
    public function edit(Request $request){
        $data['info'] = Even::find($request->id);
        return view('pages.contents.even.edit_even',$data);
    }
    public function update(Request $request){
        $user = Branch::where('id',Auth::user()->branch_id)->first();
        if(Auth::user()->initial == "HO"){
            $branch['branch'] = Branch::where('company_id',$user->company_id)->get();
        }else{
            $branch['branch'] = Branch::where('id',$user->id)->get();
        }
        $branch['data'] = $request->branch_id;

        // upload data
        $linkId = Even::where('id',$request->id)->first();
                        
        if(isset($request->attachment_request_path)){
            $dir        = $company.'/'.$branch.'/'.$tahun.'/'.$bulan.'/'.$tanggal.'/';
            $path = 'even/'.$dir.$request->get('image');
            if (! Storage::exists($path)) {
                Storage::makeDirectory($path,775,true);
            }
            
            $fileName = time() . $request->file('image')->getClientOriginalName();
            $store = $request->file('image')->storeAs($path, $fileName);
            $pathFile_application = 'storage/app/public/'.$path . $fileName ?? null;
            $base = URL::to('/');
            $link_attach = $base.'/'.$pathFile_application;

            $hide = $base.'/storage/app/';
            $storagePublic = str_replace($hide,'',$linkId->image);
            if (Storage::exists($storagePublic)) {
                Storage::delete($storagePublic);
            }
    
        }else{
            $link_attach = $linkId->image;
        }
        $data = [
            'title'         => $request->title,
            'image'         => $request->image,
            'content'       => $request->content,
        ];
        $update = Even::where('id',$request->id)->update($data);
        return redirect()->route('get-even',$branch)->with('success', 'Even  successfully updated.');
    }
    public function publish(Request $request){
        $data = [
            'status' => 1,
        ];
        $publish = Even::where('id',$request->id)->update($data);
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
        $linkId = Even::where('id',$request->id)->first();
        $base = URL::to('/');
        $hide = $base.'/storage/app/public';
        $storagePublic = str_replace($hide,'',$linkId->attachment_request_path);
        if (Storage::exists($storagePublic)) {
            Storage::delete($storagePublic);
        }
        $del = Even::where('id',$request->id)->delete();
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
            array_push($pesan,$psn->Even_id);
        }
        
        $notif = Even::select('information.*')->leftJoin('sys','sys.information_id','=','information.id')
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
        $notif = Even::select('information.id')->leftJoin('sys','sys.information_id','=','information.id')
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
        
        $notif = Even::leftJoin('sys','sys.information_id','=','information.id')
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
        $notif['inbox'] = Even::select('information.*')->leftJoin('sys','sys.information_id','=','information.id')
                            ->where('information.branch_id',Auth::user()->branch_id)
                            ->where('information.status',1)
                            ->whereNotIn('information.id', $pesan)
                            ->get();
        $notif['inbox_read'] = Even::select('information.*')->leftJoin('sys','sys.information_id','=','information.id')
                            ->where('information.branch_id',Auth::user()->branch_id)
                            ->where('information.status',1)
                            ->whereIn('information.id', $pesan)
                            ->get();
        return view('pages.contents.even.list',$notif);
    }
    public function view_notif(Request $request){
        $notif['company'] = Branch::leftJoin('companies','companies.id','branches.company_id')->where('branches.id',Auth::user()->branch_id)->first();
        $notif['data'] = Even::where('id',$request->id)->first();
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
        
        $notifi = Even::leftJoin('sys','sys.information_id','=','information.id')
                        ->where('information.branch_id',Auth::user()->branch_id)
                        ->where('information.status',1)
                        ->whereNotIn('information.id', $pesan)
                        ->count();
        $request->session()->put('notif', $notifi);
        return view('pages.contents.even.view_inbox',$notif);
    }
}