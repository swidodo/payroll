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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                                                ->leftJoin('branches','branches.id','=','day_types.branch_id')
                                                ->where('branches.company_id',$branch->company_id)->get();
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
                            'overtimes.start_date',
                            'overtimes.start_time',
                            'day_types.name as day_name',
                            'overtimes.end_time',
                            'overtimes.duration',
                            'overtimes.amount_fee',
                            'overtimes.status',
                            'overtimes.notes')
                    ->leftJoin('employees','employees.id','=','overtimes.employee_id')
                    ->leftJoin('day_types','day_types.id','=','overtimes.day_type_id')
                    ->where('employees.branch_id','=',$request->branch_id);
                    if ($request->date !=""){
                        $data->where('overtimes.start_date','=',$request->date);
                    }else{
                        $data->where(DB::raw("TO_CHAR(overtimes.start_date,'MM')"),'=',$defaultDate);
                    }
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
        // try {
                // DB::beginTransaction();
                $employee       = Employee::where('id', $request->employee_id)->where('created_by', Auth::user()->creatorId())->first();
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
                         Overtime::create([
                            'employee_id'        => $employee->id,
                            'overtime_type_id'   => 0,
                            'day_type_id'        => $dayType->id,
                            'start_date'         => $request->start_date,
                            'amount_fee'         => $amount_fee ,
                            'status'             => 'Pending',
                            'duration'           => $overTimes,
                            'start_time'         => $request->start_time,
                            'end_time'           => $request->end_time,
                        ]);
                        toast('Data success inserted !.', 'success');
                        return redirect()->back();

                    } else {
                        toast('Please set employee salary.', 'warning');
                        return redirect()->back();
                    }
                }else{

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


    public function update(Request $request, $id)
    {
        if (Auth::user()->can('edit overtime')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'employee_id' => 'required',
                    'overtime_type_id' => 'required',
                    'day_type_id' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'start_time' => 'required',
                    'end_time' => 'required',
                    'status' => 'required',
                    // 'duration' => 'required',
                    // 'notes' => 'required',
                ]
            );


            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();

                $overtime                   =  Overtime::find($id);

                if ($request->file()) {
                    $fileName = time() . '_' . $request->file('attachment_reject')->getClientOriginalName();
                    $filePath = $request->file('attachment_reject')->storeAs('public', $fileName);
                    $overtime->attachment_reject =  'storage/' . $fileName ?? null;
                }

                // fee
                $employee       = Employee::where('id', $request->employee_id)->where('created_by', Auth::user()->creatorId())->first();
                $dayType       = DayType::where('id', $request->day_type_id)->first();
                $duration       = strtotime($request->end_time) - strtotime($request->start_time);
                $durationToTime =  gmdate('H:i:s', $duration);
                $diffInHour     = Carbon::parse($request->end_time)->diffInHours(Carbon::parse($request->start_time));
                $diffInDay     = Carbon::parse($request->end_date)->diffInDays(Carbon::parse($request->start_date));
                $request['duration'] = $durationToTime;

                if (!is_null($employee->basic_salary)) {
                    $overtimePayPerHour    = 1 / 173 * $employee->basic_salary->amount;
                    if ($diffInHour == 1) {
                        $pay = 1.5 * floor($overtimePayPerHour);
                    } elseif ($diffInHour > 1) {
                        $pay = 0;
                        for ($i = 0; $i < $diffInHour; $i++) {
                            if ($i == 0) {
                                $pay += 1.5 * floor($overtimePayPerHour);
                            } else {
                                $pay += 2 * floor($overtimePayPerHour);
                            }
                        }
                    }
                    $request['amount_fee'] = $diffInDay > 0 ? $pay * $diffInDay : 0;
                    $overtime->amount_fee       = $request['amount_fee'];
                } else {
                    toast('Please set employee salary.', 'warning');
                    return redirect()->back();
                }

                $overtime->employee_id      = $request->employee_id;
                $overtime->overtime_type_id = $request->overtime_type_id;
                $overtime->day_type_id      = $request->day_type_id;
                $overtime->start_date       = $request->start_date;
                $overtime->end_date         = $request->end_date;
                $overtime->start_time       = $request->start_time;
                $overtime->end_time         = $request->end_time;
                $overtime->duration         = $request['duration'];
                $overtime->notes            = $request->notes;
                $overtime->rejected_reason  =  $request->rejected_reason ?? null;
                $overtime->created_by       = Auth::user()->creatorId();
                $overtime->save();

                // 3 Tier Approval
                if (isset($request->status) && $request->status != 0 && isset($request->level_approve) && $overtime->status != 'Rejected') {
                    $overtimeApprove = OvertimeApproval::where('overtime_id', $overtime->id)
                        ->where('level', $request->level_approve)
                        ->where('status', 'Pending')
                        ->first();


                    if (!is_null($overtimeApprove)) {
                        //check if employee can be a approver
                        $employee = Employee::find($overtimeApprove->approver_id);
                        $level = null;
                        if ($employee) {
                            $level = LevelApproval::where('created_by', Auth::user()->creatorId())
                                ->where('employee_id', $employee->id)
                                ->first();
                        }

                        if ($overtimeApprove->is_approver_company && Auth::user()->type == 'company') {
                            if ($request->status == 'Rejected') {
                                $overtimeApprove->status = 'Rejected';
                                $overtime->status           =  'Rejected';
                                $overtime->save();
                            } else {
                                $overtimeApprove->status = $request->status;
                            }
                            $overtimeApprove->save();
                        } elseif (!$overtimeApprove->is_approver_company && Auth::user()->type != 'company' && !is_null($level)) {
                            if ($request->status == 'Rejected') {
                                $overtimeApprove->status = 'Rejected';
                                $overtime->status           =  'Rejected';
                                $overtime->save();
                            } else {
                                $overtimeApprove->status = $request->status;
                            }

                            $overtimeApprove->save();
                        }
                    }

                    $countOvertimeApproved = OvertimeApproval::where('overtime_id', $overtime->id)
                        ->where('status', 'Approved')
                        ->count();
                    $countLevel = LevelApproval::where('created_by', Auth::user()->creatorId())->count();
                    if ($countOvertimeApproved == $countLevel) {
                        $overtime->status       =  'Approved';
                        $overtime->save();
                    }
                }
                // 3 Tier Approval

                DB::commit();
                toast('Overtime successfully updated.', 'success');
                return redirect()->route('overtimes.index');
            } catch (Exception $e) {
                DB::rollBack();
                dd($e);
                toast('Something went wrong.', 'error');
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
