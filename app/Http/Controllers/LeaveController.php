<?php

namespace App\Http\Controllers;

use App\Models\AttendanceEmployee;
use App\Models\Employee;
use App\Models\HistoryLeave;
use App\Models\Leave;
use App\Models\LeaveApproval;
use App\Models\LeaveType;
use App\Models\LevelApproval;
use App\Models\Overtime;
use App\Models\Utility;
use App\Models\Branch;
use App\Models\AccessBranch;
use Carbon\Carbon;
use DataTables;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;

class LeaveController extends Controller
{
    public function index()
    {
        if (Auth::user()->can('manage leave')) {
            $user     = Auth::user();
            $branchId = Branch::where('id',Auth::user()->branch_id)->first();
            $emp = Employee::where('user_id',Auth::user()->id)->first();
            if (Auth::user()->type != 'HO') {
                if (Auth::user()->type == "company"){
                    $data['branch'] = Branch::where('company_id',$branchId->company_id)->get();
                }else{
                    $data['branch'] = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                    ->where('access_branches.employee_id',$emp->id)
                                                    ->where('access_branches.company_id',$branchId->company_id)->get();
                }
                return view('pages.contents.time-management.leaves.index', $data);
            } else {
                $data['branch'] = Branch::where('id',$branchId->id)->get();
                return view('pages.contents.time-management.leaves.index', $data);
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('dashboard');
        }
    }

    public function get_leave(Request $request){
        $data = DB::table('leaves')
                    ->select('employees.name','no_employee',
                            'leave_types.title',
                            'leaves.applied_on',
                            'leaves.start_date',
                            'leaves.end_date',
                            'leaves.total_leave_days',
                            'leaves.leave_reason',
                            'leaves.attachment_request_path',
                            'leaves.status',
                            'leaves.id')
                    ->leftJoin('leave_types','leave_types.id','=','leaves.leave_type_id')
                    ->leftJoin('employees','employees.id','=','leaves.employee_id')
                    ->where('employees.branch_id',$request->branch_id)
                    ->orderBy('leaves.id','DESC')
                    ->get();
        return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                        $btn ='';
                        if(Auth()->user()->canany('edit leave','delete leave')){
                            $btn .= '<div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">';
                                        if(Auth()->user()->can('edit leave')){
                                            $btn .= '<a  data-url="'.route('leaves.edit', $row->id).'" data-id="'.$row->id.'" id="edit-leave" class="dropdown-item edit-leave" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_leave"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                        }
                                        if(Auth()->user()->can('delete leave') && $row->status !='Approved'){
                                            $btn .= '<a data-id = "'.$row->id.'" class="dropdown-item delete-leave" href="#" data-bs-toggle="modal" data-bs-target="#delete_leave"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                        }
                            $btn .= '</div></div>';
                        }
                        return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);

    }
    public function get_total_leave(Request $request){
        $data = EMployee::where('id',$request->employee_id)->pluck('total_leave')->first();
        return response()->json($data);
    }
    public function request_manage_leave(Request $request){
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        if (Auth::user()->initial == 'HO'){
            $data['employee'] = Employee::select('id','name')->where('branch_id',Auth::user()->branch_id)->get();
            $data['leaveType'] = LeaveType::select('leave_types.id','leave_types.title')
                                    ->leftJoin('users','users.id','=','leave_types.created_by')
                                    ->where('users.branch_id',Auth::user()->branch_id)
                                    ->get();
            return response()->json($data);
        }else{
            $data['employee'] = Employee::select('id','name')->where('branch_id',Auth::user()->branch_id)->get();
            $data['leaveType'] = LeaveType::select('leave_types.id','leave_types.title')
                                    ->leftJoin('users','users.id','=','leave_types.created_by')
                                    ->where('users.branch_id',Auth::user()->branch_id)
                                    ->get();
            return response()->json($data);
        }
    }
    public function store(Request $request)
    {
        if (Auth::user()->can('create leave')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'leave_type_id' => 'required',
                    'employee_id' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    // 'leave_reason' => 'required',
                    //    'remark' => 'required',
                ]
            );
            
            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }
            try {
                DB::beginTransaction();
                $startDate          = new DateTime($request->start_date);
                $endDate            = new DateTime($request->end_date);
                $total_leave_days   = !empty($startDate->diff($endDate)) && $startDate < $endDate ? $startDate->diff($endDate)->days + 1 : 1;
                $employee           = Employee::where('id', '=', isset(Auth::user()->employee) ? Auth::user()->employee->id : $request->employee_id)->first();
                $startDateCarbon    = Carbon::parse($request->start_date);
                $leaveType          = LeaveType::find($request->leave_type_id);
                // if (!is_null($employee)) {
                //     if (is_null($employee->leave_type)) {
                //         $res = [
                //             'status' => 'error',
                //             'msg'    => 'Please Set Leave Type in Employees Menu!'
                //         ];
                //         return response()->json($res);
                //     }
                //     if (is_null($employee->total_leave_remaining)) {
                //         $employee->total_leave_remaining = $employee->total_leave;
                //         $employee->save();
                //     }
                    
                //     if ($employee->total_leave_remaining < 1) {
                        
                //         if ($leaveType->title == 'DISPENSATION') {
                //         } else {
                //             $res = [
                //                 'status' => 'error',
                //                 'msg'    => 'You cannot apply for leave!'
                //             ];
                //            return response()->json($res);
                //         }
                //     }
                    
                //     // if ($employee->leave_type == 'monthly') {
                //     //     if (now()->format('m') == Carbon::parse($employee->company_doj)->addMonth()->format('m')) {
                //     //         toast('You can\'t apply for leave yet!', 'warning');
                //     //         return redirect()->route('leaves.index');
                //     //     }

                //     //     if ($employee->total_leave_remaining > 0) {
                //     //         $employee->total_leave_remaining = $employee->total_leave_remaining - 1;
                //     //         $employee->save();
                //     //     }
                //     // } elseif ($employee->leave_type == 'annual') {
                //     //     if ($employee->total_leave_remaining > 0) {
                //     //         $employee->total_leave_remaining = $employee->total_leave_remaining - 1;
                //     //         $employee->save();
                //     //     }
                //     // }
                //     if ($employee->total_leave_remaining > 0 && $leaveType->title =='LEAVE') {
                //         if ($employee->total_leave_remaining >= $total_leave_days){
                //             $employee->total_leave_remaining = $employee->total_leave_remaining - $total_leave_days;
                //             $employee->save();
                //         }
                //     }
                    
                // }
                
                $leave    = new Leave();
                if (Auth::user()->type == "employee") {
                    $leave->employee_id = $employee->id;
                } else {
                    $leave->employee_id = $request->employee_id;
                }
                // if ($request->file('attachment_request')) {
                //     $year  = date('Y');
                //     $month = date('m');
                //     $dir = 'leave/'.$year.'/'.$month.'/'.$request->get('attachment_request');;
                //     if (! Storage::exists($dir)) {
                //         Storage::makeDirectory($dir,775,true);
                //     }
                //     $fileName = time() . '_' . $request->file('attachment_request')->getClientOriginalName();
                //     $store = $request->file('attachment_request')->storeAs($dir, $fileName);
                //     $pathFile = URL::to('/').'/'.'public/storage/'.$dir.$fileName ?? null;
                //     $leave->attachment_request_path =  $pathFile;
                // }

                // upload file
                if(isset($request->attachment_request)){
                    $dta = Branch::select('branches.name as branch_name','companies.name as company_name')
                                ->leftJoin('companies','companies.id','=','branches.company_id')
                                ->where('branches.id',Auth::user()->branch_id)->first();
                    $company    =  $dta->branch_name;
                    $branch     =  $dta->company_name;
                    $tahun      =  date('Y');
                    $bulan      =  date('m');
                    $tanggal    =  date('d-m-Y');

                    $dir        = $company.'/'.$branch.'/'.$tahun.'/'.$bulan.'/'.$tanggal.'/';
                    $path = 'leave/'.$dir.$request->get('attachment_request');
                    if (! Storage::exists($path)) {
                        Storage::makeDirectory($path,775,true);
                    }
        
                    $fileName = time() . $request->file('attachment_request')->getClientOriginalName();
                    $store = $request->file('attachment_request')->storeAs($path, $fileName);
                    $pathFile_application = 'storage/app/public/'.$path . $fileName ?? null;
                    $base = URL::to('/');
                    $linkAttach = $base.'/'.$pathFile_application;
                }else{
                    $linkAttach = null;
                }

                $leave->leave_type_id    = $request->leave_type_id;
                $leave->applied_on       = date('Y-m-d');
                $leave->start_date       = $request->start_date;
                $leave->end_date         = $request->end_date;
                $leave->total_leave_days = $total_leave_days;
                $leave->leave_reason     = $request->leave_reason;
                // $leave->remark           = $request->remark;
                $leave->status           = Auth::user()->initial == "HO" ? 'Approved' : 'Pending';
                $leave->attachment_request_path = $linkAttach;
                $leave->created_by       = Auth::user()->creatorId();
                $leave->branch_id        = Auth::user()->branch_id;
                $leave->save();
                HistoryLeave::create($leave->toArray());
                
                // 3 Tier Approval
                $levels = LevelApproval::where('created_by', Auth::user()->creatorId())->get();
                foreach ($levels as $key => $value) {
                    LeaveApproval::create([
                        'leave_id'              => $leave->id,
                        'level'                 => $value->level,
                        'is_approver_company'   => $value->company_id ? true : false,
                        'approver_id'           => isset($value->company_id) ? $value->company_id : $value->employee_id,
                        'status'                => 'Approved',
                        'created_by'            => Auth::user()->creatorId(),
                    ]);
                }
                // 3 Tier Approval

                if (Auth::user()->initial == "HO") {
                    if ($leave->total_leave_day > 1) {
                        for ($i = 0; $i < $leave->total_leave_day; $i++) {
                            AttendanceEmployee::insertToAttendanceEmployeeLeave($leave, $leave->leave_type->title, $leave->attachment_request_path, $startDateCarbon);
                            //add day to date
                            $startDateCarbon->addDay(1);
                        }
                    } else {
                        AttendanceEmployee::insertToAttendanceEmployeeLeave($leave, $leave->leave_type->title, $leave->attachment_request_path, $startDateCarbon);
                    }
                }
                
                if (Auth::user()->type != "HO" && Auth::user()->type != "client") {
                    Utility::insertToRequest($leave, Auth::user(), 'Leave');
                }

                DB::commit();
                $res = [
                    'status' => 'success',
                    'msg'    => 'Leave successfully created.'
                ];
                return response()->json($res);
                
            } catch (Exception $e) {
                DB::rollBack();
                $res = [
                    'status' => 'error',
                    'msg'    => 'Something went wrong.'
                ];
                return response()->json($res);
               
            }
        } else {
            $res = [
                'status' => 'error',
                'msg'    => 'Permission denied.'
            ];
            return response()->json($res);
            
        }
    }

    public function show($id)
    {
        $leave = Leave::find($id);
        $fileType = null;

        if (!is_null($leave->attachment_reject)) {
            $fileType = Utility::getFileType($leave->attachment_reject);
        }

        return view('pages.contents.time-management.leaves.detail-rejected', compact('leave', 'fileType'));
    }

    public function edit(Request $request)
    {
        
        if (Auth::user()->can('edit leave')) {
            $id = $request->id;
            $leave = Leave::find($id);
            $leavetypes = LeaveType::select('leave_types.id','leave_types.title','users.branch_id')
                                    ->leftJoin('users','users.id','=','leave_types.created_by')
                                    ->where('users.branch_id',Auth::user()->branch_id)
                                    ->get();
            if ($leavetypes[0]->branch_id == Auth::user()->branch_id) {
                $user = Auth::user();
                $employee  = Employee::select('id','name')->where('branch_id', '=', Auth::user()->branch_id)->where('id', $leave->employee_id)->first();
                // $leavetypes = LeaveType::leftJoinwhere('branch_id', '=', Auth::user()->branch_id)->get();
               
                // 3 Tier Approval
                if (Auth::user()->type == 'company') {
                    $levelApprove = LevelApproval::where('created_by', '=', Auth::user()->creatorId())
                        ->where('company_id', Auth::user()->creatorId())
                        ->first();
                } elseif (Auth::user()->type != 'company' && Auth::user()->type != 'client') {
                    $levelApprove = LevelApproval::where('created_by', '=', Auth::user()->creatorId())
                        ->where('employee_id', isset(Auth::user()->employee) ? Auth::user()->employee->id : 0)
                        ->first();
                }

                $leaveApprovals = $leave->leave_aprovals()->orderBy('level', 'asc')->get();
                $levelAndApprovals = Utility::getLevelAndApprover($levelApprove, $leaveApprovals);
                // 3 Tier Approval

                return response()->json([
                    'employee' => $employee, 
                    'type'=>$leavetypes, 
                    'leave'=>$leave,
                    'leaveApprovals' => $levelAndApprovals['approver'],
                    'level_approve' => $levelAndApprovals['level']
                ]);
            } else {
                return response()->json(['error' => 'Permission denied.'], 403);
            }
        } else {
            return response()->json(['error' => 'Permission denied.'], 403);
        }
    }

    public function update(Request $request)
    {
        if (Auth::user()->can('edit leave')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'leave_type_id' => 'required',
                    'employee_id' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                ]
            );


            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            $startDate = new DateTime($request->start_date);
            $endDate   = new DateTime($request->end_date);
            $total_leave_days = !empty($startDate->diff($endDate)) && $startDate < $endDate ? $startDate->diff($endDate)->days +1 : 1;
            $startDateCarbon = Carbon::parse($request->start_date);
            
            try {
                DB::beginTransaction();
                $leave    =  Leave::find($request->id);

                $filePath = '';
                if ($request->file('attachment_reject')) {
                    $fileName = time() . '_' . $request->file('attachment_reject')->getClientOriginalName();
                    $filePath = $request->file('attachment_reject')->storeAs('public', $fileName);
                    $leave->attachment_reject =  'storage/' . $fileName ?? null;
                }

                $leave->employee_id      = $request->employee_id;
                $leave->leave_type_id    = $request->leave_type_id;
                $leave->applied_on       = date('Y-m-d');
                $leave->start_date       = $request->start_date;
                $leave->end_date         = $request->end_date;
                $leave->total_leave_days = $total_leave_days;
                $leave->leave_reason     = $request->leave_reason;
                // $leave->remark           = $request->remark;
                // $leave->status           =  $request->status ?? 'Pending';
                $leave->rejected_reason  =  $request->rejected_reason ?? null;
                $leave->created_by       = Auth::user()->creatorId();
                $leave->save();

                // 3 Tier Approval
                // if (isset($request->status) && $request->status != 0 && isset($request->level_approve) && $leave->status != 'Rejected') {
                //     $leaveApprove = LeaveApproval::where('leave_id', $leave->id)
                //         ->where('level', $request->level_approve)
                //         ->where('status', 'Pending')
                //         ->first();


                //     if (!is_null($leaveApprove)) {
                //         //check if employee can be a approver
                //         $employee = Employee::find($leaveApprove->approver_id);
                //         $level = null;
                //         if ($employee) {
                //             $level = LevelApproval::where('created_by', Auth::user()->creatorId())
                //                 ->where('employee_id', $employee->id)
                //                 ->first();
                //         }

                //         if ($leaveApprove->is_approver_company && Auth::user()->type == 'company') {
                //             if ($request->status == 'Rejected') {
                //                 $leaveApprove->status = 'Rejected';
                //                 $leave->status        =  'Rejected';
                //                 $leave->save();
                //             } else {
                //                 $leaveApprove->status = $request->status;
                //             }
                //             $leaveApprove->save();
                //         } elseif (!$leaveApprove->is_approver_company && Auth::user()->type != 'company' && !is_null($level)) {
                //             if ($request->status == 'Rejected') {
                //                 $leaveApprove->status = 'Rejected';
                //                 $leave->status           =  'Rejected';
                //                 $leave->save();
                //             } else {
                //                 $leaveApprove->status = $request->status;
                //             }
                //             $leaveApprove->save();
                //         }
                //     }

                //     $countLeaveApproved = LeaveApproval::where('leave_id', $leave->id)
                //         ->where('status', 'Approved')
                //         ->count();
                //     $countLevel = LevelApproval::where('created_by', Auth::user()->creatorId())->count();
                //     if ($countLeaveApproved == $countLevel) {
                //         $leave->status       =  'Approved';
                //         $leave->save();
                //     }
                // }
                // 3 Tier Approval


                // if ($leave->status == 'Approved' && Auth::user()->type == "employee" && Auth::user()->type != "company") {
                //     if ($leave->total_leave_day > 1) {
                //         for ($i = 0; $i < $leave->total_leave_day; $i++) {
                //             AttendanceEmployee::insertToAttendanceEmployeeLeave($leave, $leave->leave_type->title, $leave->attachment_request_path, $startDateCarbon);
                //             //add day to date
                //             $startDateCarbon->addDay(1);
                //         }
                //     } else {
                //         AttendanceEmployee::insertToAttendanceEmployeeLeave($leave, $leave->leave_type->title, $leave->attachment_request_path, $startDateCarbon);
                //     }
                // }

                DB::commit();
                $res = [
                    'status' => 'success',
                    'msg'    => 'Leave successfully updated.'
                ];
                return response()->json($res);
            } catch (Exception $e) {
                DB::rollBack();
                $res = [
                    'status' => 'error',
                    'msg'    => 'Something went wrong!'
                ];
                return response()->json($res);
            }
        } else {
            $res = [
                'status' => 'error',
                'msg'    => 'Permission denied.'
            ];
            return response()->json($res);
        }
    }

    public function destroy(Request $request)
    {
        $leave = Leave::find($request->id);
        if (Auth::user()->can('delete leave')) {
            // if ($leave->attachment_reject != null) {
            //     $fileNameAttReject = explode('/', $leave->attachment_reject);
            //     if (Storage::exists('public/' . $fileNameAttReject[1])) {
            //         Storage::delete('public/' . $fileNameAttReject[1]);
            //     }
            // }
           
            // upload data

            $linkId = Leave::where('id',$request->id)->first();
            $base = URL::to('/');
            $hide = $base.'/storage/app/public';
            $storagePublic = str_replace($hide,'',$linkId->attachment_request_path);
            if (Storage::exists($storagePublic)) {
                Storage::delete($storagePublic);
            }

            $leave->delete();
            $res = [
                'status' => 'success',
                'msg'    => 'Leave successfully deleted.'
            ];
            return response()->json($res);
        } else {
            $res = [
                'status' => 'error',
                'msg'    => 'Permission denied.'
            ];
            return response()->json($res);
        }
    }
}
