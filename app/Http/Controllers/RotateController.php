<?php

namespace App\Http\Controllers;

use App\models\Rotate;
use App\models\Employee;
use App\models\Branch;
use App\models\AccessBranch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use DataTables;
use Response;
use Exception;

class RotateController extends Controller
{
    public function index()
    {
        $branch = DB::table('branches')
                    ->select('*')
                    ->where('id',Auth::user()->branch_id)
                    ->first();
        $emp = DB::table('employees')->where('user_id',Auth::user()->id)->first();
        if(Auth::user()->initial == "HO"){
            if (Auth::user()->type == "company"){
                $data['branch'] = DB::table('branches')
                        ->select('*')
                        ->where('company_id',$branch->company_id)
                        ->get();
            }else{
                $data['branch'] = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                ->where('access_branches.employee_id',$emp->id)
                                                ->where('access_branches.company_id', $branch->company_id)->get();
            }
        }else{
            $data['branch'] =  DB::table('branches')
                    ->select('*')
                    ->where('id',Auth::user()->branch_id)
                    ->get();
        }
        return view('pages.contents.rotate.index',$data);
    }
    public function get_data_rotate(Request $request){
        $data   = DB::table('rotates')
                    ->leftJoin('position','position.id','=','rotates.position_id')
                    ->select('rotates.*','position.position_name')
                    ->orderBy('rotates.id','DESC')
                    ->where('rotates.branch_id',$request->branch_id)
                    ->get();
        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn ='';
                            if(Auth()->user()->can('edit rotation')){
                                $btn .= '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">';
                                if(Auth()->user()->can('edit rotation')){
                                    $btn .= '<a  data-id='.$row->id.' class="dropdown-item edit_rotate" href="javascript:void(0)" ><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                }
                                
                                    $btn .= '</div></div>';
                                }
                                return $btn;
                            })
                        ->rawColumns(['action'])
        ->make(true);
    }
    public function create()
    {

    }
    
    public function show($id)
    {
        $rotate = Rotate::where('employee_id',$id)->get();
        return reponse()->json($rotate);
    }
    public function edit(Request $request)
    {
        $user = Auth::user();
        $id = $request->id;
        $branch = DB::table('branches')
                    ->select('company_id','id','name')
                    ->where('id',$user->branch_id)
                    ->get();
        $company = DB::table('companies')
                    ->select('id','name')
                    ->where('id',$branch[0]->company_id)
                    ->get();
        $department = DB::table('departements')
                         ->select('id','name')
                         ->where('branch_id',$user->branch_id)
                         ->get();
        $employee = DB::table('employees')
                        ->select('id','name')
                        ->where('branch_id',$user->branch_id)
                        ->get();
         $position = DB::table('position')
                        ->select('id','position_name')
                        ->where('branch_id',$user->branch_id)
                        ->get();
        $rotate = DB::table('rotates')
                    ->where('id',$id)->first();
        $data = [
            'branch'        => $branch,
            'company'       => $company,
            'department'    => $department,
            'position'      => $position,
            'employee'      => $employee,
            'rotation'      => $rotate
        ];
        return response()->json($data);
    }
    public function update(Request $request)
    {
       
        try {
             DB::beginTransaction();
            $user = Auth::user();
            $dt_from_depart = DB::table('departements')
                                ->select('name')
                                ->where('id',$request->from_department)
                                ->first();
            $dt_to_depart = DB::table('departements')
                                ->select('name')
                                ->where('id',$request->to_department)
                                ->first();
            $employee = DB::table('employees')
                                ->select('name')
                                ->where('id',$request->employee_id)
                                ->first();

            $data = [
                    'rotate_date'           => $request->rotate_date,
                    'rotate_name'           => $request->rotate_name,
                    'employee_id'           => $request->employee_id,
                    'employee_name'         => $employee->name,
                    'from_department_id'    => $request->from_department,
                    'from_department_name'  => $dt_from_depart->name,
                    'to_department_id'      => $request->to_department,
                    'to_department_name'    => $dt_to_depart->name,
                    'branch_id'             => $request->branch_id,
                    'branch_name'           => $request->branch_name,
                    'company_id'            => $request->company_id,
                    'company_name'          => $request->company_name,
                    'position_id'           => $request->position_id,
                    'update_by'             => $user->id,
                    'updated_at'            => date('Y-m-d h:m:s')
                ];
                $update = [
                    'department_id' => $request->to_department,
                    'position_id'   => $request->position_id,
                ];
                DB::table('employees')
                    ->where ('id',$request->employee_id)
                    ->update($update);
                DB::table('rotates')
                    ->where('id',$request->id)
                    ->update($data);
                DB::commit();
                $response = [
                    'status' => 'success',
                    'msg'    => 'Insert data success !',
                ];
                return $response;
        }catch (Exception $e) {
            DB::rollBack();
             $response = [
                    'status' => 'error',
                    'msg'    => 'Sameting went wrong !',
                ];
             return $response;
        }
    }
    public function destroy($id)
    {

        $del = Rotate::destroy($id);
        if ($del == true){
            $response = [
                'status' => 'success',
                'msg'    => 'Delete from Rotation success !',
            ];
            return response()->json($response);
        }
    }
    public function get_branch(Request $request){
        // $user = Auth::user();
        $branch =  DB::table('branches')
                    ->select('company_id','id','name')
                    ->where('id',$request->branch_id)
                    ->first();
        $company = DB::table('companies')
                    ->select('id','name')
                    ->where('id',$branch->company_id)
                    ->get();
        $department = DB::table('departements')
                         ->select('id','name as department_name')
                         ->where('branch_id',$request->branch_id)
                         ->get(); 
        $position = DB::table('position')
                         ->select('id','position_name')
                         ->where('branch_id',$request->branch_id)
                         ->get();
        $employee = DB::table('employees')
                        ->select('id','no_employee','name')
                        ->where('branch_id',$request->branch_id)
                        ->get();
        $data = [
            'branch'        => $branch,
            'company'       => $company,
            'department'    => $department,
            'employee'      => $employee,
            'position'      => $position
        ];
        return response()->json($data);
    }
    public function get_employee(Request $request){
        $branchId = $request->branch_id;
        $employee = Employee::select('id','no_employee','name')
                            ->where('branch_id',$branchId)
                            ->get();
        return response()->json($employee);
    }
    public function save_rotation(Request $request){
      
        try {
             DB::beginTransaction();
             $user = Auth::user();
                $dt_from_depart = DB::table('departements')
                                    ->select('name')
                                    ->where('id',$request->from_department)
                                    ->first();

                $dt_to_depart = DB::table('departements')
                                    ->select('name')
                                    ->where('id',$request->to_department)
                                    ->first();
                $employee = DB::table('employees')
                                    ->select('name')
                                    ->where('id',$request->employee_id)
                                    ->first();
                $data = [
                    'rotate_date'           => $request->rotate_date,
                    'rotate_name'           => $request->rotate_name,
                    'employee_id'           => $request->employee_id,
                    'employee_name'         => $employee->name,
                    'from_department_id'    => $request->from_department,
                    'from_department_name'  => $dt_from_depart->name,
                    'to_department_id'      => $request->to_department,
                    'to_department_name'    => $dt_to_depart->name,
                    'branch_id'             => $request->branch_id,
                    'branch_name'           => $request->branch_name,
                    'company_id'            => $request->company_id,
                    'company_name'          => $request->company_name,
                    'position_id'           => $request->position_id,
                    'create_by'             => $user->id,
                    'created_at'            => date('Y-m-d h:m:s')
                ];

                $update = [
                    'department_id' => $request->to_department,
                    'position_id'   => $request->position_id,
                ];
                DB::table('employees')
                    ->where ('id',$request->employee_id)
                    ->update($update);
                DB::table('rotates')
                ->insert($data);
                DB::commit();
                $response = [
                    'status' => 'success',
                    'msg'    => 'Insert data successfuly !',
                ];
                return $response;
        }catch (Exception $e) {
            DB::rollBack();
             $response = [
                    'status' => 'error',
                    'msg'    => 'Something went wrong !',
                ];
                return $response;
           
        }
    }
}
