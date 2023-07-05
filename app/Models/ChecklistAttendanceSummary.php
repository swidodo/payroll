<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistAttendanceSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_displayed',
        'created_by',
    ];
}
