<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage branch')) {
            $branches = Branch::where('created_by', Auth::user()->creatorId())->get();
            return view('pages.contents.branch.index', compact('branches'));
        } else {
            return redirect()->back()->with('error', 'Permission denied');
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
        if (Auth::user()->can('create branch')) {

            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }
            $branchId = Auth::user()->branch_id;
            $comId = Branch::where('id',$branchId);
            $branch             = new Branch();
            $branch->name       = $request->name;
            $branch->alias      = $request->alias;
            $branch->company_id = $comId->company_id;
            $branch->created_by = Auth::user()->creatorId();
            $branch->save();

            return redirect()->route('branches.index')->with('success', 'Branch  successfully created.');
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
    public function edit(Branch $branch)
    {
        if (Auth::user()->can('edit branch')) {
            if ($branch->created_by == Auth::user()->creatorId()) {

                // return view('branches.edit', compact('branch'));
                return response()->json($branch);
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
    public function update(Request $request, Branch $branch)
    {
        if (Auth::user()->can('edit branch')) {
            if ($branch->created_by == Auth::user()->creatorId()) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'name' => 'required',
                    ]
                );

                if ($validator->fails()) {
                    return redirect()->back()->with([
                        'errors'    => $validator->messages(),
                        'edit-show' => true,
                    ]);
                }

                $branch->name = $request->name;
                $branch->alias = $request->alias;
                $branch->save();

                return redirect()->route('branches.index')->with('success', 'Branch successfully updated.');
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
    public function destroy(Branch $branch)
    {
        if (Auth::user()->can('delete branch')) {
            if ($branch->created_by == Auth::user()->creatorId()) {
                $branch->delete();

                return redirect()->route('branches.index')->with('success', 'Branch successfully deleted.');
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
