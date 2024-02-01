<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\PaySlip;
use App\Models\PayslipCodePin;
use App\Models\Utility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;

class PaySlipController extends Controller
{
    public function index()
    {
        if (Auth::user()->can('manage payslip')) {
            if (Auth::user()->type != 'company') {
                $user     = Auth::user();
                $employees = Employee::where('user_id', '=', $user->id)->get();
                if (count($employees) > 0) {
                    $net_salary = 0;
                    foreach ($employees as $key => $value) {
                        if (!is_null($value->salary)) {
                            $payslipDetail = Utility::employeePayslipDetail($value->id);
                            $value->net_salary = $payslipDetail['totalEarning'] - $payslipDetail['totalDeduction'];
                            $value->save();
                        } else {
                            $value->net_salary = 0;
                            $value->save();
                        }
                    }
                }

                return view('pages.contents.payroll.payslip.index', compact('employees'));
            } else {
                $employees = Employee::where(
                    [
                        'created_by' => Auth::user()->creatorId(),
                    ]
                )->get();

                if (count($employees) > 0) {
                    $net_salary = 0;
                    foreach ($employees as $key => $value) {
                        if (!is_null($value->salary)) {
                            $payslipDetail = Utility::employeePayslipDetail($value->id);
                            $value->net_salary = $payslipDetail['totalEarning'] - $payslipDetail['totalDeduction'];
                            $value->save();
                        } else {
                            $value->net_salary = 0;
                            $value->save();
                        }
                    }
                }
                return view('pages.contents.payroll.payslip.index', compact('employees'));
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    // public function show($id)
    // {
    //     $employee = Employee::find($id);

    //     if (is_null($employee) || empty($employee)) {
    //         toast('Employee not found', 'warning');
    //         return redirect()->route('payslips.index');
    //     }

    //     $paySlips = PaySlip::where('created_by', Auth::user()->creatorId())->where('employee_id', $employee->id)->get();
    //     return view('pages.contents.payroll.payslip.detail', compact('paySlips'));
    // }

    // public function downloadSlip(Employee $employee)
    // {
    //     $payslipPin = PayslipCodePin::where('created_by', Auth::user()->creatorId())->where('employee_id', Auth::user()->type == 'company' ? 0 : Auth::user()->employee->id)->first();

    //     if (is_null($payslipPin)) {
    //         $payslipPin = PayslipCodePin::where('created_by', Auth::user()->creatorId())->where('employee_id', null)->first();
    //     }

    //     if (Auth::user()->can('generate payslip') && Hash::check(request()->get('pin'), isset($payslipPin->pin) ? $payslipPin->pin : 0)) {
    //         try {
    //             $res = Utility::generatePayslip($employee, 'download');
    //             return $res;
    //         } catch (Exception $e) {
    //             DB::rollBack();
    //             toast($e->getMessage(), 'error');
    //             return redirect()->back();
    //         }
    //     } else {
    //         toast('Permission Denied.', 'error');
    //         return redirect()->back();
    //     }
    // }

    // public function showSlip(Employee $employee)
    // {
    //     $payslipPin = PayslipCodePin::where('created_by', Auth::user()->creatorId())->where('employee_id', Auth::user()->type == 'company' ? 0 : Auth::user()->employee->id)->first();

    //     if (is_null($payslipPin)) {
    //         $payslipPin = PayslipCodePin::where('created_by', Auth::user()->creatorId())->where('employee_id', null)->first();
    //     }

    //     if (Auth::user()->can('generate payslip') && Hash::check(request()->get('pin'), isset($payslipPin->pin) ? $payslipPin->pin : 0)) {
    //         try {
    //             $res = Utility::generatePayslip($employee, 'view');
    //             return $res;
    //         } catch (Exception $e) {
    //             DB::rollBack();
    //             toast($e->getMessage(), 'error');
    //             return redirect()->back();
    //         }
    //     } else {
    //         toast('Permission Denied.', 'error');
    //         return redirect()->back();
    //     }
    // }

    // public function downloadPDF(PaySlip $payslipEmployee)
    // {
    //     return response()->download(storage_path('app/public/' . $payslipEmployee->pdf_filename));
    // }
    public function payslip_user(){
        if (Auth::user()->can('payslip-user')){
        $employeeId = Employee::where('user_id',Auth::user()->id)->first();
        $data['payslip'] = DB::table('take_home_pay')->where('employee_id', $employeeId->id)->orderBy('enddate','DESC')->get();
        return view('pages.contents.payroll.payslip.payslip_employee',$data);
        }else{
            return redirect()->back();
        }
    }
    
}
