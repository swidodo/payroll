<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEducation extends Model
{
    use HasFactory;

    protected $fillable = [
            'employee_id',
            'start_date',
            'end_date',
            'type',
            'level',
            'institution',
            'address',
            'major',
            'gpa',
            'notes',
    ];

}
