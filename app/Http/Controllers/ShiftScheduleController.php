<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ReqShiftSchedule;
use App\Models\ShiftSchedule;
use App\Models\ShiftType;
use App\Models\Utility;
use App\Models\Dayoff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShiftScheduleController extends Controller
{
   
    public function index()
    {
        //show shift schedule
        if (Auth::user()->can('show shift schedule')) {
            $shiftSchedules = ShiftSchedule::leftJoin('employees','employees.id','=','shift_schedules.employee_id')
            ->where('employees.branch_id', '=', Auth::user()->branch_id)
            ->where('shift_schedules.status', 'Approved')
            ->orderBy('shift_schedules.id', 'asc')
            ->get();

            $nationalDay = Utility::nationalHoliday();

            if (isset($shiftSchedules)) {
                foreach ($shiftSchedules as $key => $value) {
                    $dayOfShift         = Carbon::parse($value->schedule_date)->format('Ymd');

                    if (isset($nationalDay[$dayOfShift])) {
                        $value->is_dayoff = true;
                        $value->dayoff_type = 'National Holiday';
                        $value->description = $nationalDay[$dayOfShift]['deskripsi'];
                        $value->save();
                    }
                }
            }

            $employees = Employee::where('branch_id', '=', Auth::user()->branch_id)->get();
            return view('pages.contents.shift-schedule.index', compact('shiftSchedules', 'employees'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (Auth::user()->can('edit shift schedule')) {
            $employees      = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
            $shifts         = ShiftType::where('created_by', '=', Auth::user()->creatorId())->get();
            $reqShiftSchedule   = ReqShiftSchedule::find($id);
            $shiftSchedules      =  ShiftSchedule::where('req_shift_schedules_id', $reqShiftSchedule->id)->get();

            return view('pages.contents.shift-schedule.edit', compact('employees', 'shifts', 'reqShiftSchedule', 'shiftSchedules'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
    public function update(Request $request, $id)
    {
        $reqShiftSchedule = ReqShiftSchedule::find($id);
        $shiftSchedules = ShiftSchedule::where('req_shift_schedules_id', $reqShiftSchedule->id)->where('created_by', '=', Auth::user()->creatorId())->get();


        if (Auth::user()->can('edit shift schedule')) {
            $validator = Validator::make(
                $request->all(),
                []
            );

            if (isset($request->schedule)) {
                if (count($request->schedule) > 0) {
                    foreach ($request->schedule as $key => $val) {
                        if (isset($request->schedule[$key + 1]) && $val['schedule_date']  == $request->schedule[$key + 1]['schedule_date']) {
                            return redirect()->back()->with('error', 'There is duplicate shift in request, please check the dates during the request');
                        }

                        if ($val['shift_id'] == 0) {
                            return redirect()->back()->with('error', 'Please select valid shift daily');
                        }
                    }
                }
            }

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            // $reqShiftSchedule->update($request->all());

            if (isset($request->schedule)) {
                foreach ($shiftSchedules as $key) {
                    $key->delete();
                }

                foreach ($request->schedule as $key) {
                    ShiftSchedule::create([
                        'req_shift_schedules_id'    => $reqShiftSchedule->id,
                        'schedule_date'             => $key['schedule_date'],
                        'shift_id'                  => $key['shift_id'],
                        'created_by'                => Auth::user()->creatorId(),
                    ]);
                }
            } else {
                foreach ($shiftSchedules as $key) {
                    $key->delete();
                }
            }

            return redirect()->route('shift-schedule.index')->with('success', $reqShiftSchedule->employee->name . ' successfully updated.');
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $reqShiftSchedule = ReqShiftSchedule::find($id);
        $shiftSchedule = ShiftSchedule::where('req_shift_schedules_id', $reqShiftSchedule->id)->where('created_by', '=', Auth::user()->creatorId())->get();

        if (Auth::user()->can('delete shift schedule')) {
            if ($reqShiftSchedule->created_by == Auth::user()->creatorId()) {
                $reqShiftSchedule->delete();
                if ($reqShiftSchedule) {
                    foreach ($shiftSchedule as $key) {
                        $key->delete();
                    }
                }

                return redirect()->route('request-shift-schedule.index')->with('success', $reqShiftSchedule->employee->name . ' successfully deleted.');
            } else {
                toast('Permission denied.', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function indexDayOff()
    {
        if (Auth::user()->can('show shift schedule')) {
            // $employees = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
            // $shiftSchedules = ShiftSchedule::where('created_by', '=', Auth::user()->creatorId())->where('status', 'Approved')->orderBy('id', 'asc')->get();
            return view('pages.contents.dayoff.index');
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
    public function importSchedule()
    {
        try{
            $file_extension = request()->file('file-excel')->extension();
            if ('csv' == $file_extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } elseif ('xls' == $file_extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } elseif ('xlsx' == $file_extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            // $reader = new Xls();
            $spreadsheet = $reader->load(request()->file('file-excel'));
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            $scheduleShift = [];
            foreach ($sheetData as $key => $value) {
                if ($key > 0) :
                    $employeeId = employee::where('no_employee',$value[1])->where('branch_id',Auth::user()->branch_id)->first();
                    if ($employeeId != null ):
                        $checked    = ShiftSchedule::where('employee_id',$employeeId->id)->where('schedule_date',$value[3])->first();
                        $dayOff     = Dayoff::where('date',$value[3])->where('branch_id',Auth::user()->branch_id)->first();
                        $shift      = ShiftType::where('name', $value[4])->where('branch_id',Auth::user()->branch_id)->first();
                        if ($dayOff != null){
                            $is_dayoff = 1;
                        }else{
                            $is_dayoff = 0;
                        }
                        if ($checked !=null):
                            $data = [
                                'schedule_date'     => $value[3],
                                'shift_id'          => $shift->id,
                                'status'            => 1,
                                'is_dayoff'         => $is_dayoff,
                                'is_active'         => 1,
                                'created_at'        => date('Y-m-d h:m:s'),
                                'updated_at'        => date('Y-m-d h:m:s'),
                                'created_by'        => Auth::user()->id,
                            ];
                            if ($shift !=null){
                                $updateSchedule = ShiftSchedule::where('schedule_date',$checked->schedule_date)->where('employee_id',$employeeId->id)->update($data);
                            }
                        endif;
                        if($checked == null):
                                $data = [
                                    'employee_id'       => $employeeId->id,
                                    'schedule_date'     => $value[3],
                                    'shift_id'          => ($shift !==null) ?  $shift->id:0,
                                    'status'            => 1,
                                    'is_dayoff'         => $is_dayoff,
                                    'is_active'         => 1,
                                    'created_at'        => date('Y-m-d h:m:s'),
                                    'updated_at'        => date('Y-m-d h:m:s'),
                                    'created_by'        => Auth::user()->id,
                                ];
                                if ($shift !=null){
                                    if(!in_array($data,$scheduleShift)){
                                        array_push($scheduleShift,$data);
                                    }
                                }
                        endif;
                    endif;
                endif;
            }
            if (count($scheduleShift) > 0){
                $insertSchedule = ShiftSchedule::insert($scheduleShift);
            }
            $res = [
                'status' => 'success',
                'msg'    => 'Successfully Import Schedule !'
            ];
            return response()->json($res);
        }catch(Exception $e){
            $res = [
                'status' => 'info',
                'msg'    => 'Data not Found !'
            ];
            return response()->json($res);
        } 
    }
}