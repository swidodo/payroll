<?php

namespace App\Http\Controllers;

use App\Imports\AttendanceEmployeeImport;
use App\Models\AttendanceEmployee;
use App\Models\Branch;
use App\Models\Denda;
use App\Models\Employee;
use App\Models\AccessBranch;
use App\Models\LogAttendance;
use App\Models\Overtime;
use App\Models\OvertimeType;
use App\Models\ShiftSchedule;
use App\Models\ShiftType;
use App\Models\Utility;
use Carbon\Carbon;
use DataTables;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

class AttendanceEmployeeController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->can('manage attendance')) {
            $branches = Branch::where('created_by', Auth::user()->creatorId())->get();
            $employees = Employee::where('created_by', Auth::user()->creatorId())->get();
            if (Auth::user()->initial !="HO") {
                $emp = !empty(Auth::user()->employee) ? Auth::user()->employee->id : 0;
                $attendanceEmployee = AttendanceEmployee::where('employee_id', $emp);
                if ($request->type == 'monthly' && !empty($request->month)) {

                    $month = date('m', strtotime($request->month));
                    $year  = date('Y', strtotime($request->month));

                    $start_date = Carbon::parse(date($year . '-' . $month))->startOfMonth()->toDateString();
                    $end_date   = Carbon::parse(date($year . '-' . $month))->endOfMonth()->toDateString();

                    $attendanceEmployee->whereBetween(
                        'date',
                        [
                            $start_date,
                            $end_date,
                        ]
                    );
                } elseif ($request->type == 'daily' && !empty($request->date)) {

                    $attendanceEmployee->where('date', $request->date);
                } else {

                    $month      = date('m');
                    $year       = date('Y');
                    $start_date = Carbon::parse(date($year . '-' . $month))->startOfMonth()->toDateString();
                    $end_date   = Carbon::parse(date($year . '-' . $month))->endOfMonth()->toDateString();

                    $attendanceEmployee->whereBetween(
                        'date',
                        [
                            $start_date,
                            $end_date,
                        ]
                    );
                }
                $attendanceEmployee = $attendanceEmployee->get();
            } else {
                $branch = Branch::find(Auth::user()->branch_id);
                $emp = Employee::where('user_id',Auth::user()->id)->first();
                if (Auth::user()->type == "company"){
                    $data['branch'] = Branch::where('company_id',$branch->company_id)->get();
                }else{
                    $data['branch'] = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                    ->where('access_branches.employee_id',$emp->id)
                                                    ->where('access_branches.company_id',$branch->company_id)->get();
                }
                $data['employees'] = Employee::where('branch_id',$branch ->id);
                $data['date'] = date('Y-m-d');
            }
            return view('pages.contents.attendance.index', $data);
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }

    }
    public function get_data(Request $request){
        $data = DB::table('attendance_employees')
                    ->select('employees.no_employee',
                            'employees.name',
                            'shift_types.name as shif',
                            'attendance_employees.date',
                            'attendance_employees.status',
                            'attendance_employees.clock_in',
                            'attendance_employees.clock_out',
                            'attendance_employees.late',
                            'attendance_employees.early_leaving',
                            'attendance_employees.overtime',
                            'attendance_employees.id')
                    ->leftJoin('employees','attendance_employees.employee_id','=','employees.id')
                    ->leftJoin('shift_schedules','shift_schedules.employee_id','=','employees.id')
                    ->leftJoin('shift_types','shift_types.id','=','shift_schedules.shift_id')
                    ->where('employees.branch_id','=',$request->branch_id);
                    if($request->type_filter =="monthly"){
                        $month = date('m',strtotime($request->date));
                        $data->where(DB::raw("TO_CHAR(attendance_employees.date, 'MM')"),'=',$month);//ubah berdasarkan bulan
                    }else{
                        $data->where('attendance_employees.date','=',$request->date);
                    }
                    if ($request->employee_id != []){
                        $data->whereIn('employees.id',$request->employee_id);
                    }
                    $data->get();
        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn ='';
                            if(Auth()->user()->canany('edit attendance','delete attendance')){
                                $btn .= '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">';
                                if(Auth()->user()->can('edit attendance')){
                                    $btn .= '<a  data-url='.route('attendance.edit', $row->id).' id="edit-attendance_btn" class="dropdown-item edit-attendance" href="javascript:void(0)" ><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                }
                                // if(Auth()->user()->can('delete attendance')){
                                //     $btn .= '<a id="delete-attendance" data-url='.route('attendance.destroy', $row->id).' class="dropdown-item" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                // }
                                    $btn .= '</div></div>';
                                }
                                return $btn;
                            })
                        ->rawColumns(['action'])
                        ->make(true);

    }
    public function get_list_employee(Request $request){
        $data = Employee::where('branch_id','=',$request->branch_id)->with('branch');
        return datatables()->eloquent($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                                $input = '<input type="checkbox" name="list[]" class="checkedEmployee" value ="'.$row->id.'">';
                                return $input;
                            })
                            ->escapeColumns([])
                            ->toJson();
    }
    public function edit($id)
    {
        if (Auth::user()->can('edit attendance')) {
            $attendanceEmployee = AttendanceEmployee::where('id', $id)->with('employee')->get();
            return response()->json($attendanceEmployee);
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $employeeId      = !empty(Auth::user()->employee) ? Auth::user()->employee->id : 0;
        // $todayAttendance = AttendanceEmployee::where('employee_id', '=', $employeeId)->where('date', date('Y-m-d'))->first();
        // if(!empty($todayAttendance) && $todayAttendance->clock_out == '00:00:00')
        // {

        $startTime = Utility::getValByName('company_start_time');
        $endTime   = Utility::getValByName('company_end_time');

        if (Auth::user()->type != 'company') {

            $date = date("Y-m-d");
            $time = date("H:i:s");

            //early Leaving
            $totalEarlyLeavingSeconds = strtotime($date . $endTime) - time();
            $hours                    = floor($totalEarlyLeavingSeconds / 3600);
            $mins                     = floor($totalEarlyLeavingSeconds / 60 % 60);
            $secs                     = floor($totalEarlyLeavingSeconds % 60);
            $earlyLeaving             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

            if (time() > strtotime($date . $endTime)) {
                //Overtime
                $totalOvertimeSeconds = time() - strtotime($date . $endTime);
                $hours                = floor($totalOvertimeSeconds / 3600);
                $mins                 = floor($totalOvertimeSeconds / 60 % 60);
                $secs                 = floor($totalOvertimeSeconds % 60);
                $overtime             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
            } else {
                $overtime = '00:00:00';
            }

            // $attendanceEmployee                 = AttendanceEmployee::find($id);
            $attendanceEmployee['clock_out']     = $time;
            $attendanceEmployee['early_leaving'] = $earlyLeaving;
            $attendanceEmployee['overtime']      = $overtime;

            if (!empty($request->date)) {
                $attendanceEmployee['date']       =  $request->date;
            }
            AttendanceEmployee::where('id', $id)->update($attendanceEmployee);

            return redirect()->back()->with('success', 'Employee successfully clock Out.');
        } else {
            $date = date("Y-m-d");

            //late
            $totalLateSeconds = strtotime($request->clock_in) - strtotime($date . $startTime);

            $hours = floor($totalLateSeconds / 3600);
            $mins  = floor($totalLateSeconds / 60 % 60);
            $secs  = floor($totalLateSeconds % 60);
            $late  = substr(sprintf('%02d:%02d:%02d', $hours, $mins, $secs),0,8);
            
            //early Leaving
            $totalEarlyLeavingSeconds = strtotime($date . $endTime) - strtotime($request->clock_out);
            $hours                    = floor($totalEarlyLeavingSeconds / 3600);
            $mins                     = floor($totalEarlyLeavingSeconds / 60 % 60);
            $secs                     = floor($totalEarlyLeavingSeconds % 60);
            $earlyLeaving             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);


            if (strtotime($request->clock_out) > strtotime($date . $endTime)) {
                //Overtime
                $totalOvertimeSeconds = strtotime($request->clock_out) - strtotime($date . $endTime);
                $hours                = floor($totalOvertimeSeconds / 3600);
                $mins                 = floor($totalOvertimeSeconds / 60 % 60);
                $secs                 = floor($totalOvertimeSeconds % 60);
                $overtime             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
            } else {
                $overtime = '00:00:00';
            }

            $attendanceEmployee                = AttendanceEmployee::find($id);
            $attendanceEmployee->employee_id   = $request->employee_id;
            $attendanceEmployee->date          = $request->date;
            $attendanceEmployee->clock_in      = $request->clock_in;
            $attendanceEmployee->clock_out     = $request->clock_out;
            $attendanceEmployee->late          = $late;
            $attendanceEmployee->early_leaving = ($earlyLeaving > 0) ? $earlyLeaving : '00:00:00';
            $attendanceEmployee->overtime      = $overtime;
            $attendanceEmployee->total_rest    = '00:00:00';
            $attendanceEmployee->status    = $request->status;

            $saveData = $attendanceEmployee->save();
            if($saveData){
                 $res = [
                       'status' => 'success',
                       'msg'    => 'Employee attendance successfully updated.',
                    ];
            }else{
                $res = [
                       'status' => 'error',
                       'msg'    => 'Someting went wrong !.',
                    ];
            }
            return response()->json($res);
        }
        // }
        // else
        // {
        //     return redirect()->back()->with('error', 'Employee are not allow multiple time clock in & clock out for every day.');
        // }
    }

    public function destroy($id)
    {
        if (Auth::user()->can('delete attendance')) {
            $attendance = AttendanceEmployee::where('id', $id)->first();

            $attendance->delete();

            return redirect()->route('attendance.index')->with('success', 'Attendance successfully deleted.');
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function bulkAttendance(Request $request)
    {
        if (Auth::user()->can('create attendance')) {

            $branches = Branch::where('created_by', Auth::user()->creatorId())->get();

            // $department = Department::where('created_by', Auth::user()->creatorId())->get()->pluck('name', 'id');
            // $department->prepend('Select Department', '');

            $employees = [];
            // $attendance  = AttendanceEmployee::where('date', now()->format('Y-m-d'))
            //     ->where('created_by', '=', Auth::user()->creatorId())
            //     ->where('status', 'Present')
            //     ->count();
            if (!empty($request->branch)) {
                $employees = Employee::where('created_by', Auth::user()->creatorId())->where('branch_id', $request->branch)->get();
            } else {
                $employees = Employee::where('created_by', Auth::user()->creatorId())->get();
            }


            return view('pages.contents.attendance.bulk', compact('employees', 'branches'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function bulkAttendanceData(Request $request)
    {
        // dd($request->all());
        if (Auth::user()->can('create attendance')) {
            if (!empty($request->branch)) {
                $startTime = Utility::getValByName('company_start_time');
                $endTime   = Utility::getValByName('company_end_time');
                $date      = $request->date;

                $employees = $request->employee_id;
                $atte      = [];
                foreach ($employees as $employee) {
                    $present = 'present-' . $employee;
                    $in      = 'in-' . $employee;
                    $out     = 'out-' . $employee;
                    $break_in      = 'break_in-' . $employee;
                    $break_out     = 'break_out-' . $employee;

                    $atte[]  = $present;
                    if ($request->$present == 'on') {
                        $in  = date("H:i:s", strtotime($request->$in));
                        $out = date("H:i:s", strtotime($request->$out));

                        $break_in  = date("H:i:s", strtotime($request->$break_in));
                        $break_out = date("H:i:s", strtotime($request->$break_out));

                        $totalLateSeconds = strtotime($in) - strtotime($startTime);

                        $hours = floor($totalLateSeconds / 3600);
                        $mins  = floor($totalLateSeconds / 60 % 60);
                        $secs  = floor($totalLateSeconds % 60);
                        $late  = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

                        //early Leaving
                        $totalEarlyLeavingSeconds = strtotime($endTime) - strtotime($out);
                        $hours                    = floor($totalEarlyLeavingSeconds / 3600);
                        $mins                     = floor($totalEarlyLeavingSeconds / 60 % 60);
                        $secs                     = floor($totalEarlyLeavingSeconds % 60);
                        $earlyLeaving             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

                        if (strtotime($out) > strtotime($endTime)) {
                            //Overtime
                            $totalOvertimeSeconds = strtotime($out) - strtotime($endTime);
                            $hours                = floor($totalOvertimeSeconds / 3600);
                            $mins                 = floor($totalOvertimeSeconds / 60 % 60);
                            $secs                 = floor($totalOvertimeSeconds % 60);
                            $overtime             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
                        } else {
                            $overtime = '00:00:00';
                        }

                        $attendance = AttendanceEmployee::where('employee_id', '=', $employee)->where('date', '=', $request->date)->first();

                        if (!empty($attendance)) {
                            $employeeAttendance = $attendance;
                        } else {
                            $employeeAttendance              = new AttendanceEmployee();
                            $employeeAttendance->employee_id = $employee;
                            $employeeAttendance->created_by  = Auth::user()->creatorId();
                        }

                        $employeeAttendance->date          = $request->date;
                        $employeeAttendance->status        = 'Present';
                        $employeeAttendance->clock_in      = $in;
                        $employeeAttendance->clock_out     = $out;
                        $employeeAttendance->break_in      = $break_in;
                        $employeeAttendance->break_out     = $break_out;
                        $employeeAttendance->late          = $late;
                        $employeeAttendance->early_leaving = ($earlyLeaving > 0) ? $earlyLeaving : '00:00:00';
                        $employeeAttendance->overtime      = $overtime;
                        $employeeAttendance->total_rest    = '00:00:00';
                        $employeeAttendance->save();
                    } else {
                        $attendance = AttendanceEmployee::where('employee_id', '=', $employee)->where('date', '=', $request->date)->first();

                        if (!empty($attendance)) {
                            $employeeAttendance = $attendance;
                        } else {
                            $employeeAttendance              = new AttendanceEmployee();
                            $employeeAttendance->employee_id = $employee;
                            $employeeAttendance->created_by  = Auth::user()->creatorId();
                        }

                        $employeeAttendance->status        = 'Leave';
                        $employeeAttendance->date          = $request->date;
                        $employeeAttendance->clock_in      = '00:00:00';
                        $employeeAttendance->clock_out     = '00:00:00';
                        $employeeAttendance->break_in      = '00:00:00';
                        $employeeAttendance->break_out     = '00:00:00';
                        $employeeAttendance->late          = '00:00:00';
                        $employeeAttendance->early_leaving = '00:00:00';
                        $employeeAttendance->overtime      = '00:00:00';
                        $employeeAttendance->total_rest    = '00:00:00';
                        $employeeAttendance->save();
                    }
                }

                toast('Employee attendance successfully created.', 'success');
                return redirect()->back();
            } else {
                toast('Branch field required.', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function clockStore(Request $request)
    {
        $employeeId = Employee::where('user_id',Auth::user()->id)->first();
        $employeeShift = ShiftSchedule::where('employee_id', Auth::user()->employee->id)
                                    ->where('schedule_date', Carbon::now()->format('Y-m-d'))
                                    ->where('is_active','=',true)
                                    ->first();

        $startTime = Utility::getValByName('company_start_time');
        $endTime   = Utility::getValByName('company_end_time');

        $shiftSchedule = ShiftSchedule::where('employee_id', Auth::user()->employee->id)
                                        ->where('branch_id', '=', $employeeId->branch_id)
                                        ->where('schedule_date', date('Y-m-d'))
                                        ->first();
        if (Auth::user()->type != 'company') {
            if (!is_null($shiftSchedule)) {
                $employee = Employee::where('user_id', Auth::user()->id)->first();
                if ($request->clock == 'clock_in') {
                    $in  = date("H:i:s");
                    $totalLateSeconds = strtotime($in) - strtotime($employeeShift->shift_type->start_time);
                    // late
                    $hours = floor($totalLateSeconds / 3600);
                    $mins  = floor($totalLateSeconds / 60 % 60);
                    $secs  = floor($totalLateSeconds % 60);
                    // validasi jadwal
                    $late  = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
                    $dendas = Denda::where('created_by', Auth::user()->creatorId())->get();
                    
                    $employeeAttendance                = new AttendanceEmployee();
                    $employeeAttendance->employee_id   = $employee->id;
                    $employeeAttendance->created_by    = Auth::user()->creatorId();
                    $employeeAttendance->date          = date("Y-m-d");
                    $employeeAttendance->status        = $shiftSchedule->is_dayoff ? 'OVERTIME' : 'PRESENT';
                    $employeeAttendance->clock_in      = $in;
                    $employeeAttendance->clock_out     = '00:00:00';
                    $employeeAttendance->late          = ($late > 0) && $shiftSchedule->is_dayoff != true ? $late : '00:00:00';
                    $employeeAttendance->early_leaving = '00:00:00';
                    $employeeAttendance->overtime      = '00:00:00';
                    $employeeAttendance->total_rest    = '00:00:00';
                    $employeeAttendance->save();

                    if (!is_null($dendas)) {
                        $amountDenda = 0;
                        foreach ($dendas as $key => $value) {
                            if ($late > 0 && strtotime($late) < strtotime($value->time)) {
                                $attendanceEmployee = AttendanceEmployee::where('employee_id', Auth::user()->employee->id)->where('date', date('Y-m-d'))->first();

                                $attendanceEmployee->denda = $value->amount;
                                $attendanceEmployee->save();
                            }
                        }
                    }

                    LogAttendance::create([
                        'employee_id'   => $employeeAttendance->employee_id,
                        'date'          => now(),
                        'activity'      => ucwords($employeeAttendance->employee->name) . ' Has Clocked In',
                        'created_by'    => Auth::user()->creatorId()
                    ]);
                    toast('Succes Clock In!', 'success');
                    return redirect()->back();
                } else {
                    $out = date("H:i:s");
                    $employee         = Employee::where('user_id', Auth::user()->id)->first();
                    $employeeAttendance = AttendanceEmployee::where('employee_id', $employee->id)->orderBy('id', 'desc')->first();

                    //early Leaving
                    $totalEarlyLeavingSeconds = strtotime($employeeShift->shift_type->end_time) - strtotime($out);
                    // dd($employeeShift->shift_type->end_time);
                    $hours                    = floor($totalEarlyLeavingSeconds / 3600);
                    $mins                     = floor($totalEarlyLeavingSeconds / 60 % 60);
                    $secs                     = floor($totalEarlyLeavingSeconds % 60);
                    $earlyLeaving             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
                    
                    // dihidden untuk kalkulasi overtime otomatis
                    if ($shiftSchedule->is_dayoff) {
                        if (strtotime($out) > strtotime($employeeShift->shift_type->start_time)) {
                            //Overtime
                            $totalOvertimeSeconds = strtotime($out) - strtotime($employeeShift->shift_type->start_time);
                            $hours                = floor($totalOvertimeSeconds / 3600);
                            $mins                 = floor($totalOvertimeSeconds / 60 % 60);
                            $secs                 = floor($totalOvertimeSeconds % 60);
                            $overtime             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
                        }
                    }

                        // // overtime calculation fee
                        // $diffInHour     = Carbon::parse($out)->diffInHours(Carbon::parse($employeeAttendance->clock_in));
                        // $diffInDay     = 1;
                        // $duration       = strtotime($out) - strtotime($employeeAttendance->clock_in);
                        // $durationToTime =  gmdate('H:i:s', $duration);

                        // $pay = 0;
                        // $amount_fee = 0;
                        // if (!is_null($employee->basic_salary)) {
                        //     $overtimePayPerHour    = 1 / 173 * $employee->basic_salary->amount;
                        //     if ($diffInHour == 1) {
                        //         $pay = 1.5 * floor($overtimePayPerHour);
                        //     } elseif ($diffInHour > 1) {
                        //         $pay = 0;
                        //         for ($i = 0; $i < $diffInHour; $i++) {
                        //             if ($i == 0) {
                        //                 $pay += 1.5 * floor($overtimePayPerHour);
                        //             } else {
                        //                 $pay += 2 * floor($overtimePayPerHour);
                        //             }
                        //         }
                        //     }
                        //     $amount_fee = $diffInDay > 0 ? $pay * $diffInDay : 0;
                        // } else {
                        //     toast('Please set employee salary.', 'warning');
                        //     return redirect()->back();
                        // }

                    //     $overtimeType = OvertimeType::where('name', 'Dayoff Overtime')->first();
                    //     if (is_null($overtimeType)) {
                    //         $overtimeType = OvertimeType::create([
                    //             'name' => 'Dayoff Overtime',
                    //             'created_by' => Auth::user()->creatorId()
                    //         ]);
                    //     }

                    //     $overtimeModel = new Overtime();
                    //     $overtimeModel->employee_id      = $employee->id;
                    //     $overtimeModel->start_date       = $employeeAttendance->date;
                    //     $overtimeModel->end_date         = $employeeAttendance->date;
                    //     $overtimeModel->start_time       = $employeeAttendance->clock_in;
                    //     $overtimeModel->end_time         = $out;
                    //     $overtimeModel->duration         = $durationToTime;
                    //     $overtimeModel->amount_fee       = $amount_fee;
                    //     $overtimeModel->status           =  'Approved';
                    //     $overtimeModel->overtime_type_id =  $overtimeType->id;
                    //     $overtimeModel->created_by       = Auth::user()->creatorId();
                    //     $overtimeModel->save();
                    // } else {
                    //     $overtime = '00:00:00';
                    // }

                    $employeeAttendance->clock_out     = $out;
                    $employeeAttendance->early_leaving = ($earlyLeaving > 0) && $shiftSchedule->is_dayoff != true ? $earlyLeaving : '00:00:00';
                    $employeeAttendance->overtime      = (isset($overtime)) ? $overtime : '00:00:00';
                    $employeeAttendance->total_rest    = '00:00:00';
                    $employeeAttendance->save();

                    LogAttendance::create([
                        'employee_id'   => $employeeAttendance->employee_id,
                        'date'          => now(),
                        'activity'      => ucwords($employeeAttendance->employee->name) . ' Has Clocked Out',
                        'created_by'    => Auth::user()->creatorId()
                    ]);
                    toast('Succes Clock Out!', 'success');
                    return redirect()->route('dashboard');
                }
            } else {
                $employee = Employee::where('user_id', Auth::user()->id)->first();
                if ($request->clock == 'clock_in') {
                    $in  = date("H:i:s");
                    $totalLateSeconds = strtotime($in) - strtotime($employeeShift->shift_type->start_time);
                    // late
                    $hours = floor($totalLateSeconds / 3600);
                    $mins  = floor($totalLateSeconds / 60 % 60);
                    $secs  = floor($totalLateSeconds % 60);
                    $late  = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
                    $dendas = Denda::where('created_by', Auth::user()->creatorId())->get();

                    $employeeAttendance              = new AttendanceEmployee();
                    $employeeAttendance->employee_id = $employee->id;
                    $employeeAttendance->created_by  = Auth::user()->creatorId();
                    $employeeAttendance->date          = date("Y-m-d");
                    $employeeAttendance->status        = $shiftSchedule->is_dayoff ? 'OVERTIME' : 'PRESENT';
                    $employeeAttendance->clock_in      = $in;
                    $employeeAttendance->clock_out     = '00:00:00';
                    $employeeAttendance->late          = ($late > 0) && $shiftSchedule->is_dayoff != true ? $late : '00:00:00';
                    $employeeAttendance->early_leaving = '00:00:00';
                    $employeeAttendance->overtime      = '00:00:00';
                    $employeeAttendance->total_rest    = '00:00:00';
                    $employeeAttendance->save();

                    if (!is_null($dendas)) {
                        $amountDenda = 0;
                        foreach ($dendas as $key => $value) {
                            if ($late > 0 && strtotime($late) < strtotime($value->time)) {
                                $attendanceEmployee = AttendanceEmployee::where('employee_id', Auth::user()->employee->id)->where('date', date('Y-m-d'))->first();

                                $attendanceEmployee->denda = $value->amount;
                                $attendanceEmployee->save();
                            }
                        }
                    }

                    LogAttendance::create([
                        'employee_id'   => $employeeAttendance->employee_id,
                        'date'          => now(),
                        'activity'      => ucwords($employeeAttendance->employee->name) . ' Has Clocked In',
                        'created_by'    => Auth::user()->creatorId()
                    ]);
                    toast('Succes Clock In!', 'success');
                    return redirect()->back();
                } else {
                    $out = date("H:i:s");
                    $employee         = Employee::where('user_id', Auth::user()->id)->first();
                    $employeeAttendance = AttendanceEmployee::where('employee_id', $employee->id)->orderBy('id', 'desc')->first();

                    //early Leaving
                    $totalEarlyLeavingSeconds = strtotime($employeeShift->shift_type->end_time) - strtotime($out);
                    $hours                    = floor($totalEarlyLeavingSeconds / 3600);
                    $mins                     = floor($totalEarlyLeavingSeconds / 60 % 60);
                    $secs                     = floor($totalEarlyLeavingSeconds % 60);
                    $earlyLeaving             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
                    
                    // dihidden untuk kalkulasi overtime otomatis
                    // if ($shiftSchedule->is_dayoff) {
                    //     if (strtotime($out) > strtotime($employeeShift->shift_type->start_time)) {
                    //         //Overtime
                    //         $totalOvertimeSeconds = strtotime($out) - strtotime($employeeShift->shift_type->start_time);
                    //         $hours                = floor($totalOvertimeSeconds / 3600);
                    //         $mins                 = floor($totalOvertimeSeconds / 60 % 60);
                    //         $secs                 = floor($totalOvertimeSeconds % 60);
                    //         $overtime             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
                    //     }

                    //     // overtime calculation fee
                    //     $diffInHour     = Carbon::parse($out)->diffInHours(Carbon::parse($employeeAttendance->clock_in));
                    //     $diffInDay     = 1;
                    //     $duration       = strtotime($out) - strtotime($employeeAttendance->clock_in);
                    //     $durationToTime =  gmdate('H:i:s', $duration);

                    //     $pay = 0;
                    //     $amount_fee = 0;
                    //     if (!is_null($employee->basic_salary)) {
                    //         $overtimePayPerHour    = 1 / 173 * $employee->basic_salary->amount;
                    //         if ($diffInHour == 1) {
                    //             $pay = 1.5 * floor($overtimePayPerHour);
                    //         } elseif ($diffInHour > 1) {
                    //             $pay = 0;
                    //             for ($i = 0; $i < $diffInHour; $i++) {
                    //                 if ($i == 0) {
                    //                     $pay += 1.5 * floor($overtimePayPerHour);
                    //                 } else {
                    //                     $pay += 2 * floor($overtimePayPerHour);
                    //                 }
                    //             }
                    //         }
                    //         $amount_fee = $diffInDay > 0 ? $pay * $diffInDay : 0;
                    //     } else {
                    //         toast('Please set employee salary.', 'warning');
                    //         return redirect()->back();
                    //     }

                    //     $overtimeType = OvertimeType::where('name', 'Dayoff Overtime')->first();
                    //     if (is_null($overtimeType)) {
                    //         $overtimeType = OvertimeType::create([
                    //             'name' => 'Dayoff Overtime',
                    //             'created_by' => Auth::user()->creatorId()
                    //         ]);
                    //     }

                    //     $overtimeModel = new Overtime();
                    //     $overtimeModel->employee_id      = $employee->id;
                    //     $overtimeModel->start_date       = $employeeAttendance->date;
                    //     $overtimeModel->end_date         = $employeeAttendance->date;
                    //     $overtimeModel->start_time       = $employeeAttendance->clock_in;
                    //     $overtimeModel->end_time         = $out;
                    //     $overtimeModel->duration         = $durationToTime;
                    //     $overtimeModel->amount_fee       = $amount_fee;
                    //     $overtimeModel->status           =  'Approved';
                    //     $overtimeModel->overtime_type_id =  $overtimeType->id;
                    //     $overtimeModel->created_by       = Auth::user()->creatorId();
                    //     $overtimeModel->save();
                    // } else {
                    //     $overtime = '00:00:00';
                    // }

                    $employeeAttendance->clock_out     = $out;
                    $employeeAttendance->early_leaving = ($earlyLeaving > 0) && $shiftSchedule->is_dayoff != true ? $earlyLeaving : '00:00:00';
                    $employeeAttendance->overtime      = $overtime;
                    $employeeAttendance->total_rest    = '00:00:00';
                    $employeeAttendance->save();

                    LogAttendance::create([
                        'employee_id'   => $employeeAttendance->employee_id,
                        'date'          => now(),
                        'activity'      => ucwords($employeeAttendance->employee->name) . ' Has Clocked Out',
                        'created_by'    => Auth::user()->creatorId()
                    ]);
                    toast('Succes Clock Out!', 'success');
                    return redirect()->route('dashboard');
                }
            }
        } else {
            toast('You are not an employee!', 'warning');
            return redirect()->route('dashboard');
        }
    }
    public function breakStore(Request $request)
    {
        $shiftSchedule = ShiftSchedule::where('employee_id', Auth::user()->employee->id)
            ->where('branch_id', '=', Auth::user()->branch_id)
            ->where('schedule_date', date('Y-m-d'))
            ->first();
        if (Auth::user()->type != 'company') {
            if (!is_null($shiftSchedule)) {
                $employee = Employee::where('user_id', Auth::user()->id)->first();
                $employeeAttendance = AttendanceEmployee::where('employee_id', $employee->id)
                                                        ->orderBy('id', 'desc')->first();
                if ($request->break == 'break_in') {
                    $in  = date("H:i:s");

                    $employeeAttendance->break_in    = $in;
                    $employeeAttendance->save();

                    LogAttendance::create([
                        'employee_id'   => $employeeAttendance->employee_id,
                        'date'          => now(),
                        'activity'      => ucwords($employeeAttendance->employee->name) . ' Began To Rest',
                        'created_by'    => Auth::user()->creatorId()
                    ]);
                    toast('Succes Break In!', 'success');
                    return redirect()->route('dashboard');
                } else {
                    $out = date("H:i:s");
                    $employeeAttendance->break_out    = $out;
                    $employeeAttendance->save();

                    LogAttendance::create([
                        'employee_id'   => $employeeAttendance->employee_id,
                        'date'          => now(),
                        'activity'      => ucwords($employeeAttendance->employee->name) . ' Finished Resting',
                        'created_by'    => Auth::user()->creatorId()
                    ]);
                    toast('Succes Break Out!', 'success');
                    return redirect()->route('dashboard');
                }
            } else {
                toast('You dont have shift today', 'warning');
                return redirect()->route('dashboard');
            }
        } else {
            toast('You are not an employee!', 'warning');
            return redirect()->route('dashboard');
        }
    }
    public function get_employee_adustment(Request $request){
        $branch = $request->branch_id;
        $data['employee'] = Employee::select('id','no_employee','name')->where('branch_id',$branch)->get();
        return response()->json($data);
    }
    public function ajdustment(Request $request){
        $i = 0;
        $attendance = [];
        foreach($request->date as $date){
            $data = [
                'employee_id' => $request->employee_id,
                'date'        => $date,
                'clock_in'    => $request->clock_in[$i],
                'clock_out'   => $request->clock_out[$i],
                'status'      => $request->status[$i],
                'late'        => '00:00:00',
                'early_leaving'=> '00:00:00',
                'overtime'     => '00:00:00',
                'total_rest'     => '00:00:00',
                'created_at'  => date('Y-m-d h:m:s'),
                'updated_at'  => date('Y-m-d h:m:s'),
                'created_by'  => Auth::user()->id,
            ];
            $i++;
            if (!in_array($data,$attendance)){
                array_push($attendance, $data);
            }
        }
       $insert =  AttendanceEmployee::insert($attendance);
       if ($insert){
            $res = [
                'status' => 'success',
                'msg'    => 'Data successfully ajdustmented !'
            ];
       }else{
            $res = [
                'status' => 'success',
                'msg'    => 'Someting went Wrong !'
            ];
       }
       return response()->json($res);
    }
    public function importExcel()
    {
        $file_extension = request()->file('file-excel')->extension();
        if ('csv' == $file_extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } elseif ('xls' == $file_extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } elseif ('xlsx' == $file_extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        // $reader = new Xls();
        $spreadsheet = $reader->load(request()->file('file-excel'));
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $dataEmployee = [];
        $attendaceData = [];
        $status = null;
        // dd($sheetData);
        foreach ($sheetData as $key => $value) {
            if ($key > 0) :
                $employeeId = employee::where('no_employee',$value[1])->where('branch_id',Auth::user()->branch_id)->first();
                if ($employeeId != null ):
                    $checked = AttendanceEmployee::where('employee_id',$employeeId->id)->where('date',$value[3])->first();
                    if ($checked !=null):
                        $data = [
                            'employee_id'       => $employeeId->id,
                            'date'              => $value[3],
                            'clock_in'          => $value[4],
                            'clock_out'         => $value[5],
                            'late'              => $value[6],
                            'early_leaving'     => $value[7],
                            'overtime'          => $value[8],
                            'status'            => ucwords($status),
                            'total_rest'        => '00:00:00',
                            'created_at'        => date('Y-m-d h:m:s'),
                            'updated_at'        => date('Y-m-d h:m:s'),
                            'created_by'        => Auth::user()->id,
                        ];
                        $status = AttendanceEmployee::where('employee_id')->update($data);
                    endif;
                endif;
                if (ucwords($value[9]) == 'Present' || 
                    ucwords($value[9]) == 'Alpha' || 
                    ucwords($value[9]) == 'Permit' || 
                    ucwords($value[9]) == 'Sick' ||
                    ucwords($value[9]) == 'Leave' ||
                    ucwords($value[9]) == 'Dispensation'
                     )
                {
                    $status = $value[9];
                }else{
                     $status = '';
                }
                if ($employeeId != null ):
                    if ($checked ==null):
                        $data = [
                            'employee_id'       => $employeeId->id,
                            'date'              => $value[3],
                            'clock_in'          => $value[4],
                            'clock_out'         => $value[5],
                            'late'              => $value[6],
                            'early_leaving'     => $value[7],
                            'overtime'          => $value[8],
                            'status'            => ucwords($status),
                            'total_rest'        => '00:00:00',
                            'created_at'        => date('Y-m-d h:m:s'),
                            'updated_at'        => date('Y-m-d h:m:s'),
                            'created_by'        => Auth::user()->id,
                        ];
                        if(!in_array($data,$dataEmployee)){
                            array_push($dataEmployee,$data);
                        }
                    endif;
                endif;
            endif;
        }
        if (count($dataEmployee) > 0){
            $status = AttendanceEmployee::insert($dataEmployee);
        }
        if ($status) {
            $res = [
                'status' => 'success',
                'msg'    => 'Successfully Import Attendance !'
            ];
            // toast('Successfully Import Attendance', 'success');
            // return redirect()->back();
        }else{
            $res = [
                'status' => 'success',
                'msg'    => 'Someting went wrong !'
            ];
            // toast('Something wrong went Import Attendance', 'error');
            // return redirect()->back();
        }
        return response()->json($res);
        
    }

    public function view_maps(Request $request){
        $data = DB::table('attendance_locations')->where('attendance_employees_id',$request->id)->get();
        $initialMarkers = [];
        foreach($data as $loglat){
            if ($loglat->longitude != null &&  $loglat->latitude != null):
                $loc = [
                    'position' => [
                        'lat' => substr($loglat->latitude,0,20),
                        'lng' => substr($loglat->longitude,0,20)
                    ],
                    'draggable' => true,
                    'name' => $loglat->status.' : ',
                ];
                if (!in_array($loc,$initialMarkers)){
                    array_push($initialMarkers,$loc);
                }
            endif;
        }
        return view('pages.contents.report.daily_report.maps', compact('initialMarkers'));
    }
    public function rekap_cutoff_montnly(Request $request){
        $branch = Branch::find(Auth::user()->branch_id);
                $emp = Employee::where('user_id',Auth::user()->id)->first();
                if (Auth::user()->type == "company"){
                    $branches = Branch::where('company_id',$branch->company_id)->get();
                }else{
                    $branches = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                    ->where('access_branches.employee_id',$emp->id)
                                                    ->where('access_branches.company_id',$branch->company_id)->get();
                }
        if(($request->startdate == null)){
            $bulan      = date('m');
            $tahun      = date('Y');
            $tglstart   = date('d');
            $bulanEnd   = date('m');
            $tahunEnd   = date('Y');
            $tglEnd     = date('d');
            $start_date = date('Y-m');
            $end_date   = date('Y-m');
            
        }else{
            $bulan       = date('m',strtotime($request->startdate));
            $tahun       = date('Y',strtotime($request->startdate));
            $tglstart    = date('d',strtotime($request->startdate));

            $bulanEnd  = date('m',strtotime($request->enddate));
            $tahunEnd  = date('Y',strtotime($request->enddate));
            $tglEnd    = date('d',strtotime($request->enddate));

            $start_date = date('Y-m',strtotime($request->startdate));
            $end_date   = date('Y-m',strtotime($request->enddate));
        }
        
        $jumtglstart = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun); // dapat jumlah tanggal 
        $jumtglEnd = cal_days_in_month(CAL_GREGORIAN, $bulanEnd, $tahunEnd); // dapat jumlah tanggal
        
        if ($start_date != $end_date ){
            $header = [];
            $field = ['employee_id','employee_name'];
            for($i=$tglstart; $i<=$jumtglstart;$i ++){
                if($i < 10){
                    array_push($header,'0'.(int)$i);
                    array_push($field,'0'.(int)$i.' as d'.(int)$i);
                }else{
                    array_push($header,$i);
                    array_push($field,$i.' as d'.$i);
                }
            }

            $headerEnd = [];
            $fieldEnd = [];
            for($i=$tglEnd; $i<=$jumtglEnd;$i ++){
                if($i < 10){
                    array_push($headerEnd,'0'.(int)$i);
                    array_push($fieldEnd,'0'.(int)$i.' as e'.(int)$i);
                }else{
                    array_push($headerEnd,$i);
                    array_push($fieldEnd,$i.' as e'.$i);
                }
            }
            $dtfield = [];
            foreach($field as $fs){
                $f = "v_rekap_periode_attendance.$fs";
                array_push($dtfield,$f);
            }
            foreach($fieldEnd as $fe){
                $f = "v_rekap_periode_attendance_end.$fe";
                array_push($dtfield,$f);
            }
            $data= DB::table('v_rekap_periode_attendance')
                        ->distinct()
                        ->leftJoin('v_rekap_periode_attendance_end','v_rekap_periode_attendance_end.employee_id','=', 'v_rekap_periode_attendance.employee_id')
                        ->where('v_rekap_periode_attendance.bulan','=',$start_date)
                        ->where('v_rekap_periode_attendance_end.bulan','=',$end_date)
                        ->where('v_rekap_periode_attendance.branch_id',$request->branch_id)
                        ->get($dtfield);
        }else{
            $header = [];
            $field = ['employee_id','employee_name'];
            for($i=$tglstart; $i<=$jumtglstart;$i ++){
                if($i < 10){
                    array_push($header,'0'.(int)$i);
                    array_push($field,'0'.(int)$i.' as d'.(int)$i);
                }else{
                    array_push($field,$i.' as d'.$i);
                    array_push($header,$i);
                }
            }
            $dtfield = [];
            foreach($field as $fs){
                $f = "v_rekap_periode_attendance.$fs";
                array_push($dtfield,$f);
            }
            $headerEnd = [];
            $jumtglEnd = 0;
            $tglEnd    = 0;
            $data= DB::table('v_rekap_periode_attendance')
                        ->distinct()
                        ->leftJoin('v_rekap_periode_attendance_end','v_rekap_periode_attendance_end.employee_id','=', 'v_rekap_periode_attendance.employee_id')
                        ->where('v_rekap_periode_attendance.bulan','=',$start_date)
                        ->where('v_rekap_periode_attendance.branch_id',$request->branch_id)
                        ->get($dtfield);
                        // dd($start_date);
        }
        return view('pages.contents.report.attendance.rekap_monthly',
                compact('header','data','tglstart','jumtglstart',
                        'headerEnd','tglEnd','jumtglEnd','branches'));
    }
    public function attendance_user(){
        $data['attendance'] = DB::table('attendance_employees')
                                ->select('employees.no_employee',
                                        'employees.name',
                                        'shift_types.name as shif',
                                        'attendance_employees.date',
                                        'attendance_employees.status',
                                        'attendance_employees.clock_in',
                                        'attendance_employees.clock_out',
                                        'attendance_employees.late',
                                        'attendance_employees.early_leaving',
                                        'attendance_employees.overtime',
                                        'attendance_employees.id')
                                ->leftJoin('employees','attendance_employees.employee_id','=','employees.id')
                                ->leftJoin('shift_schedules','shift_schedules.employee_id','=','employees.id')
                                ->leftJoin('shift_types','shift_types.id','=','shift_schedules.shift_id')
                                ->where('employees.branch_id','=',Auth::user()->branch_id)
                                ->where('attendance_employees.employee_id',auth()->user()->employee->id)
                                ->where(DB::raw("to_char(attendance_employees.date, 'YYYY-MM')"),DB::raw("to_char(now(),'YYYY-MM')"))
                                ->get();
        return view('pages.contents.attendance.attendance_employee',$data); 
    }
    public function attendance_search(Request $request){
        $data['attendance'] = DB::table('attendance_employees')
                                ->select('employees.no_employee',
                                        'employees.name',
                                        'shift_types.name as shif',
                                        'attendance_employees.date',
                                        'attendance_employees.status',
                                        'attendance_employees.clock_in',
                                        'attendance_employees.clock_out',
                                        'attendance_employees.late',
                                        'attendance_employees.early_leaving',
                                        'attendance_employees.overtime',
                                        'attendance_employees.id')
                                ->leftJoin('employees','attendance_employees.employee_id','=','employees.id')
                                ->leftJoin('shift_schedules','shift_schedules.employee_id','=','employees.id')
                                ->leftJoin('shift_types','shift_types.id','=','shift_schedules.shift_id')
                                ->where('employees.branch_id','=',Auth::user()->branch_id)
                                ->where('attendance_employees.employee_id',auth()->user()->employee->id)
                                ->where(DB::raw("to_char(attendance_employees.date, 'YYYY-MM')"),$request->priode)
                                ->get();
        return view('pages.contents.attendance.attendance_employee',$data); 
    }
}
