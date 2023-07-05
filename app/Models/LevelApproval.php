<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'employee_id',
        'company_id',
        'created_by',
    ];
}
