<?php

namespace App\Console\Commands;

use App\Models\AttendanceEmployee;
use App\Models\Employee;
use Illuminate\Console\Command;

class CheckEmployeeAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check-attendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if the employee has clocked in';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $employees = Employee::where('status', 'active')->where('is_active', 1)->get();

        foreach ($employees as $key => $value) {
            $att = AttendanceEmployee::where('employee_id', $value->id)
                ->where('date', now()->format('Y-m-d'))
                ->first();
            if (is_null($att)) {
                $employeeAttendance                = new AttendanceEmployee();
                $employeeAttendance->employee_id   = $value->id;
                $employeeAttendance->date          = now()->format('Y-m-d');
                $employeeAttendance->status        = 'Alpha';
                $employeeAttendance->clock_in      = '00:00:00';
                $employeeAttendance->clock_out     = '00:00:00';
                $employeeAttendance->late          = '00:00:00';
                $employeeAttendance->early_leaving = '00:00:00';
                $employeeAttendance->overtime      = '00:00:00';
                $employeeAttendance->total_rest    = '00:00:00';
                $employeeAttendance->created_by    = $value->user->creatorId();
                $employeeAttendance->save();
            }
        }
    }
}
