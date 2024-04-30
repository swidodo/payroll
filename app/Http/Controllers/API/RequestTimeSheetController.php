<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Branch;
use App\Models\Timesheet;
// use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class RequestTimeSheetController extends Controller
{
    public function index(Request $request){
        $data = Timesheet::select('timesheets.*',
                            'employees.name as employee_name',
                            'employees.no_employee as no_employee',
                            'branches.name as branch_name')
                ->leftJoin('employees','employees.id','timesheets.employee_id')
                ->leftJoin('branches','branches.id','timesheets.branch_id')
                ->where('timesheets.employee_id',$request->employee_id)
                ->orderBy('timesheets.id','DESC')
                ->get();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    
    public function store(Request $request){
        try{
            DB::beginTransaction();
                $validator = Validator::make($request->all(), [
                    'employee_id'       => 'required',
                    'start_date'        => 'required|date',
                    'end_date'          => 'required|date',
                    'project_stage'     => 'required',
                    'task_or_project'   => 'required',
                    'activity'          => 'required',
                    'client_company'    => 'required',
                    'label_project'     => 'required',
                    'support'           => 'required',                   
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                        'wrong' => $validator->errors()
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                }
                

                $dta = Branch::select('branches.name as branch_name','companies.name as company_name')
                            ->leftJoin('companies','companies.id','=','branches.company_id')
                            ->where('branches.id',Auth::user()->branch_id)->first();
                $company    =  $dta->branch_name;
                $branch     =  $dta->company_name;
                $tahun      =  date('Y');
                $bulan      =  date('m');
                $tanggal    =  date('d-m-Y');

                $dir        = $company.'/'.$branch.'/'.$tahun.'/'.$bulan.'/'.$tanggal.'/';
                $path = 'timesheet/'.$dir.$request->get('file_attachment');
                if (! Storage::exists($path)) {
                    Storage::makeDirectory($path,775,true);
                }
    
                $fileName = time() . $request->file('file_attachment')->getClientOriginalName();
                $store = $request->file('file_attachment')->storeAs($path, $fileName);
                $pathFile_application = 'storage/app/public/'.$path . $fileName ?? null;
                $base = URL::to('/');


                $data = [
                    'employee_id'       => $request->employee_id,
                    'project_stage'     => $request->project_stage,
                    'label_project'     => $request->label_project,
                    'start_date'        => $request->start_date,
                    'end_date'          => $request->end_date,
                    'start_time'        => $request->start_time,
                    'end_time'          => $request->end_time,
                    // 'duration'          => '',  
                    'task_or_project'   => $request->task_or_project,
                    'activity'          => $request->activity,
                    'client_company'    => $request->client_company,
                    'support'           => $request->support,
                    'remark'           => $request->remark,
                    'file_attachment'   => $base.'/'.$pathFile_application,  
                    'status'            => 'pending',
                    'branch_id'         => Auth::user()->branch_id,
                    'created_by'        => Auth::user()->id,
                ];
            Timesheet::create($data);
            $emp = Employee::where('id',$request->employee_id)->first();
            if($emp != null){
                if($emp->department_id == '' || $emp->department_id == null ) {
                    return response()->json([
                        'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                        'message' => 'Depratment not empty!'
                    ], Response::HTTP_OK);
                }
            }
            $superior = DB::table('level_approvals')->where('department_id',$emp->department_id)->where('branch_id',Auth::user()->branch_id)->get();
            $approve1 = null;
            $approve2 = null;
            $approve3 = null;
            foreach ($superior as $s){
                if ($s->level == '1'){
                    $approve1 = $s->employee_id;
                }
                if ($s->level == '2'){
                    $approve2 = $s->employee_id;
                }
                if ($s->level == '3'){
                    $approve3 = $s->employee_id;
                }
            }
                $approve = [
                    'timesheet_id'      => DB::getPdo()->lastInsertId(),
                    'employee_id'   => $request->employee_id,
                    'department_id' => $emp->department_id,
                    'approve_1'     => $approve1,
                    'approve_2'     => $approve2,
                    'approve_3'     => $approve3,
                    'status'        => '0',
                    'created_at'    => date('Y-m-d H:m:s'),
                    'updated_at'    => date('Y-m-d H:m:s'),
                ];
            DB::table('timesheet_approvals')->insert($approve);
            DB::commit();
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Timesheet successfully created.'
            ], Response::HTTP_OK);
        }catch(Exeption $e){
            DB::rollBack();
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Something went wrong!'
            ], Response::HTTP_OK);
        }
    }
    public function edit(Request $request){
        $data['data'] = Timesheet::select('timesheets.*',
                                    'employees.name as employee_name',
                                    'employees.no_employee as no_employee',
                                    'branches.name as branch_name')
                            ->leftJoin('employees','employees.id','timesheets.employee_id')
                            ->leftJoin('branches','branches.id','timesheets.branch_id')
                            ->where('timesheets.id',$request->id)
                            ->first();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    public function update(Request $request){
        try{
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                    'project_stage'     => 'required',
                    'label_project'     => 'required',
                    'start_date'        => 'required',
                    'end_date'          => 'required',
                    'task_or_project'   => 'required',
                    'activity'          => 'required',
                    'support'           => 'required',        
                    
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                        'wrong' => $validator->errors()
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                }

                $dta = Branch::select('branches.name as branch_name','companies.name as company_name')
                            ->leftJoin('companies','companies.id','=','branches.company_id')
                            ->where('branches.id',Auth::user()->branch_id)->first();
                $company    =  $dta->branch_name;
                $branch     =  $dta->company_name;
                $tahun      =  date('Y');
                $bulan      =  date('m');
                $tanggal    =  date('d-m-Y');

                // upload data
                $linkId = Timesheet::where('id',$request->id)->first();
                                
                if(isset($request->file_attachment)){
                    $dir        = $company.'/'.$branch.'/'.$tahun.'/'.$bulan.'/'.$tanggal.'/';
                    $path = 'timesheet/'.$dir.$request->get('file_attachment');
                    if (! Storage::exists($path)) {
                        Storage::makeDirectory($path,775,true);
                    }
                    
                    $fileName = time() . $request->file('file_attachment')->getClientOriginalName();
                    $store = $request->file('file_attachment')->storeAs($path, $fileName);
                    $pathFile_application = 'storage/app/public/'.$path . $fileName ?? null;
                    $base = URL::to('/');
                    $link_attach = $base.'/'.$pathFile_application;

                    $hide = $base.'/storage/app/';
                    $storagePublic = str_replace($hide,'',$linkId->file_attachment);
                    if (Storage::exists($storagePublic)) {
                        Storage::delete($storagePublic);
                    }
            
                }else{
                    $link_attach = $linkId->file_attachment;
                }

                $data = [
                    'project_stage'     => $request->project_stage,
                    'label_project'     => $request->label_project,
                    'start_date'        => $request->start_date,
                    'end_date'          => $request->end_date,
                    'start_time'        => $request->start_time,
                    'end_time'          => $request->end_time,
                    // 'duration'          => '',  
                    'task_or_project'   => $request->task_or_project,
                    'activity'          => $request->activity,
                    'client_company'    => $request->client_company,
                    'support'           => $request->support,
                    'file_attachment'   => $link_attach,  
                    
                ];
            Timesheet::where('id',$request->id)->update($data);
            DB::commit();
            $dataUpdate = Timesheet::select('timesheets.*',
                                        'employees.name as employee_name',
                                        'employees.no_employee as no_employee',
                                        'branches.name as branch_name')
                                ->leftJoin('employees','employees.id','timesheets.employee_id')
                                ->leftJoin('branches','branches.id','timesheets.branch_id')
                                ->where('timesheets.id',$request->id)
                                ->first();
            return response()->json([
                'status' => Response::HTTP_OK,
                'result' => $dataUpdate,
                'message'=> 'Data successfuly updated.'
            ], Response::HTTP_OK);
        }catch(Exeption $e){
            DB::rollBack();
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Something went wrong!'
            ], Response::HTTP_OK);
        }
    }
    public function show(Request $request){
        $data['data'] = Timesheet::select('timesheets.*',
                                'employees.name as employee_name',
                                'employees.no_employee as no_employee',
                                'branches.name as branch_name')
                        ->leftJoin('employees','employees.id','timesheets.employee_id')
                        ->leftJoin('branches','branches.id','timesheets.branch_id')
                        ->where('timesheets.id',$request->id)
                        ->first();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    public function destroy(Request $request){
        try{
            $del = Timesheet::where('id',$request->id)
                    ->where('status','pending')
                    ->where('branch_id',Auth::user()->branch_id)
                    ->delete();
            return response()->json([
                'status'  => Response::HTTP_OK,
                'message' => 'Timesheet successfuly deleted.'
            ], Response::HTTP_OK);
        }catch(Exeption $e){
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Something went wrong!'
            ], Response::HTTP_OK);
        }
    }
}