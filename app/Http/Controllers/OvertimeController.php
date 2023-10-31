<?php

namespace App\Http\Controllers;

use App\Models\DayType;
use App\Models\Employee;
use App\Models\LevelApproval;
use App\Models\Overtime;
use App\Models\OvertimeApproval;
use App\Models\OvertimeType;
use App\Models\Utility;
use App\Models\Branch;
use App\Models\AllowanceFinance;
use Carbon\Carbon;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OvertimeController extends Controller
{
    public function break_time($hourTime){
        $jmlhour = $hourTime;
        $break = 0;
        if ($jmlhour <= 4){
            $break = 0;
        }
        if ($jmlhour > 4 && $jmlhour < 8 )
        {
            $break = 1;
        }
        if ($jmlhour >= 8){
        $over = [];
        for ($x=1; $x <= $jmlhour; $x++){
            if ( $x % 4 == 0 ){
            array_push($over,$x);
            }
        }
        $break = count($over) - 1;
        }
        return $break;
    }
    public function timeTot_61($Tottime,$type_overtime){
        if ($type_overtime == "Saturday"){
            if ( $Tottime <= 5 ) {
                $hour1 = $Tottime * 2;
                $sisa = 0;
            }
            if ($Tottime > 5) {
                $hour1 = 5 * 2;
                $sisa = $Tottime - 5;
            }
            $hour2 = 0;
            $hour3 = 0;
            if ($sisa > 0 && $sisa == 1){
                $hour2 = $sisa * 3;
            }
            if ($sisa > 0 && $sisa > 1){
                $hour2 = 1 * 3;
                $hour3 = ($sisa - 1) * 4;
            }
            $hour = $hour1 + $hour2 + $hour3 ;
            return $hour;
        }else{
            if ( $Tottime <= 7 ) {
                $hour1 = $Tottime * 2;
                $sisa = 0;
            }
            if ($Tottime > 7) {
                $hour1 = 7 * 2;
                $sisa = $Tottime - 7;
            }
            $hour2 = 0;
            $hour3 = 0;
            if ($sisa > 0 && $sisa == 1){
                $hour2 = $sisa * 3;
            }
            if ($sisa > 0 && $sisa > 1){
                $hour2 = 1 * 3;
                $hour3 = ($sisa - 1) * 4;
            }
            $hour = $hour1 + $hour2 + $hour3 ;
            return $hour;
        }
    }
    public function timeTot_52($Tottime){
        // 8 jam pertama * 2
        if ( $Tottime <= 8 ) {
            $hour1 = $Tottime * 2;
            $sisa = 0;
        }
        if ($Tottime > 8) {
            $hour1 = 8 * 2;
            $sisa = $Tottime - 8;
        }
        $hour2 = 0;
        $hour3 = 0;
        if ($sisa > 0 && $sisa == 1){
            $hour2 = $sisa * 3;
        }
        if ($sisa > 0 && $sisa > 1){
            $hour2 = 1 * 3;
            $hour3 = ($sisa - 1) * 4;
        }
        $hour = $hour1 + $hour2 + $hour3 ;
       return $hour;
    }

    public function timeTot_weekday($Totover){
        $fisrttime  = 1.5 * 1;
        $Tottime    =  $Totover - 1;
        $sisa = $Tottime * 2;
        $hour = $fisrttime + $sisa ;
        return $hour;
    }

    public function total_allowance($employee_id){
        $allowance = AllowanceFinance::select(DB::raw('sum(amount) as total_allowance'))
                                     ->leftJoin('allowance_options','allowance_options.id','=','allowance_type_id')
                                     ->where('employee_id','=',$employee_id)
                                     ->where('allowance_options.pay_type','=','fixed')
                                     ->first();
        if ($allowance !=null ){
            $total = $allowance->total_allowance;
        }else{
            $total = 0;
        }
        return  $total;
    }
    public function index()
    {
        if (Auth::user()->can('manage overtime')) {
            $branch = Branch::where('id',Auth::user()->branch_id)->first();
            if (Auth::user()->initial == 'HO'){
                $data['branch']     = Branch::Where('company_id','=',$branch->company_id)->get();
                $data['dayTypes']   = DayType::select('day_types.id','day_types.name')
                                                ->get();
                $data['date']       = date('Y-m-d');
                return view('pages.contents.time-management.overtime.index',$data );
            }else{
                $data['branch']     = Branch::Where('id','=',$branch->id)->get();
                $data['dayTypes']   = DayType::select('day_types.id','day_types.name')
                                                ->leftJoin('branches','branches.id','=','day_types.branch_id')
                                                ->where('branches.company_id',$branch->company_id)->get();
                $data['date']       = date('Y-m-d');
                return view('pages.contents.time-management.overtime.index',$data );
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('dashboard');
        }
    }
    public function get_employee(Request $request){
        $branch = Branch::where('id',$request->branch_id)->first();
        $data['employee'] = Employee::where('branch_id',$branch->id)->get();
        return response()->json($data);
    }
    public function get_data(Request $request){
        $defaultDate = date('m');
        $data = DB::table('overtimes')
                    ->select('overtimes.id',
                            'employees.no_employee',
                            'employees.name',
                            'overtimes.overtime_type',
                            'overtimes.start_date',
                            'overtimes.start_time',
                            'day_types.name as day_name',
                            'overtimes.end_time',
                            'overtimes.duration',
                            'overtimes.nominal_per_hour',
                            'overtimes.amount_fee',
                            'overtimes.status',
                            'overtimes.multiplier',
                            'overtimes.notes')
                    ->leftJoin('employees','employees.id','=','overtimes.employee_id')
                    ->leftJoin('day_types','day_types.id','=','overtimes.day_type_id')
                    ->where('employees.branch_id','=',$request->branch_id);
                    if ($request->date !=""){
                        $data->where('overtimes.start_date','=',$request->date);
                    }else{
                        $data->where(DB::raw("TO_CHAR(overtimes.start_date,'MM')"),'=',$defaultDate);
                    }
                    $data->orderBy('employees.name','ASC');
                    $data->get();
        return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                    $btn ='';
                    if(Auth()->user()->canany('edit overtime','delete overtime')){
                        $btn .= '<div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">';
                                    if(Auth()->user()->can('edit overtime')){
                                        $btn .= '<a  data-id="'.$row->id.'" class="dropdown-item edit-overtime" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_overtime"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                    }
                                    if(Auth()->user()->can('delete overtime')){
                                        $btn .= '<a id="delete-overtime" data-url="'.route('overtimes.destroy', $row->id).'" class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_overtime"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                    }
                        $btn .= '</div></div>';
                    }
                    return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function store(Request $request)
    {
        if (isset($request->unnormal_overtime)){
            $data =[
                'employee_id'        => $request->employee_id,
                'overtime_type'      => $request->unnormal_overtime,
                'day_type_id'        => $request->day_type_id,
                'start_date'         => $request->start_date,
                'nominal_per_hour'   => $request->nominal,
                'amount_fee'         => $request->total_nominal ,
                'status'             => 'approve',
                'duration'           => $request->duration_overtime,
                'start_time'         => $request->start_time,
                'end_time'           => $request->end_time,
                'branch_id'          => $request->branch_id,
                'multiplier'         => $request->multiplier,
                'created_by'         => Auth::user()->id
            ];
           $insert = Overtime::create($data);
           if ($insert){
                $res = [
                    'status' =>'success',
                    'msg' =>'Created Data Overtime successfully !'
                ];
           }else{
                $res = [
                    'status' =>'error',
                    'msg' =>'Sameting went wrong !'
                ];
           }
           return response()->json($res);
        }else{
            try {
                $employee       = Employee::select('employees.*','payrolls.amount as salary')
                                ->leftJoin('payrolls','payrolls.employee_id','employees.id')
                                ->where('employees.id', $request->employee_id)
                                ->where('employees.branch_id', $request->branch_id)
                                ->first();
                $dayType        = DayType::where('id', $request->day_type_id)->first();
                $diffInHour     = Carbon::parse($request->end_time)->diffInHours(Carbon::parse($request->start_time));
                $typeCompany = 'default';

                if ($typeCompany=='default'){
                    // overtime calculation
                    // ini belum untuk pengurangan tanggal dan waktu
                    $overTimes = (int)$diffInHour - (int)$this->break_time($diffInHour);
                    if ($employee->work_type == "52" && $dayType->name =="Week Day"){
                        $tot_Overtime = $this->timeTot_weekday($overTimes);
                    }
                    if ($employee->work_type == "61" && $dayType->name =="Week Day"){
                        $tot_Overtime = $this->timeTot_weekday($overTimes);
                    }
                    if ($employee->work_type == "61" && $dayType->name =="Saturday"){
                        $tot_Overtime = $this->timeTot_61($overTimes,$dayType->name);
                    }
                    if ($employee->work_type == "61" && $dayType->name =="Holiday"){
                        $tot_Overtime = $this->timeTot_61($overTimes,$dayType->name);
                    }
                    if ($employee->work_type == "52" && $dayType->name =="Holiday"){
                        $tot_Overtime = $this->timeTot_52($overTimes);
                    }
                    $totFixedAllowance = $this->total_allowance($employee->id);

                    if (!is_null($employee->salary)) {
                        $overtimePayPerHour     = round(($employee->salary + $totFixedAllowance) /173);
                        $amount_fee             = round($tot_Overtime * $overtimePayPerHour);
                         $data = [
                            'employee_id'        => $employee->id,
                            'branch_id'          => $request->branch_id,
                            'overtime_type_id'   => 0,
                            'overtime_type'      => "normatif",
                            'day_type_id'        => $dayType->id,
                            'start_date'         => $request->start_date,
                            'amount_fee'         => $amount_fee ,
                            'status'             => 'approve',
                            'nominal_per_hour'   => 0,
                            'duration'           => $overTimes,
                            'start_time'         => $request->start_time,
                            'end_time'           => $request->end_time,
                            'created_by'         => Auth::user()->id
                        ];
                        $insert = Overtime::create($data);
                        if ($insert){
                            $res = [
                                'status' => 'success',
                                'msg'    =>'Created Data Overtime successfully !'
                            ];
                        }else{
                            $res = [
                                'status' => 'error',
                                'msg'    =>'Sameting went wrong !'
                            ];
                        }
                        return response()->json($res);
                    } else {
                        $res = [
                                'status' => 'info',
                                'msg'    => 'Please set employee salary.!'
                            ];
                        return response()->json($res);
                    }
                }
            }
            catch(Exception $e){
                $res = [
                        'status' => 'error',
                        'msg'    => 'Someting went wrong.!'
                    ];
                return response()->json($res);
            }
        }
       
    }

    public function show($id)
    {
        $overtime = Overtime::find($id);
        $fileType = null;

        if (!is_null($overtime->attachment_reject)) {
            $fileType = Utility::getFileType($overtime->attachment_reject);
        }

        return view('pages.contents.time-management.overtime.detail-rejected', compact('overtime', 'fileType'));
    }

    public function edit(Request $request)
    {
        if (Auth::user()->can('edit overtime')) {
            $branch = Branch::where('id',Auth::user()->branch_id)->first();
            $data['data']       = Overtime::where('id',$request->id)->with('employee')->first();
            $data['dayTypes']   = DayType::select('day_types.id','day_types.name')
                                                ->leftJoin('branches','branches.id','=','day_types.branch_id')
                                                ->where('branches.company_id',$branch->company_id)->get();
            return response()->json($data);
           
        } else {
            return response()->json(['error' => 'Permission denied.'], 401);
        }
    }


    public function update(Request $request)
    {
        if (isset($request->unnormal_overtime)){
            $data =[
                'employee_id'        => $request->employee_id,
                'overtime_type'      => $request->unnormal_overtime,
                'day_type_id'        => $request->day_type_id,
                'start_date'         => $request->start_date,
                'nominal_per_hour'   => $request->nominal,
                'amount_fee'         => $request->total_nominal ,
                'status'             => 'approve',
                'duration'           => $request->duration_overtime,
                'start_time'         => $request->start_time,
                'end_time'           => $request->end_time,
                'branch_id'           => $request->branch_id,
                'multiplier'         => $request->multiplier,
                'updated_at'          => date('Y-m-d h:m:s'),
            ];
            // dd($data);
           $update = Overtime::where('id',$request->id)->update($data);
           if ($update){
                $res = [
                    'status' =>'success',
                    'msg' =>'Update Data Overtime successfully !'
                ];
           }else{
                $res = [
                    'status' =>'error',
                    'msg' =>'Sameting went wrong !'
                ];
           }
           return response()->json($res);
        }else{
            try {
                $employee       = Employee::select('employees.*','payrolls.amount as salary')
                                ->leftJoin('payrolls','payrolls.employee_id','employees.id')
                                ->where('employees.id', $request->employee_id)
                                ->where('employees.branch_id', $request->branch_id)
                                ->first();
                $dayType        = DayType::where('id', $request->day_type_id)->first();
                $diffInHour     = Carbon::parse($request->end_time)->diffInHours(Carbon::parse($request->start_time));
                $typeCompany = 'default';

                if ($typeCompany=='default'){
                    // overtime calculation
                    // ini belum untuk pengurangan tanggal dan waktu
                    $overTimes = (int)$diffInHour - (int)$this->break_time($diffInHour);
                    if ($employee->work_type == "52" && $dayType->name =="Week Day"){
                        $tot_Overtime = $this->timeTot_weekday($overTimes);
                    }
                    if ($employee->work_type == "61" && $dayType->name =="Week Day"){
                        $tot_Overtime = $this->timeTot_weekday($overTimes);
                    }
                    if ($employee->work_type == "61" && $dayType->name =="Saturday"){
                        $tot_Overtime = $this->timeTot_61($overTimes,$dayType->name);
                    }
                    if ($employee->work_type == "61" && $dayType->name =="Holiday"){
                        $tot_Overtime = $this->timeTot_61($overTimes,$dayType->name);
                    }
                    if ($employee->work_type == "52" && $dayType->name =="Holiday"){
                        $tot_Overtime = $this->timeTot_52($overTimes);
                    }
                    $totFixedAllowance = $this->total_allowance($employee->id);

                    $overtimePayPerHour     = round(($employee->salary + $totFixedAllowance) /173);
                    $amount_fee             = round($tot_Overtime * $overtimePayPerHour);
                     $data = [
                        'employee_id'        => $employee->id,
                        'branch_id'          => $request->branch_id,
                        'overtime_type_id'   => 0,
                        'overtime_type'      => "normatif",
                        'day_type_id'        => $dayType->id,
                        'start_date'         => $request->start_date,
                        'amount_fee'         => $amount_fee ,
                        'status'             => 'approve',
                        'nominal_per_hour'   => 0,
                        'duration'           => $overTimes,
                        'start_time'         => $request->start_time,
                        'end_time'           => $request->end_time,
                        'updated_at'          => date('Y-m-d h:m:s'),
                    ];
                    $insert = Overtime::where('id',$request->id)->update($data);
                    if ($insert){
                        $res = [
                            'status' => 'success',
                            'msg'    =>'Update Data Overtime successfully !'
                        ];
                    }else{
                        $res = [
                            'status' => 'error',
                            'msg'    =>'Sameting went wrong !'
                        ];
                    }
                    return response()->json($res);
                }
            }
            catch(Exception $e){
                $res = [
                        'status' => 'error',
                        'msg'    => 'Someting went wrong.!'
                    ];
                return response()->json($res);
            }
        }
    }

  
    public function destroy($id)
    {
        $overtime = Overtime::find($id);
        if (Auth::user()->can('delete overtime')) {
            if ($overtime->created_by == Auth::user()->creatorId()) {

                if ($overtime->attachment_reject != null) {
                    $fileNameAttReject = explode('/', $overtime->attachment_reject);
                    if (Storage::exists('public/' . $fileNameAttReject[1])) {
                        Storage::delete('public/' . $fileNameAttReject[1]);
                    }
                }

                $overtime->delete();

                toast('Overtime successfully deleted.', 'success');
                return redirect()->route('overtimes.index');
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
}
