<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'overtime_id',
        'level',
        'is_approver_company',
        'approver_id',
        'status',
        'created_by'
    ];

    public function overtime()
    {
        return $this->belongsTo(Overtime::class, 'overtime_id');
    }
}
