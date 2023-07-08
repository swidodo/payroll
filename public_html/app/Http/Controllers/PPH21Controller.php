<?php

namespace App\Http\Controllers;

use App\Models\PTKP;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PPH21Controller extends Controller
{
    public function indexPTKP()
    {
        if (Auth::user()->can('manage ptkp')) {

            $ptkp = PTKP::where('created_by', '=', Auth::user()->creatorId())->orderBy('id', 'asc')->get();
            return view('pages.contents.payroll.pph21.ptkp', compact('ptkp'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function storeAndUpdatePTKP(Request $request)
    {
        if (Auth::user()->can('edit ptkp')) {
            try {
                DB::beginTransaction();

                if (isset($request->pph21)) {
                    foreach ($request->pph21 as $key => $value) {
                        foreach ($value as $key => $v) {
                            $ptkp = PTKP::where('status_name', $v['status'])->first();
                            if (!is_null($ptkp)) {
                                $ptkp->ptkp_amount = $v['amount'];
                                $ptkp->save();
                            } else {
                                PTKP::create([
                                    'status_name'   => $v['status'],
                                    'ptkp_amount'   => $v['amount'],
                                    'created_by'    => Auth::user()->creatorId()
                                ]);
                            }
                        }
                    }
                }

                DB::commit();
                toast('Successfully updated', 'success');
                return redirect()->route('setting.ptkp.index');
            } catch (Exception $e) {
                DB::rollBack();
                dd($e);
                toast('Something went wrong', 'error');
                return redirect()->route('setting.ptkp.index');
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('setting.ptkp.index');
        }
    }
}
