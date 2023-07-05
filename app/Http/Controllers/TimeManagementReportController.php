<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceEmployeeExport;
use App\Exports\LeaveExport;
use App\Exports\OvertimeExport;
use App\Exports\TimesheetExport;
use App\Exports\TravelExport;
use App\Models\AttendanceEmployee;
use App\Models\Leave;
use App\Models\Overtime;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TimeManagementReportController extends Controller
{
    public function index()
    {
        return view('pages.contents.time-management.report.index');
    }

    public function exportPdf(Request $request)
    {
        if ($request->menu == 'leaves') {
            return Excel::download(new LeaveExport($request), 'Leave Report.xlsx');

        } elseif ($request->menu == 'overtimes') {
            // $overtimes = Overtime::where('created_by', Auth::user()->creatorId())->whereBetween('created_at', [$request->start_date, $request->end_date])->get();
            // $pdf = Pdf::loadview('pages.contents.time-management.report.overtimes', [
            //     'overtimes' => $overtimes,
            // ]);

            return Excel::download(new OvertimeExport($request), 'Overtime Report.xlsx');

        } elseif ($request->menu == 'attendances') {
            return Excel::download(new AttendanceEmployeeExport($request), 'Attendance Report.xlsx');

        }elseif($request->menu == 'on-duty')
        {
            return Excel::download(new TravelExport($request), 'On Duty Report.xlsx');
        }elseif($request->menu == 'timesheet')
        {
            return Excel::download(new TimesheetExport($request), 'Timesheet Report.xlsx');
        }

        // return $pdf->download('report.pdf');

        // dd($leaves, $overtimes, $attendances);
        // return view('pages.contents.time-management.report.export-template', compact('leaves', 'overtimes', 'attendances'));
    }
}
