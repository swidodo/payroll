<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\PerformanceReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PerformanceReviewController extends Controller
{
    public function index()
    {
        if (Auth::user()->can('manage performance review')) {
            $user = Auth::user();
            if ($user->type == 'employee') {
                $employee   = Employee::where('user_id', $user->id)->first();
                // $competencyCount = Competencies::where('created_by', '=', $user->creatorId())->count();
                // $appraisals = Appraisal::where('created_by', '=', \Auth::user()->creatorId())->where('branch', $employee->branch_id)->where('employee', $employee->id)->get();
            } else {
                // $competencyCount = Competencies::where('created_by', '=', $user->creatorId())->count();
                $performanceReviews = PerformanceReview::where('created_by', '=', Auth::user()->creatorId())->get();
            }
            return view('pages.contents.performance-review.index', compact('performanceReviews'));
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
        if (Auth::user()->can('create performance review')) {
            $employees = Employee::where('created_by', Auth::user()->creatorId())->get();
            return view('pages.contents.performance-review.create', compact('employees'));
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

        if (Auth::user()->can('create performance review')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'employee_id' => 'required',
                    'knowledge' => 'required',
                    'skill' => 'required',
                    'accuracy' => 'required',
                    'quality' => 'required',
                    'care' => 'required',
                    'reliability' => 'required',
                    'working_method' => 'required',
                    'flexibility' => 'required',
                    'initiative' => 'required',
                    'cooperation' => 'required',
                    'attendance' => 'required',
                    'organizational_commitment' => 'required',
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            $kpiScore = ($request->knowledge + $request->skill + $request->accuracy + $request->quality + $request->care + $request->reliability + $request->working_method + $request->flexibility + $request->initiative + $request->cooperation + $request->attendance + $request->organizational_commitment) / 12;
            $request['created_by']  = Auth::user()->creatorId();
            $request['kpi_total_score']  = $kpiScore;

            PerformanceReview::create($request->all());

            return redirect()->route('performance-review.index')->with('success', 'Performance Review successfully created.');
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
        if (Auth::user()->can('edit performance review')) {
            $performanceReview = PerformanceReview::where('created_by', Auth::user()->creatorId())->where('id', $id)->first();
            $employees         = Employee::where('created_by', Auth::user()->creatorId())->get();
            return view('pages.contents.performance-review.edit', compact('performanceReview', 'employees'));
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
        if (Auth::user()->can('edit performance review')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'employee_id' => 'required',
                    'knowledge' => 'required',
                    'skill' => 'required',
                    'accuracy' => 'required',
                    'quality' => 'required',
                    'care' => 'required',
                    'reliability' => 'required',
                    'working_method' => 'required',
                    'flexibility' => 'required',
                    'initiative' => 'required',
                    'cooperation' => 'required',
                    'attendance' => 'required',
                    'organizational_commitment' => 'required',
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            $kpiScore = ($request->knowledge + $request->skill + $request->accuracy + $request->quality + $request->care + $request->reliability + $request->working_method + $request->flexibility + $request->initiative + $request->cooperation + $request->attendance + $request->organizational_commitment) / 12;
            $request['created_by']  = Auth::user()->creatorId();
            $request['kpi_total_score']  = $kpiScore;

            $performanceReview = PerformanceReview::where('employee_id', $request->employee_id)->first();

            if ($performanceReview->created_by == Auth::user()->creatorId()) {
                $performanceReview->update($request->all());
                return redirect()->route('performance-review.index')->with('success', 'Performance Review successfully updated.');
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
        $performanceReview = PerformanceReview::where('created_by', Auth::user()->creatorId())->where('id', $id)->first();
        if (Auth::user()->can('delete performance review')) {
            if ($performanceReview->created_by == Auth::user()->creatorId()) {
                $performanceReview->delete();

                return redirect()->route('performance-review.index')->with('success', 'Performance Review successfully deleted.');
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
