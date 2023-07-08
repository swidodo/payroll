<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'leave_type_id',
        'applied_on',
        'start_date',
        'end_date',
        'total_leave_days',
        'leave_reason',
        'attachment_request_path',
        'remark',
        'status',
        'rejected_reason',
        'attachment_reject',
        'created_by',
    ];

    public function leave_type()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function attendances()
    {
        return $this->hasMany(AttendanceEmployee::class, 'employee_id');
    }

    public function leave_aprovals()
    {
        return $this->hasMany(LeaveApproval::class, 'leave_id');
    }
}
