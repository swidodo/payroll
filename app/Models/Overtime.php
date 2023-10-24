<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'overtime_type_id',
        'overtime_type',
        'branch_id',
        'nominal_per_hour',
        'day_type_id',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'duration',
        'amount_fee',
        'notes',
        'status',
        'rejected_reason',
        'attachment_reject',
        'created_by',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function overtime_type()
    {
        return $this->belongsTo(OvertimeType::class, 'overtime_type_id');
    }
    public function day_type()
    {
        return $this->belongsTo(DayType::class, 'day_type_id');
    }

    public function overtime_approvals()
    {
        return $this->hasMany(OvertimeApproval::class, 'overtime_id');
    }
}
