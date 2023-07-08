<?php

namespace App\Http\Controllers;

use App\Models\Allowance;
use App\Models\ReimburstmentOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReimburstmentOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage reimbursement option')) {
            $reimbursementOptions = ReimburstmentOption::where('created_by', '=', Auth::user()->creatorId())->get();

            return view('pages.contents.reimbursement-option.index', compact('reimbursementOptions'));
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
        if (Auth::user()->can('create reimbursement option')) {

            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:20',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            $reimbursementOption             = new ReimburstmentOption();
            $reimbursementOption->name       = $request->name;
            $reimbursementOption->created_by = Auth::user()->creatorId();
            $reimbursementOption->save();

            return redirect()->route('reimbursement-option.index')->with('success', 'Reimbursement Option  successfully created.');
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
        $reimbursementOption = ReimburstmentOption::find($id);
        if (Auth::user()->can('edit reimbursement option')) {
            if ($reimbursementOption->created_by == Auth::user()->creatorId()) {

                return response()->json($reimbursementOption);
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
        $reimbursementOption = ReimburstmentOption::find($id);

        if (Auth::user()->can('edit reimbursement option')) {
            if ($reimbursementOption->created_by == Auth::user()->creatorId()) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'name' => 'required|max:20',

                    ]
                );

                if ($validator->fails()) {
                    return redirect()->back()->with('errors', $validator->messages());
                }

                $reimbursementOption->name = $request->name;
                $reimbursementOption->save();

                return redirect()->route('reimbursement-option.index')->with('success', 'Reimbursement Option successfully updated.');
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
        $reimbursementOption = ReimburstmentOption::find($id);

        if (Auth::user()->can('delete reimbursement option')) {
            if ($reimbursementOption->created_by == Auth::user()->creatorId()) {
                $reimbursementOption->delete();

                return redirect()->route('reimbursement-option.index')->with('success', 'Reimbursement Option successfully deleted.');
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
