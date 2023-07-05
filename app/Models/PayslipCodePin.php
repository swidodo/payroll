<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayslipCodePin extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'pin',
        'created_by',
    ];
}
