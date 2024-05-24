<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReqShiftSchedule extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function shift_schedules()
    {
        return $this->hasMany(ShiftSchedule::class, 'req_shift_schedules_id');
    }

    public function req_shift_schedule_approvals()
    {
        return $this->hasMany(RequestShiftScheduleApproval::class, 'req_shift_schedule_id');
    }
}
