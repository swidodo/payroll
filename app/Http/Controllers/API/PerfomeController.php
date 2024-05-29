<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\PerformanceReview;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PerfomeController extends Controller
{
    public function index(){
        $data = PerformanceReview::where('employee_id', '=', Auth::user()->employee->id)->get();
        if(count($data) > 0) {
           $res = [
                'status' => Response::HTTP_OK,
                'result' => [
                    'employee_id' => Auth::user()->employee->no_employee,
                    'employee_name' => Auth::user()->employee->name,
                    'kpi'=> $data[0]->kpi_total_score
                ],
            ];
        }else{
            $res = [
                'status' => Response::HTTP_OK,
                'message' => "You don't have KPI",
            ];
        }
        return response()->json($res,Response::HTTP_OK);
    }
  
}
