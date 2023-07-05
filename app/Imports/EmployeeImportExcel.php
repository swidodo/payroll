<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;

class EmployeeImportExcel implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $branch = DB::table('branches')
                    ->select('id')
                    ->where('alias',$row[12])
                    ->get();
        $branchId = $branch->id;
        $save  = DB::insert("insert into users (name,email,password)value('$row[1]','$row[9]','pehadirpassword')");
        return new Employee([
            "user_id"               =>$row[0],
            "name"                  =>$row[1],
            "identity_card"         =>$row[2],
            "family_card"           =>$row[3],
            "npwp_number"           =>$row[4],
            "dob"                   =>$row[5],
            "gender"                =>$row[6],
            "phone"                 =>$row[7],
            "address"               =>$row[8],
            "email"                 =>$row[9],
            "password"              =>$row[10],
            "employee_id"           =>$row[11],
            "branch_id"             =>$branchId,
            "department_id"         =>$row[13],
            "designation_id"        =>$row[14],
            "company_doj"           =>$row[15],
            "company_doe"           =>$row[16],
            "documents"             =>$row[17],
            "account_holder_name"   =>$row[18],
            "account_number"        =>$row[19],
            "bank_name"             =>$row[20],
            "bank_identifier_code"  =>$row[21],
            "branch_location"       =>$row[22],
            "tax_payer_id"          =>$row[23],
            "salary_type"           =>$row[24],
            "salary"                =>$row[25],
            "net_salary"            =>$row[26],
            "is_active"             =>$row[27],
            "created_by"            =>$row[28],
            "leave_approval"        =>$row[29],
            "leave_type"            =>$row[30],
            "employee_type"         =>$row[31],
            "marital_status"        =>$row[32],
            "total_leave"           =>$row[33],
            "total_leave_remaining" =>$row[34],
            "out_date"              =>$row[35],
            "status"                =>$row[36],
        ]);
    }
}
