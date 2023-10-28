<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\Deduction_other;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeductionOtherController extends Controller
{
    public function index(){
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        if(Auth::user()->initial =="HO"){
            $data['branch'] = Branch::where('company_id',$branch->company_id)->get();
        }else{
            $data['branch'] = Branch::where('id',$branch->id)->get();
        }
        return view('pages.contents.deduction_other.index',$data);
    }
    public function get_data(Request $request){
        $data = Deduction_other::select('deduction_others.*','employees.no_employee','employees.name as employee_name')
                                ->leftJoin('employees','employees.id','deduction_others.employee_id')
                                ->where('deduction_others.branch_id',$request->branch_id)->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                 $btn ='';
                    if(Auth()->user()->canany('edit deduction other','delete deduction other')){
                        $btn .= '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">';
                       if(Auth()->user()->can('edit deduction other')){
                            $btn .= '<a  data-id ="'.$row->id.'" class="dropdown-item edit-deduction_other" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_deduction_other"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                        }
                        if(Auth()->user()->can('delete deduction other')){
                            $btn .='<a  data-id="'.$row->id.'" class="dropdown-item delete-data-deduction_other" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                        }
                    }
                    return $btn;
                    })
                ->rawColumns(['action'])
                ->make(true);
    }
    public function create(Request $request){
        $data['employee'] = Employee::where('branch_id',$request->branch_id)->get();
        return response()->json($data);
    }
    public function store(Request $request){
        $data = [
            'employee_id'   => $request->employee_id,
            'branch_id'     => $request->branch_id,
            'name'          => $request->name,
            'amount'        => $request->amount,
            'date'          => $request->date,
            'created_by'    => Auth::user()->id,
        ];
        $insert = Deduction_other::create($data);
        if ($insert){
            $res = [
                'status' =>'success',
                'msg' =>'Created data successfuly !',
            ];
        }else{
            $res = [
                'status' =>'error',
                'msg' =>'Sameting went wrong !',
            ];
        }
        return response()->json($res);
    }
    public function edit(Request $request){
        $data = Deduction_other::select('deduction_others.*','employees.no_employee','employees.name as employee_name')->leftJoin('employees','employees.id','=','deduction_others.employee_id')->where('deduction_others.id',$request->id)->first();
        return response()->json($data);
    }
    public function update(Request $request){
        $data = [
            'date'          => $request->date,
            'name'          => $request->name,
            'amount'        => $request->amount,
            'updated_by'    => Auth::user()->id,
            'updated_at'    => date('Y-m-d h:m:s'),
        ];
        $update = Deduction_other::where('id',$request->id)->update($data);
        if ($update){
            $res = [
                'status' =>'success',
                'msg' =>'Update data successfuly !',
            ];
        }else{
            $res = [
                'status' =>'error',
                'msg' =>'Sameting went wrong !',
            ];
        }
        return response()->json($res);
    }
    public function destroy(Request $request){
        $del = Deduction_other::destroy($request->id);
        if ($del){
            $res = [
                'status' =>'success',
                'msg' =>'Update data successfuly !',
            ];
        }else{
            $res = [
                'status' =>'error',
                'msg' =>'Sameting went wrong !',
            ];
        }
        return response()->json($res);
    }
}
