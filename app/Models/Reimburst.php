<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimburst extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'reimburst_type_id',
        'amount',
        'date',
        'status',
        'created_by',
    ];

    public function reimburst_type()
    {
        return $this->belongsTo(ReimburstmentOption::class, 'reimburst_type_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
