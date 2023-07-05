<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ShiftSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'req_shift_schedules_id',
        'schedule_date',
        'shift_id',
        'status',
        'is_dayoff',
        'dayoff_type',
        'description',
        'created_by',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function req_shift_schedule()
    {
        return $this->belongsTo(ReqShiftSchedule::class, 'req_shift_schedules_id');
    }

    public function shift_type()
    {
        return $this->belongsTo(ShiftType::class, 'shift_id');
    }

    public static function destroyHoliday($modelCheck, $dateFormat)
    {
        $scheduleWorkDay    = ShiftSchedule::where('created_by', Auth::user()->creatorId())->get();

        if (isset($scheduleWorkDay)) {
            foreach ($scheduleWorkDay as $key => $value) {
                $dayOfShift         = Carbon::parse($value->schedule_date)->format($dateFormat);
                if ($modelCheck == $dayOfShift) {
                    $value->is_dayoff = false;
                    $value->dayoff_type = null;
                    $value->description = null;
                    $value->save();
                }
            }
        }
    }

    public static function updateShift($modelCheck, $dateFormat, $dayoff_type = null, $description = null, $employeeId = null)
    {
        $scheduleWorkDay    = ShiftSchedule::where('created_by', Auth::user()->creatorId())->where('is_active', true)->get();

        if (isset($scheduleWorkDay)) {
            foreach ($scheduleWorkDay as $key => $value) {
                $dayOfShift         = Carbon::parse($value->schedule_date)->format($dateFormat);
                if ($value->dayoff_type != 'National Holiday') {
                    if ($modelCheck == $dayOfShift && $value->is_dayoff == false) {
                        $value->is_dayoff = true;
                        $value->dayoff_type = $dayoff_type;
                        $value->description = $description;
                        $value->save();
                    } elseif ($modelCheck != $dayOfShift && $value->dayoff_type == $dayoff_type) {
                        $value->is_dayoff = false;
                        $value->dayoff_type = null;
                        $value->description = null;
                        $value->save();
                    }
                }
            }
        }
    }

    public static function updateShiftDayOff($modelCheck, $dateFormat, $dayoff_type = null, $description = null, $employeeId = null)
    {
        $scheduleWorkDay    = ShiftSchedule::where('created_by', Auth::user()->creatorId())->where('is_active', true)->get();

        if (isset($scheduleWorkDay)) {
            foreach ($scheduleWorkDay as $key => $value) {
                //         $dayOfShift         = Carbon::parse($value->schedule_date)->format($dateFormat);
                if ($value->dayoff_type != 'National Holiday') {
                    if ($modelCheck == $value->schedule_date && $value->is_dayoff == false) {
                        $value->is_dayoff = true;
                        $value->dayoff_type = $dayoff_type;
                        $value->description = $description;
                        $value->save();
                    }
                }
            }
        }
    }

    public static function updateShiftImport($modelCheck, $dateFormat, $dayoff_type = null, $description = null, $employeeId = null)
    {
        $scheduleWorkDay    = ShiftSchedule::where('created_by', Auth::user()->creatorId())->where('is_active', true)->get();

        if (isset($scheduleWorkDay)) {
            foreach ($scheduleWorkDay as $key => $value) {
                $dayOfShift         = Carbon::parse($value->schedule_date)->format($dateFormat);
                if ($value->dayoff_type != 'National Holiday') {
                    if ($modelCheck == $dayOfShift && $value->is_dayoff == false) {
                        $value->is_dayoff = true;
                        $value->dayoff_type = $dayoff_type;
                        $value->description = $description;
                        $value->save();
                    }
                }
            }
        }
    }
}
