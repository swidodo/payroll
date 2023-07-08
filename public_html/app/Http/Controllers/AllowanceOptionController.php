<?php

namespace App\Http\Controllers;

use App\Models\AllowanceOption;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AllowanceOptionController extends Controller
{
    public function index()
    {
        if (Auth::user()->can('manage allowance option')) {
            $allowanceOptions = AllowanceOption::where('created_by', '=', Auth::user()->creatorId())->get();

            return view('pages.contents.allowance-option.index', compact('allowanceOptions'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->can('create allowance option')) {

            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:20',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();

                $allowanceOption             = new AllowanceOption();
                $allowanceOption->name       = $request->name;
                $allowanceOption->created_by = Auth::user()->creatorId();
                $allowanceOption->save();

                DB::commit();
                toast('Allowance Option  successfully created.', 'success');
                return redirect()->route('allowance-option.index');
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

    public function edit($id)
    {
        $allowanceOption = AllowanceOption::find($id);
        if (Auth::user()->can('edit allowance option')) {
            if ($allowanceOption->created_by == Auth::user()->creatorId()) {

                return response()->json($allowanceOption);
            } else {
                return response()->json(['error' => 'Permission denied.'], 401);
            }
        } else {
            return response()->json(['error' => 'Permission denied.'], 401);
        }
    }

    public function update(Request $request, $id)
    {
        $allowanceOption = AllowanceOption::find($id);

        if (Auth::user()->can('edit allowance option')) {
            if ($allowanceOption->created_by == Auth::user()->creatorId()) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'name' => 'required|max:20',

                    ]
                );

                if ($validator->fails()) {
                    return redirect()->back()->with('errors', $validator->messages());
                }

                try {
                    DB::beginTransaction();

                    $allowanceOption->name = $request->name;
                    $allowanceOption->save();

                    DB::commit();
                    toast('Allowance Option  successfully updated.', 'success');
                    return redirect()->route('allowance-option.index');
                } catch (Exception $e) {
                    DB::rollBack();
                    toast('Something went wrong.', 'error');
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
        $allowanceOption = AllowanceOption::find($id);

        if (Auth::user()->can('delete allowance option')) {
            if ($allowanceOption->created_by == Auth::user()->creatorId()) {
                $allowanceOption->delete();

                toast('Allowance Option successfully deleted.', 'success');
                return redirect()->route('allowance-option.index');
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
