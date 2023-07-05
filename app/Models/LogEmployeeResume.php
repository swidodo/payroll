<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogEmployeeResume extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'date',
        'activity',
        'created_by',
    ];
}
