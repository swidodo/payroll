<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\Thr;
use App\Models\AccessBranch;
use Exception;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ThrController extends Controller
{
    public function index(){
        $userInitial = Auth::user()->initial;
        $branch = Branch::select('company_id')->where('id', Auth::user()->branch_id)->first(); 
        $emp = Employee::where('user_id',Auth::user()->id)->first();
         
        if ($userInitial == 'HO'){
            if (Auth::user()->type == "company"){
                $data['branch'] = Branch::select('id','name')->where('company_id',$branch->company_id)->get();
            }else{
                $data['branch'] = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                ->where('access_branches.employee_id',$emp->id)
                                                ->where('access_branches.company_id',$branch->company_id)->get();
            }
        }else{
             $data['branch'] = Branch::select('id','name')->where('id',Auth::user()->branch_id)->fist();
        }
        
        return view('pages.contents.thr.index',$data);
    }
    public function get_data(Request $request){
        $data = Thr::select('thrs.*',
                            'employees.name as employee_name',
                            'employees.no_employee',
                            'employees.bank_name',
                            'employees.account_number',
                            'departements.name as departement_name',
                            'position.position_name',
                            'branches.name as branch_name')
                    ->leftJoin('employees','employees.id','=','thrs.employee_id')
                    ->leftJoin('departements','departements.id','employees.department_id')
                    ->leftJoin('position','position.id','employees.position_id')
                    ->leftJoin('branches','branches.id','employees.branch_id')
                    ->where('thrs.branch_id',$request->branch_id)
                    ->whereRaw("date_part('year',date) = date_part('year',date(now()))")
                    ->orderBy('employees.name','ASC')
                    ->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $btn ='';
                    if(Auth()->user()->canany('edit thr','delete thr')){
                        $btn .= '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">';
                       if(Auth()->user()->can('edit thr')){
                            $btn .= '<a  data-id ="'.$row->id.'" class="dropdown-item edit-thr" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_thr"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                        }
                        if(Auth()->user()->can('delete thr')){
                            $btn .='<a  data-id="'.$row->id.'" class="dropdown-item delete-thr" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                        }
                    }
                    return $btn;
                    })
                ->rawColumns(['action'])
                ->make(true);
    }
    public function generate_store(Request $request){

        try {
            DB::beginTransaction();
            $employee = Employee::select('employees.branch_id',
                                        'employees.id',
                                        'employees.no_employee',
                                        'employees.name',
                                        'employees.company_doj',
                                        'payrolls.amount as basic_salary',
                                        DB::raw("(SELECT a.amount from allowance_finances a left join allowance_options b on b.id=a.allowance_type_id where b.name = 'Tunjangan jabatan and a.employee_id=employees.id') as tunjangan_jabatan"))
                                ->leftJoin('payrolls','payrolls.employee_id','employees.id')
                                ->where('employees.branch_id',$request->branch_id)
                                ->where('employees.status','active')
                                ->get();
            $thr =[];
            foreach($employee as $emp){
                $service = Carbon::parse($request->cutoff_thr)->diff($emp->company_doj);
                $lengthService = $service->y.' tahun,'. $service->m.' bulan';
                if ($service->y < 1 && $service->d >= 30){
                    $amount = Round(($emp->basic_salary + $emp->tunjangan_jabatan) / 12 * $service->m);
                }elseif ($service->y < 1 && $service->d < 30 ){
                    $amount = 0;
                }else{
                     $amount = round($emp->basic_salary + $emp->tunjangan_jabatan);
                }
                $data = [
                    'date'                        => $request->cutoff_thr,
                    'employee_id'                 => $emp->id,
                    'branch_id'                   => $emp->branch_id,
                    'doj'                         => $emp->company_doj,
                    'service_of_year'             => $lengthService,
                    'basic_salary'                => $emp->basic_salary,
                    'amount_allowance_position'   => $emp->tunjangan_jabatan,
                    'amount'                      => $amount,
                    'created_by'                  => Auth::user()->id,
                    'created_at'                  => date('Y-m-d h:m:s')
                ];
                if(!in_array($data,$thr)){
                    array_push($thr,$data);
                }
               
            }
             $check = Thr::where('branch_id',$request->branch_id)
                            ->whereRaw("date_part('year',date) = date_part('year',date(now()))")
                            ->count();
            if ($check > 0){
                Thr::where('branch_id',$request->branch_id)->whereRaw("date_part('year',date) = date_part('year',date(now()))")->delete();
            }
            Thr::insert($thr);
            DB::commit();
            
                $res = [
                    'status' => 'success',
                    'msg'    => 'Generate THR successfully !',
                ];
            return response()->json($res);
        }catch (Exception $e) {
                DB::rollBack();
                $res = [
                    'status' => 'error',
                    'msg'    => 'Someting went wrong !',
                ];
                return response()->json($res);
        }

    }
}
