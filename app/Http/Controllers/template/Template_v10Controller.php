<?php

namespace App\Http\Controllers\template;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Employee;
use App\Models\Payroll;
use App\Models\PayslipType;
use App\Models\SetBpjsTK;
use App\Models\Utility;
use App\Models\AllowanceFinance;
use App\Models\AllowanceOption;
use App\Models\Master_bpjs;
use App\Models\Bpjs_value;
use App\Models\Branch;
use App\Models\LoanOption;
use App\Models\Loan;
use App\Models\Deduction_other;
use App\Models\Deduction_admin;
use App\Models\AccessBranch;
use Carbon\Carbon;
use Exception;
use DataTables;
use PDF;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
// gaji basic salary, uang makan utuh, overtime utuh
class Template_v10Controller extends Controller
{
    public function index(Request $request){
        $file_extension = request()->file('import-payroll')->extension();
        if ('csv' == $file_extension) {
            $res = [
                'status' => 'success',
                'msg'    => 'Import Data Successfuly !',
            ];
            return response()->json($res);
            return true;
        } elseif ('xls' == $file_extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } elseif ('xlsx' == $file_extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        // $reader = new Xls();
        $spreadsheet = $reader->load(request()->file('import-payroll'));
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        $import =[];
        DB::beginTransaction();
        foreach ($sheetData as $key => $value) {
            if ($key > 0) :
                $branch = Branch::where('alias',$value[24])->first();
                if ($branch != null) :
                    $employeeId = Employee::where('no_employee',$value[1])->where('branch_id',$branch->id)->first();
                    $takeHP = DB::table('take_home_pay')
                                ->where('employee_id',$employeeId->id)
                                ->where('startdate',$value[22])
                                ->where('enddate',$value[23])
                                ->count();
                    if ($takeHP > 0){
                        DB::table('take_home_pay')
                            ->where('employee_id',$employeeId->id)
                            ->where('startdate',$value[22])
                            ->where('enddate',$value[23])
                            ->delete();
                    }
                    $ded_other = Deduction_other::where('employee_id',$employeeId->id)->where('date',$value[23])->count();
                    if($ded_other > 0 ){
                        Deduction_other::where('employee_id',$employeeId->id)->where('date',$value[23])->delete();
                    }
                    $ded_loan = Loan::where('employee_id',$employeeId->id)->where(DB::raw("DATE(created_at)"),$value[23])->count();
                    if ($ded_loan > 0 ){
                        Loan::where('employee_id',$employeeId->id)->where(DB::raw("DATE(created_at)"),$value[23])->delete();
                    }
                    $allFinance = AllowanceFinance::where('employee_id',$employeeId->id)->where(DB::raw("DATE(created_at)"),$value[23])->count();
                    if ($allFinance > 0){
                        AllowanceFinance::where('employee_id',$employeeId->id)->where(DB::raw("DATE(created_at)"),$value[23])->delete();
                    }
                    $allother = DB::table('allowances')->where('employee_id',$employeeId->id)->where('date',$value[23])->count();
                    if ($allother > 0){
                        DB::table('allowances')->where('employee_id',$employeeId->id)->where(DB::raw("DATE(created_at)"),$value[23])->delete();
                    }
                    if ($employeeId != null ):
                        if($employeeId->id =='' | $employeeId->id ==null){
                            return true;
                        }
                        $basic_salary     =  (($value[3] !=null) ? $value[3] : 0);
                        $meal_allowance   =  (($value[6] !=null) ? $value[6] : 0);
                        $allowancefixed   =  (($value[5] !=null) ? $value[5] : 0 );
                        $allowanceUnfixed =  
                        $meal_allowance + 
                        (($value[7] !=null) ? $value[7] : 0 ) + 
                        (($value[8] !=null) ? $value[8] : 0 );

                        $rapel            = (($value[9] !=null) ? $value[9] : 0);
                        $overtime         = (($value[10] !=null) ? $value[10] : 0);                        
                        $val_salarymonth  =  $basic_salary + $allowancefixed + $allowanceUnfixed + $rapel +  $overtime;
                        
                        $total_loan       = (($value[12] !=null) ? $value[12] : 0 );
                        $deduction_other  = 
                        (($value[15] !=null) ? $value[15] : 0 ) + 
                        (($value[16] !=null) ? $value[16] : 0 ) + 
                        (($value[17] !=null) ? $value[17] : 0 ) + 
                        (($value[18] !=null) ? $value[18] : 0 ) + 
                        (($value[19] !=null) ? $value[19] : 0 ) + 
                        (($value[20] !=null) ? $value[20] : 0 ) + 
                        (($value[21] !=null) ? $value[21] : 0 );

                        $bpjs             = (($value[13] !=null) ? $value[13] : 0 ) + (($value[14] !=null) ? $value[14] : 0 );
                        $total_deduction  = $total_loan + $deduction_other + $bpjs;
                        $thp              = $val_salarymonth -  $total_deduction;
                        $datas = [
                            'date'                              => date('Y-m-d'),
                            'employee_id'                       => $employeeId->id,
                            'employee_code'                     => $employeeId->employee_id,
                            'no_employee'                       => $employeeId->no_employee,
                            'name'                              => $employeeId->name,
                            'position_id'                       => $employeeId->position_id,
                            // 'level'                          => $employeeId->position_id,
                            'bank_name'                         => $employeeId->bank_name,
                            'account_number'                    => $employeeId->account_number,
                            'basic_salary'                      => $basic_salary,
                            'allowance_fixed'                   => $allowancefixed,
                            'allowance_unfixed'                 => $allowanceUnfixed,
                            'allowance_other'                   => 0,
                            'overtime'                          => $overtime,
                            'salary_this_month'                 => $val_salarymonth,
                            'company_pay_bpjs'                  => 0,
                            'total_salary'                      => $val_salarymonth,
                            'company_pay_bpjs_kesehatan'        => 0,
                            'company_pay_bpjs_ketenagakerjaan'  => 0,
                            'employee_pay_bpjs_kesehatan'       => (($value[13] !=null) ? $value[13] : 0 ),
                            'employee_pay_bpjs_ketenagakerjaan' => (($value[14] !=null) ? $value[14] : 0 ),
                            'company_total_pay_bpjs'            => 0,
                            'employee_total_pay_bpjs'           => $bpjs,
                            'installment'                       => 0,
                            'loans'                             => $total_loan,
                            'total_pay_loans'                   => $total_loan,
                            'sanksi_adm'                        => 0,
                            'total_deduction_other'             => $deduction_other,
                            'pph21'                             => 0,
                            'total_deduction'                   => $total_deduction,
                            'rapel'                             => $rapel,
                            'startdate'                         => $value[22],
                            'enddate'                           => $value[23],
                            'take_home_pay'                     => $thp,
                            'branch_id'                         => $employeeId->branch_id,
                            'total_attendance'                  => $value[4],
                            'total_overtime_hour'               => $value[11],
                            'created_at'                        => date('Y-m-d h:m:s'),
                        ];
                        if (!in_array($datas,$import)){
                            array_push($import,$datas);
                        }
                        
                        // if ($value[5] !=null){
                        //     $opt = AllowanceOption::where('name','Tunjangan Jabatan')->where('pay_type','fixed')->where('include_attendance','N')->first();
                        //     if ($opt !=null){
                        //         $chkData = AllowanceFinance::select('allowance_finances.*')
                        //                                     ->leftJoin('allowance_options','allowance_options.id','=','allowance_finances.allowance_type_id')
                        //                                     ->where('employee_id',$employeeId->id)
                        //                                     ->where('allowance_options.id',$opt->id)
                        //                                     ->first();
                        //         if ($chkData == null){
                        //             $data =[
                        //                 'employee_id'       => $employeeId->id,
                        //                 'allowance_type_id' => $opt->id,
                        //                 'amount'            => (($value[5] !=null) ? $value[5] : 0 ),
                        //                 'created_by'        => Auth::user()->id,
                        //                 'created_at'        => $value[23].' '.date('h:m:s'),
                        //                 'updated_at'        => $value[23].' '.date('h:m:s')
                        //             ];
                        //             $allowanceFinance = AllowanceFinance::insert($data);
                        //         }else{
                        //             $data =[
                        //                 'employee_id'       => $employeeId->id,
                        //                 'allowance_type_id' => $opt->id,
                        //                 'amount'            => (($value[5] !=null) ? $value[5] : 0 ),
                        //                 'created_by'        => Auth::user()->id,
                        //                 'created_at'        => $value[23].' '.date('h:m:s'),
                        //                 'updated_at'        => $value[23].' '.date('h:m:s')
                        //             ];
                        //             $allowanceFinance = AllowanceFinance::where('id',$chkData->id)->update($data);
                        //         }
                        //     }else{
                        //         $opts = [
                        //             'name'               => 'Tunjangan Jabatan',
                        //             'pay_type'           => 'fixed',
                        //             'include_attendance' => 'N',
                        //             'branch_id'          => $employeeId->branch_id,
                        //             'created_by'         => Auth::user()->id,
                        //             'created_at'        => $value[23].' '.date('h:m:s'),
                        //             'updated_at'        => $value[23].' '.date('h:m:s')
                        //         ];
                                
                        //         $createOpt = AllowanceOption::Insert($opts);
                                
                        //         $data =[
                        //             'employee_id'       => $employeeId->id,
                        //             'allowance_type_id' => DB::getPdo()->lastInsertId(),
                        //             'amount'            => (($value[5] !=null) ? $value[5] : 0 ),
                        //             'created_by'        => Auth::user()->creatorId(),
                        //             'created_at'        => $value[23].' '.date('h:m:s'),
                        //             'updated_at'        => $value[23].' '.date('h:m:s')
                        //         ];
                        //         $allowanceFinance = AllowanceFinance::insert($data);
                                
                        //     }
                        //      // log allowance_finance
                        //     if ($allowanceFinance){
                        //         $finance = AllowanceFinance::select('allowance_finances.*')
                        //                                     ->leftJoin('allowance_options','allowance_options.id','=','allowance_finances.allowance_type_id')
                        //                                     ->where('employee_id',$employeeId->id)
                        //                                     ->where('allowance_options.pay_type','fixed')
                        //                                     ->where('allowance_options.include_attendance','N')
                        //                                     ->get();
                        //         foreach ($finance as $logFinance){
                        //             $check = DB::table('log_allowance_finances')
                        //                         ->where('allowance_type_id',$logFinance->allowance_type_id)
                        //                         ->where('employee_id',$logFinance->employee_id)
                        //                         ->where('start_date',$value[22])
                        //                         ->where('end_date',$value[23])
                        //                         ->first();
                        //             if ($check !=null){
                        //                 if ($check->amount != $logFinance->amount){
                        //                     $data = [
                        //                         'start_date'         => $value[22],
                        //                         'end_date'           => $value[23],
                        //                         'branch_id'         => $employeeId->branch_id,
                        //                         'employee_id'       => $logFinance->employee_id,
                        //                         'allowance_type_id' => $logFinance->allowance_type_id,
                        //                         'amount'            => $logFinance->amount,
                        //                         'created_by'        => Auth::user()->id,
                        //                         'created_at'        => $value[23].' '.date('h:m:s'),
                        //                         'updated_at'        => $value[23].' '.date('h:m:s')
                        //                     ];
                        //                     DB::table('log_allowance_finances')
                        //                         ->where('allowance_type_id',$logFinance->allowance_type_id)
                        //                         ->where('employee_id',$logFinance->employee_id)
                        //                         ->where('start_date',$value[22])
                        //                         ->where('end_date',$value[23])
                        //                         ->update($data);
                        //                 }
                        //             }else{
                        //                 $data = [
                        //                     'start_date'         => $value[22],
                        //                     'end_date'           => $value[23],
                        //                     'branch_id'         => $employeeId->branch_id,
                        //                     'employee_id'       => $logFinance->employee_id,
                        //                     'allowance_type_id' => $logFinance->allowance_type_id,
                        //                     'amount'            => $logFinance->amount,
                        //                     'created_by'        => Auth::user()->id,
                        //                     'created_at'        => $value[23].' '.date('h:m:s'),
                        //                     'updated_at'        => $value[23].' '.date('h:m:s')
                        //                 ];
                        //                 DB::table('log_allowance_finances')->insert($data);
                        //             }
                        //         }
                        //     } 
                        // }
                        if ($value[5] !=null){
                            $opt = AllowanceOption::where('name','Tunjangan Jabatan')->where('pay_type','fixed')->where('include_attendance','N')->first();
                            if ($opt !=null){
                                $data =[
                                    'employee_id'       => $employeeId->id,
                                    'allowance_option_id' => $opt->id,
                                    'amount'            => $value[5],
                                    'created_by'        => Auth::user()->id,
                                    'date'              => date('Y-m-d', strtotime($value[23])),
                                    'branch_id'          => $employeeId->branch_id,
                                    'created_at'        => $value[23].' '.date('h:m:s'),
                                    'updated_at'        => $value[23].' '.date('h:m:s')
                                ];
                                DB::table('allowances')->insert($data);
                            }else{
                                $opts = [
                                    'name'               => 'Tunjangan Jabatan',
                                    'pay_type'           => 'unfixed',
                                    'include_attendance' => 'Y',
                                    'branch_id'          => $employeeId->branch_id,
                                    'created_by'         => Auth::user()->id,
                                    'created_at'        =>  $value[23].' '.date('h:m:s'),
                                    'updated_at'        =>  $value[23].' '.date('h:m:s')
                                ];
                                
                                $createOpt = AllowanceOption::Insert($opts);
                                
                                $data =[
                                    'employee_id'       => $employeeId->id,
                                    'allowance_option_id' => DB::getPdo()->lastInsertId(),
                                    'amount'            => $value[5],
                                    'created_by'        => Auth::user()->id,
                                    'date'              => date('Y-m-d', strtotime($value[23])),
                                    'branch_id'          => $employeeId->branch_id,
                                    'created_at'        => $value[23].' '.date('h:m:s'),
                                    'updated_at'        => $value[23].' '.date('h:m:s')
                                ];
                                DB::table('allowances')->insert($data);
                            }
                        }
                        if ($value[6] !=null){
                            $opt = AllowanceOption::where('name','Uang Makan')->where('pay_type','unfixed')->where('include_attendance','Y')->first();
                            if ($opt !=null){
                                $data =[
                                    'employee_id'       => $employeeId->id,
                                    'allowance_option_id' => $opt->id,
                                    'amount'            => $meal_allowance,
                                    'created_by'        => Auth::user()->id,
                                    'date'              => date('Y-m-d', strtotime($value[23])),
                                    'branch_id'          => $employeeId->branch_id,
                                    'created_at'        => $value[23].' '.date('h:m:s'),
                                    'updated_at'        => $value[23].' '.date('h:m:s')
                                ];
                                DB::table('allowances')->insert($data);
                            }else{
                                $opts = [
                                    'name'               => 'Uang Makan',
                                    'pay_type'           => 'unfixed',
                                    'include_attendance' => 'Y',
                                    'branch_id'          => $employeeId->branch_id,
                                    'created_by'         => Auth::user()->id,
                                    'created_at'        =>  $value[23].' '.date('h:m:s'),
                                    'updated_at'        =>  $value[23].' '.date('h:m:s')
                                ];
                                
                                $createOpt = AllowanceOption::Insert($opts);
                                
                                $data =[
                                    'employee_id'       => $employeeId->id,
                                    'allowance_option_id' => DB::getPdo()->lastInsertId(),
                                    'amount'            => $meal_allowance,
                                    'created_by'        => Auth::user()->id,
                                    'date'              => date('Y-m-d', strtotime($value[23])),
                                    'branch_id'          => $employeeId->branch_id,
                                    'created_at'        => $value[23].' '.date('h:m:s'),
                                    'updated_at'        => $value[23].' '.date('h:m:s')
                                ];
                                DB::table('allowances')->insert($data);
                            }
                        }
                        if ($value[7] !=null){
                            $opt = AllowanceOption::where('name','Prestasi')->where('pay_type','unfixed')->where('include_attendance','N')->first();
                            if ($opt !=null){
                                $data =[
                                    'employee_id'       => $employeeId->id,
                                    'allowance_option_id' => $opt->id,
                                    'amount'            => (($value[7] !=null) ? $value[7] : 0 ),
                                    'created_by'        => Auth::user()->id,
                                    'date'              => date('Y-m-d', strtotime($value[23])),
                                    'branch_id'          => $employeeId->branch_id,
                                    'created_at'        => $value[23].' '.date('h:m:s'),
                                    'updated_at'        => $value[23].' '.date('h:m:s')
                                ];
                                DB::table('allowances')->insert($data);
                            }else{
                                $opts = [
                                    'name'               => 'Prestasi',
                                    'pay_type'           => 'unfixed',
                                    'include_attendance' => 'N',
                                    'branch_id'          => $employeeId->branch_id,
                                    'created_by'         => Auth::user()->id,
                                    'created_at'        =>  $value[23].' '.date('h:m:s'),
                                    'updated_at'        =>  $value[23].' '.date('h:m:s')
                                ];
                                
                                $createOpt = AllowanceOption::Insert($opts);
                                
                                $data =[
                                    'employee_id'       => $employeeId->id,
                                    'allowance_option_id' => DB::getPdo()->lastInsertId(),
                                    'amount'            => (($value[7] !=null) ? $value[7] : 0 ),
                                    'created_by'        => Auth::user()->creatorId(),
                                    'date'              => date('Y-m-d', strtotime($value[23])),
                                    'branch_id'          => $employeeId->branch_id,
                                    'created_at'        => $value[23].' '.date('h:m:s'),
                                    'updated_at'        => $value[23].' '.date('h:m:s')
                                ];
                                DB::table('allowances')->insert($data);
                                
                            }
                        }
                        if ($value[8] !=null){
                            $opt = AllowanceOption::where('name','Transport Inap')->where('pay_type','unfixed')->where('include_attendance','N')->first();
                            if ($opt !=null){
                                $data =[
                                    'employee_id'       => $employeeId->id,
                                    'allowance_option_id' => $opt->id,
                                    'amount'            => (($value[8] !=null) ? $value[8] : 0 ),
                                    'created_by'        => Auth::user()->id,
                                    'date'              => date('Y-m-d', strtotime($value[23])),
                                    'branch_id'          => $employeeId->branch_id,
                                    'created_at'        => $value[23].' '.date('h:m:s'),
                                    'updated_at'        => $value[23].' '.date('h:m:s')
                                ];
                                DB::table('allowances')->insert($data);
                            }else{
                                $opts = [
                                    'name'               => 'Transport Inap',
                                    'pay_type'           => 'unfixed',
                                    'include_attendance' => 'N',
                                    'branch_id'          => $employeeId->branch_id,
                                    'created_by'         => Auth::user()->id,
                                    'created_at'        =>  $value[23].' '.date('h:m:s'),
                                    'updated_at'        =>  $value[23].' '.date('h:m:s')
                                ];
                                
                                $createOpt = AllowanceOption::Insert($opts);
                                
                                $data =[
                                    'employee_id'       => $employeeId->id,
                                    'allowance_option_id' => DB::getPdo()->lastInsertId(),
                                    'amount'            => (($value[8] !=null) ? $value[8] : 0 ),
                                    'created_by'        => Auth::user()->creatorId(),
                                    'date'              => date('Y-m-d', strtotime($value[23])),
                                    'branch_id'          => $employeeId->branch_id,
                                    'created_at'        => $value[23].' '.date('h:m:s'),
                                    'updated_at'        => $value[23].' '.date('h:m:s')
                                ];
                                DB::table('allowances')->insert($data);
                                
                            }
                        }
                        if ($value[12] !=null){
                            $idopt = LoanOption::where('name','KASBON')->first();
                        
                            $data = [
                                'employee_id'           => $employeeId->id,
                                'loan_type_id'          => $idopt->id,
                                'installment'           => 0,
                                'number_of_installment' => 0,
                                'status'                => 'paid off',
                                'amount'                => $value[12],
                                'created_by'            => Auth::user()->id,
                                'branch_id'             => $employeeId->branch_id,
                                'created_at'            => $value[23].' '.date('h:m:s'),
                                'updated_at'            => $value[23].' '.date('h:m:s')
                            ];
                            Loan::insert($data);
                        }
                        if ($value[15] != null){
                            $deduc2 = [
                                'employee_id'           => $employeeId->id,
                                'branch_id'             => $employeeId->branch_id,
                                'date'                  => $value[23],
                                'name'                  => 'Koperasi',
                                'amount'                => $value[15],
                                'created_by'            => Auth::user()->id,
                                'created_at'            => $value[23].' '.date('h:m:s'),
                                'updated_at'            => $value[23].' '.date('h:m:s')
                            ];
                            Deduction_other::create($deduc2);
                        }
                        if ($value[16] != null){
                            $deduc3 = [
                                'employee_id'           => $employeeId->id,
                                'branch_id'             => $employeeId->branch_id,
                                'date'                  => $value[23],
                                'name'                  => 'Seragam',
                                'amount'                => $value[16],
                                'created_by'            => Auth::user()->id,
                                'created_at'            => $value[23].' '.date('h:m:s'),
                                'updated_at'            => $value[23].' '.date('h:m:s')
                            ];
                            Deduction_other::create($deduc3);
                        }
                        if ($value[17] != null){
                            $deduc4 = [
                                'employee_id'           => $employeeId->id,
                                'branch_id'             => $employeeId->branch_id,
                                'date'                  => $value[23],
                                'name'                  => 'Potongan Absensi',
                                'amount'                => $value[17],
                                'created_by'            => Auth::user()->id,
                                'created_at'            => $value[23].' '.date('h:m:s'),
                                'updated_at'            => $value[23].' '.date('h:m:s')
                            ];
                            Deduction_other::create($deduc4);
                        }
                        if ($value[18] != null){
                            $deduc5 = [
                                'employee_id'           => $employeeId->id,
                                'branch_id'             => $employeeId->branch_id,
                                'date'                  => $value[23],
                                'name'                  => 'Potongan Terlambat',
                                'amount'                => $value[18],
                                'created_by'            => Auth::user()->id,
                                'created_at'            => $value[23].' '.date('h:m:s'),
                                'updated_at'            => $value[23].' '.date('h:m:s')
                            ];
                            Deduction_other::create($deduc5);
                        }
                        if ($value[19] != null){
                            $deduc5 = [
                                'employee_id'           => $employeeId->id,
                                'branch_id'             => $employeeId->branch_id,
                                'date'                  => $value[23],
                                'name'                  => 'Potongan Kelebihan gaji',
                                'amount'                => $value[19],
                                'created_by'            => Auth::user()->id,
                                'created_at'            => $value[23].' '.date('h:m:s'),
                                'updated_at'            => $value[23].' '.date('h:m:s')
                            ];
                            Deduction_other::create($deduc5);
                        }
                        if ($value[20] != null){
                            $deduc5 = [
                                'employee_id'           => $employeeId->id,
                                'branch_id'             => $employeeId->branch_id,
                                'date'                  => $value[23],
                                'name'                  => 'Potongan Materai',
                                'amount'                => $value[20],
                                'created_by'            => Auth::user()->id,
                                'created_at'            => $value[23].' '.date('h:m:s'),
                                'updated_at'            => $value[23].' '.date('h:m:s')
                            ];
                            Deduction_other::create($deduc5);
                        }
                        if ($value[21] != null){
                            $deduc5 = [
                                'employee_id'           => $employeeId->id,
                                'branch_id'             => $employeeId->branch_id,
                                'date'                  => $value[23],
                                'name'                  => 'Potongan Lain-lain',
                                'amount'                => $value[21],
                                'created_by'            => Auth::user()->id,
                                'created_at'            => $value[23].' '.date('h:m:s'),
                                'updated_at'            => $value[23].' '.date('h:m:s')
                            ];
                            Deduction_other::create($deduc5);
                        }
                    endif;
                endif;
            endif;
        }
       
        $run = DB::table('take_home_pay')->insert($import);
        DB::commit();
            $res = [
                'status' => 'success',
                'msg'    => 'Import Data Successfuly !',
            ];
            return response()->json($res);
        DB::rollBack();
            $res = [
                'status' => 'error',
                'msg'    => 'Someting went Wrong!',
            ];
            return response()->json($res);
    }
}
