<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Rekap_pph21;
use Illuminate\Support\Facades\DB;

class Rekap_pph21Controller extends Controller
{
    public function index(){
        $user = Auth::user();
        if ($user->initial == "HO"){
            $branchId           = Branch::where('id',$user->branch_id)->first();
            $branch['branch']   = Branch::where('company_id',$branchId->company_id)->get();
        }else{
            $branch['branch']   = Branch::where('id',$user->branch_id)->get();
        }
        return view('pages.contents.report.rekap_pph21.index', $branch);
    }
    public function get_pph21(Request $request){
        $data   = Rekap_pph21::select('rekap_pph21s.*','employees.name','employees.no_employee','position.position_name')
                                ->leftJoin('employees','employees.id','=','rekap_pph21s.employee_id')
                                ->leftJoin('position','position.id','=','employees.position_id')
                                ->where('rekap_pph21s.branch_id','=',$request->branch_id);
                                 if ($request->startdate !== null && $request->enddate !== null){
                                    $data->where('rekap_pph21s.startdate','>=',$request->startdate);
                                    $data->where('rekap_pph21s.enddate','<=',$request->enddate);
                                }
                                $data->get();
        return DataTables::of($data)->make(true);
    }
    public function cetak_pdf(Request $request){
        $date = date('Ymd');
         if ($request->from_date !== null && $request->to_date !== null){
            $data = DB::table('rekap_pph21s')
                        ->select('rekap_pph21s.*','employees.name','employees.no_employee',,'position.position_name')
                        ->leftJoin('employees','employees.id','=','rekap_pph21s.employee_id')
                        ->leftJoin('position','position.id','=','employees.position_id')
                        ->where('rekap_pph21s.branch_id','=',$this->request->branch_id)
                        ->where('rekap_pph21s.startdate','>=',$this->request->from_date)
                        ->where('rekap_pph21s.enddate','<=',$this->request->to_date)
                        ->get(); 
            $total = DB::table('rekap_pph21s')
                        ->select(DB::raw('sum(pph21_terhutang_1_bulan) as total'))
                        ->where('branch_id','=',$this->request->branch_id)
                        ->where('startdate','>=',$this->request->from_date)
                        ->where('enddate','<=',$this->request->to_date)
                        ->first();
            $dat['branch']      = Branch::where('id',$request->branch_id)->first();
            $dat['start_date']  = $request->from_date;
            $dat['end_date']    = $request->to_date;
            $dat['pph']         = $data;                           
            $dat['total']       = $total;
           }                     
        $pdf = PDF::loadview('pages.contents.report.rekap_pph21.rekap_pph21_pdf',$dat)->setPaper('A3','landscape');
        ob_get_clean();
        return $pdf->stream('Rekap_pph21_'.$date.'');
    }
    public function ExportExcel(Request $request){
        $date = date('Ymd');
        $fileName = 'Rekap_pph21_'.$date.'.xlsx';
        return Excel::download(new RekapPayrollExport($request), $fileName);
    }
}
