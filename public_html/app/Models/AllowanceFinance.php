<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowanceFinance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'allowance_type_id',
        'amount',
        'created_by',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function allowance_type()
    {
        return $this->belongsTo(AllowanceOption::class, 'allowance_type_id');
    }
}
