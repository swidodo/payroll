<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaySlip extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'pdf_filename',
        'net_payble',
        'basic_salary',
        'salary',
        'salary_month',
        'status',
        'allowance',
        'reimburst',
        'cash_in_advance',
        'denda',
        'bpjs_kesehatan',
        'pph21',
        'overtime',
        'created_by',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
