<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_id',
        'level',
        'is_approver_company',
        'approver_id',
        'status',
        'created_by'
    ];

    public function leave()
    {
        return $this->belongsTo(Leave::class, 'leave_id');
    }
}
