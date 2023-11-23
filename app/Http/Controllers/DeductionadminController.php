<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\Deduction_admin;
use App\Models\AccessBranch;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeductionadminController extends Controller
{
    public function index(){
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        $emp = Employee::where('user_id',Auth::user()->id)->first();
        
        if(Auth::user()->initial =="HO"){
            if (Auth::user()->type == "company"){
                $data['branch'] = Branch::where('company_id',$branch->company_id)->get();
            }else{
                $data['branch'] = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                ->where('access_branches.employee_id',$emp->id)
                                                ->where('access_branches.company_id',$branch->company_id)->get();
            }
        }else{
            $data['branch'] = Branch::where('id',$branch->id)->get();
        }
        return view('pages.contents.deduction_admin.index',$data);
    }
    public function get_data(Request $request){
        $data = Deduction_admin::select('deduction_admins.*','branches.name as branch_name')
                                ->leftJoin('branches','branches.id','deduction_admins.branch_id')
                                ->where('deduction_admins.branch_id',$request->branch_id)->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                 $btn ='';
                    if(Auth()->user()->canany('edit deduction admin','delete deduction admin')){
                        $btn .= '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">';
                       if(Auth()->user()->can('edit deduction admin')){
                            $btn .= '<a  data-id ="'.$row->id.'" class="dropdown-item edit-deduction_admin" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_deduction_admin"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                        }
                        if(Auth()->user()->can('delete deduction admin')){
                            $btn .='<a  data-id="'.$row->id.'" class="dropdown-item delete-data-deduction_admin" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                        }
                    }
                    return $btn;
                    })
                ->rawColumns(['action'])
                ->make(true);
    }
    public function store(Request $request){
        $data = [
            'branch_id'     => $request->branch_id,
            'name'          => $request->name,
            'amount'        => $request->amount,
            'created_by'    => Auth::user()->id,
        ];
        $insert = Deduction_admin::create($data);
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
        $data = Deduction_admin::select('deduction_admins.*','branches.name as branch_name')
                                ->leftJoin('branches','branches.id','=','deduction_admins.branch_id')
                                ->where('deduction_admins.id',$request->id)->first();
        return response()->json($data);
    }
    public function update(Request $request){
        $data = [
            'name'          => $request->name,
            'amount'        => $request->amount,
            'updated_by'    => Auth::user()->id,
            'updated_at'    => date('Y-m-d h:m:s'),
        ];
        $update = Deduction_admin::where('id',$request->id)->update($data);
        if ($update){
            $res = [
                'status' =>'success',
                'msg'    =>'Update data successfuly !',
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
        $del = Deduction_admin::destroy($request->id);
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
