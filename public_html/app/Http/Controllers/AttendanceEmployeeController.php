<?php

namespace App\Http\Controllers;

use App\Imports\AttendanceEmployeeImport;
use App\Models\AttendanceEmployee;
use App\Models\Branch;
use App\Models\Denda;
use App\Models\Employee;
use App\Models\LogAttendance;
use App\Models\Overtime;
use App\Models\OvertimeType;
use App\Models\ShiftSchedule;
use App\Models\ShiftType;
use App\Models\Utility;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
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

            // $department = Department::where('created_by', Auth::user()->creatorId())->get()->pluck('name', 'id');
            // $department->prepend('Select Department', '');

            if (Auth::user()->type != 'client' && Auth::user()->type != 'company') {

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

                $employee = Employee::select('id')->where('created_by', Auth::user()->creatorId());

                if (!empty($request->branch)) {
                    $employee->where('branch_id', $request->branch);
                }

                // if(!empty($request->department))
                // {
                //     $employee->where('department_id', $request->department);
                // }

                $employee = $employee->get()->pluck('id');

                $attendanceEmployee = AttendanceEmployee::whereIn('employee_id', $employee);
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
                // dd($attendanceEmployee->toSql());
                //dd($attendanceEmployee->toSql(), $attendanceEmployee->getBindings());
                $attendanceEmployee = $attendanceEmployee->get();
            }

            return view(
                'pages.contents.attendance.index',
                compact('branches', 'attendanceEmployee', 'employees')
                // , compact('attendanceEmployee', 'branch', 'department')
            );
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        if (Auth::user()->can('edit attendance')) {
            $attendanceEmployee = AttendanceEmployee::where('id', $id)->first();
            $employees          = Employee::where('created_by', '=', Auth::user()->creatorId())->get();

            // return view('attendance.edit', compact('attendanceEmployee', 'employees'));
            return response()->json([$employees, $attendanceEmployee]);
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
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
            $late  = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

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

            $attendanceEmployee->save();

            return redirect()->back()->with('success', 'Employee attendance successfully updated.');
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
        $employeeShift = ShiftSchedule::where('employee_id', Auth::user()->employee->id)->where('schedule_date', Carbon::now()->format('Y-m-d'))->where('status', 'Approved')->first();

        $startTime = Utility::getValByName('company_start_time');
        $endTime   = Utility::getValByName('company_end_time');
        $shiftSchedule = ShiftSchedule::where('employee_id', Auth::user()->employee->id)
            ->where('created_by', '=', Auth::user()->creatorId())
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
                    $late  = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

                    $dendas = Denda::where('created_by', Auth::user()->creatorId())->get();


                    $employeeAttendance              = new AttendanceEmployee();
                    $employeeAttendance->employee_id = $employee->id;
                    $employeeAttendance->created_by  = Auth::user()->creatorId();
                    $employeeAttendance->date          = date("Y-m-d");
                    $employeeAttendance->status        = $shiftSchedule->is_dayoff ? 'Overtime' : 'Present';
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

                    if ($shiftSchedule->is_dayoff) {
                        if (strtotime($out) > strtotime($employeeShift->shift_type->start_time)) {
                            //Overtime
                            $totalOvertimeSeconds = strtotime($out) - strtotime($employeeShift->shift_type->start_time);
                            $hours                = floor($totalOvertimeSeconds / 3600);
                            $mins                 = floor($totalOvertimeSeconds / 60 % 60);
                            $secs                 = floor($totalOvertimeSeconds % 60);
                            $overtime             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
                        }

                        // overtime calculation fee
                        $diffInHour     = Carbon::parse($out)->diffInHours(Carbon::parse($employeeAttendance->clock_in));
                        $diffInDay     = 1;
                        $duration       = strtotime($out) - strtotime($employeeAttendance->clock_in);
                        $durationToTime =  gmdate('H:i:s', $duration);

                        $pay = 0;
                        $amount_fee = 0;
                        if (!is_null($employee->basic_salary)) {
                            $overtimePayPerHour    = 1 / 173 * $employee->basic_salary->amount;
                            if ($diffInHour == 1) {
                                $pay = 1.5 * floor($overtimePayPerHour);
                            } elseif ($diffInHour > 1) {
                                $pay = 0;
                                for ($i = 0; $i < $diffInHour; $i++) {
                                    if ($i == 0) {
                                        $pay += 1.5 * floor($overtimePayPerHour);
                                    } else {
                                        $pay += 2 * floor($overtimePayPerHour);
                                    }
                                }
                            }
                            $amount_fee = $diffInDay > 0 ? $pay * $diffInDay : 0;
                        } else {
                            toast('Please set employee salary.', 'warning');
                            return redirect()->back();
                        }

                        $overtimeType = OvertimeType::where('name', 'Dayoff Overtime')->first();
                        if (is_null($overtimeType)) {
                            $overtimeType = OvertimeType::create([
                                'name' => 'Dayoff Overtime',
                                'created_by' => Auth::user()->creatorId()
                            ]);
                        }

                        $overtimeModel = new Overtime();
                        $overtimeModel->employee_id      = $employee->id;
                        $overtimeModel->start_date       = $employeeAttendance->date;
                        $overtimeModel->end_date         = $employeeAttendance->date;
                        $overtimeModel->start_time       = $employeeAttendance->clock_in;
                        $overtimeModel->end_time         = $out;
                        $overtimeModel->duration         = $durationToTime;
                        $overtimeModel->amount_fee       = $amount_fee;
                        $overtimeModel->status           =  'Approved';
                        $overtimeModel->overtime_type_id =  $overtimeType->id;
                        $overtimeModel->created_by       = Auth::user()->creatorId();
                        $overtimeModel->save();
                    } else {
                        $overtime = '00:00:00';
                    }



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
            } else {
                toast('You dont have shift today', 'warning');
                return redirect()->route('dashboard');
            }
        } else {
            toast('You are not an employee!', 'warning');
            return redirect()->route('dashboard');
        }
    }

    public function breakStore(Request $request)
    {
        $shiftSchedule = ShiftSchedule::where('employee_id', Auth::user()->employee->id)
            ->where('created_by', '=', Auth::user()->creatorId())
            ->where('schedule_date', date('Y-m-d'))
            ->first();

        if (Auth::user()->type != 'company') {
            if (!is_null($shiftSchedule)) {

                $employee = Employee::where('user_id', Auth::user()->id)->first();
                $employeeAttendance = AttendanceEmployee::where('employee_id', $employee->id)->orderBy('id', 'desc')->first();
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

    public function importExcel()
    {
        // dd(1);
        $file_extension = request()->file('file-excel')->extension();
        if ('csv' == $file_extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } elseif ('xls' == $file_extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } elseif ('xlsx' == $file_extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $reader = new Xls();
        $spreadsheet = $reader->load(request()->file('file-excel'));
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $dataEmployee = [];
        $attendaceData = [];
        $status = null;

        foreach ($sheetData as $key => $value) {
            if (is_string($value[1]) && $value[1] == 'No. ID') {
                $dataEmployee = [];
                $attendaceData = [];
            }
            if (is_integer($value[5])) {
                $dataEmployee['employeeId'] = (int)$value[5];
            } elseif (is_string($value[5])) {
                $dataEmployee['employeeName'] = $value[5];
            } elseif (!is_integer($value[0]) && $date = DateTime::createFromFormat('d/m/Y', $value[0])) {
                $attendaceData['date']          = $date;
                $attendaceData['start_time'] = isset($value[7]) ? $value[7] : null;
                $attendaceData['end_time'] = isset($value[10]) ? $value[10] : null;
                $attendaceData['clock_in']      = $value[13];
                $attendaceData['clock_out']     = $value[15];
                $attendaceData['late']          = isset($value[16]) ? $value[16] : null;
                $attendaceData['early_leaving'] = isset($value[17]) ? $value[17] : null;
                $attendaceData['overtime'] = isset($value[19]) ? $value[19] : null;


                $startTime = Carbon::parse($attendaceData['start_time'])->format('H:i:s');
                $endTime = Carbon::parse($attendaceData['end_time'])->format('H:i:s');
                $shiftType = ShiftType::where('start_time', $startTime)->where('end_time', $endTime)->first();
                $shiftType = is_null($shiftType);

                if (is_null($shiftType)) {
                    toast('Shift does not match the system, please set the shift type first', 'warning');
                    return redirect()->back();
                }

                $status = AttendanceEmployee::insertToAttendanceEmployeeLeave($dataEmployee, 'Present', null, null, $attendaceData);
            } elseif (!is_integer($value[0]) && $date = DateTime::createFromFormat('d-M-y', $value[0])) {

                $attendaceData['date']          = $date;
                $attendaceData['start_time'] = isset($value[7]) ? $value[7] : null;
                $attendaceData['end_time'] = isset($value[10]) ? $value[10] : null;
                $attendaceData['clock_in']      = $value[13];
                $attendaceData['clock_out']     = $value[15];
                $attendaceData['late']          = isset($value[16]) ? $value[16] : null;
                $attendaceData['early_leaving'] = isset($value[17]) ? $value[17] : null;
                $attendaceData['overtime'] = isset($value[19]) ? $value[19] : null;

                $startTime = Carbon::parse($attendaceData['start_time'])->format('H:i:s');
                $endTime = Carbon::parse($attendaceData['end_time'])->format('H:i:s');
                $shiftType = ShiftType::where('start_time', $startTime)->where('end_time', $endTime)->first();
                $shiftType = is_null($shiftType);
                if (is_null($shiftType)) {
                    toast('Shift does not match the system, please set the shift type first', 'warning');
                    return redirect()->back();
                }

                $status = AttendanceEmployee::insertToAttendanceEmployeeLeave($dataEmployee, 'Present', null, null, $attendaceData);
            }
        }

        // $status = Excel::import(new AttendanceEmployeeImport, request()->file('file-excel'));

        if (!is_null($status)) {
            toast('Successfully Import Attendance', 'success');
            return redirect()->back();
        }

        toast('Something wrong went Import Attendance', 'error');
        return redirect()->back();
    }
}
