<?php

namespace App\Http\Controllers;

use App\Models\AttendanceEmployee;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\LogAttendance;
use App\Models\LogEmployeeResume;
use App\Models\ShiftSchedule;
use App\Models\Timesheet;
use App\Models\Utility;
use App\Models\Information;
use App\Models\Sys;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public  function index(Request $request)
    {
        $read = Sys::where('user_id',Auth::user()->id)->get();
        $pesan=[];
        foreach($read as $psn){
            array_push($pesan,$psn->information_id);
        }
        
        $notif = Information::leftJoin('sys','sys.information_id','=','information.id')
                        ->where('information.branch_id',Auth::user()->branch_id)
                        ->where('information.status',1)
                        ->whereNotIn('information.id', $pesan)
                        ->count();
        $request->session()->put('notif', $notif);
        if (Auth::user()->initial == 'HO') {
            $branch = Branch::find(Auth::user()->branch_id);
            $data['branches'] = Branch::where('company_id', '=', $branch->company_id)->get();
            // get notif
            $read = Sys::where('user_id',Auth::user()->id)->get();
            $pesan=[];
            foreach($read as $psn){
                array_push($pesan,$psn->information_id);
            }
            
            $data['inbox'] = Information::select('information.*')->leftJoin('sys','sys.information_id','=','information.id')
                            ->where('information.branch_id',Auth::user()->branch_id)
                            ->where('information.status',1)
                            ->whereNotIn('information.id', $pesan)
                            ->get();
            // $data['birtday'] = Employee::whereRaw(DB::raw("to_char(dob,'MM') = to_char(now(),'MM')"))->where('branch_id',Auth::user()->branch_id)->get();
            return view('pages.contents.dashboard.dashboard-company', $data);
        } else {
            $employee = Employee::where('user_id', Auth::user()->id)->first();
            $attendanceStatus = $employee->present_status($employee->id, date('Y-m-d'));
            $attendanceEmployee = AttendanceEmployee::where('employee_id', $employee->id)->where('date', date('Y-m-d'))->orderBy('id', 'desc')->first();
            $shiftSchedule = ShiftSchedule::where('employee_id', Auth::user()->employee->id)->where('created_by', '=', Auth::user()->creatorId())->where('schedule_date', date('Y-m-d'))->first();
            $timesheet = Timesheet::where('employee_id', Auth::user()->employee->id)->where('created_by', '=', Auth::user()->creatorId())->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->first();
            $read = Sys::where('user_id',Auth::user()->id)->get();
            $pesan=[];
            foreach($read as $psn){
                array_push($pesan,$psn->information_id);
            }
            $notif = Information::select('information.*')->leftJoin('sys','sys.information_id','=','information.id')
                                ->where('information.branch_id',Auth::user()->branch_id)
                                ->where('information.status',1)
                                ->whereNotIn('information.id', $pesan)
                                ->get();
            return view('pages.contents.dashboard.dashboard', compact('employee', 'attendanceStatus', 'attendanceEmployee', 'shiftSchedule', 'timesheet'));
        }
    }

    public function filterChartAttendance(Request $request)
    {
        $months = Utility::filterChart($request->all());

        // $months = json_encode($months);
        return response()->json($months);
    }

    public function filterByBranch(Request $request)
    {
        $branch = Branch::find($request->branch_id);
        $data = [];
        $branchId = Branch::where('id',Auth::user()->branch_id)->first();
        $logAttendanceQuery = LogAttendance::select('employees.name', 'log_attendances.date', 'log_attendances.activity')
            ->leftJoin('employees', 'log_attendances.employee_id', '=', 'employees.id')
            ->leftJoin('branches','employees.branch_id','=','branches.id')
            ->where('branches.company_id',$branchId->company_id);

        if (!is_null($branch)) {
            $data['totalEmployees'] = Employee::where('created_by', '=', Auth::user()->creatorId())
                ->where('branch_id', $branch->id)
                ->count();
            $data['totalEmployeesJobholder'] = Employee::where('created_by', '=', Auth::user()->creatorId())
                ->where('branch_id', $branch->id)
                ->where('employee_type', 'jobholder')
                ->count();
            $data['totalEmployeesContract'] = Employee::where('created_by', '=', Auth::user()->creatorId())
                ->where('branch_id', $branch->id)
                ->where('employee_type', '!=', 'jobholder')
                ->where('employee_type', '!=', 'freelancers')
                ->count();
            $data['totalEmployeesFreelance'] = Employee::where('created_by', '=', Auth::user()->creatorId())
                ->where('branch_id', $branch->id)
                ->where('employee_type', 'freelancers')
                ->count();

            $data['totalTodaySick'] = AttendanceEmployee::select('id')
                ->join('employees', 'attendance_employees.employee_id', '=', 'employees.id')
                ->where('attendance_employees.created_by', '=', Auth::user()->creatorId())
                ->where('attendance_employees.status', 'Sick With Letter')
                ->where('attendance_employees.date', now()->format('Y-m-d'))
                ->where('employees.branch_id', $branch->id)
                ->count();
            $data['totalTodayLeave'] = AttendanceEmployee::select('id')
                ->join('employees', 'attendance_employees.employee_id', '=', 'employees.id')
                ->where('attendance_employees.created_by', '=', Auth::user()->creatorId())
                ->where('attendance_employees.status', 'Leave')
                ->where('attendance_employees.date', now()->format('Y-m-d'))
                ->where('employees.branch_id', $branch->id)
                ->count();
            $data['totalTodayPermit'] = AttendanceEmployee::select('id')
                ->join('employees', 'attendance_employees.employee_id', '=', 'employees.id')
                ->where('attendance_employees.created_by', '=', Auth::user()->creatorId())
                ->where('attendance_employees.status', 'Permit')
                ->where('attendance_employees.date', now()->format('Y-m-d'))
                ->where('employees.branch_id', $branch->id)
                ->count();
            $data['totalTodayAlpha'] = AttendanceEmployee::select('id')
                ->join('employees', 'attendance_employees.employee_id', '=', 'employees.id')
                ->where('attendance_employees.created_by', '=', Auth::user()->creatorId())
                ->where('attendance_employees.status', '!=', 'Present')
                ->where('attendance_employees.status', '!=', 'Leave')
                ->where('attendance_employees.status', '!=', 'Permit')
                ->where('attendance_employees.status', '!=', 'Sick With Letter')
                ->where('attendance_employees.date', now()->format('Y-m-d'))
                ->where('employees.branch_id', $branch->id)
                ->count();

            $data['totalClockIn'] = AttendanceEmployee::select('id')
                ->join('employees', 'attendance_employees.employee_id', '=', 'employees.id')
                ->where('attendance_employees.created_by', '=', Auth::user()->creatorId())
                ->where('attendance_employees.status', 'Present')
                ->where('attendance_employees.date', now()->format('Y-m-d'))
                ->where('employees.branch_id', $branch->id)
                ->count();
            $data['totalAbsent'] = AttendanceEmployee::select('id')
                ->join('employees', 'attendance_employees.employee_id', '=', 'employees.id')
                ->where('attendance_employees.created_by', '=', Auth::user()->creatorId())
                ->where('attendance_employees.status', '!=', 'Present')
                ->where('employees.branch_id', $branch->id)
                ->count();
            $data['totalTimesheets'] = Timesheet::select('timesheets.*')
                ->join('employees', 'timesheets.employee_id', '=', 'employees.id')
                ->where('timesheets.created_by', '=', Auth::user()->creatorId())
                ->where('timesheets.status', 'Approved')
                ->where('employees.branch_id', $branch->id)
                ->count();
            $data['totalLate'] = AttendanceEmployee::select('id')
                ->join('employees', 'attendance_employees.employee_id', '=', 'employees.id')
                ->where('attendance_employees.created_by', '=', Auth::user()->creatorId())
                ->where('attendance_employees.status', 'Present')
                ->where('employees.branch_id', $branch->id)
                ->where('attendance_employees.date', now()->format('Y-m-d'))
                ->where('attendance_employees.late', '!=', '00:00:00')
                ->count();
            $data['timesheetsInCity'] = Timesheet::select('timesheets.*')
                ->join('employees', 'timesheets.employee_id', '=', 'employees.id')
                ->where('timesheets.created_by', '=', Auth::user()->creatorId())
                ->where('timesheets.status', 'Approved')
                ->where('timesheets.project_stage', 'like', 'Dinas Dalam Kota')
                ->where('employees.branch_id', $branch->id)
                ->count();
            $data['timesheetsOutCity'] = Timesheet::select('timesheets.*')
                ->join('employees', 'timesheets.employee_id', '=', 'employees.id')
                ->where('timesheets.created_by', '=', Auth::user()->creatorId())
                ->where('timesheets.status', 'Approved')
                ->where('timesheets.project_stage', 'like', 'Dinas Luar Kota')
                ->where('employees.branch_id', $branch->id)
                ->count();
            $data['logNewestAttendance'] = $logAttendanceQuery
                ->where('employees.branch_id', $branch->id)
                ->orderBy('date', 'desc')
                ->limit(3)
                ->get();

            $data['timesheetsSchedule'] = Timesheet::select('timesheets.*')
                ->join('employees', 'timesheets.employee_id', '=', 'employees.id')
                ->where('timesheets.created_by', '=', Auth::user()->creatorId())
                ->where('timesheets.start_date', '>=', now())
                ->where('employees.branch_id', $branch->id)
                ->orderBy('timesheets.start_date', 'asc')
                ->limit(5)
                ->get();

            $data['dataChart'] = Utility::filterChart([
                'dateFrom' => Carbon::now()->startOfYear()->format('M Y'),
                'dateTo' => Carbon::now()->format('M Y'),
                'branch_id' => $request->branch_id,
                'chart_type' => $request->chart_type,
                "yKeysArr"   => $request->yKeysArr,
                "labels" => $request->labels,
            ]);

            $data['male'] =  Employee::where('created_by', '=', Auth::user()->creatorId())
                ->where('branch_id', $branch->id)
                ->where('gender', 'Male')
                ->count();
            $data['female'] =  Employee::where('created_by', '=', Auth::user()->creatorId())
                ->where('branch_id', $branch->id)
                ->where('gender', 'Female')
                ->count();

            $data['dataChartGenderDiversity'] = [];
            if ($data['male'] == 0 && $data['female'] == 0) {
                $data['dataChartGenderDiversity'][0] = [
                    'label' => "None",
                    'value' => 0
                ];
            }

            if ($data['male'] > 0) {
                $data['dataChartGenderDiversity'][0] = [
                    'label' => 'Male',
                    'value' =>  $data['male']
                ];
            }

            if ($data['female'] > 0) {
                $data['dataChartGenderDiversity'][2] = [
                    'label' => 'Female',
                    'value' =>  $data['female']
                ];
            }


            return response()->json([
                'success' => true,
                'data'    => $data
            ], 200);
        } else {
            $bch = Branch::where('id',Auth::user()->branch_id)->first();

            $data['totalEmployees'] = Employee::leftJoin('branches','branches.id','employees.branch_id')->where('company_id', '=', $bch->company_id)
                ->count();
            $data['totalEmployeesJobholder'] = Employee::leftJoin('branches','branches.id','employees.branch_id')->where('company_id', '=', $bch->company_id)->where('employee_type', 'jobholder')
                ->count();
            $data['totalEmployeesContract'] = Employee::leftJoin('branches','branches.id','employees.branch_id')->where('company_id', '=', $bch->company_id)->where('employee_type', '!=', 'jobholder')
                ->where('employee_type', '!=', 'freelancers')
                ->count();
            $data['totalEmployeesFreelance'] = Employee::leftJoin('branches','branches.id','employees.branch_id')->where('company_id', '=', $bch->company_id)
                ->where('employee_type', 'freelancers')
                ->count();

            $data['totalTodaySick'] = AttendanceEmployee::select('id')
                ->join('employees', 'attendance_employees.employee_id', '=', 'employees.id')
                ->where('attendance_employees.created_by', '=', Auth::user()->creatorId())
                ->where('attendance_employees.status', 'Sick With Letter')
                ->where('attendance_employees.date', now()->format('Y-m-d'))
                ->count();
            $data['totalTodayLeave'] = AttendanceEmployee::select('id')
                ->join('employees', 'attendance_employees.employee_id', '=', 'employees.id')
                ->where('attendance_employees.created_by', '=', Auth::user()->creatorId())
                ->where('attendance_employees.status', 'Leave')
                ->where('attendance_employees.date', now()->format('Y-m-d'))
                ->count();
            $data['totalTodayPermit'] = AttendanceEmployee::select('id')
                ->join('employees', 'attendance_employees.employee_id', '=', 'employees.id')
                ->where('attendance_employees.created_by', '=', Auth::user()->creatorId())
                ->where('attendance_employees.status', 'Permit')
                ->where('attendance_employees.date', now()->format('Y-m-d'))
                ->count();
            $data['totalTodayAlpha'] = AttendanceEmployee::select('id')
                ->join('employees', 'attendance_employees.employee_id', '=', 'employees.id')
                ->where('attendance_employees.created_by', '=', Auth::user()->creatorId())
                ->where('attendance_employees.status', '!=', 'Present')
                ->where('attendance_employees.status', '!=', 'Leave')
                ->where('attendance_employees.status', '!=', 'Permit')
                ->where('attendance_employees.status', '!=', 'Sick With Letter')
                ->where('attendance_employees.date', now()->format('Y-m-d'))
                ->count();

            $data['totalClockIn'] = AttendanceEmployee::select('id')
                ->join('employees', 'attendance_employees.employee_id', '=', 'employees.id')
                ->where('attendance_employees.created_by', '=', Auth::user()->creatorId())
                ->where('attendance_employees.status', 'Present')
                ->where('attendance_employees.date', now()->format('Y-m-d'))
                ->count();
            $data['totalAbsent'] = AttendanceEmployee::select('id')
                ->join('employees', 'attendance_employees.employee_id', '=', 'employees.id')
                ->where('attendance_employees.created_by', '=', Auth::user()->creatorId())
                ->where('attendance_employees.status', '!=', 'Present')
                ->where('attendance_employees.date', now()->format('Y-m-d'))
                ->count();
            $data['totalTimesheets'] = Timesheet::select('timesheets.*')
                ->join('employees', 'timesheets.employee_id', '=', 'employees.id')
                ->where('timesheets.created_by', '=', Auth::user()->creatorId())
                ->where('timesheets.status', 'Approved')
                ->count();
            $data['totalLate'] = AttendanceEmployee::select('id')
                ->join('employees', 'attendance_employees.employee_id', '=', 'employees.id')
                ->where('attendance_employees.created_by', '=', Auth::user()->creatorId())
                ->where('attendance_employees.status', 'Present')
                ->where('attendance_employees.date', now()->format('Y-m-d'))
                ->where('attendance_employees.late', '!=', '00:00:00')
                ->count();
            $data['timesheetsInCity'] = Timesheet::select('timesheets.*')
                ->join('employees', 'timesheets.employee_id', '=', 'employees.id')
                ->where('timesheets.created_by', '=', Auth::user()->creatorId())
                ->where('timesheets.status', 'Approved')
                ->where('timesheets.project_stage', 'like', '%Dinas Dalam Kota%')
                ->count();
            $data['timesheetsOutCity'] = Timesheet::select('timesheets.*')
                ->join('employees', 'timesheets.employee_id', '=', 'employees.id')
                ->where('timesheets.created_by', '=', Auth::user()->creatorId())
                ->where('timesheets.status', 'Approved')
                ->where('timesheets.project_stage', 'like', '%Dinas Luar Kota%')
                ->count();
            $data['logNewestAttendance'] = $logAttendanceQuery
                ->orderBy('date', 'desc')
                ->limit(3)
                ->get();

            $data['timesheetsSchedule'] = Timesheet::select('timesheets.*')
                ->join('employees', 'timesheets.employee_id', '=', 'employees.id')
                ->where('timesheets.created_by', '=', Auth::user()->creatorId())
                ->where('timesheets.start_date', '>=', now()->format('Y-m-d'))
                ->orderBy('timesheets.id', 'asc')
                ->limit(5)
                ->get();

            $data['dataChart'] = Utility::filterChart([
                'dateFrom' => Carbon::now()->startOfYear()->format('M Y'),
                'dateTo' => Carbon::now()->format('M Y'),
                'branch_id' => 0,
                'chart_type' => $request->chart_type,
                "yKeysArr"   => $request->yKeysArr,
                "labels" => $request->labels,
            ]);

            $data['male'] =  Employee::where('created_by', '=', Auth::user()->creatorId())
                ->where('gender', 'Male')
                ->count();
            $data['female'] =  Employee::where('created_by', '=', Auth::user()->creatorId())
                ->where('gender', 'Female')
                ->count();

            $data['dataChartGenderDiversity'] = [];
            if ($data['male'] == 0 && $data['female'] == 0) {
                $data['dataChartGenderDiversity'][0] = [
                    'label' => "None",
                    'value' => 0
                ];
            }
            if ($data['male'] > 0) {
                $data['dataChartGenderDiversity'][0] = [
                    'label' => 'Male',
                    'value' =>  $data['male']
                ];
            }

            if ($data['female'] > 0) {
                $data['dataChartGenderDiversity'][1] = [
                    'label' => 'Female',
                    'value' =>  $data['female']
                ];
            }

            return response()->json([
                'success' => true,
                'data'    => $data
            ], 200);
        }
    }

    public function timesheetFilterByBranch(Request $request)
    {
        $branch = Branch::find($request->branch_id);
        $timesheetQuery = Timesheet::select('timesheets.*')
            ->join('employees', 'timesheets.employee_id', '=', 'employees.id')
            ->where('timesheets.created_by', '=', Auth::user()->creatorId());

        if (request()->ajax()) {
            $timesheet = $timesheetQuery;
            return DataTables::of($timesheet)
                ->filter(function (Builder $query) {
                    $request = request()->all();

                    $branch_id = $request['branch_id'] ?? '';

                    if (!empty($branch_id)) {
                        $query->where('employees.branch_id', $branch_id);
                    }
                })
                ->editColumn('status', function ($times) {
                    if ($times->status == 'Approved') {
                        return '<span class="badge bg-inverse-success">' . $times->status . '</span>';
                    } else {
                        return '<span class="badge bg-inverse-danger">' . $times->status . '</span>';
                    }
                })
                ->rawColumns(['status'])
                ->make(true);
        }
    }

    public function employeeResumeFilterByBranch(Request $request)
    {
        $query = LogEmployeeResume::where('branch_id', Auth::user()->branch_id)
            ->orderBy('date', 'desc')
            ->limit(5);

        if (request()->ajax()) {
            $q = $query;
            return DataTables::of($q)
                ->filter(function (Builder $query) {
                    $request = request()->all();

                    $branch_id = $request['branch_id'] ?? '';

                    if (!empty($branch_id)) {
                        $query->where('branch_id', $branch_id);
                    }
                })
                ->make(true);
        }
    }
    public function get_report_timesheet(Request $request){
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        $data = Timesheet::select('timesheets.*',
                                    'employees.no_employee',
                                    'employees.name as employee_name',
                                    'branches.name as branch_name')
                        ->leftJoin('employees','employees.id','=','timesheets.employee_id')
                        ->leftJoin('branches','branches.id','=','timesheets.branch_id');
                    if($request->branch_id ==0){
                        $data->where('branches.company_id',$branch->company_id);
                    }else{
                        $data->where('branches.id',$request->branch_id);
                    }
                        $data->get();
        return DataTables::of($data)->make(true);
    }
}
