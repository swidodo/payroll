<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class ReportSalaryController extends Controller
{
    public function index(){
        return view('pages.contents.report.report_salary');
    }
    public function get_data(){
        $data = DB::table('data_salery')
                    ->select('*')
                    ->get();
          return DataTables::of($data)->make(true);
    }
}
