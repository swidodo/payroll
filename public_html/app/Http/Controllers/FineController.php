<?php

namespace App\Http\Controllers;

use App\Models\DayType;
use App\Models\Denda;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage denda')) {

            $dendas = Denda::where('created_by', '=', Auth::user()->creatorId())->get();

            return view('pages.contents.denda.index', compact('dendas'));
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
        if (Auth::user()->can('create denda')) {
            $dayTypes = DayType::where('created_by', '=', Auth::user()->creatorId())->get();


            return view('pages.contents.denda.create', compact('dayTypes'));
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
        if (Auth::user()->can('create denda')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'denda' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();

                if (isset($request->denda)) {
                    foreach ($request->denda as $key => $value) {
                        $value['created_by'] = Auth::user()->creatorId();
                        Denda::create($value);
                    }
                }

                DB::commit();
                toast('Denda successfully created', 'success');
                return redirect()->route('denda.index');
            } catch (Exception $e) {
                DB::rollBack();
                toast('Something went wrong', 'error');
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
        $denda = Denda::find($id);
        if (Auth::user()->can('delete denda')) {

            try {
                DB::beginTransaction();

                if (isset($denda)) {
                    $denda->delete();
                }

                DB::commit();
                toast('Successfully delete data', 'success');
                return redirect()->route('denda.index');
            } catch (Exception $e) {
                DB::rollBack();
                toast('Something went wrong', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
}
