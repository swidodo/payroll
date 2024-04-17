<?php

namespace App\Http\Controllers\Report;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\AccessBranch;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DailyReportExport;

class RekapDailyReportController extends Controller
{
    public function ExportExcel(Request $request){
        $date = date('Ymd');
        $fileName = 'daily-report_'.$date.'.xlsx';
        return Excel::download(new DailyReportExport($request), $fileName);
    }
    
}
