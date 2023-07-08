<?php

namespace App\Http\Controllers;

use App\Models\PayslipType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PayslipTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage payslip type')) {
            $payslipTypes = PayslipType::where('created_by', '=', Auth::user()->creatorId())->get();

            return view('pages.contents.payslip-type.index', compact('payslipTypes'));
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
        if (Auth::user()->can('create payslip type')) {

            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:20',
                    'type' => 'required|not_in:0',
                ]
            );

            if ($validator->fails()) {
                if ($validator->messages()->has('type')) {
                    toast($validator->messages()->get('type')[0], 'error');
                } elseif ($validator->messages()->has('name')) {
                    toast($validator->messages()->get('name')[0], 'error');
                }
                return redirect()->back()->with('errors', $validator->messages());
            }

            $payslipType             = new PayslipType();
            $payslipType->name       = $request->name;
            $payslipType->type       = $request->type;
            $payslipType->created_by = Auth::user()->creatorId();
            $payslipType->save();

            toast('Payslip Type ' . $payslipType->name . ' successfully created.', 'success');
            return redirect()->route('payslip-type.index');
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
        $payslipType = PayslipType::find($id);
        if (Auth::user()->can('edit payslip type')) {
            if ($payslipType->created_by == Auth::user()->creatorId()) {

                return response()->json($payslipType);
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
        $payslipType = PayslipType::find($id);

        if (Auth::user()->can('edit payslip type')) {
            if ($payslipType->created_by == Auth::user()->creatorId()) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'name' => 'required|max:20',
                    ]
                );

                if ($validator->fails()) {
                    return redirect()->back()->with('errors', $validator->messages());
                }

                $payslipType->name = $request->name;
                $payslipType->type = $request->type;
                $payslipType->save();

                toast('Payslip Type ' . $payslipType->name . ' successfully updated.', 'success');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payslipType = PayslipType::find($id);

        if (Auth::user()->can('delete payslip type')) {
            if ($payslipType->created_by == Auth::user()->creatorId()) {
                $payslipType->delete();

                toast('Payslip Type ' . $payslipType->name . ' successfully deleted.', 'success');
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
