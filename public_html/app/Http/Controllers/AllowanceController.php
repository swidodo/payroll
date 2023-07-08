<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Employee;
use App\Models\AllowanceFinance;
use App\Models\AllowanceOption;
use App\Models\Utility;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AllowanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage allowance')) {
            if (Auth::user()->type != 'company') {
                $user     = Auth::user();
                $employee = Employee::where('user_id', '=', $user->id)->get();
                $allowance  = AllowanceFinance::where('employee_id', '=', $user->employee->id)->get();
                $allowanceTypes  = AllowanceOption::where('created_by', '=', Auth::user()->creatorId())->get();

                return view('pages.contents.allowance.index', compact('allowance', 'employee', 'allowanceTypes'));
            } else {
                $allowance = AllowanceFinance::where('created_by', '=', Auth::user()->creatorId())->get();
                $employee  = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
                $allowanceTypes  = AllowanceOption::where('created_by', '=', Auth::user()->creatorId())->get();
                return view('pages.contents.allowance.index', compact('allowance', 'employee', 'allowanceTypes'));
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->can('create allowance')) {
            $validator = Validator::make(
                $request->all(),
                [
                   'employee_id' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();

                $employee = Employee::where('user_id', '=', Auth::user()->id)->first();

                $allowance    = new AllowanceFinance();
                if (Auth::user()->type == "employee") {
                    $allowance->employee_id = $employee->id;
                } else {
                    $allowance->employee_id = $request->employee_id;
                }
                $i=0;
                $data_array= [];
                foreach($request->amount as $amount){
                    if ($amount !=''){
                        $data = [
                            'allowance_type_id' =>$request->allowance_id[$i],
                            'employee_id'       => $request->employee_id,
                            'amount'            => $amount,
                            'created_by'        => Auth::user()->creatorId()
                        ];
                        array_push($data_array,$data);
                    }
                    $i++;
                }
                if (count($data_array) > 0){
                    AllowanceFinance::Insert($data_array);
                }else{
                    toast('Allowance Faild created.', 'error');
                    return redirect()->route('allowances.index');
                }
                // $allowance->allowance_type_id    = $request->allowance_type_id;
                // $allowance->amount       = $request->amount;
                // $allowance->created_by       = Auth::user()->creatorId();
                // $allowance->save();

                // Utility::insertToRequest($allowance, Auth::user(), 'Allowance');

                DB::commit();
                toast('Allowance successfully created.', 'success');
                return redirect()->route('allowances.index');
            } catch (Exception $e) {
                DB::rollBack();
                toast('Something went wrong.', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $allowance = AllowanceFinance::find($id);
        if (Auth::user()->can('edit allowance')) {
            if ($allowance->created_by == Auth::user()->creatorId()) {

                return response()->json($allowance);
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
        if (Auth::user()->can('edit allowance')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'allowance_type_id' => 'required',
                    'employee_id' => 'required',
                    'amount' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();
                $employee = Employee::where('user_id', '=', Auth::user()->id)->first();
                $allowance = AllowanceFinance::find($id);
                $allowance->update($request->all());
                $allowance->save();

                DB::commit();
                toast('Allowance successfully updated.', 'success');
                return redirect()->route('allowances.index');
            } catch (Exception $e) {
                DB::rollBack();
                toast('Something went wrong.', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
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
        $allowance = AllowanceFinance::find($id);

        if (Auth::user()->can('delete allowance')) {
            if ($allowance->created_by == Auth::user()->creatorId()) {
                $allowance->delete();

                toast('Allowance ' . $allowance->name . ' successfully deleted.', 'success');
                return redirect()->route('payslip-type.index');
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
