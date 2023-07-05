<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnDutyApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'travel_id',
        'level',
        'is_approver_company',
        'approver_id',
        'status',
        'created_by'
    ];

    public function travel()
    {
        return $this->belongsTo(Travel::class, 'travel_id');
    }
}
