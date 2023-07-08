<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Employee;
use App\Models\Cash;
use App\Models\LoanOption;
use App\Models\Utility;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage cash advance')) {
            if (Auth::user()->type != 'company') {
                $user     = Auth::user();
                $employee = Employee::where('user_id', '=', $user->id)->get();
                $cash  = Cash::where('employee_id', '=', $user->employee->id)->get();
                $loanType = LoanOption::where('created_by', '=', Auth::user()->creatorId())->get();

                return view('pages.contents.cash.index', compact('cash', 'employee', 'loanType'));
            } else {
                $cash = Cash::where('created_by', '=', Auth::user()->creatorId())->get();
                $employee  = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
                $loanType = LoanOption::where('created_by', '=', Auth::user()->creatorId())->get();

                return view('pages.contents.cash.index', compact('cash', 'employee', 'loanType'));
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('cash.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->can('create cash advance')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'loan_type_id' => 'required',
                    'employee_id' => 'required',
                    'amount' => 'required',
                    'installment' => 'required',

                    //    'remark' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();

                $employee = Employee::where('user_id', '=', Auth::user()->id)->first();

                $cash    = new Cash();
                if (Auth::user()->type == "employee") {
                    $cash->employee_id = $employee->id;
                } else {
                    $cash->employee_id = $request->employee_id;
                }
                $cash->loan_type_id    = $request->loan_type_id;
                $cash->amount       = $request->amount;
                $cash->installment          = $request->installment;
                $cash->number_of_installment = 1;
                $cash->status               = 'ongoing';
                $cash->created_by       = Auth::user()->creatorId();
                $cash->save();

                Utility::insertToRequest($cash, Auth::user(), 'Cash Advance');

                DB::commit();
                toast('Cash Advance successfully created.', 'success');
                return redirect()->route('cash.index');
            } catch (Exception $e) {
                DB::rollBack();
                toast('Something went wrong.', 'error');
                return redirect()->route('cash.index');
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('cash.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cash = Cash::find($id);
        if (Auth::user()->can('edit cash advance')) {
            if ($cash->created_by == Auth::user()->creatorId()) {

                return response()->json($cash);
            } else {
                return response()->json(['error' => 'Permission denied.'], 401);
            }
        } else {
            return response()->json(['error' => 'Permission denied.'], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cash = Cash::find($id);

        if (Auth::user()->can('edit cash advance')) {
            if ($cash->created_by == Auth::user()->creatorId()) {
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
                    $cash->update($request->all());

                    toast('Cash' . $cash->name . ' successfully updated.', 'success');
                    return redirect()->route('cash.index');
                } catch (Exception $e) {
                    toast('Permission denied.', 'error');
                    return redirect()->route('cash.index');
                }
            } else {
                toast('Permission denied.', 'error');
                return redirect()->route('cash.index');
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('cash.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cash = Cash::find($id);

        if (Auth::user()->can('delete cash advance')) {
            if ($cash->created_by == Auth::user()->creatorId()) {
                $cash->delete();

                toast('Cash' . $cash->name . ' successfully deleted.', 'success');
                return redirect()->route('cash.index');
            } else {
                toast('Permission denied.', 'error');
                return redirect()->route('cash.index');
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('cash.index');
        }
    }
}
