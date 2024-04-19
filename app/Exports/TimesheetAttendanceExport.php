<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\AccessBranch;

class TimesheetAttendanceExport implements FromView
{
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function view(): View
    {
        $branch = Branch::find(Auth::user()->branch_id);
        $emp = Employee::where('user_id',Auth::user()->id)->first();
        if (Auth::user()->type == "company"){
            $branches = Branch::where('company_id',$branch->company_id)->get();
        }else{
            $branches = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                            ->where('access_branches.employee_id',$emp->id)
                                            ->where('access_branches.company_id',$branch->company_id)->get();
        }
        if(($this->request->startdate == null)){
            $bulan      = date('m');
            $tahun      = date('Y');
            $tglstart   = date('d');
            $bulanEnd   = date('m');
            $tahunEnd   = date('Y');
            $tglEnd     = date('d');
            $start_date = date('Y-m');
            $end_date   = date('Y-m');
            
        }else{
            $bulan       = date('m',strtotime($this->request->startdate));
            $tahun       = date('Y',strtotime($this->request->startdate));
            $tglstart    = date('d',strtotime($this->request->startdate));

            $bulanEnd  = date('m',strtotime($this->request->enddate));
            $tahunEnd  = date('Y',strtotime($this->request->enddate));
            $tglEnd    = date('d',strtotime($this->request->enddate));

            $start_date = date('Y-m',strtotime($this->request->startdate));
            $end_date   = date('Y-m',strtotime($this->request->enddate));
        }

        $jumtglstart = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun); // dapat jumlah tanggal 
        $jumtglEnd = cal_days_in_month(CAL_GREGORIAN, $bulanEnd, $tahunEnd); // dapat jumlah tanggal

        if ($start_date != $end_date ){
            $header = [];
            $field = ['employee_id','employee_name'];
            for($i=$tglstart; $i<=$jumtglstart;$i ++){
                if($i < 10){
                    array_push($header,'0'.(int)$i);
                    array_push($field,'s0'.(int)$i);
                }else{
                    array_push($header,$i);
                    array_push($field,'s'.$i);
                }
            }

            $headerEnd = [];
            $fieldEnd = [];
            for($i=1; $i<=$tglEnd;$i ++){
                if($i < 10){
                    array_push($headerEnd,'0'.(int)$i);
                    array_push($fieldEnd,'e0'.(int)$i);
                }else{
                    array_push($headerEnd,$i);
                    array_push($fieldEnd,'e'.$i);
                }
            }
            $dtfield = [];
            foreach($field as $fs){
                array_push($dtfield,$fs);
            }
            foreach($fieldEnd as $fe){
                array_push($dtfield,$fe);
            }
            array_push($dtfield,'wda');
            $arExpl         = implode(',',$dtfield);
            $paramstart     = $this->request->startdate;
            $paramend       = $this->request->enddate;
            $parambranch    = $this->request->branch_id;
            $data= DB::SELECT("SELECT DISTINCT $arExpl FROM rekap_monthly_attendance('$start_date','$end_date') as a
                                LEFT JOIN getattendance('".$paramstart."','". $paramend."','".$parambranch."') as b
                                ON b.noemployee= a.employee_id where branch_id = $parambranch");
                                // dd($data);
                                // rekap_total_attendance('$request->startdate','$request->enddate',$request->branch_id) as b 
            // $array = [];
            // $i=1;
            // foreach($data as $d){
            //     $dtArr = [
            //         $i,
            //         $d->employee_id,
            //         $d->employee_name,
            //     ];
            //     $dtArr2 =[];
            //     foreach($header as $h){
            //         $name = 's'.$h;
            //         array_push($dtArr2,$d->$name);
            //     }
            //     foreach($headerEnd as $s){
            //         $name = 'e'.$s;
            //         array_push($dtArr2,$d->$name);
            //     }
            
            //         array_push($dtArr2,$d->wda);
                
            //     $dat=array_merge($dtArr,$dtArr2);
            //     array_push($array,$dat);
            //     $i++;
            // }
            // dd($headerEnd);
            $dtTable['data'] = $data;
            $dtTable['header'] = $header;
            $dtTable['headerEnd'] = $headerEnd;
            return view('pages.contents.report.attendance.export_timesheet_attendance',$dtTable);
        }else{
            $header = [];
            $field = ['employee_id','employee_name'];
            for($i=$tglstart; $i<=$tglEnd;$i ++){
                if($i < 10){
                    array_push($header,'0'.(int)$i);
                    array_push($field,'s0'.(int)$i);
                }else{
                    array_push($field,'s'.$i);
                    array_push($header,$i);
                }
            }
            // array_push($header,'wda');
            $dtfield = [];
            foreach($field as $fs){
                array_push($dtfield,$fs);
            }
            array_push($dtfield,'wda');
            $headerEnd = [];
            $jumtglEnd = 0;
            $tglEnd    = 0;
            $exfil = implode(',',$dtfield);
            $paramstart     = $this->request->startdate;
            $paramend       = $this->request->enddate;
            $parambranch    = $this->request->branch_id;
            $data= DB::SELECT("SELECT DISTINCT $exfil FROM rekap_monthly_attendance('$start_date','$end_date') as a
                                LEFT JOIN  getattendance('".$paramstart."','".$paramend."','".$parambranch."') as b
                                ON b.noemployee = a.employee_id where branch_id = $parambranch");
                                // rekap_total_attendance('$request->startdate','$request->enddate',$request->branch_id) as b
            // $array = [];
            // $i=1;
            // foreach($data as $d){
            //     $dtArr = [
            //         $i,
            //         $d->employee_id,
            //         $d->employee_name,
            //     ];
            //     $dtArr2 =[];
            //     foreach($header as $h){
            //         if ($h == "wda"){
            //             $name = 'wda';
            //         }else{

            //             $name = 's'.$h;
            //         }
            //         array_push($dtArr2,$d->$name);
            //     }
            //     // array_push($dtArr2,$d->wda);
                
            //     $dat=array_merge($dtArr,$dtArr2);
            //     array_push($array,$dat);
            //     $i++;
            // }
            $dtTable['data'] = $data;
            $dtTable['header'] = $header;
            $dtTable['headerEnd'] = $headerEnd;
            // dd($data);
            // dd($header);
            return view('pages.contents.report.attendance.export_timesheet_attendance',$dtTable);
        }
    }
}
