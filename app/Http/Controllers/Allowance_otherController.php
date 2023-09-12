<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\Allowance_other;
use App\Models\AllowanceOption;
use Illuminate\Support\Facades\DB;

class Allowance_otherController extends Controller
{
     public function index(){
        $user = Auth::user();
        $branch['branch'] = Branch::where('id',$user->branch_id)->get();
        $branch['employee'] = Employee::where('branch_id','=',$user->branch_id)->get();
        $branch['allowanceTypes'] = AllowanceOption::where('branch_id','=',$user->branch_id)->get();
        return view('pages.contents.allowance.allowance_other', $branch);
     }
     public function get_data(){
        $branch  = Auth::user()->branch_id;
        $branchs = Branch::where('id',$branch)->first();
        $data   = Allowance_other::where('branch_id','=',$branchs->id)->with('employee','allowance_type')->get();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn ='';
                            // if(Auth()->user()->canany('edit allowance')){
                                $btn .= '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">';
                                // if(Auth()->user()->can('edit allowance')){
                                    $btn .= '<a  data-id='.$row->id.' class="dropdown-item edit-allowance-other" href="javascript:void(0)" ><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                // }
                                // if(Auth()->user()->can('delete allowance')){
                                    $btn .= '<a data-id='.$row->id.' class="dropdown-item delete-allowance-other" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                // }
                                    
                                // }
                                return $btn;
                            })
                        ->rawColumns(['action'])
                        ->make(true);
    }
     public function store(Request $request){
        $validate = $this->validate($request, [
            'employee_id'           => 'required|string',
            'allowance_option_id'   => 'required|string',
            'date'                  => 'required|date',
            'amount'                => 'required',
        ]);
        if($validate == false){
            return response()->json($validate);
        }
        $checked = Allowance_other::where('employee_id','=',$request->employee_id)
                                    ->where('date','=',$request->date)
                                    ->where('allowance_option_id','=',$request->allowance_option_id)->count();
        if($checked > 0 ){
            $res = [
                'status' => 'info',
                'msg'    => 'Data already !'
            ];
            return response()->json($res);
        }
       $save = Allowance_other::create([
                'employee_id'           => $request->employee_id,
                'allowance_option_id'   => $request->allowance_option_id,
                'date'                  => $request->date,
                'amount'                => $request->amount,
                'created_by'            => Auth::user()->id,
                'branch_id'             => Auth::user()->brach_id,
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
        $data = Allowance_other::where('id','=',$request->id)->with('employee')->first();
        $data['allowance_type'] = AllowanceOption::where('branch_id','=',Auth::user()->branch_id)->get();
        return response()->json($data);
     }
     public function update(Request $request){
        $data = [
            'date'                  => $request->date,
            'allowance_option_id'   => $request->allowance_option_id,
            'amount'                =>$request->amount
        ];
        $update = Allowance_other::where('id',$request->id)->update($data);
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
        $del = Allowance_other::destroy($request->id);
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
