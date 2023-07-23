<?php

namespace App\Http\Controllers;

use App\models\RotateModel;
use App\models\Employee;
use App\models\Branch;
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
        return view('pages.contents.rotate.index');
    }
    public function get_data_rotate(){
        $user   = Auth::user();
        $branch = DB::table('branches')
                    ->select('*')
                    ->where('id',$user->branch_id)
                    ->get();
        $data   = DB::table('rotates')
                    ->select('*')
                    ->orderBy('id','DESC')
                    ->get();
        return DataTables::of($data)->make(true);
    }
    public function create()
    {

    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        $employee_name = Employee::select('employee_name')
                                    ->where('employee_id',$request->employee_id)
                                    ->where('branch_id',$request->branch_id)
                                    ->where('company_id',$request->company_id)
                                    ->first();
        $branch_id = Branch::select('branch_name')
                                ->where('branch_id',$request->branch_id)
                                ->where('company_id',$request->company_id)
                                ->first();
        $company_id = Company::select('company_name')
                                ->where('company_id',$request->company_id)
                                ->first();
        $from_department_id = Department::select('department_name')
                                        ->where('branch_id',$request->branch_id)
                                        ->where('company_id',$request->company_id)
                                        ->where('from_department_id',$request->department_id)
                                        ->first();
        $to_department_id = Department::select('department_name')
                                    ->where('to_department_id',$request->department_id)
                                    ->where('branch_id',$request->branch_id)
                                    ->where('company_id',$request->company_id)
                                    ->first();

        try {
            $data = [
                'employee_id'           => $request->employee_id,
                'branch_id'             => $request->branch_id,
                'company_id'            => $request->company_id,
                'from_department_id'    => $request->from_department_id,
                'to_department_id'      => $request->to_department_id,
                'employee_name'         => $employee_name,
                'branch_name'           => $branch_name,
                'from_department_name'  => $from_name,
                'to_department_name'    => $to_name,
                'updated_at'            => $update,
            ];
            $data_employee = [
                'department_id' =>$request->to_department_id,
            ];
            Rotate::insert($data);
            DB::table('employee')->where('id',$request->employee_id)->update($data_employee);
            $response = [
                'status' => 'success',
                'msg'    => 'Insert data success !',
            ];
            DB::commit();
            return reponse()->json($response);

        }
        catch (Exception $e) {
            DB::rollBack();
        }

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
        $department = DB::table('departments')
                         ->select('id','department_name')
                         ->where('branch_id',$user->branch_id)
                         ->get();
        $employee = Employee::select('id','name')
                        ->where('branch_id',$user->branch_id)
                        ->get();
        $rotate = Rotate::where('id',$id)->first();
        $data = [
            'branch'        => $branch,
            'company'       => $company,
            'department'    => $department,
            'employee'      => $employee,
            'rotation'      => $rotate
        ];
        return response()->json($data);
    }
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $dt_from_depart = DB::table('departments')
                                ->select('department_name')
                                ->where('id',$request->from_department)
                                ->get();
            $dt_to_depart = DB::table('departments')
                                ->select('department_name')
                                ->where('id',$request->to_department)
                                ->get();
            $employee = DB::table('employees')
                                ->select('name')
                                ->where('id',$request->employee_id)
                                ->get();
            $data = [
                    'rotate_date'           => $request->rotate_date,
                    'rotate_name'           => $request->rotate_name,
                    'employee_id'           => $request->employee_id,
                    'employee_name'         => $employee[0]->name,
                    'from_department_id'    => $request->from_department,
                    'from_department_name'  => $dt_from_depart[0]->department_name,
                    'to_department_id'      => $request->to_department,
                    'to_department_name'    => $dt_to_depart[0]->department_name,
                    'branch_id'             => $request->branch_id,
                    'branch_name'           => $request->branch_name,
                    'company_id'            => $request->company_id,
                    'company_name'          => $request->company_name,
                    'job_level'             => $request->job_level,
                    'update_by'             => $user->id,
                ];
                $update = [
                    'department_id' => $request->to_department,
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
    public function get_branch(){
        $user = Auth::user();
        $branch =  DB::table('branches')
                    ->select('company_id','id','name')
                    ->where('id',$user->branch_id)
                    ->get();
        $company = DB::table('companies')
                    ->select('id','name')
                    ->where('id',$branch[0]->company_id)
                    ->get();
        $department = DB::table('departments')
                         ->select('id','department_name')
                         ->where('branch_id',$user->branch_id)
                         ->get();
        $employee = DB::table('employees')
                        ->select('id','name')
                        ->where('branch_id',$user->branch_id)
                        ->get();
        $data = [
            'branch'        => $branch,
            'company'       => $company,
            'department'    => $department,
            'employee'      => $employee
        ];
        return response()->json($data);
    }
    public function get_employee(Request $request){
        $branchId = $request->branch_id;
        $employee = Employee::select('id','name')
                            ->where('branch_id',$branchId)
                            ->get();
        return response()->json($employee);
    }
    public function save_rotation(Request $request){
        DB::beginTransaction();
        $user = Auth::user();
        try {
                $dt_from_depart = DB::table('departments')
                                    ->select('department_name')
                                    ->where('id',$request->from_department)
                                    ->get();
                $dt_to_depart = DB::table('departments')
                                    ->select('department_name')
                                    ->where('id',$request->to_department)
                                    ->get();
                $employee = DB::table('employees')
                                    ->select('name')
                                    ->where('id',$request->employee_id)
                                    ->get();
                $data = [
                    'rotate_date'           => $request->rotate_date,
                    'rotate_name'           => $request->rotate_name,
                    'employee_id'           => $request->employee_id,
                    'employee_name'         => $employee[0]->name,
                    'from_department_id'    => $request->from_department,
                    'from_department_name'  => $dt_from_depart[0]->department_name,
                    'to_department_id'      => $request->to_department,
                    'to_department_name'    => $dt_to_depart[0]->department_name,
                    'branch_id'             => $request->branch_id,
                    'branch_name'           => $request->branch_name,
                    'company_id'            => $request->company_id,
                    'company_name'          => $request->company_name,
                    'job_level'             => $request->job_level,
                    'create_by'             => $user->id,
                ];
                $update = [
                    'department_id' => $request->to_department,
                ];
                DB::table('employees')
                    ->where ('id',$request->employee_id)
                    ->update($update);
                RotateModel::insert($data);
                DB::commit();
                $response = [
                    'status' => 'success',
                    'msg'    => 'Insert data success !',
                ];
                return $response;
        }catch (Exception $e) {
            DB::rollBack();
        }
    }
}
