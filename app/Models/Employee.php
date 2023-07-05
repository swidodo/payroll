<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'identity_card',
        'family_card',
        'npwp_number',
        'religion',
        'dob',
        'gender',
        'phone',
        'address',
        'email',
        'password',
        'employee_id',
        'branch_id',
        'department_id',
        'designation_id',
        'company_doj',
        'company_doe',
        'documents',
        'account_holder_name',
        'account_number',
        'bank_name',
        'bank_identifier_code',
        'branch_location',
        'tax_payer_id',
        'salary_type',
        'salary',
        'net_salary',
        'level_approval',
        'created_by',

        'employee_type',
        'leave_type',
        'marital_status',
        'total_leave',
        'total_leave_remaining',
        'status',
        'is_active',
        'out_date',

    ];

    public function present_status($employee_id, $data)
    {
        return AttendanceEmployee::where('employee_id', $employee_id)->where('date', $data)->first();
    }

    public function payroll()
    {
        return $this->hasMany(Payroll::class, 'employee_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function salaryType()
    {
        return $this->hasOne(PayslipType::class, 'salary_type');
    }

    public function documents()
    {
        return $this->hasMany(EmployeeDocument::class, 'employee_id');
    }

    public function payslips()
    {
        return $this->hasMany(PaySlip::class, 'employee_id');
    }

    public function educations()
    {
        return $this->hasMany(EmployeeEducation::class, 'employee_id');
    }

    public function shift_schedules()
    {
        return $this->hasMany(ShiftSchedule::class, 'employee_id');
    }

    public function basic_salary()
    {
        return $this->hasOne(Payroll::class, 'employee_id');
    }

    public function getShiftToday()
    {
        $shiftName = '';
        foreach ($this->shift_schedules as $k) {
            dd($k->schedule_date);
        }
        return;
    }

    public function approval()
    {
        return $this->hasOne(LevelApproval::class, 'employee_id');
    }
}
