<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimesheetApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'timesheet_id',
        'level',
        'is_approver_company',
        'approver_id',
        'status',
        'created_by'
    ];

    public function timesheet()
    {
        return $this->belongsTo(Timesheet::class, 'timesheet_id');
    }
}
