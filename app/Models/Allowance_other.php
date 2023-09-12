<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allowance_other extends Model
{
    use HasFactory;
    protected $table = 'allowances';
    protected $guarded = ['id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function allowance_type()
    {
        return $this->belongsTo(AllowanceOption::class, 'allowance_option_id');
    }
}
