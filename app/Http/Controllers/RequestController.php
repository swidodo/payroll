<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\Request_employee;
use App\Models\AttendanceEmployee;
use App\Models\DayType;
use App\Models\AllowanceFinance;
use App\Models\Overtime;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Timesheet;
use DataTables;
use DateTime;
use Carbon\Carbon;
class RequestController extends Controller
{
    public function break_time($hourTime){
        $jmlhour = $hourTime;
        $break = 0;
        if ($jmlhour <= 4){
            $break = 0;
        }
        if ($jmlhour > 4 && $jmlhour < 8 )
        {
            $break = 1;
        }
        if ($jmlhour >= 8){
        $over = [];
        for ($x=1; $x <= $jmlhour; $x++){
            if ( $x % 4 == 0 ){
            array_push($over,$x);
            }
        }
        $break = count($over) - 1;
        }
        return $break;
    }
    public function timeTot_61($Tottime,$type_overtime){
        if ($type_overtime == "Saturday"){
            if ( $Tottime <= 5 ) {
                $hour1 = $Tottime * 2;
                $sisa = 0;
            }
            if ($Tottime > 5) {
                $hour1 = 5 * 2;
                $sisa = $Tottime - 5;
            }
            $hour2 = 0;
            $hour3 = 0;
            if ($sisa > 0 && $sisa == 1){
                $hour2 = $sisa * 3;
            }
            if ($sisa > 0 && $sisa > 1){
                $hour2 = 1 * 3;
                $hour3 = ($sisa - 1) * 4;
            }
            $hour = $hour1 + $hour2 + $hour3 ;
            return $hour;
        }else{
            if ( $Tottime <= 7 ) {
                $hour1 = $Tottime * 2;
                $sisa = 0;
            }
            if ($Tottime > 7) {
                $hour1 = 7 * 2;
                $sisa = $Tottime - 7;
            }
            $hour2 = 0;
            $hour3 = 0;
            if ($sisa > 0 && $sisa == 1){
                $hour2 = $sisa * 3;
            }
            if ($sisa > 0 && $sisa > 1){
                $hour2 = 1 * 3;
                $hour3 = ($sisa - 1) * 4;
            }
            $hour = $hour1 + $hour2 + $hour3 ;
            return $hour;
        }
    }
    public function timeTot_52($Tottime){
        // 8 jam pertama * 2
        if ( $Tottime <= 8 ) {
            $hour1 = $Tottime * 2;
            $sisa = 0;
        }
        if ($Tottime > 8) {
            $hour1 = 8 * 2;
            $sisa = $Tottime - 8;
        }
        $hour2 = 0;
        $hour3 = 0;
        if ($sisa > 0 && $sisa == 1){
            $hour2 = $sisa * 3;
        }
        if ($sisa > 0 && $sisa > 1){
            $hour2 = 1 * 3;
            $hour3 = ($sisa - 1) * 4;
        }
        $hour = $hour1 + $hour2 + $hour3 ;
       return $hour;
    }

    public function timeTot_weekday($Totover){
        $fisrttime  = 1.5 * 1;
        $Tottime    =  $Totover - 1;
        $sisa = $Tottime * 2;
        $hour = $fisrttime + $sisa ;
        return $hour;
    }
    public function total_allowance($employee_id){
        $allowance = AllowanceFinance::select(DB::raw('sum(amount) as total_allowance'))
                                     ->leftJoin('allowance_options','allowance_options.id','=','allowance_type_id')
                                     ->where('employee_id','=',$employee_id)
                                     ->where('allowance_options.pay_type','=','fixed')
                                     ->first();
        if ($allowance !=null ){
            $total = $allowance->total_allowance;
        }else{
            $total = 0;
        }
        return  $total;
    }

    public function index(){
        $userInitial = Auth::user()->initial;
        $data = '';
        if ($userInitial != null){
            if ($userInitial == 'HO'){
                $branch = Branch::select('id_company')->where('id', Auth::user()->branch_id)->first(); 
                $branchCompany = Branch::select('id','name')->where('company_id',$branch->company_id)->get();
                $data['branch'] = $branchCompany;
            }else{
                 $data['branch'] = Branch::select('id','name')->where('id',Auth::user()->branch_id)->fist();
            }
        }else{
            $data = [
                'status' => 'success',
                'msg'    => 'Branch Nothing IN employee !'
            ];
        }
        
        return view('pages.contents.request.index',$data);
    }
    public function get_data(){
        $data = DB::select("SELECT a.*,
                            b.name as employee_name,
                            b.no_employee,
                            c.name as approve_name,
                            d.name as departement_name,
                            e.position_name,
                            f.name as branch_name
                            FROM request_employees as a 
                            LEFT JOIN employees as b 
                            ON b.id=a.employee_id
                            LEFT JOIN employees as c
                            ON c.id = a.approve_id
                            LEFT JOIN departements as d
                            ON d.id = a.department_id
                            LEFT JOIN position as e 
                            ON e.id = a.position_id
                            LEFT JOIN branches as f
                            ON f.id=a.branch_id");
        return DataTables::of($data)
        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn ='';
                            // if(Auth()->user()->canany('edit bpjs')){
                                $btn .= '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">';
                                // if(Auth()->user()->can('edit attendance')){
                                    $btn .= '<a  data-id='.$row->id.' class="dropdown-item approve" href="javascript:void(0)" ><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                // }
                                // if(Auth()->user()->can('delete attendance')){
                                    $btn .= '<a data-id='.$row->id.' class="dropdown-item delete-master-bpjs" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                // }
                                    $btn .= '</div></div>';
                                // }
                                return $btn;
                            })
                        ->rawColumns(['action'])
        ->make(true);
    }
    public function create(){
        $user = Auth::user()->initial;
        if ($user == "HO"){
            $branch = Branch::where('id',Auth::user()->branch_id)->first();
            $data['branch'] = Branch::where('company_id',$branch->company_id)->get();
            $data['employee'] = Employee::where('branch_id',Auth::user()->branch_id)->get();
        }else{
            $data['branch'] = Branch::where('id',Auth::user()->branch_id)->get();
            $data['employee'] = Employee::where('user_id',Auth::user()->id)->get();
        }
        return view('pages.contents.request.create',$data);
    }
    public function store(Request $request){
     try {
            DB::beginTransaction();
            $dataEmp = Employee::find($request->employee_id);
            $approval = DB::table('v_approval')->where('employee_id',$request->employee_id)->first();
            if ($approval !=null){
                $userApprove ='';
                if($approval->status_approval == 'APPROVE_1'){
                    $getApprove = DB::table('v_approval')->where('status_approval','APPROVE_2')->first();
                    $userApprove = $getApprove->employee_id;
                }else if($approval->status_approval == 'APPROVE_2'){
                    $getApprove = DB::table('v_approval')->where('status_approval','APPROVE_3')->first();
                    $userApprove = $getApprove->employee_id;
                }else if($approval->status_approval == 'APPROVE_3'){
                    $getApprove = DB::table('v_approval')->where('status_approval','APPROVE_4')->first();
                    $userApprove = $getApprove->employee_id;
                }else if($approval->status_approval == 'APPROVE_4'){
                    $getApprove = DB::table('v_approval')->where('status_approval','APPROVE_5')->first();
                    $userApprove = $getApprove->employee_id;
                }
            }else{
                $approval = DB::table('v_approval')
                            ->where('departement_id',$dataEmp->department_id)
                            ->where('position_id',$dataEmp->position_id)
                            ->where('status_approval','APPROVE_1')
                            ->first();
                // $userApprove = $approval->employee_id;
                $userApprove = 100;
            }
            if ($request->request_type =="attendance"){
                $dataAttend = [
                    'date'          => $request->date,
                    'employee_id'   => $request->employee_id,
                    'status'        => $request->status,
                    'clock_in'      => $request->clock_in,
                    'clock_out'     => $request->clock_out,
                    'late'          =>'00:00:00',
                    'early_leaving' =>'00:00:00',
                    'overtime'      =>'00:00:00',
                    'total_rest'    =>'00:00:00',
                    'created_by'    => Auth::user()->id,
                ];
                $data_id = AttendanceEmployee::create($dataAttend)->id;
            }else if($request->request_type =="schedule"){

            }else if($request->request_type =="timesheet"){
                 if ($request->file('formFile')) {
                    $fileName = time() . '_' . $request->file('formFile')->getClientOriginalName();
                    $store = $request->file('formFile')->storeAs('public', $fileName);
                    $pathFile = 'storage/' . $fileName ?? null;
                }
                $dataTimesheet = [
                    'employee_id'       => $request->employee_id,
                    'project_stage'     => $request->project_stage,
                    'start_date'        => $request->startdate,
                    'end_date'          => $request->enddate,
                    'taks_or_project'   => $request->task_or_project,
                    'activity'          => $request->activity,
                    'client_company'    => $request->client_company,
                    'label_project'     => $request->label_project,
                    'support'           => $request->support,
                    'remark'            => $request->remark,
                    'status'            => 'waiting',
                    'file_attachment'   => $pathFile,
                ];
                $data_id = Timesheet::create($dataTimesheet)->id;
                
            }else if($request->request_type =="overtime"){
                $employee       = Employee::where('id', $request->employee_id)->first();
                $dayType        = DayType::where('id', $request->daytype_id)->first();
                $diffInHour     = Carbon::parse($request->end_time)->diffInHours(Carbon::parse($request->start_time));
                $typeCompany = 'default';
                $data_id ='';
                if ($typeCompany=='default'){
                    // overtime calculation
                    // ini belum untuk pengurangan tanggal dan waktu
                    $overTimes = (int)$diffInHour - (int)$this->break_time($diffInHour);
                    if ($employee->work_type == "52" && $dayType->name =="Week Day"){
                        $tot_Overtime = $this->timeTot_weekday($overTimes);
                    }
                    if ($employee->work_type == "61" && $dayType->name =="Week Day"){
                        $tot_Overtime = $this->timeTot_weekday($overTimes);
                    }
                    if ($employee->work_type == "61" && $dayType->name =="Saturday"){
                        $tot_Overtime = $this->timeTot_61($overTimes,$dayType->name);
                    }
                    if ($employee->work_type == "61" && $dayType->name =="Holiday"){
                        $tot_Overtime = $this->timeTot_61($overTimes,$dayType->name);
                    }
                    if ($employee->work_type == "52" && $dayType->name =="Holiday"){
                        $tot_Overtime = $this->timeTot_52($overTimes);
                    }
                    $totFixedAllowance = $this->total_allowance($employee->id);
                    if (!is_null($employee->salary)) {
                        $overtimePayPerHour     = round(($employee->salary + $totFixedAllowance) /173);
                        $amount_fee             = round($tot_Overtime * $overtimePayPerHour);
                        $dataOvertime = [
                            'employee_id'        => $employee->id,
                            'overtime_type_id'   => 0,
                            'day_type_id'        => $request->daytype_id,
                            'start_date'         => $request->start_date,
                            'amount_fee'         => $amount_fee ,
                            'status'             => 'Pending',
                            'duration'           => $overTimes,
                            'start_time'         => $request->start_time,
                            'end_time'           => $request->end_time,
                        ];
                        $data_id = Overtime::create($dataOvertime)->id;
                    }
                }
            }else if($request->request_type =="leave"){
                if ($request->file('attachment_leave')) {
                    $fileName = time() . '_' . $request->file('attachment_leave')->getClientOriginalName();
                    $store = $request->file('attachment_leave')->storeAs('public', $fileName);
                    $pathFile = 'storage/' . $fileName ?? null;
                }
                $startDate = new DateTime($request->start_date);
                $endDate   = new DateTime($request->end_date);
                $total_leave_days = !empty($startDate->diff($endDate)) && $startDate < $endDate ? $startDate->diff($endDate)->days : 0;
                $dataLeave =[
                    'employee_id'               => $request->employee_id,
                    'leave_type_id'             => $request->leave_type_id,
                    'applied_on'                => $request->date_request,
                    'start_date'                => $request->start_date,
                    'end_date'                  => $request->end_date,
                    'total_leave_days'          => $total_leave_days,
                    'leave_reason'              => $request->leave_reason,
                    'status'                    => 'waiting',
                    'attachment_request_path'   => $pathFile,
                    'created_by'                => Auth::user()->id,
                ];
                $data_id = Leave::create($dataLeave)->id;
            }
                $data = [
                        'date'              => $request->date_request,
                        'branch_id'         => $request->branch_id,
                        'request_type'      => $request->request_type,
                        'request_data_id'   => $data_id,
                        'employee_id'       => $request->employee_id,
                        'approve_id'        => $userApprove,
                        'position_id'       => $dataEmp->position_id,
                        'department_id'     => $dataEmp->department_id,
                        'status'            => 'waiting',
                        'create_by'         => Auth::user()->id,
                    ];
                Request_employee::create($data);
                DB::commit();
             $res = [
                    'status' => 'success',
                    'msg'    => 'Request successfully created !',
                ];
            return response()->json($res);
        }catch (Exception $e) {
            DB::rollBack();
            $res = [
                'status' => 'error',
                'msg'    => 'Request Someting went wrong !',
            ];
            return response()->json($res);
        }

    }
    public function get_daytype(){
        $data['day_type'] = DayType::all();
        return response()->json($data);;
    }
    public function get_leavetype(){
        $data['leave_type'] = LeaveType::all();
        return response()->json($data);;
    }
    public function approve_leave(){

    }
    public function approve_overtime(){
        
    }
    public function approve_timesheet(){
        
    }
    public function approve_attendance(){
        
    }
}
