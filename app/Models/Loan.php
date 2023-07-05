<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id ',
        'loan_type_id',
        'installment',
        'number_of_installment',
        'amount',
        'status',
        'created_by',
    ];

    public function loan_type()
    {
        return $this->belongsTo(LoanOption::class, 'loan_type_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
