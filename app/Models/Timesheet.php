<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'branch_id',
        'project_stage',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'duration',
        'task_or_project',
        'activity',
        'client_company',
        'label_project',
        'file_attachment',
        'remark',
        'support',
        'status',
        'rejected_reason',
        'attachment_reject',
        'created_by',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function timesheet_approvals()
    {
        return $this->hasMany(TimesheetApproval::class, 'timesheet_id');
    }
}
