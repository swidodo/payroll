<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Master_limit_max_bpjs;
use Illuminate\Support\Facades\DB;

class Master_max_limit_bpjsController extends Controller
{
    public function index(){
        $user = Auth::user();
        $branch['branch'] = Branch::where('id',$user->branch_id)->get();
        return view('pages.contents.limit-bpjs.index', $branch);
    }
    public function get_data(){
        $branch  = Auth::user()->branch_id;
        $branch = Branch::where('id',$branch)->first();
        $data   = Master_limit_max_bpjs::all();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn ='';
                            if(Auth()->user()->canany('edit bpjs')){
                                $btn .= '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">';
                                if(Auth()->user()->can('edit bpjs')){
                                    $btn .= '<a  data-id='.$row->id.' class="dropdown-item edit-masterLimit-bpjs" href="javascript:void(0)" ><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                }
                                if(Auth()->user()->can('delete bpjs')){
                                    $btn .= '<a data-id='.$row->id.' class="dropdown-item delete-masterLimit-bpjs" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                }
                                    $btn .= '</div></div>';
                                }
                                return $btn;
                            })
                        ->rawColumns(['action'])
                        ->make(true);
    }
    public function store(Request $request){

        $check = Master_limit_max_bpjs::where('bpjs_code','=',$request->bpjs_code)->where('branch_id',Auth::user()->branch_id)->first();
        if($check != null){
            if ($check->bpjs_code != "" ){
                $data = [
                    'status' => 'error',
                    'msg'    => 'Sorry, Data is Ready !'
                ];
                return response()->json($data);
            }
        }
        if ($request->bpjs_code == "KSHT"){
            $bpjs= "BPJS KESEHATAN";
        }else if($request->bpjs_code == "JP"){
            $bpjs = "BPJS TK JP";
        }
        $branch = Auth::user()->branch_id;
        $save = Master_limit_max_bpjs::create([
                    'bpjs_code'     => $request->bpjs_code,
                    'bpjs_name'     => $bpjs,
                    'value'   => $request->value,
                    'branch_id'     => $branch,
                ]);

        if ($save){
            $res = [
                'status' => 'success',
                'msg'    => 'Data success saved !',
            ];
        }else{
            $res = [
                'status' => 'success',
                'msg'    => 'Data not success !, try again.',
            ];
        }
        return response()->json($res);
    }
    public function edit(Request $request){
        $data = Master_limit_max_bpjs::find($request->id);
        return response()->json($data);
    }
    public function update(Request $request){
        $update = DB::table('master_limit_max_bpjs')->where('id',$request->id)->update([
                        'value'  => $request->value
                    ]);
        if ($update){
            $res = [
                'status' => 'success',
                'msg'    => 'Data success updated !',
            ];
        }else{
            $res = [
                'status' => 'success',
                'msg'    => 'Data not success updated !, try again.',
            ];
        }
        return response()->json($res);
    }
    public function destroy(Request $request){
        $del = Master_limit_max_bpjs::destroy($request->id);
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
}
