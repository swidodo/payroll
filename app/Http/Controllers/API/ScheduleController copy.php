<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\ReqShiftSchedule;
use App\Models\ShiftSchedule;
use App\Models\AttendanceEmployee;
use App\Models\ShiftType;
use App\Models\Utility;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class ScheduleController extends Controller
{
    public function index(){
        $shiftSchedules = ShiftSchedule::select('shift_schedules.id',
                                            'employees.no_employee as employee_id',
                                            'employees.name as employee_name',
                                            'shift_schedules.schedule_date',
                                            'shift_schedules.is_dayoff',
                                            'shift_types.name as shift_name',
                                            'shift_types.start_time',
                                            'shift_types.end_time',
                                            'day_types.name as day_name'
                                            )
                        ->leftJoin('shift_types','shift_types.id','=','shift_schedules.shift_id')
                        ->leftJoin('day_types','day_types.id','=','shift_types.day_type_id')
                        ->leftJoin('employees','employees.id','=','shift_schedules.employee_id')
                        ->where('employees.user_id', '=', Auth::user()->id)
                        // ->where('shift_schedules.status', 'Approved')
                        ->orderBy('shift_schedules.id', 'asc')
                        ->get();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $shiftSchedules,
        ], Response::HTTP_OK);
    }
    public function loadSchedule(){
        try {
            $data['text_btn']   = 'Clock In';
            $data['param_btn']  = 'I';
            $data['btn']        = true;
            $data['btn_msg']    = "No Access";
            $data['attendance'] = AttendanceEmployee::select('clock_in','clock_out')->where('employee_id', '=', auth()->user()->employee->id)->where('date',now())->first();
            if ($data['attendance'] != null){
                if($data['attendance']->clock_in != null){
                    $data['param_btn']  = 'O';
                    $data['text_btn']   = 'Clock Out';
                }
                if ($data['attendance']->clock_out !=null){
                    $data['btn']        = false;
                    $data['btn_msg']    = "You've been absent";
                }
            }
            $data['schedule'] = ShiftSchedule::select('shift_schedules.id',
                                                'employees.no_employee as employee_id',
                                                'employees.name as employee_name',
                                                'shift_schedules.schedule_date',
                                                'shift_schedules.is_dayoff',
                                                'shift_types.name as shift_name',
                                                'shift_types.start_time',
                                                'shift_types.end_time',
                                                'day_types.name as day_name'
                                                )
                            ->leftJoin('shift_types','shift_types.id','=','shift_schedules.shift_id')
                            ->leftJoin('day_types','day_types.id','=','shift_types.day_type_id')
                            ->leftJoin('employees','employees.id','=','shift_schedules.employee_id')
                            ->where('employees.user_id', '=', Auth::user()->id)
                            // ->where('shift_schedules.status', 'Approved')
                            ->where('shift_schedules.schedule_date', now())
                            ->orderBy('shift_schedules.id', 'asc')
                            ->first();
            return response()->json([
                'status' => Response::HTTP_OK,
                'result' => $data,
            ], Response::HTTP_OK);
        }catch(Exeption $e){
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Someting went wrong !',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
       
        
    }
       
}
