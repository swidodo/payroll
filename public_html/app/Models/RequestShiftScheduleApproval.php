<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestShiftScheduleApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'req_shift_schedule_id',
        'level',
        'is_approver_company',
        'approver_id',
        'status',
        'created_by'
    ];

    public function request_shift_schedule()
    {
        return $this->belongsTo(ReqShiftSchedule::class, 'req_shift_schedule_id');
    }
}
