<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approval;
use App\Models\Branch;
use App\Models\Departement;
use App\Models\Employee;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ApprovalController extends Controller
{
    public function index(){
        $branch         = Branch::where('id',Auth::user()->branch_id)->first();
        $data['branch'] = Branch::where('company_id', $branch->company_id)->get();
        return view('pages.contents.approvel.index',$data);
    }
    public function get_data(Request $request){
        $data = Approval::select('level_approvals.*','employees.no_employee',
                                'employees.name',
                                'branches.name as branch_name',
                                'departements.name as department_name')
                        ->leftJoin('employees','employees.id','=','level_approvals.employee_id')
                        ->leftJoin('branches','branches.id','=','level_approvals.branch_id')
                        ->leftJoin('departements','departements.id','=','level_approvals.department_id')
                        ->where('level_approvals.branch_id',$request->branch_id)
                        ->where('level_approvals.department_id',$request->department_id)
                        ->get();
        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn ='';
                            if(Auth()->user()->canany('edit master approval','delete master approval')){
                                $btn .= '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">';
                                if(Auth()->user()->can('edit master approval')){
                                    $btn .= '<a  data-id='.$row->id.' class="dropdown-item edit-approval" href="javascript:void(0)" ><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                }
                                if(Auth()->user()->can('delete master approval')){
                                    $btn .= '<a data-id='.$row->id.'  class="dropdown-item delete-approval" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                }
                                    $btn .= '</div></div>';
                                }
                                return $btn;
                            })
                        ->rawColumns(['action'])
                        ->make(true);
    }
    public function create_data(Request $request){
        $data['department'] = Departement::where('branch_id',$request->branch_id)->get();
        return response()->json($data);
    }
    public function get_data_emp(Request $request){
        $data = Employee::select('employees.*')
                        ->leftJoin('position','position.id','employees.position_id')
                        ->where('employees.branch_id',$request->branch_id)
                        ->whereIn('position.position_code',['LEADER','SUPERVISOR','MANAGER','GM'])
                        ->get();
        return response()->json($data);
    }
    public function store(Request $request){
        $check = Approval::where('employee_id',$request->employee_id)
                            ->where('department_id',$request->department_id)
                            ->where('branch_id',$request->branch_id)
                            ->count();
        if ($check > 0){
            $res = [
                'status' => 'info',
                'msg'    => 'User Approval Ready in Department!.'
            ];
            return response()->json($res);
        }
        $cekLevel = Approval::where('department_id',$request->department_id)
                            ->where('level',$request->level)
                            ->where('branch_id',$request->branch_id)
                            ->count();
        if ($check > 0){
            $res = [
                'status' => 'info',
                'msg'    => 'User Level This Ready !'
            ];
            return response()->json($res);
        }
        try {
            $data = [
                'level'         => $request->level,
                'employee_id'   => $request->employee_id,
                'branch_id'     => $request->branch_id,
                'department_id' => $request->department_id,
            ];
            Approval::create($data);
            $res = [
                'status' => 'success',
                'msg'    => 'Approval successfuly created.'
            ];
            return response()->json($res);
        }catch(Exeption $e){
            $res = [
                'status' => 'error',
                'msg'    => 'Something went wrong!'
            ];
            return response()->json($res);
        }

    }
    public function edit(Request $request){
       
        $data['approval'] = Approval::select('level_approvals.*','branches.name as branch_name')
                                    ->leftJoin('branches','branches.id','=','level_approvals.branch_id')
                                    ->where('level_approvals.id',$request->id)->first();
        $data['department'] = Departement::where('branch_id',$data['approval']->branch_id)->get();
        $data['employee'] = Employee::select('employees.*')
                                    ->leftJoin('position','position.id','employees.position_id')
                                    ->where('employees.branch_id',$data['approval']->branch_id)
                                    ->whereIn('position.position_code',['LEADER','SUPERVISOR','MANAGER','GM'])
                                    ->get();
        return response()->json($data);
    }
    public function update(Request $request){
        $check = Approval::where('id','<>',$request->id)
                            ->where('employee_id',$request->employee_id)
                            ->where('branch_id',$request->branch_id)
                            ->where('department_id',$request->department_id)
                            ->count();
        if ($check > 0){
            $res = [
                'status' => 'info',
                'msg'    => 'User Approval Ready in Department!.'
            ];
            return response()->json($res);
        }
        $cekLevel = Approval::where('department_id',$request->department_id)
                            ->where('level',$request->level)
                            ->where('branch_id',$request->branch_id)
                            ->where('id','<>',$request->id)
                            ->count();
        if ($check > 0){
            $res = [
                'status' => 'info',
                'msg'    => 'User Level This Ready !'
            ];
            return response()->json($res);
        }
        try {
            $data = [
                'level'         => $request->level,
                'employee_id'   => $request->employee_id,
            ];
            Approval::where('id',$request->id)->update($data);
            $res = [
                'status' => 'success',
                'msg'    => 'Approval successfuly updated.'
            ];
            return response()->json($res);
        }catch(Exeption $e){
            $res = [
                'status' => 'error',
                'msg'    => 'Something went wrong!'
            ];
            return response()->json($res);
        }
    }
    public function destroy(Request $request){
        try{
            Approval::where('id',$request->id)->delete();
            $res = [
                'status' => 'success',
                'msg'    => 'Approval successfuly Deleted                                       .'
            ];
            return response()->json($res);
        }catch(Exception $e){
            $res = [
                'status' => 'error',
                'msg'    => 'Something went wrong!'
            ];
            return response()->json($res);
        }
    }
    
}
