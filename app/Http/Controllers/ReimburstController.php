<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Employee;
use App\Models\Reimburst;
use App\Models\ReimburstmentOption;
use App\Models\ShiftType;
use App\Models\Utility;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReimburstController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage reimburst')) {
            if (Auth::user()->type != 'company') {
                $user     = Auth::user();
                $employee = Employee::where('user_id', '=', $user->id)->get();
                $reimburst  = Reimburst::where('employee_id', '=', $user->employee->id)->get();
                $reimburstType = ReimburstmentOption::where('created_by', '=', Auth::user()->creatorId())->get();

                return view('pages.contents.reimburst.index', compact('reimburst', 'employee', 'reimburstType'));
            } else {
                $reimburst = Reimburst::where('created_by', '=', Auth::user()->creatorId())->get();
                $employee  = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
                $reimburstType = ReimburstmentOption::where('created_by', '=', Auth::user()->creatorId())->get();

                return view('pages.contents.reimburst.index', compact('reimburst', 'employee', 'reimburstType'));
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
        if (Auth::user()->can('create reimburst')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'reimburst_type_id' => 'required',
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

                $reimburst    = new Reimburst();
                if (Auth::user()->type == "employee") {
                    $reimburst->employee_id = $employee->id;
                } else {
                    $reimburst->employee_id = $request->employee_id;
                }
                $reimburst->reimburst_type_id    = $request->reimburst_type_id;
                $reimburst->amount       = $request->amount;
                $reimburst->created_by       = Auth::user()->creatorId();
                $reimburst->save();

                // Utility::insertToRequest($reimburst, Auth::user(), 'Reimburst');

                DB::commit();
                toast('Reimburst successfully created.', 'success');
                return redirect()->route('reimburst.index');
            } catch (Exception $e) {
                DB::rollBack();
                toast('Something went wrong.', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
