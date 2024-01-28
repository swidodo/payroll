<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceEmployee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'date',
        'status',
        'clock_in',
        'clock_out',
        'break_in',
        'break_out',
        'late',
        'denda',
        'early_leaving',
        'overtime',
        'total_rest',
        'created_by',
        'longitude',
        'latitude'
    ];

    // public function employees()
    // {
    //     return $this->hasOne(Employee::class, 'user_id', 'employee_id');
    // }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function shift()
    {
        return $this->belongsTo(ShiftSchedule::class, 'date', 'schedule_date');
    }

    //perlu revisi 17 jan 2023
    public static function getLateClockIn($clock_in)
    {
        $startTime = Utility::getValByName('company_start_time');

        $in = date("H:i:s", strtotime($clock_in));
        $totalLateSeconds = strtotime($in) - strtotime($startTime);

        // late
        $hours = floor($totalLateSeconds / 3600);
        $mins  = floor($totalLateSeconds / 60 % 60);
        $secs  = floor($totalLateSeconds % 60);
        $late  = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

        return $late > 0 ? $late : '00:00:00';
    }

    //perlu revisi 17 jan 2023
    public static function getEarlyLeaving($clock_out)
    {
        $endTime   = Utility::getValByName('company_end_time');
        $out = date("H:i:s", strtotime($clock_out));


        //early Leaving
        $totalEarlyLeavingSeconds = strtotime($endTime) - strtotime($out);
        $hours                    = floor($totalEarlyLeavingSeconds / 3600);
        $mins                     = floor($totalEarlyLeavingSeconds / 60 % 60);
        $secs                     = floor($totalEarlyLeavingSeconds % 60);
        $earlyLeaving             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

        return ($earlyLeaving > 0) ? $earlyLeaving : '00:00:00';
    }

    //perlu revisi 17 jan 2023
    public static function getOvertime($clock_out)
    {
        $endTime   = Utility::getValByName('company_end_time');
        $out = date("H:i:s", strtotime($clock_out));


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

        return $overtime;
    }

    public static function insertToAttendanceEmployeeLeave($model, $leave_type = null, $attachment = null, $startDateCarbon = null, $otherData = null)
    {
        try {
            DB::beginTransaction();
            if (strtolower($leave_type) == 'sick' || strtolower($leave_type) == 'sakit') {
                if (!is_null($attachment)) {
                    $employeeAttendance              = new AttendanceEmployee();
                    $employeeAttendance->employee_id   = $model->employee_id;
                    $employeeAttendance->date          = $startDateCarbon->format('Y-m-d');
                    $employeeAttendance->status        = 'Sick With Letter';
                    $employeeAttendance->clock_in      = '00:00:00';
                    $employeeAttendance->clock_out     = '00:00:00';
                    $employeeAttendance->late          = '00:00:00';
                    $employeeAttendance->early_leaving = '00:00:00';
                    $employeeAttendance->overtime      = '00:00:00';
                    $employeeAttendance->total_rest    = '00:00:00';
                    $employeeAttendance->created_by       = Auth::user()->creatorId();
                    $employeeAttendance->save();
                } else {
                    $employeeAttendance              = new AttendanceEmployee();
                    $employeeAttendance->employee_id   = $model->employee_id;
                    $employeeAttendance->date          = $startDateCarbon->format('Y-m-d');
                    $employeeAttendance->status        = 'Sick Without Letter';
                    $employeeAttendance->clock_in      = '00:00:00';
                    $employeeAttendance->clock_out     = '00:00:00';
                    $employeeAttendance->late          = '00:00:00';
                    $employeeAttendance->early_leaving = '00:00:00';
                    $employeeAttendance->overtime      = '00:00:00';
                    $employeeAttendance->total_rest    = '00:00:00';
                    $employeeAttendance->created_by       = Auth::user()->creatorId();
                    $employeeAttendance->save();
                }
            } elseif (strtolower($leave_type) == 'permit' || strtolower($leave_type) == 'izin') {
                $employeeAttendance              = new AttendanceEmployee();
                $employeeAttendance->employee_id   = $model->employee_id;
                $employeeAttendance->date          = $startDateCarbon->format('Y-m-d');
                $employeeAttendance->status        = 'Permit';
                $employeeAttendance->clock_in      = '00:00:00';
                $employeeAttendance->clock_out     = '00:00:00';
                $employeeAttendance->late          = '00:00:00';
                $employeeAttendance->early_leaving = '00:00:00';
                $employeeAttendance->overtime      = '00:00:00';
                $employeeAttendance->total_rest    = '00:00:00';
                $employeeAttendance->created_by       = Auth::user()->creatorId();
                $employeeAttendance->save();
            } elseif (strtolower($leave_type) == 'leave' || strtolower($leave_type) == 'cuti') {
                $employeeAttendance              = new AttendanceEmployee();
                $employeeAttendance->employee_id   = $model->employee_id;
                $employeeAttendance->date          = $startDateCarbon->format('Y-m-d');
                $employeeAttendance->status        = 'Leave';
                $employeeAttendance->clock_in      = '00:00:00';
                $employeeAttendance->clock_out     = '00:00:00';
                $employeeAttendance->late          = '00:00:00';
                $employeeAttendance->early_leaving = '00:00:00';
                $employeeAttendance->overtime      = '00:00:00';
                $employeeAttendance->total_rest    = '00:00:00';
                $employeeAttendance->created_by       = Auth::user()->creatorId();
                $employeeAttendance->save();
            } elseif (strtolower($leave_type) == 'present' || strtolower($leave_type) == 'hadir') {
                $employee = Employee::find($model['employeeId']);
                $dendas = Denda::where('created_by', Auth::user()->creatorId())->get();

                if (is_null($employee) && isset($model['employeeName'])) {
                    // $employee = Employee::where('name', 'LIKE',$model['employeeName'])->first();
                    $employee = Employee::where(DB::raw('LOWER(name)'), 'like', ['%' . trim(strtolower($model['employeeName'])) . '%'])->first();
                }

                if (!is_null($employee)) {
                    $attendanceIsExist = AttendanceEmployee::where('date', $otherData['date'])->where('employee_id', $employee->id)->first();

                    if (is_null($attendanceIsExist)) {
                        $employeeAttendance              = new AttendanceEmployee();
                        $employeeAttendance->employee_id   = $employee->id;
                        $employeeAttendance->date          = $otherData['date'];
                        $employeeAttendance->status        = 'Present';
                        $employeeAttendance->clock_in      = $otherData['clock_in'] ?? '00:00:00';
                        $employeeAttendance->clock_out     = $otherData['clock_out'] ?? '00:00:00';
                        $employeeAttendance->late          = $otherData['late'] ?? '00:00:00';
                        $employeeAttendance->early_leaving = $otherData['early_leaving'] ?? '00:00:00';
                        $employeeAttendance->overtime      = $otherData['overtime'] ?? '00:00:00';
                        $employeeAttendance->total_rest    = '00:00:00';
                        $employeeAttendance->created_by       = Auth::user()->creatorId();

                        if (!is_null($dendas) && !is_null($otherData['late'])) {
                            $amountDenda = 0;
                            foreach ($dendas as $key => $value) {
                                if ($otherData['late'] > 0 && strtotime($otherData['late']) < strtotime($value->time)) {
                                    $employeeAttendance->denda = $value->amount;
                                }
                            }
                        }
                        $employeeAttendance->save();
                    }
                }
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
