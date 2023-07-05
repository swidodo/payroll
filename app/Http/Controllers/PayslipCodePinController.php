<?php

namespace App\Http\Controllers;

use App\Models\PayslipCodePin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PayslipCodePinController extends Controller
{
    public function index()
    {
        if (Auth::user()->can('manage payslip code pin')) {
            $pin = PayslipCodePin::where('created_by', Auth::user()->creatorId())->first();

            return view('pages.contents.payroll.payslip.code-pin.index', compact('pin'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->can('edit payslip code pin')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'pin' => 'required|string',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();
                $pin = PayslipCodePin::where('created_by', Auth::user()->creatorId())->first();

                if (!is_null($pin)) {
                    $pin->pin = Hash::make($request->pin);
                    $pin->save();
                } else {
                    PayslipCodePin::create([
                        'employee_id' => Auth::user()->type == 'company' ? null : Auth::user()->employee->id,
                        'pin'        => Hash::make($request->pin),
                        'created_by' => Auth::user()->creatorId(),
                    ]);
                }

                DB::commit();
                toast('Successfuly set the pin', 'success');
                return redirect()->route('payslip-code-pin.index');
            } catch (Exception $e) {
                DB::rollBack();
                toast($e->getMessage(), 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
}
