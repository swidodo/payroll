<?php

namespace App\Http\Controllers;

use App\Models\AttendanceEmployee;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\HistoryLeave;
use App\Models\Leave;
use App\Models\LeaveApproval;
use App\Models\LeaveType;
use App\Models\LevelApproval;
use App\Models\Overtime;
use App\Models\Utility;
use Carbon\Carbon;
use DataTables;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HistoryLeaveController extends Controller
{
    public function index()
    {
        if (Auth::user()->can('manage leave')) {
            $user = Auth::user();
            $branch = Branch::find($user->branch_id);
            if ( $user->initial == 'HO'){
                $dataLeaveHistory['branch'] = Branch::select('*')->where('company_id',$branch->company_id)->get();
            }else{
                $dataLeaveHistory['branch'] =  Branch::select('*')->where('id',$user->branch_id)->get();
                $dataLeaveHistory['employee'] = Employee::select('id','name')->where('branch_id',$user->branch_id)->groupBy('id')->get();
            }
            return view('pages.contents.time-management.history-leave.index',$dataLeaveHistory);
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('dashboard');
        }

    }
    public function get_data(Request $request){

        $data = DB::table('history_leaves')
                    ->select('history_leaves.*','employees.name','employees.no_employee','leave_types.title')
                    ->leftJoin('leave_types','leave_types.id','=','history_leaves.leave_type_id')
                    ->leftJoin('employees','employees.id','=','history_leaves.employee_id')
                    ->where('employees.branch_id',$request->branch_id);
                    if ($request->employee_id !=""){
                    $data->where('employees.id',$request->employee_id);
                    }
                    $data->orderBy('history_leaves.id','DESC')
                            ->get();
        return Datatables::of($data)->make(true);
    }
}
