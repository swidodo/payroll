<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeMedical extends Model
{
    use HasFactory;

    protected $fillable = [
        'height',
        'employee_id',
        'weight',
        'blood_type',
        'medical_test'
    ];
}
