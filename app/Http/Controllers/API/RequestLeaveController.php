<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Branch;
use App\Models\Leave;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class RequestLeaveController extends Controller
{
    public function leave(Request $request){
        $data = Leave::select('leaves.*',
                            'leave_types.title',
                            'employees.name as employee_name',
                            'employees.no_employee as no_employee')
                ->leftJoin('leave_types','leave_types.id','leaves.leave_type_id')
                ->leftJoin('employees','employees.id','leaves.employee_id')
                ->where('leaves.employee_id',$request->employee_id)
                ->whereIn('leave_types.title',['LEAVE','DISPENSATION'])
                ->orderBy('leaves.id','DESC')
                ->get();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    public function submision(Request $request){
        $data = Leave::select('leaves.*',
                            'leave_types.title',
                            'employees.name as employee_name',
                            'employees.no_employee as no_employee')
                ->leftJoin('leave_types','leave_types.id','leaves.leave_type_id')
                ->leftJoin('employees','employees.id','leaves.employee_id')
                ->where('leaves.employee_id',$request->employee_id)
                ->whereIn('leave_types.title',['SICK','PERMIT'])
                ->orderBy('leaves.id','DESC')
                ->get();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    public function getTypeLeave(Request $request){
        $data = LeaveType::select('leave_types.id','leave_types.title')
                                ->leftJoin('users','users.id','=','leave_types.created_by')
                                ->where('branch_id',Auth::user()->branch_id)
                                ->whereIn('title',['LEAVE','DISPENSATION'])
                                ->get();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    public function getTypeSubmision(Request $request){
        $data = LeaveType::select('leave_types.id','leave_types.title')
                                ->leftJoin('users','users.id','=','leave_types.created_by')
                                ->where('branch_id',Auth::user()->branch_id)
                                ->whereIn('title',['PERMIT','SICK'])
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
                    'employee_id'               => ['required','numeric'],
                    'leave_type_id'             => ['required','numeric'],
                    'applied_on'                => ['required','date'],
                    'start_date'                => ['required','date'],                   
                    'end_date'                  => ['required','date'],                    
                    'leave_reason'              => ['required'],                    
                                        
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                        'wrong' => $validator->errors()
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                }
                // upload file
                if(isset($request->attachment_request_path)){
                    $dta = Branch::select('branches.name as branch_name','companies.name as company_name')
                                ->leftJoin('companies','companies.id','=','branches.company_id')
                                ->where('branches.id',Auth::user()->branch_id)->first();
                    $company    =  $dta->branch_name;
                    $branch     =  $dta->company_name;
                    $tahun      =  date('Y');
                    $bulan      =  date('m');
                    $tanggal    =  date('d-m-Y');
    
                    $dir        = $company.'/'.$branch.'/'.$tahun.'/'.$bulan.'/'.$tanggal.'/';
                    $path = 'leave/'.$dir.$request->get('attachment_request_path');
                    if (! Storage::exists($path)) {
                        Storage::makeDirectory($path,775,true);
                    }
        
                    $fileName = time() . $request->file('attachment_request_path')->getClientOriginalName();
                    $store = $request->file('attachment_request_path')->storeAs($path, $fileName);
                    $pathFile_application = 'storage/app/public/'.$path . $fileName ?? null;
                    $base = URL::to('/');
                    $linkAttach = $base.'/'.$pathFile_application;
                }else{
                    $linkAttach = null;
                }
                
                $data = [
                    'employee_id'               => $request->employee_id,
                    'leave_type_id'             => $request->leave_type_id,
                    'applied_on'                => $request->applied_on,
                    'start_date'                => $request->start_date,
                    'end_date'                  => $request->end_date,
                    'leave_reason'              => $request->leave_reason,
                    'attachment_request_path'   => $linkAttach,
                    'status'                    => 'pending',
                    'branch_id'                 => Auth::user()->branch_id,
                    'created_by'                => Auth::user()->id,
                ];
            Leave::create($data);
             // approval
            $dept = Employee::where('user_id',Auth::user()->id)->first();
            if ($dept !=null){
                if($dept->department_id == '' || $dept->department_id == null){
                    return response()->json([
                        'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                        'message' => 'Depratment not empty!'
                    ], Response::HTTP_OK);
                }
            }
            $Level = DB::table('level_approvals')->where('department_id',$dept->department_id)->get();
            $approve1 = [];
            $approve2 = [];
            $approve3 = [];
            foreach( $Level as $lv){
                if($lv->level == 1){
                    if(!in_array($lv->employee_id,$approve1)){
                        array_push($approve1,$lv->employee_id);
                    }
                }
                if($lv->level == 2){
                    if(!in_array($lv->employee_id,$approve2)){
                        array_push($approve2,$lv->employee_id);
                    }
                }
                if($lv->level == 3){
                    if(!in_array($lv->employee_id,$approve3)){
                        array_push($approve3,$lv->employee_id);
                    }
                }
            }
            $dtApprove = [
                'leave_id'      => DB::getPdo()->lastInsertId(),
                'department_id' => $dept->department_id,
                'approve_1'     => (($approve1 !=[]) ? $approve1[0]:null),
                'approve_2'     => (($approve2 !=[]) ? $approve2[0]: null),
                'approve_3'     => (($approve3 !=[]) ? $approve3[0]: null),
                'status'        => 0,
            ];
            DB::table('leave_approvals')->insert($dtApprove);
            DB::commit();
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Data successfully created.'
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
        $data['data'] = Leave::select('leaves.id',
                                        'leaves.employee_id',
                                        'employees.name as employee_name',
                                        'leaves.leave_type_id',
                                        'leave_types.title',
                                        'leaves.applied_on',
                                        'leaves.start_date',
                                        'leaves.end_date',
                                        'leaves.total_leave_days',
                                        'leaves.leave_reason',
                                        'leaves.attachment_request_path',
                                        'leaves.remark',
                                        'leaves.status',
                                        'leaves.rejected_reason')
                            ->leftJoin('leave_types','leave_types.id','=','leaves.leave_type_id')
                            ->leftJoin('employees','employees.id','=','leaves.employee_id')
                            ->where('leaves.id',$request->id)
                            ->first();
         $leaveType = ['LEAVE','DISPENSATION'];
         $permit    = ['SICK','PERMIT'];
         if (in_array($data['data']->title, $leaveType)){
            $data['leave_type'] = LeaveType::select('leave_types.id','leave_types.title')
                                                    ->leftJoin('users','users.id','=','leave_types.created_by')
                                                    ->where('users.branch_id',Auth::user()->branch_id)
                                                    ->whereIn('leave_types.title',['LEAVE','DISPENSATION'])
                                                    ->get();
         }else if(in_array($data['data']->title, $permit)){
            $data['submision_type'] = LeaveType::select('leave_types.id','leave_types.title')
                                            ->leftJoin('users','users.id','=','leave_types.created_by')
                                            ->where('users.branch_id',Auth::user()->branch_id)
                                            ->whereIn('leave_types.title',['SICK','PERMIT'])
                                            ->get();
        }
        
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    public function update(Request $request){
        try{
            DB::beginTransaction();
                $validator = Validator::make($request->all(), [
                    'leave_type_id'             => ['required','numeric'],
                    'start_date'                => ['required','date'],                   
                    'end_date'                  => ['required','date'],                    
                    'leave_reason'              => ['required'],                    
                    // 'attachment_request_path'   => ['required'],        
                    
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                        'wrong' => $validator->errors()
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                }
                
                // upload data
                $dta = Branch::select('branches.name as branch_name','companies.name as company_name')
                            ->leftJoin('companies','companies.id','=','branches.company_id')
                            ->where('branches.id',Auth::user()->branch_id)->first();
                $company    =  $dta->branch_name;
                $branch     =  $dta->company_name;
                $tahun      =  date('Y');
                $bulan      =  date('m');
                $tanggal    =  date('d-m-Y');

                // upload data
                $linkId = Leave::where('id',$request->id)->first();
                if($linkId == null){
                    return response()->json([
                        'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                        'message' => 'Data not found'
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                }
                                
                if(isset($request->attachment_request_path)){
                    $dir        = $company.'/'.$branch.'/'.$tahun.'/'.$bulan.'/'.$tanggal.'/';
                    $path = 'leave/'.$dir.$request->get('attachment_request_path');
                    if (! Storage::exists($path)) {
                        Storage::makeDirectory($path,775,true);
                    }
                    
                    $fileName = time() . $request->file('attachment_request_path')->getClientOriginalName();
                    $store = $request->file('attachment_request_path')->storeAs($path, $fileName);
                    $pathFile_application = 'storage/app/public/'.$path . $fileName ?? null;
                    $base = URL::to('/');
                    $link_attach = $base.'/'.$pathFile_application;

                    $hide = $base.'/storage/app/';
                    $storagePublic = str_replace($hide,'',$linkId->attachment_request_path);
                    if (Storage::exists($storagePublic)) {
                        Storage::delete($storagePublic);
                    }
            
                }else{
                    $link_attach = $linkId->attachment_request_path;
                }
                
                $data = [
                    'leave_type_id'             => $request->leave_type_id,
                    'start_date'                => $request->start_date,
                    'end_date'                  => $request->end_date,
                    'leave_reason'              => $request->leave_reason,
                    'attachment_request_path'   => $link_attach,
                ];
            Leave::where('id',$request->id)->update($data);
            DB::commit();
            $dataUpdate = Leave::select('leaves.id',
                                            'leaves.employee_id',
                                            'employees.name as employee_name',
                                            'leaves.leave_type_id',
                                            'leave_types.title',
                                            'leaves.applied_on',
                                            'leaves.start_date',
                                            'leaves.end_date',
                                            'leaves.total_leave_days',
                                            'leaves.leave_reason',
                                            'leaves.attachment_request_path',
                                            'leaves.remark',
                                            'leaves.status',
                                            'leaves.rejected_reason')
                                ->leftJoin('leave_types','leave_types.id','=','leaves.leave_type_id')
                                ->leftJoin('employees','employees.id','=','leaves.employee_id')
                                ->where('leaves.id',$request->id)
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
        $data['data'] = Leave::select('leaves.id',
                                        'leaves.employee_id',
                                        'employees.name as employee_name',
                                        'leaves.leave_type_id',
                                        'leave_types.title',
                                        'leaves.applied_on',
                                        'leaves.start_date',
                                        'leaves.end_date',
                                        'leaves.total_leave_days',
                                        'leaves.leave_reason',
                                        'leaves.attachment_request_path',
                                        'leaves.remark',
                                        'leaves.status',
                                        'leaves.rejected_reason',
                                        'leaves.branch_id')
                                ->leftJoin('leave_types','leave_types.id','=','leaves.leave_type_id')
                                ->leftJoin('employees','employees.id','=','leaves.employee_id')
                                ->where('leaves.id',$request->id)
                                ->first();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    public function destroy(Request $request){
        try{
            $del = Leave::where('id',$request->id)
                    ->where('status','pending')
                    ->orWhereNull('status')
                    ->delete();
            return response()->json([
                'status'  => Response::HTTP_OK,
                'message' => 'Data successfuly deleted.'
            ], Response::HTTP_OK);
        }catch(Exeption $e){
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Something went wrong!'
            ], Response::HTTP_OK);
        }
    }
}