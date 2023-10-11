<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\PTKP;
use Illuminate\Support\Facades\DB;
class PtkpController extends Controller
{
    public function index(){
        return view('pages.contents.payroll.pph21.ptkp');
    }
    public function get_data(){
        $data = PTKP::all();
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn ='';
                    // if(Auth()->user()->canany('edit allowance')){
                        $btn .= '<div class="dropdown dropdown-action">
                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                        <div class="dropdown-menu dropdown-menu-right">';
                        // if(Auth()->user()->can('edit allowance')){
                            $btn .= '<a  data-id='.$row->id.' class="dropdown-item edit-ptkp" href="javascript:void(0)" ><i class="fa fa-pencil m-r-5"></i> Edit</a></div></div>';
                        // }

                        return $btn;
                    })
                ->rawColumns(['action'])
                ->make(true);
    }
    public function store(Request $request){
        $checked = PTKP::where('code',$request->code)->count(); 
        if($checked > 0 ){
            $res = [
                'status' => 'info',
                'msg'    => 'Data PTKP already !'
            ];
            return response()->json($res);
        }
         
       $save = PTKP::create([
                'name'   => $request->name,
                'code'   => $request->code,
                'value'  => $request->value,
            ]);
       if ($save){
            $res = [
                'status' => 'success',
                'msg'    => 'Data successfully Created !'
            ];
       }else{
        $res = [
                'status' =>'error',
                'msg'    =>'Data Fail Created !'
            ];
       }
       return response()->json($res);
    }
    public function edit(Request $request){
        $data = PTKP::where('id','=',$request->id)->first();
        return response()->json($data);
    }
    public function update(Request $request){
        $data = [
                'name'   => $request->name,
                'code'   => $request->code,
                'value'  => $request->value,
            ];

        $update = PTKP::where('id',$request->id)->update($data);
        if($update){
            $res = [
                'status' => 'success',
                'msg'    => 'Data successfully updated !'
            ];
        }else{
            $res = [
                'status' => 'success',
                'msg'    => 'Data faild updated!'
            ];
        }
        return response()->json($res);
    }

    public function destroy(Request $request){
        $del = PTKP::destroy($request->id);
        if ($del){
            $res = [
                'status' => 'success',
                'msg'    => 'Data successfully Deleted !'
            ];
       }else{
        $res = [
                'status' =>'error',
                'msg'    =>'Data Fail Deleted !',
            ];
       }
       return response()->json($res);
    }

}
