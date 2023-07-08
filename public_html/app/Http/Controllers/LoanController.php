<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Loan;
use App\Models\LoanOption;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    public function index()
    {
        if (Auth::user()->can('manage loan')) {
            if (Auth::user()->type != 'company') {
                $user     = Auth::user();
                $employee = Employee::where('user_id', '=', $user->id)->get();
                $loans  = Loan::where('employee_id', '=', $user->employee->id)->get();
                $loanType = LoanOption::where('created_by', '=', Auth::user()->creatorId())->get();

                return view('pages.contents.loan.index', compact('loans', 'employee', 'loanType'));
            } else {
                $loans = Loan::where('created_by', '=', Auth::user()->creatorId())->get();
                $employee  = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
                $loanType = LoanOption::where('created_by', '=', Auth::user()->creatorId())->get();

                return view('pages.contents.loan.index', compact('loans', 'employee', 'loanType'));
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->can('create loan')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'loan_type_id' => 'required',
                    'employee_id' => 'required',
                    'installment' => 'required',
                    'amount' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();

                $employee = Employee::where('user_id', '=', Auth::user()->id)->first();

                $loan    = new Loan();
                if (Auth::user()->type == "employee") {
                    $loan->employee_id = $employee->id;
                } else {
                    $loan->employee_id = $request->employee_id;
                }
                $loan->loan_type_id         = $request->loan_type_id;
                $loan->amount               = $request->amount;
                $loan->installment          = $request->installment;
                $loan->number_of_installment = 1;
                $loan->status               = 'ongoing';
                $loan->created_by           = Auth::user()->creatorId();
                $loan->save();

                DB::commit();
                toast('Loan successfully created.', 'success');
                return redirect()->route('loans.index');
            } catch (Exception $e) {
                DB::rollBack();
                toast('Something went wrong.', 'error');
                return redirect()->route('loans.index');
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('loans.index');
        }
    }

    public function edit($id)
    {
        $loan = Loan::find($id);
        if (Auth::user()->can('edit loan')) {
            if ($loan->created_by == Auth::user()->creatorId()) {

                return response()->json($loan);
            } else {
                return response()->json(['error' => 'Permission denied.'], 401);
            }
        } else {
            return response()->json(['error' => 'Permission denied.'], 401);
        }
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::find($id);

        if (Auth::user()->can('edit loan')) {
            if ($loan->created_by == Auth::user()->creatorId()) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'loan_type_id' => 'required',
                        'employee_id' => 'required',
                        'amount' => 'required',
                    ]
                );

                if ($validator->fails()) {
                    return redirect()->back()->with('errors', $validator->messages());
                }

                try {
                    $loan->update($request->all());

                    toast('Loan' . $loan->name . ' successfully updated.', 'success');
                    return redirect()->route('loans.index');
                } catch (Exception $e) {
                    toast('Permission denied.', 'error');
                    return redirect()->back();
                }
            } else {
                toast('Permission denied.', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $loan = Loan::find($id);

        if (Auth::user()->can('delete loan')) {
            if ($loan->created_by == Auth::user()->creatorId()) {
                $loan->delete();

                toast('Loan' . $loan->name . ' successfully deleted.', 'success');
                return redirect()->route('loans.index');
            } else {
                toast('Permission denied.', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
}
