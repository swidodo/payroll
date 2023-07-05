<?php

namespace App\Imports;

use App\Models\AttendanceEmployee;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

// HeadingRowFormatter::default('none');
class AttendanceEmployeeImport implements ToModel
// , WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */


    public function model(array $row)
    {
        dd($row);
        if (is_numeric($row['Emp No.'])) {
            $employee = Employee::find($row['Emp No.']);
        } else {
            $employee = null;
        }

        if (!is_null($employee)) {
            return new AttendanceEmployee([
                'employee_id'       => $employee->id,
                'date'              => date('Y-m-d', strtotime($row['Date'])),
                'status'            => $row['Status'] == 'PRS' ? 'Present' : 'Absent',
                'clock_in'          => $row['Shift In'],
                'clock_out'         => $row['Shift Out'],
                'late'              => AttendanceEmployee::getLateClockIn($row['Shift In']),
                'early_leaving'     => AttendanceEmployee::getEarlyLeaving($row['Shift Out']),
                'overtime'          => AttendanceEmployee::getOvertime($row['Shift Out']),
                'total_rest'        => '00:00:00',
                'created_by'        => $employee->created_by,
            ]);
        } else {
            return null;
        }
    }


    // public function rules(): array
    // {
    //     return [
    //          // Can also use callback validation rules
    //          '1' => function($attribute, $value, $onFailure) {
    //                 $employee = Employee::find($value);
    //               if (!is_null( $employee)) {
    //                    $onFailure('Name is not Patrick Brouwers');
    //               }
    //           }
    //     ];
    // }
}
