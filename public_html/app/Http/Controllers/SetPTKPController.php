<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\SetPTKP;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SetPTKPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage set ptkp')) {

            $set_ptkp = SetPTKP::where('created_by', '=', Auth::user()->creatorId())->orderBy('id', 'asc')->get();
            $employees = Employee::where('created_by', Auth::user()->creatorId())->get();

            return view('pages.contents.set-ptkp.index', compact('set_ptkp', 'employees'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
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
        $validator = Validator::make(
            $request->all(),
            [
                'employee_id' => 'required|not_in:0,null',
            ]
        );

        if ($validator->fails()) {
            if ($validator->errors()->has('employee_id')) {
                toast('Please select employee', 'error');
                return redirect()->back();
            }
        }

        try {
            DB::beginTransaction();

            if (isset($request->ptkp)) {
                foreach ($request->ptkp as $key => $value) {
                    $arrays[] =
                        $value;
                }
            }

            $values = json_encode($arrays);

            $set  = new SetPTKP();
            $set->employee_id = $request->employee_id;
            $set->ptkp_name = $values;
            $set->created_by = Auth::user()->creatorId();
            $set->save();

            DB::commit();
            toast('Successfully saved', 'success');
            return redirect()->route('set-ptkp.index');
        } catch (Exception $th) {
            DB::rollBack();
            dd($th);
            toast('Something went wrong', 'error');
            return redirect()->route('set-ptkp.index');
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
        $ptkp = SetPTKP::find($id);
        $decode = json_decode($ptkp->ptkp_name, true);

        return response()->json([
            'id' => $ptkp->id,
            'employee_id' => $ptkp->employee_id,
            'val_ptkp'  => $decode
        ]);
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
        $model = SetPTKP::find($id);
        try {
            DB::beginTransaction();
            if (isset($request->ptkp)) {
                foreach ($request->ptkp as $key => $value) {
                    $arrays[] =
                        $value;
                }
            }

            $values = json_encode($arrays);

            $model->employee_id = $request->employee_id;
            $model->ptkp_name = $values;
            $model->save();
            DB::commit();

            toast('Successfully updated.', 'success');
            return redirect()->route('set-ptkp.index');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            toast('Failure occurred.', 'error');
            return redirect()->route('set-ptkp.index');
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
        $model = SetPTKP::find($id);
        $model->delete();

        toast('Successfully deleted.', 'success');
        return redirect()->route('set-ptkp.index');
    }
}
