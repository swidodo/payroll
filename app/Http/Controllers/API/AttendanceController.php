<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AttendanceEmployee;
use App\Models\Denda;
use App\Models\Employee;
use App\Models\LogAttendance;
use App\Models\Overtime;
use App\Models\OvertimeType;
use App\Models\ShiftSchedule;
use App\Models\Timesheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index()
    {
        $data = [];
        $data['attendance_status'] = (new Employee())->present_status(auth()->user()->employee->id, date('Y-m-d'));
        $data['shift_schedule'] = ShiftSchedule::where('employee_id', auth()->user()->employee->id)
            ->with('shift_type')
            ->where('created_by', '=', auth()->user()->creatorId())
            ->where('schedule_date', date('Y-m-d'))
            ->first();
        $data['timesheet'] = Timesheet::where('employee_id', auth()->user()->employee->id)
            ->where('created_by', '=', auth()->user()->creatorId())
            ->where('start_date', '<=', date('Y-m-d'))
            ->where('end_date', '>=', date('Y-m-d'))
            ->first();
        $r = ['status' => Response::HTTP_OK, 'result' => $data];
        return response()->json($r, Response::HTTP_OK);
    }
    public function list(Request $request)
    {
        $from = $request->from_date ?? Carbon::now()->subMonths(1)->format('Y-m-d');
        $to = $request->to_date ?? Carbon::now()->format('Y-m-d');
        $data = AttendanceEmployee::where('employee_id', '=', auth()->user()->employee->id)
            ->whereBetween('date', [$from, $to])
            ->paginate(10);
        $r = ['status' => Response::HTTP_OK, 'result' => $data];
        return response()->json($r, Response::HTTP_OK);
    }

    /**
     * create
     *
     * @param  mixed Request
     * @return void
     */
    // public function create(Request $request)
    // {
        
    //     $data = json_decode($request->data, true);
    //     $data['photo'] = $request->file('photo');
    //     $validator = Validator::make($data, [
    //         'longitude' => ['required', 'numeric', 'between:-180,180'],
    //         'latitude' => ['required', 'numeric', 'between:-90,90'],
    //         'type' => 'required|string|in:I,O',
    //         'notes' => 'nullable|string|max:128',
    //         'source' => 'nullable|string|max:128',
    //         'photo' => 'nullable|file|max:5120|mimes:jpg,jpeg,png|mimetypes:image/*',
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
    //             'wrong' => $validator->errors()
    //         ], Response::HTTP_UNPROCESSABLE_ENTITY);
    //     }
    //     $data = (object)$validator->validated();
    //     $employeeShift = ShiftSchedule::where('employee_id', auth()->user()->employee->id)->where('schedule_date', Carbon::now()->format('Y-m-d'))->where('status', 'Approved')->first();
    //     $shiftSchedule = ShiftSchedule::where('employee_id', auth()->user()->employee->id)
    //         ->where('created_by', '=', auth()->user()->creatorId())
    //         ->where('schedule_date', date('Y-m-d'))
    //         ->first();
    //     $employee = Employee::where('user_id', auth()->user()->id)->first();
    //     if ($data->type == 'I') {
    //         $in  = date("H:i:s");
    //         $totalLateSeconds = strtotime($in) - ($employeeShift ? strtotime($employeeShift->shift_type->start_time) : 0);
    //         // late
    //         $hours = floor($totalLateSeconds / 3600);
    //         $mins  = floor($totalLateSeconds / 60 % 60);
    //         $secs  = floor($totalLateSeconds % 60);
    //         $late  = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
    //         $dendas = Denda::where('created_by', auth()->user()->creatorId())->get();
    //         $employeeAttendance              = new AttendanceEmployee();
    //         $employeeAttendance->employee_id = $employee->id;
    //         $employeeAttendance->created_by  = auth()->user()->creatorId();
    //         $employeeAttendance->date          = date("Y-m-d");
    //         $employeeAttendance->status        = $shiftSchedule && $shiftSchedule->is_dayoff ? 'OVERTIME' : 'PRESENT';
    //         $employeeAttendance->clock_in      = $in;
    //         $employeeAttendance->clock_out     = '00:00:00';
    //         $employeeAttendance->late          = ($late > 0) && ($shiftSchedule && $shiftSchedule->is_dayoff != true) ? $late : '00:00:00';
    //         $employeeAttendance->early_leaving = '00:00:00';
    //         $employeeAttendance->overtime      = '00:00:00';
    //         $employeeAttendance->total_rest    = '00:00:00';
    //         $employeeAttendance->save();
    //         $loc = [
    //             'attendance_employees_id' => $employeeAttendance->id,
    //             'time'                    => $in,
    //             'latitude'                => $data->longitude,
    //             'longitude'               => $data->latitude,
    //             'status'                  => 'clock in',
    //         ];
    //         DB::table('attendance_locations')->insert($loc);
    //         if (!is_null($dendas)) {
    //             foreach ($dendas as $key => $value) {
    //                 if ($late > 0 && strtotime($late) < strtotime($value->time)) {
    //                     $attendanceEmployee = AttendanceEmployee::where('employee_id', auth()->user()->employee->id)->where('date', date('Y-m-d'))->first();
    //                     $attendanceEmployee->denda = $value->amount;
    //                     $attendanceEmployee->save();
    //                 }
    //             }
    //         }
    //         LogAttendance::create([
    //             'employee_id'   => $employeeAttendance->employee_id,
    //             'date'          => now(),
    //             'activity'      => ucwords($employeeAttendance->employee->name) . ' Has Clocked In',
    //             'created_by'    => auth()->user()->creatorId()
    //         ]);
    //     } else {
    //         $out = date("H:i:s");
    //         $employee         = Employee::where('user_id', auth()->user()->id)->first();
    //         $employeeAttendance = AttendanceEmployee::where('employee_id', $employee->id)->orderBy('id', 'desc')->first();
    //         //early Leaving
    //         $totalEarlyLeavingSeconds = strtotime($employeeShift->shift_type->end_time) - strtotime($out);
    //         $hours                    = floor($totalEarlyLeavingSeconds / 3600);
    //         $mins                     = floor($totalEarlyLeavingSeconds / 60 % 60);
    //         $secs                     = floor($totalEarlyLeavingSeconds % 60);
    //         $earlyLeaving             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
    //         if ($shiftSchedule->is_dayoff) {
    //             if (strtotime($out) > strtotime($employeeShift->shift_type->start_time)) {
    //                 //Overtime
    //                 $totalOvertimeSeconds = strtotime($out) - strtotime($employeeShift->shift_type->start_time);
    //                 $hours                = floor($totalOvertimeSeconds / 3600);
    //                 $mins                 = floor($totalOvertimeSeconds / 60 % 60);
    //                 $secs                 = floor($totalOvertimeSeconds % 60);
    //                 $overtime             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
    //             }
    //             // overtime calculation fee
    //             $diffInHour     = Carbon::parse($out)->diffInHours(Carbon::parse($employeeAttendance->clock_in));
    //             $diffInDay     = 1;
    //             $duration       = strtotime($out) - strtotime($employeeAttendance->clock_in);
    //             $durationToTime =  gmdate('H:i:s', $duration);
    //             $pay = 0;
    //             $amount_fee = 0;
    //             // if (!is_null($employee->basic_salary)) {
    //             //     $overtimePayPerHour    = 1 / 173 * $employee->basic_salary->amount;
    //             //     if ($diffInHour == 1) {
    //             //         $pay = 1.5 * floor($overtimePayPerHour);
    //             //     } elseif ($diffInHour > 1) {
    //             //         $pay = 0;
    //             //         for ($i = 0; $i < $diffInHour; $i++) {
    //             //             if ($i == 0) {
    //             //                 $pay += 1.5 * floor($overtimePayPerHour);
    //             //             } else {
    //             //                 $pay += 2 * floor($overtimePayPerHour);
    //             //             }
    //             //         }
    //             //     }
    //             //     $amount_fee = $diffInDay > 0 ? $pay * $diffInDay : 0;
    //             // } else {
    //             //     toast('Please set employee salary.', 'warning');
    //             //     return redirect()->back();
    //             // }
    //             // $overtimeType = OvertimeType::where('name', 'Dayoff Overtime')->first();
    //             // if (is_null($overtimeType)) {
    //             //     $overtimeType = OvertimeType::create([
    //             //         'name' => 'Dayoff Overtime',
    //             //         'created_by' => auth()->user()->creatorId()
    //             //     ]);
    //             // }
    //             // $overtimeModel = new Overtime();
    //             // $overtimeModel->employee_id      = $employee->id;
    //             // $overtimeModel->start_date       = $employeeAttendance->date;
    //             // $overtimeModel->end_date         = $employeeAttendance->date;
    //             // $overtimeModel->start_time       = $employeeAttendance->clock_in;
    //             // $overtimeModel->end_time         = $out;
    //             // $overtimeModel->duration         = $durationToTime;
    //             // $overtimeModel->amount_fee       = $amount_fee;
    //             // $overtimeModel->status           =  'Approved';
    //             // $overtimeModel->overtime_type_id =  $overtimeType->id;
    //             // $overtimeModel->created_by       = auth()->user()->creatorId();
    //             // $overtimeModel->save();
    //         } else {
    //             $overtime = '00:00:00';
    //         }
    //         $employeeAttendance->clock_out     = $out;
    //         $employeeAttendance->early_leaving = ($earlyLeaving > 0) && $shiftSchedule->is_dayoff != true ? $earlyLeaving : '00:00:00';
    //         $employeeAttendance->overtime      = $overtime;
    //         $employeeAttendance->total_rest    = '00:00:00';
    //         $employeeAttendance->save();
    //         $locat = [
    //             'attendance_employees_id' => $employeeAttendance->id,
    //             'time'                    => $in,
    //             'latitude'                => $data->longitude,
    //             'longitude'               => $data->latitude,
    //             'status'                  => 'clock out',
    //         ];
    //         DB::table('attendance_locations')->insert($locat);
    //         LogAttendance::create([
    //             'employee_id'   => $employeeAttendance->employee_id,
    //             'date'          => now(),
    //             'activity'      => ucwords($employeeAttendance->employee->name) . ' Has Clocked Out',
    //             'created_by'    => auth()->user()->creatorId()
    //         ]);
    //     }
    //     $r = ['status' => Response::HTTP_OK, 'message' => 'success'];
    //     return response()->json($r, Response::HTTP_OK);
    // }
    
    
     public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'latitude'  => ['required', 'numeric', 'between:-90,90'],
            'type'      => 'required|string|in:I,O',
            'notes'     => 'nullable|string|max:128',
            'source'    => 'nullable|string|max:128',
            'photo'     => 'nullable|file|max:5120|mimes:jpg,jpeg,png|mimetypes:image/*',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        // $data = $validator->validated();
        $employeeShift = ShiftSchedule::where('employee_id', auth()->user()->employee->id)
                        ->where('schedule_date', Carbon::now()->format('Y-m-d'))
                        // ->where('status', 'Approved')
                        ->first();
        $shiftSchedule = ShiftSchedule::where('employee_id', auth()->user()->employee->id)
                        ->where('schedule_date', now())
                        ->first();
        $employee = Employee::where('user_id', auth()->user()->id)->first();
        if ($request->type == 'I') {
            $in  = date("H:i:s");
            $totalLateSeconds = strtotime($in) - ($employeeShift ? strtotime($employeeShift->shift_type->start_time) : 0);
            // late
            $hours = floor($totalLateSeconds / 3600);
            $mins  = floor($totalLateSeconds / 60 % 60);
            $secs  = floor($totalLateSeconds % 60);
            $late  = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
            $dendas = Denda::where('created_by', auth()->user()->creatorId())->get();
            $employeeAttendance              = new AttendanceEmployee();
            $employeeAttendance->employee_id = $employee->id;
            $employeeAttendance->created_by  = auth()->user()->creatorId();
            $employeeAttendance->date          = date("Y-m-d");
            $employeeAttendance->status        = $shiftSchedule && $shiftSchedule->is_dayoff ? 'OVERTIME' : 'PRESENT';
            $employeeAttendance->clock_in      = $in;
            // $employeeAttendance->clock_out     = '00:00:00';
            $employeeAttendance->late          = ($late > 0) && ($shiftSchedule && $shiftSchedule->is_dayoff != true) ? $late : '00:00:00';
            $employeeAttendance->early_leaving = '00:00:00';
            $employeeAttendance->overtime      = '00:00:00';
            $employeeAttendance->total_rest    = '00:00:00';
            $employeeAttendance->save();
            if($request->is_live == 'ya'){
                $logitude = $request->longitude;
                $latitude = $request->latitude;
            }else{
                $logitude = null;
                $latitude = null;
            }
            $loc = [
                'attendance_employees_id' => $employeeAttendance->id,
                'time'                    => $in,
                'latitude'                => $logitude,
                'longitude'               => $latitude,
                'status'                  => 'clock in',
                'is_live'                 => $request->is_live
            ];
            DB::table('attendance_locations')->insert($loc);
            if (!is_null($dendas)) {
                foreach ($dendas as $key => $value) {
                    if ($late > 0 && strtotime($late) < strtotime($value->time)) {
                        $attendanceEmployee = AttendanceEmployee::where('employee_id', auth()->user()->employee->id)->where('date', date('Y-m-d'))->first();
                        $attendanceEmployee->denda = $value->amount;
                        $attendanceEmployee->save();
                    }
                }
            }
            LogAttendance::create([
                'employee_id'   => $employeeAttendance->employee_id,
                'date'          => now(),
                'activity'      => ucwords($employeeAttendance->employee->name) . ' Has Clocked In',
                'created_by'    => auth()->user()->creatorId()
            ]);
            $r = ['status' => Response::HTTP_OK, 'message' => 'success clock in'];
            return response()->json($r, Response::HTTP_OK);
        } else {
            $out = date("H:i:s");
            $employee         = Employee::where('user_id', auth()->user()->id)->first();
            $employeeAttendance = AttendanceEmployee::where('employee_id', $employee->id)->orderBy('id', 'desc')->first();
            //early Leaving
            if ($employeeShift == null){
                $earlyLeaving = '00:00:00';
                $overtime     = '00:00:00';
                $dayoff       = false;
            }else{
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
                // $overtimeType = OvertimeType::where('name', 'Dayoff Overtime')->first();
                // if (is_null($overtimeType)) {
                //     $overtimeType = OvertimeType::create([
                //         'name' => 'Dayoff Overtime',
                //         'created_by' => auth()->user()->creatorId()
                //     ]);
                // }
                // $overtimeModel = new Overtime();
                // $overtimeModel->employee_id      = $employee->id;
                // $overtimeModel->start_date       = $employeeAttendance->date;
                // $overtimeModel->end_date         = $employeeAttendance->date;
                // $overtimeModel->start_time       = $employeeAttendance->clock_in;
                // $overtimeModel->end_time         = $out;
                // $overtimeModel->duration         = $durationToTime;
                // $overtimeModel->amount_fee       = $amount_fee;
                // $overtimeModel->status           =  'Approved';
                // $overtimeModel->overtime_type_id =  $overtimeType->id;
                // $overtimeModel->created_by       = auth()->user()->creatorId();
                // $overtimeModel->save();
                } else {
                    $overtime = '00:00:00';
                }
                $dayoff = $shiftSchedule->is_dayof;
            }
            
            $employeeAttendance->clock_out     = $out;
            $employeeAttendance->early_leaving = ($earlyLeaving > 0) && $dayoff != true ? $earlyLeaving : '00:00:00';
            $employeeAttendance->overtime      = $overtime;
            $employeeAttendance->total_rest    = '00:00:00';
            $employeeAttendance->save();
            if($request->is_live == 'ya'){
                $logitude = $request->longitude;
                $latitude = $request->latitude;
            }else{
                $logitude = null;
                $latitude = null;
            }
            $locat = [
                'attendance_employees_id' => $employeeAttendance->id,
                'time'                    => $out,
                'latitude'                => $logitude,
                'longitude'               => $latitude,
                'status'                  => 'clock out',
                'is_live'                 => $request->is_live
            ];
            DB::table('attendance_locations')->insert($locat);
            LogAttendance::create([
                'employee_id'   => $employeeAttendance->employee_id,
                'date'          => now(),
                'activity'      => ucwords($employeeAttendance->employee->name) . ' Has Clocked Out',
                'created_by'    => auth()->user()->creatorId()
            ]);
            $r = ['status' => Response::HTTP_OK, 'message' => 'success clock out'];
            return response()->json($r, Response::HTTP_OK);
        }
        
    }
}
