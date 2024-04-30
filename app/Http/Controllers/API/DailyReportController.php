<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Daily_reports;
use App\Models\Daily_report_details;
use App\Models\ShiftSchedule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Employee;
use Illuminate\Support\Facades\URL;

class DailyReportController extends Controller
{
    public function index(Request $request){
        $data = DB::table('v_daily_reports')
                    ->where('date',$request->date)
                    ->where('branch_id', $request->branch_id)
                    ->where('shift',$request->shift)
                    ->where('employee_id',$request->employee_id)
                    ->get();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'branch_id'     => 'required',
                'shift'         => 'required',
                'date'          => 'required',
                'employee_id'   => 'required',
                'time'          => 'required',
                'location_name' => 'required',
                'longitude'     => 'required',        
                'latitude'      => 'required',        
                'foto'          => 'required', 
                // 'description'   => 'required',
                
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'wrong' => $validator->errors()
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            
            DB::beginTransaction();
            $dta = Branch::select('branches.name as branch_name','companies.name as company_name')
                            ->leftJoin('companies','companies.id','=','branches.company_id')
                            ->where('branches.id',$request->branch_id)->first();
            $company    =  $dta->branch_name;
            $branch     =  $dta->company_name;
            $tahun      =  date('Y');
            $bulan      =  date('m');
            $tanggal    =  date('d-m-Y');
            $dir        = $company.'/'.$branch.'/'.$tahun.'/'.$bulan.'/'.$tanggal.'/';
            $path = 'daily_report/'.$dir.$request->get('foto');
            if (! Storage::exists($path)) {
                Storage::makeDirectory($path,775,true);
            }

            $fileName = time() . $request->file('foto')->getClientOriginalName();
            $store = $request->file('foto')->storeAs($path, $fileName);
            $pathFile_application = 'storage/app/public/'.$path . $fileName ?? null;
            $base = URL::to('/');
            $link_foto = $base.'/'.$pathFile_application;
            
            if (!$store){
                return response()->json([
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => "Can not create directory, please try again !"
                ], Response::HTTP_OK);
            }
            $emp = Employee::where('id',$request->employee_id)->first();
            // $employeeShift = ShiftSchedule::select('shift_types.name')
            //             ->leftJoin('shift_types','shift_types.id','=','shift_schedules.shift_id')
            //             ->where('employee_id', $request->employee_id)
            //             ->where('schedule_date', $request->date)
            //             // ->where('status', 'Approved')
            //             ->first();
            // if($employeeShift != null){
            //     $shift = $employeeShift->name;
            // }else{
            //     $shift = 'No shift';
            // }
            $master = [
                'branch_id'     => $request->branch_id,
                'shift'         => $request->shift,
                'date'          => $request->date,
                'department_id' => $emp->department_id,
            ];
            Daily_reports::create($master);
            
            $details = [
                'daily_reports_id'  => DB::getPdo()->lastInsertId(),
                'branch_id'         => $request->branch_id,
                'employee_id'       => $request->employee_id,
                'date'              => $request->date,
                'time'              => $request->time,
                'location_name'     => $request->location_name,
                'foto_url'          => $link_foto,
                'longitude'         => $request->longitude,
                'latitude'          => $request->latitude,
                'description'       => $request->description,
                'created_at'        => date('Y-m-d H:m:s'),
                'updated_at'        => date('Y-m-d H:m:s'),
            ];
            Daily_report_details::insert($details);
            DB::commit();
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Created daily report successfully.'
            ], Response::HTTP_OK);
        }catch(Exeption $e){
            DB::rollBack();
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Something went wrong!'
            ], Response::HTTP_OK);
        }
    }
    public function detail($id){
        $data = DB::table('v_daily_reports')
                    ->where('detail_id',$id)
                    ->get();
        return response()->json([
                'status' => Response::HTTP_OK,
                'result' => $data
            ], Response::HTTP_OK);
    }
}
