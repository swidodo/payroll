<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Employee;
use App\Models\Payroll;
use App\Models\PayslipType;
use App\Models\SetBpjsTK;
use App\Models\Utility;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage payroll')) {
            if (Auth::user()->type != 'company') {
                $user     = Auth::user();
                $employee = Employee::where('user_id', '=', $user->id)->get();
                $payroll  = Payroll::where('employee_id', '=', $user->employee->id)->get();
                $payslipType = PayslipType::where('created_by', '=', Auth::user()->creatorId())->get();

                return view('pages.contents.payroll.index', compact('payroll', 'employee', 'payslipType'));
            } else {
                $payroll = Payroll::where('created_by', '=', Auth::user()->creatorId())->get();
                $employee  = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
                $payslipType = PayslipType::where('created_by', '=', Auth::user()->creatorId())->get();

                return view('pages.contents.payroll.index', compact('payroll', 'employee', 'payslipType'));
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
        if (Auth::user()->can('create payroll')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'payslip_type_id' => 'required',
                    'employee_id' => 'required',
                    'amount' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();

                $employee = Employee::where('id', '=', $request->employee_id)->first();

                $payroll    = new Payroll();
                if (Auth::user()->type == "employee") {
                    $payroll->employee_id = $employee->id;
                } else {
                    $payroll->employee_id = $request->employee_id;
                }
                $payroll->payslip_type_id    = $request->payslip_type_id;
                $payroll->amount       = $request->amount;
                $payroll->created_by       = Auth::user()->creatorId();


                $employee->salary       = $payroll->amount;
                $employee->salary_type  = isset($payroll->payslip_type) ? $payroll->payslip_type->name . ' (' . ucwords($payroll->payslip_type->type) . ')' : null;

                $payroll->save();
                $employee->save();

                // Utility::insertToRequest($payroll, Auth::user(), 'Payroll');

                DB::commit();
                toast('Payroll successfully created.', 'success');
                return redirect()->route('payroll.index');
            } catch (Exception $e) {
                DB::rollBack();
                toast('Something went wrong.' . $e, 'error');
                return redirect()->route('payroll.index');
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('payroll.index');
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
        if (Auth::user()->can('edit payroll')) {
            $payroll = Payroll::find($id);

            return response()->json($payroll);
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
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
        if (Auth::user()->can('edit payroll')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'payslip_type_id' => 'required',
                    'employee_id' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();
                $payroll = Payroll::find($id);

                if (is_null($payroll)) {
                    toast('Payroll not found.', 'error');
                    return redirect()->route('payroll.index');
                }

                $employee = Employee::where('id', '=', $request->employee_id)->first();


                $payroll->employee_id = $request->employee_id;
                $payroll->payslip_type_id    = $request->payslip_type_id;
                $payroll->amount       = $request->amount;
                $payroll->created_by       = Auth::user()->creatorId();


                $employee->salary       = $payroll->amount;
                $employee->salary_type  = isset($payroll->payslip_type) ? $payroll->payslip_type->name . ' (' . ucwords($payroll->payslip_type->type) . ')' : null;

                $payroll->save();
                $employee->save();

                DB::commit();
                toast('Payroll successfully created.', 'success');
                return redirect()->route('payroll.index');
            } catch (Exception $e) {
                DB::rollBack();
                toast('Something went wrong.', 'error');
                return redirect()->route('payroll.index');
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('payroll.index');
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
        $payroll = Payroll::find($id);
        if (Auth::user()->can('delete payroll')) {
            if ($payroll->created_by == Auth::user()->creatorId()) {

                $payroll->employee->net_salary -= $payroll->employee->salary;
                $payroll->employee->salary = null;
                $payroll->employee->salary_type = null;
                $payroll->employee->save();
                $payroll->delete();

                toast('Payroll successfully deleted.', 'success');
                return redirect()->route('payroll.index');
            } else {
                toast('Permission denied.', 'error');
                toast('Permission denied.', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function indexBpjsTk()
    {
        if (Auth::user()->can('manage bpjs kesehatan')) {
            $bpjs_tk = Utility::where('name', 'bpjs_tk')->first();

            $bpjs_tk_val = null;
            if (!is_null($bpjs_tk)) {
                $bpjs_tk_val = json_decode($bpjs_tk->value, true);
            }

            return view('pages.contents.payroll.bpjs-tk.index', compact('bpjs_tk_val'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function storeBpjsTk(Request $request)
    {
        if (Auth::user()->can('create bpjs kesehatan')) {

            try {
                DB::beginTransaction();
                $bpjs_tk = Utility::where('name', 'bpjs_tk')->first();

                if (is_null($bpjs_tk)) {
                    $data = ['type' => $request->type, 'value' => $request->number_value, 'maximum_salary' => $request->maximum_salary];
                    $encode = json_encode($data);

                    $utility  = new Utility();
                    $utility->name = 'bpjs_tk';
                    $utility->value = $encode;
                    $utility->created_by = Auth::user()->creatorId();
                    $utility->save();
                } else {
                    $data = ['type' => $request->type, 'value' => $request->number_value, 'maximum_salary' => $request->maximum_salary];
                    $encode = json_encode($data);
                    $bpjs_tk->value = $encode;
                    $bpjs_tk->save();
                }

                DB::commit();

                toast('Successfully saved', 'success');
                return redirect()->route('setting.bpjs-tk.index');
            } catch (Exception $th) {
                DB::rollBack();
                toast('Something went wrong', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function indexPph21()
    {
        if (Auth::user()->can('manage pph21')) {
            $pph21 = Utility::where('name', 'pph21')->first();

            $pph21_val = null;
            if (!is_null($pph21)) {
                $pph21_val = json_decode($pph21->value, true);
            }

            return view('pages.contents.payroll.pph21.index', compact('pph21_val'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function storePph21(Request $request)
    {
        if (Auth::user()->can('edit pph21')) {

            try {
                DB::beginTransaction();
                $bpjs_tk = Utility::where('name', 'pph21')->first();
                $is_paid_by_employee_themselve = Utility::where('name', 'is_paid_by_employee_themselve')->first();

                if (isset($request->is_paid_by_employee_themselve)) {
                    if ($request->is_paid_by_employee_themselve == 'on') {

                        if (is_null($is_paid_by_employee_themselve)) {
                            Utility::create([
                                'name' => 'is_paid_by_employee_themselve',
                                'value' => true,
                                'created_by' => Auth::user()->creatorId(),
                            ]);
                        } else {
                            $is_paid_by_employee_themselve->value = true;
                            $is_paid_by_employee_themselve->save();
                        }
                    }
                } else {
                    if (is_null($is_paid_by_employee_themselve)) {
                        Utility::create([
                            'name' => 'is_paid_by_employee_themselve',
                            'value' => false,
                            'created_by' => Auth::user()->creatorId(),
                        ]);
                    } else {
                        $is_paid_by_employee_themselve->value = false;
                        $is_paid_by_employee_themselve->save();
                    }
                }

                if (is_null($bpjs_tk)) {
                    if (isset($request->pph21)) {
                        foreach ($request->pph21 as $key => $value) {
                            if (!is_null($value['income']) && $value['percentage']) {
                                $arrays[] = ['income' => $value['income'], 'percentage' => $value['percentage']];
                            }
                        }
                    }



                    $values = json_encode($arrays);

                    $utility  = new Utility();
                    $utility->name = 'pph21';
                    $utility->value = $values;
                    $utility->created_by = Auth::user()->creatorId();
                    $utility->save();
                } else {
                    if (isset($request->pph21)) {
                        foreach ($request->pph21 as $key => $value) {
                            if (!is_null($value['income']) && $value['percentage']) {
                                $arrays[] = ['income' => $value['income'], 'percentage' => $value['percentage']];
                            }
                        }
                    }

                    $values = json_encode($arrays);

                    $bpjs_tk->value = $values;
                    $bpjs_tk->save();
                }

                DB::commit();

                toast('Successfully saved', 'success');
                return redirect()->route('setting.pph21.index');
            } catch (Exception $th) {
                DB::rollBack();
                toast('Something went wrong', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function indexJht()
    {
        if (Auth::user()->can('manage jht')) {
            $jht = Utility::where('name', 'jht')->first();

            $jht_val = null;
            if (!is_null($jht)) {
                $jht_val = json_decode($jht->value, true);
            }

            return view('pages.contents.payroll.jaminan-hari-tua.index', compact('jht_val'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function storeJht(Request $request)
    {
        if (Auth::user()->can('edit jht')) {
            try {
                DB::beginTransaction();
                $jht = Utility::where('name', 'jht')->first();

                if (is_null($jht)) {
                    $data = ['type' => $request->name_type, 'value' => $request->number_value];
                    $encode = json_encode($data);

                    $utility  = new Utility();
                    $utility->name = 'jht';
                    $utility->value = $encode;
                    $utility->created_by = Auth::user()->creatorId();
                    $utility->save();
                } else {
                    $data = ['type' => $request->name_type, 'value' => $request->number_value];
                    $encode = json_encode($data);
                    $jht->value = $encode;
                    $jht->save();
                }

                DB::commit();

                toast('Successfully saved', 'success');
                return redirect()->route('setting.jht.index');
            } catch (Exception $th) {
                DB::rollBack();
                toast('Something went wrong', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function indexJkk()
    {
        if (Auth::user()->can('manage jkk')) {
            $jkk = Utility::where('name', 'jkk')->first();

            $jkk_val = null;
            if (!is_null($jkk)) {
                $jkk_val = json_decode($jkk->value, true);
            }

            return view('pages.contents.payroll.jaminan-kecelakaan-kerja.index', compact('jkk_val'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function storeJkk(Request $request)
    {
        if (Auth::user()->can('edit jkk')) {

            try {
                DB::beginTransaction();
                $jkk = Utility::where('name', 'jkk')->first();

                if (is_null($jkk)) {
                    if (isset($request->jkk)) {
                        foreach ($request->jkk as $key => $value) {
                            if (!is_null($value['risk']) && $value['percentage']) {
                                $arrays[] = ['risk' => $value['risk'], 'percentage' => $value['percentage']];
                            }
                        }
                    }

                    $values = json_encode($arrays);

                    $utility  = new Utility();
                    $utility->name = 'jkk';
                    $utility->value = $values;
                    $utility->created_by = Auth::user()->creatorId();
                    $utility->save();
                } else {
                    if (isset($request->jkk)) {
                        foreach ($request->jkk as $key => $value) {
                            if (!is_null($value['risk']) && $value['percentage']) {
                                $arrays[] = ['risk' => $value['risk'], 'percentage' => $value['percentage']];
                            }
                        }
                    }

                    $values = json_encode($arrays);

                    $jkk->value = $values;
                    $jkk->save();
                }

                DB::commit();

                toast('Successfully saved', 'success');
                return redirect()->route('setting.jkk.index');
            } catch (Exception $th) {
                DB::rollBack();
                toast('Something went wrong', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function indexJkm()
    {
        if (Auth::user()->can('manage jkm')) {
            $jkm = Utility::where('name', 'jkm')->first();

            $jkm_val = null;
            if (!is_null($jkm)) {
                $jkm_val = json_decode($jkm->value, true);
            }

            return view('pages.contents.payroll.jaminan-kematian.index', compact('jkm_val'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function storeJkm(Request $request)
    {
        if (Auth::user()->can('edit jkm')) {
            try {
                DB::beginTransaction();
                $jkm = Utility::where('name', 'jkm')->first();

                if (is_null($jkm)) {
                    $data = ['type' => $request->type, 'value' => $request->number_value];
                    $encode = json_encode($data);

                    $utility  = new Utility();
                    $utility->name = 'jkm';
                    $utility->value = $encode;
                    $utility->created_by = Auth::user()->creatorId();
                    $utility->save();
                } else {
                    $data = ['type' => $request->type, 'value' => $request->number_value];
                    $encode = json_encode($data);
                    $jkm->value = $encode;
                    $jkm->save();
                }

                DB::commit();

                toast('Successfully saved', 'success');
                return redirect()->route('setting.jkm.index');
            } catch (Exception $th) {
                DB::rollBack();
                toast('Something went wrong', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function indexJp()
    {
        if (Auth::user()->can('manage jp')) {
            $jp = Utility::where('name', 'jp')->first();

            $jp_val = null;
            if (!is_null($jp)) {
                $jp_val = json_decode($jp->value, true);
            }

            return view('pages.contents.payroll.jaminan-pensiun.index', compact('jp_val'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    // jika pensiun
    public function storeJp(Request $request)
    {
        if (Auth::user()->can('edit jp')) {
            try {
                DB::beginTransaction();
                $jp = Utility::where('name', 'jp')->first();

                if (is_null($jp)) {
                    $data = ['type' => $request->name_type, 'value' => $request->number_value, 'maximum_limit_value' => $request->maximum_limit_value];
                    $encode = json_encode($data);

                    $utility  = new Utility();
                    $utility->name = 'jp';
                    $utility->value = $encode;
                    $utility->created_by = Auth::user()->creatorId();
                    $utility->save();
                } else {
                    $data = ['type' => $request->name_type, 'value' => $request->number_value, 'maximum_limit_value' => $request->maximum_limit_value];
                    $encode = json_encode($data);
                    $jp->value = $encode;
                    $jp->save();
                }

                DB::commit();

                toast('Successfully saved', 'success');
                return redirect()->route('setting.jp.index');
            } catch (Exception $th) {
                DB::rollBack();
                toast('Something went wrong', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function indexSetBpjsTk()
    {
        $datas = SetBpjsTK::where('created_by', Auth::user()->creatorId())->get();
        $employees = Employee::where('created_by', Auth::user()->creatorId())->get();
        // $bpjstk = new Collection();

        // foreach ($user->bpjstk as $tk) {
        //     $bpjstk = $bpjstk->merge($tk->bpjstk_name);
        // }
        // $bpjstk = $bpjstk->pluck('name', 'id')->toArray();
        // dd($datas);

        return view('pages.contents.set-bpjstk.index', compact('datas', 'employees'));
    }
    public function storeSetBpjsTk(Request $request)
    {
        try {
            DB::beginTransaction();

            if (isset($request->bpjstk)) {
                foreach ($request->bpjstk as $key => $value) {
                    $arrays[] =
                        $value;
                }
            }

            $values = json_encode($arrays);

            $set  = new SetBpjsTK();
            $set->employee_id = $request->employee_id;
            $set->bpjstk_name = $values;
            $set->created_by = Auth::user()->creatorId();
            $set->save();
            DB::commit();

            toast('Successfully saved', 'success');
            return redirect()->route('set-bpjstk.index');
        } catch (Exception $th) {
            DB::rollBack();
            toast('Something went wrong', 'error');
            return redirect()->back();
        }
    }

    public function editSetBpjsTk($id)
    {
        $bpjstk = SetBpjsTK::find($id);
        $decode = json_decode($bpjstk->bpjstk_name, true);

        return response()->json([
            'id' => $bpjstk->id,
            'employee_id' => $bpjstk->employee_id,
            'val_bpjstk'  => $decode
        ]);
    }

    public function updateSetBpjsTk(Request $request, $id)
    {
        $model = SetBpjsTK::find($id);
        try {
            DB::beginTransaction();
            if (isset($request->bpjstk)) {
                foreach ($request->bpjstk as $key => $value) {
                    $arrays[] =
                        $value;
                }
            }

            $values = json_encode($arrays);

            $model->employee_id = $request->employee_id;
            $model->bpjstk_name = $values;
            $model->save();
            DB::commit();

            toast('Successfully updated.', 'success');
            return redirect()->route('set-bpjstk.index');
        } catch (Exception $e) {
            DB::rollBack();
            toast('Failure occurred.', 'error');
            return redirect()->back();
        }
    }

    public function destroySetBpjstk($id)
    {
        $model = SetBpjsTK::find($id);
        $model->delete();

        toast('Successfully deleted.', 'success');
        return redirect()->route('set-bpjstk.index');
    }
}
