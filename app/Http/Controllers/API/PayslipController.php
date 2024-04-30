<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Deduction_admin;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PayslipController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $data = DB::table('take_home_pay')
            ->select('take_home_pay.*')
            ->where('take_home_pay.employee_id', '=', auth()->user()->employee->id)
            ->paginate(10);
        $r = ['status' => Response::HTTP_OK, 'result' => $data];
        return response()->json($r, Response::HTTP_OK);
    }

    /**
     * detail
     *
     * @param  mixed $id
     * @return void
     */
    public function detail(Request $request, $id)
    {
        $validateData = Validator::make($request->all(), [
            'password' => ['required']
        ]);

        if ($validateData->fails()) {
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'wrong' => $validateData->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if (!Hash::check($request->password, auth()->user()->password)) {
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'wrong' => ['password' => ['Password salah']]
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $data['salary'] = DB::table('take_home_pay')
            ->select('take_home_pay.*', 'employees.name as employee_name', 'branches.name as branch_name', 'position.position_name', 'companies.name as company_name')
            ->leftJoin('employees', 'employees.id', '=', 'take_home_pay.employee_id')
            ->leftJoin('branches', 'branches.id', '=', 'take_home_pay.branch_id')
            ->leftJoin('position', 'position.id', '=', 'employees.position_id')
            ->leftJoin('companies', 'companies.id', '=', 'branches.company_id')
            ->where('take_home_pay.id', $id)->first();

        $data['allowance_fixed'] = DB::select("SELECT * from log_allowance_fixed('" . $data['salary']->startdate . "','" . $data['salary']->enddate . "','" . $data['salary']->branch_id . "') where employeeid = '" . $data['salary']->employee_id . "'");
        $data['allowance_unfixed'] = DB::select("SELECT * from getallowance_unfixed('" . $data['salary']->startdate . "','" . $data['salary']->enddate . "','" . $data['salary']->branch_id . "') where employeeid = '" . $data['salary']->employee_id . "'");
        $data['allowance_other'] = DB::select("SELECT * from get_other_allowance('" . $data['salary']->startdate . "','" . $data['salary']->enddate . "','" . $data['salary']->branch_id . "') where employeeid = '" . $data['salary']->employee_id . "'");
        $data['reimbursement'] = DB::select("SELECT * FROM get_reimburstment('" . $data['salary']->startdate . "','" . $data['salary']->enddate . "','" . $data['salary']->branch_id . "') where employee_id = '" . $data['salary']->employee_id . "'");
        $data['deduction_other'] = DB::select("SELECT * FROM get_deduction_other('" . $data['salary']->startdate . "','" . $data['salary']->enddate . "','" . $data['salary']->branch_id . "') where employeeid = '" . $data['salary']->employee_id . "'");
        $data['deduction'] = DB::table('v_deduction_acumulation')->where('employee_id', $data['salary']->employee_id)->first();
        $data['attendance'] = DB::select("SELECT * FROM getsalary('" . $data['salary']->startdate . "','" . $data['salary']->enddate . "','" . $data['salary']->branch_id . "') where employee_id = '" . $data['salary']->employee_id . "'");
        $data['adm']    = Deduction_admin::where('branch_id', $data['salary']->branch_id)->get();

        $r = ['status' => Response::HTTP_OK, 'result' => $data];
        return response()->json($r, Response::HTTP_OK);
    }
    
    /**
     * download
     *
     * @param  mixed $id
     * @return void
     */
    public function download($id)
    {
        $data['salary'] = DB::table('take_home_pay')
            ->select('take_home_pay.*', 'employees.name as employee_name', 'branches.name as branch_name', 'position.position_name', 'companies.name as company_name')
            ->leftJoin('employees', 'employees.id', '=', 'take_home_pay.employee_id')
            ->leftJoin('branches', 'branches.id', '=', 'take_home_pay.branch_id')
            ->leftJoin('position', 'position.id', '=', 'employees.position_id')
            ->leftJoin('companies', 'companies.id', '=', 'branches.company_id')
            ->where('take_home_pay.employee_id', auth()->user()->employee->id)
            ->where('take_home_pay.id', $id)
            ->first();

        $data['allowance_fixed'] = DB::select("SELECT * from get_allowance_fixed('" . $data['salary']->startdate . "','" . $data['salary']->enddate . "','" . $data['salary']->branch_id . "') where employeeid = '" . $data['salary']->employee_id . "'");
        $data['allowance_unfixed'] = DB::select("SELECT * from getallowance_unfixed('" . $data['salary']->startdate . "','" . $data['salary']->enddate . "','" . $data['salary']->branch_id . "') where employeeid = '" . $data['salary']->employee_id . "'");
        $data['allowance_other'] = DB::select("SELECT * from get_other_allowance('" . $data['salary']->startdate . "','" . $data['salary']->enddate . "','" . $data['salary']->branch_id . "') where employeeid = '" . $data['salary']->employee_id . "'");
        $data['reimbursement'] = DB::select("SELECT * FROM get_reimburstment('" . $data['salary']->startdate . "','" . $data['salary']->enddate . "','" . $data['salary']->branch_id . "') where employee_id = '" . $data['salary']->employee_id . "'");
        $data['deduction_other'] = DB::select("SELECT * FROM get_deduction_other('" . $data['salary']->startdate . "','" . $data['salary']->enddate . "','" . $data['salary']->branch_id . "') where employeeid = '" . $data['salary']->employee_id . "'");
        $data['deduction'] = DB::table('v_deduction_acumulation')->where('employee_id', $data['salary']->employee_id)->first();
        $data['attendance'] = DB::select("SELECT * FROM getsalary('" . $data['salary']->startdate . "','" . $data['salary']->enddate . "','" . $data['salary']->branch_id . "') where employee_id = '" . $data['salary']->employee_id . "'");
        $data['adm']    = Deduction_admin::where('branch_id', $data['salary']->branch_id)->get();

        $pdf = Pdf::loadview('pages.contents.payroll.payslip.pdf_mobile', $data);
        return $pdf->download('payslip-' . $data['salary']->employee_name . '-' . substr($data['salary']->enddate, 0, 7) . '.pdf');
    }
    
}
