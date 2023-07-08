<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>

    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}"> --}}

    <style>
        .bg-total-salary{
            background-color: rgb(205, 205, 205);
        }

        .center{
            border-right-style: solid;
            border-bottom-style: solid;
            border-left-style: solid;
            border-top-style: solid;
            padding: 25px 0px;
        }

        .border-left{
            border-left-style: solid;
        }
        .border-bottom{
            border-bottom: 1px solid rgb(153, 153, 153);
        }

        .text-center{
            text-align: center;
        }

        .slip-gaji{
            border-right-style: solid;
            border-bottom-style: solid;
            border-left-style: solid;
        }

        h4, h5, h2{
            margin: 0 0;
        }
        

        .company{
            font-weight: 900 !important;
            font-size: 30px
        }

        .city{
            font-size: 20px;
        }

        .slip{
            text-align: center;
        }

        .slip-gaji{
            padding: 15px 10px;

        }

        .slip-gaji .slip .slip-gaji-karyawan {
            font-size: 20px;
            font-weight: 900;
        }
        .slip-gaji .slip .period {
            font-size: 18px;
            font-weight: normal;
        }
        .earning-deduction{
            border-right-style: solid;
            border-bottom-style: solid;
            border-left-style: solid;
            display: flex;
            padding: 5px 10px;

        }

        .subtotal{
            border-right-style: solid;
            border-bottom-style: solid;
            border-left-style: solid;
            display: flex;
            padding: 5px 10px;
        }

        .clear-salary{
            border-right-style: solid;
            border-bottom-style: solid;
            border-left-style: solid;
           padding: 10px 15px;
        }

        .earning-deduction .col-md-6{
            width: 50%;
            display: flex;
            
        }

        .earning-deduction .fw-bold{
            font-size: 18px;
            font-weight: 900;
        }

        .salary{
            border-right-style: solid;
            border-bottom-style: solid;
            border-left-style: solid;
            /* display: flex; */
            padding: 10px 10px;
        }

        .inline{
            display: inline;
        }

        .salary .row .earning{
            display: inline;
            margin-right: 13%;
        }
        .salary .row .deduction{
            display: inline;
        }

        .border{
            border: 1px solid black
        }

        /* .earning, .deduction{
            width: 50%;
        } */

        .full{
            width: 100%;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .clear { clear:both; }

        /* .employee-name .row{
            display: flex;
        }
        .employee-name .row h5{
            font-size: 18px;
        } */

        .fs-14{
            font-size: 14px;
        }
        .fs-11{
            font-size: 11px;
        }
        .fs-12{
            font-size: 12px;
        }
        .fs-18{
            font-size: 18px;
        }

        .text-bold{
            font-weight: 900;
        }

        .text-right{
            text-align: right;
        }

        .mb-2{
            margin-bottom: 10px;
        }

        .text-italic{
            font-style: italic;
        }
        .text-center{
            text-align: center;
        }
        .mt-5{
            margin-top: 25px;
        }
        .mt-18{
            margin-top: 18px;
        }
        .m-0{
            margin: 0;
        }
        .pb-5{
            padding-bottom: 5px;
        }
    </style>
</head>
<body>
    @php
        function formatRupiah($angka){
        $hasil_rupiah = number_format($angka,0,',','.');
        return $hasil_rupiah;
        }

        function penyebut($nilai) {
            $nilai = abs($nilai);
            $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
            $temp = "";
            if ($nilai < 12) {
                $temp = " ". $huruf[$nilai];
            } else if ($nilai <20) {
                $temp = penyebut($nilai - 10). " belas";
            } else if ($nilai < 100) {
                $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
            } else if ($nilai < 200) {
                $temp = " seratus" . penyebut($nilai - 100);
            } else if ($nilai < 1000) {
                $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
            } else if ($nilai < 2000) {
                $temp = " seribu" . penyebut($nilai - 1000);
            } else if ($nilai < 1000000) {
                $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
            } else if ($nilai < 1000000000) {
                $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
            } else if ($nilai < 1000000000000) {
                $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
            } else if ($nilai < 1000000000000000) {
                $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
            }     
            return $temp;
        }

        function terbilang($nilai) {
            if($nilai<0) {
                $hasil = "minus ". trim(penyebut($nilai));
            } else {
                $hasil = trim(penyebut($nilai));
            }     		
            return $hasil;
        }
    @endphp
    <div class="container p-2">

        <div class="center" style="padding: 8px">
            <table style="width: 90%">
                <tbody>
                    <tr style="font-weight: 900" >
                        <td class="fs-14" rowspan="2" >
                            <div class="text-center">
                                <img src="{{ asset('assets/img/logo-pehadir.jpg') }}" width="120px"  alt="">
                            </div>
                        </td>
                        <td class="fs-14">
                            <h2 class="company text-center">PT. Penukal Jaya Utama</h2>
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <h5 class="city text-center">Tangerang</h5>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row slip-gaji ">
            <div class="slip mb-2">
                <div class="row justify-content-center">
                    <div class="col-12 d-flex justify-content-center">
                        <h4 class="slip-gaji-karyawan">SLIP GAJI KARYAWAN</h4>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 d-flex justify-content-center">
                        <h4 class="period">Periode {{\Carbon\Carbon::parse($payslipEmployee->salary_month)->format('F Y')}}</h4>
                    </div>
                </div>
            </div>
            <div class="employee-name">

                <table style="width: 90%">
                    <tbody>
                        <tr> 
                            <td style="width: 18%;font-size: 16px">ID</td>
                            <td style="width: 2%">:</td>
                            <td style="font-size: 16px;text-align:start;font-weight: 800;">{{$employee->id}}</td>
                        </tr>
                        <tr> 
                            <td style="width: 18%;font-size: 16px">Nama</td>
                            <td style="width: 2%">:</td>
                            <td style=" font-size: 16px;text-align:start;font-weight: 800;">{{$employee->name}}</td>
                        </tr>
                        <tr> 
                            <td style="width: 18%;font-size: 16px">Branch</td>
                            <td style="width: 2%">:</td>
                            <td style=" font-size: 16px;text-align:start;font-weight: 800;">{{$employee->branch->name}}</td>
                        </tr>
                        <tr> 
                            <td style="width: 18%;font-size: 16px">Jabatan</td>
                            <td style="width: 2%">:</td>
                            <td style=" font-size: 16px;text-align:start;font-weight: 800;">{{$employee->user->type}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="earning-deduction">
            <table style="width: 90%">
                <tbody>
                    <tr style="font-weight: 900">
                        <td class="fs-14">Penghasilan</td>
                        <td class="fs-14">Potongan</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="salary clearfix">
            <div class="full">
                <div style="display: inline-block; width: 50%;">
                    <table style="width: 90%">
                        <tbody>
                            @foreach ($payslipBasicSalary as $basic_salary)
                                @php
                                    $basic_salary = \App\Models\Payroll::find($basic_salary['id']);
                                @endphp
                                
                                <tr class="fs-14 " style="font-weight: 400">
                                    <td style="width: 45%">{{$basic_salary->payslip_type->name}}</td>
                                    <td>:</td>
                                    <td class="text-right">{{formatRupiah($basic_salary->amount) }}</td>
                                </tr>
                            @endforeach
                            @foreach ($payslipAllowance as $allowance)
                                @php
                                    $allowance = \App\Models\AllowanceFinance::find($allowance['id']);
                                @endphp
                                
                                <tr class="fs-14 " style="font-weight: 400">
                                    <td style="width: 45%">{{$allowance->allowance_type->name}}</td>
                                    <td>:</td>
                                    <td class="text-right">{{formatRupiah($allowance->amount) }}</td>
                                </tr>
                            @endforeach
                            @foreach ($payslipReimburst as $reimburst)
                                @php
                                    $reimburst = \App\Models\Reimburst::find($reimburst['id']);
                                @endphp
                                
                                <tr class="fs-14 " style="font-weight: 400">
                                    <td style="width: 45%">{{$reimburst->reimburst_type->name}}</td>
                                    <td>:</td>
                                    <td class="text-right">{{formatRupiah($reimburst->amount) }}</td>
                                </tr>
                            @endforeach
                            @foreach ($payslipOvertime as $overtime)
                                @php
                                    $overtime = \App\Models\Overtime::find($overtime['id']);
                                @endphp
                                
                                <tr class="fs-14 " style="font-weight: 400">
                                    <td style="width: 45%">{{$overtime->overtime_type->name}}</td>
                                    <td>:</td>
                                    <td class="text-right">{{formatRupiah($overtime->amount_fee) }}</td>
                                </tr>
                            @endforeach
                            
                            @if ($pension > 0)
                                <tr class="fs-14 " style="font-weight: 400">
                                    <td style="width: 45%">Jaminan Pensiun</td>
                                    <td>:</td>
                                    <td class="text-right">{{formatRupiah($pension) }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div style="display: inline-block; width: 49%; float: right">
                    <table style="width: 90%">
                        <tbody>
                            @foreach ($payslipCashInAdvance as $cash_in_advance)
                                @php
                                    $cash_in_advance = \App\Models\Cash::find($cash_in_advance['id']);
                                @endphp
                                
                                <tr class="fs-14 " style="font-weight: 400">
                                    <td style="width: 45%">{{$cash_in_advance->loan_type->name}} ({{$cash_in_advance->number_of_installment}})</td>
                                    <td>:</td>
                                    <td class="text-right">{{formatRupiah($cash_in_advance->amount / $cash_in_advance->installment) }}</td>
                                </tr>
                            @endforeach
                            @foreach ($payslipLoan as $loan)
                                @php
                                    $loan = \App\Models\Loan::find($loan['id']);
                                @endphp
                                
                                <tr class="fs-14 " style="font-weight: 400">
                                    <td style="width: 45%">{{$loan->loan_type->name}} ({{$loan->number_of_installment}})</td>
                                    <td>:</td>
                                    <td class="text-right">{{formatRupiah($loan->amount / $loan->installment) }}</td>
                                </tr>
                            @endforeach
                            @foreach ($payslipDenda as $denda)
                                @php
                                    $denda = \App\Models\Denda::find($denda['id']);
                                @endphp
                                
                                <tr class="fs-14 " style="font-weight: 400">
                                    <td style="width: 45%">Terlambat</td>
                                    <td>:</td>
                                    <td class="text-right">{{formatRupiah($denda->amount) }}</td>
                                </tr>
                            @endforeach
                                @php
                                    $totalBpjsTkAmount = 0;
                                    if (!is_null($payslipBpjsK)) {
                                        if ($payslipBpjsK['type'] == 'Fixed') {
                                            $totalVal  = $payslipBpjsK['value'];
                                        } else {
                                            $totalVal  = (int)$payslipBpjsK['value'] * $employee->salary / 100;
                                        }
                                        if ($employee->salary > $payslipBpjsK['maximum_salary']) {
                                            $totalVal = 1200000;
                                        }
                                        $totalBpjsTkAmount += $totalVal;
                                    }
                                @endphp
                                @if (!is_null($payslipBpjsK))
                                    <tr class="fs-14 " style="font-weight: 400">
                                        <td style="width: 45%">BPJS Kesehatan</td>
                                        <td>:</td>
                                        <td class="text-right">{{formatRupiah($totalBpjsTkAmount) }}</td>
                                    </tr>
                                @endif
                                @if ($payslipPph21 > 0)
                                    <tr class="fs-14 " style="font-weight: 400">
                                        <td style="width: 45%">PPH21</td>
                                        <td>:</td>
                                        <td class="text-right">{{formatRupiah($payslipPph21) }}</td>
                                    </tr>
                                @endif
                                @if ($payslipBpjsTk > 0)
                                    <tr class="fs-14 " style="font-weight: 400">
                                        <td style="width: 45%">BPJS TK</td>
                                        <td>:</td>
                                        <td class="text-right">{{formatRupiah($payslipBpjsTk) }}</td>
                                    </tr>
                                @endif
                            </tbody>
                    </table>
                </div>
                
            </div>
        </div>
        <div class="subtotal">
            <table style="width: 100%; ">
                <tbody>
                    <tr style="font-weight: 900">
                        <td class="fs-14" style="width: 36%">Sub Total</td>
                        <td class=" fs-14">{{formatRupiah($payslipDetail['totalEarning'])}}</td>
                        <td class=" fs-14" style="width: 39%; padding-left: 15px">Sub Total</td>
                        <td class=" fs-14">{{formatRupiah($payslipDetail['totalDeduction'])}}</td>
                    </tr>
                </tbody>
            </table>
            
        </div>
        <div class="clear-salary">
           
            <div style="display: block; padding: 5px 14px;  background-color: rgb(217, 217, 217)">
                <table style="width: 100%">
                    <tbody>
                        <tr class="fs-14 " style="font-weight: 400;">
                            <td class="text-bold">Total Gaji Bersih</td>
                            <td class="text-right text-bold" style="padding-right: 25px">{{formatRupiah($payslipEmployee->net_payble)}}</td>
                        </tr>
                        <tr>
                            <td class="text-italic text-center" colspan="2">Terbilang : <span>{{ucwords( terbilang($payslipEmployee->net_payble)).' Rupiah'}}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- <div style="margin-top: 15px">
                <table style="width: 100%">
                    <tbody>
                       <tr >
                            <td style="width: 58%; padding: 0;margin:0;"></td>
                            <td class="text-left border-bottom"><p class="m-0 fs-11 text-bold pb-5">Attendance Summary</p></td>
                       </tr>
                        @php
                            $is_displayed = false;
                            foreach ($checklists as $key => $value) {
                                if ($value->name == 'actual_working_day') {
                                    $is_displayed = true;
                                }
                            } 
                        @endphp
                        @if ($is_displayed)
                            <tr style="padding: 0px; margin: 0px">
                                <td class="p-0 m-0" style="width: 58%; padding: 0px; margin: 0px"></td>
                                <td class="clearfix p-0 m-0" style="padding: 0px;padding-top: 8px; margin: 0px" >
                                    <p class=" text-left m-0 p-0" style="font-size: 9px;float: left;padding: 0px; margin: 0px">Actual Working Day</p>
                                    <p class=" text-right m-0 p-0" style="font-size: 9px;padding: 0px; margin: 0px">{{$attendanceSummary['actual_work_day']}}</p>
                                </td>
                            </tr>
                        @endif

                        @php
                            $is_displayed = false;
                            foreach ($checklists as $key => $value) {
                                if ($value->name == 'schedule_working_day') {
                                    $is_displayed = true;
                                }
                            } 
                        @endphp
                        @if ($is_displayed)
                            <tr >
                                <td class="p-0 m-0" style="width: 58%;"></td>
                                <td class="clearfix m-0 p-0" style="">
                                    <p class=" text-left m-0 p-0" style="font-size: 9px;float: left;">Schedule Working Day</p>
                                    <p class=" text-right m-0 p-0" style="font-size: 9px;">{{$attendanceSummary['schedule_work_day']}}</p>
                                </td>
                            </tr>
                        @endif
                        
                        @php
                            $is_displayed = false;
                            foreach ($checklists as $key => $value) {
                                if ($value->name == 'dayoff') {
                                    $is_displayed = true;
                                }
                            } 
                        @endphp
                        @if ($is_displayed)
                            <tr>
                                <td style="width: 58%"></td>
                                <td class="clearfix">
                                    <p class=" text-left m-0 " style="font-size: 9px;float: left">Dayoff</p>
                                    <p class=" text-right m-0 " style="font-size: 9px">{{$attendanceSummary['dayoff']}}</p>
                                </td>
                            </tr>
                        @endif

                        @php
                            $is_displayed = false;
                            foreach ($checklists as $key => $value) {
                                if ($value->name == 'national_holiday') {
                                    $is_displayed = true;
                                }
                            } 
                        @endphp
                        @if ($is_displayed)
                            <tr>
                                <td style="width: 58%"></td>
                                <td class="clearfix">
                                    <p class=" text-left m-0 " style="font-size: 9px;float: left">National Holiday</p>
                                    <p class=" text-right m-0 " style="font-size: 9px">{{$attendanceSummary['national_holiday']}}</p>
                                </td>
                            </tr>
                        @endif

                        @php
                            $is_displayed = false;
                            foreach ($checklists as $key => $value) {
                                if ($value->name == 'company_holiday') {
                                    $is_displayed = true;
                                }
                            } 
                        @endphp
                        @if ($is_displayed)
                            <tr>
                                <td style="width: 58%"></td>
                                <td class="clearfix">
                                    <p class=" text-left m-0 " style="font-size: 9px;float: left">Company Holiday</p>
                                    <p class=" text-right m-0 " style="font-size: 9px">{{$attendanceSummary['company_holiday']}}</p>
                                </td>
                            </tr>
                        @endif

                        @php
                            $is_displayed = false;
                            foreach ($checklists as $key => $value) {
                                if ($value->name == 'timeoff_code') {
                                    $is_displayed = true;
                                }
                            } 
                        @endphp
                        @if ($is_displayed)
                            <tr>
                                <td style="width: 58%"></td>
                                <td class="clearfix">
                                    <p class=" text-left m-0 " style="font-size: 9px;float: left">Attendance/Time Off Code</p>
                                    <p class=" text-right m-0 " style="font-size: 9px">
                                        @foreach ($timeOffCodes as $code => $value)
                                            @if ($value > 0)
                                            {{$code.': '.$value}}
                                            @endif
                                        @endforeach
                                    </p>
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div> --}}
            <div style="margin-top: 15px" class="clearfix">
                <div class="" style="width: 50%; float: right;">
                    <span class="text-left" style="float: left;display:inline-block: 0px; font-size: 11px; font-weight: 700;">Attendance Summary</span>
                    <div class="clear"></div>
                    <hr style=" margin-bottom: 5px; margin-top:5">

                    @php
                        $is_displayed = false;
                        foreach ($checklists as $key => $value) {
                            if ($value->name == 'actual_working_day') {
                                $is_displayed = true;
                            }
                        } 
                    @endphp
                    @if ($is_displayed)
                        <span class="text-left" style="float: left;display:inline-block: 0px; font-size: 10px">Actual Working Day</span>
                        <span class="text-right" style="float: right;margin: 0px; font-size: 10px">{{$attendanceSummary['actual_work_day']}}</span>
                        <div class="clear"></div>
                    @endif
                    
                    @php
                        $is_displayed = false;
                        foreach ($checklists as $key => $value) {
                            if ($value->name == 'schedule_working_day') {
                                $is_displayed = true;
                            }
                        } 
                    @endphp
                    @if ($is_displayed)
                        <span class="text-left" style="float: left;display:inline-block: 0px; font-size: 10px">Schedule Working Day</span>
                        <span class="text-right" style="float: right;margin: 0px; font-size: 10px">{{$attendanceSummary['schedule_work_day']}}</span>
                        <div class="clear"></div>
                    @endif
                    
                    @php
                        $is_displayed = false;
                        foreach ($checklists as $key => $value) {
                            if ($value->name == 'dayoff') {
                                $is_displayed = true;
                            }
                        } 
                    @endphp
                    @if ($is_displayed)
                        <span class="text-left" style="float: left;display:inline-block: 0px; font-size: 10px">Dayoff</span>
                        <span class="text-right" style="float: right;margin: 0px; font-size: 10px">{{$attendanceSummary['dayoff']}}</span>
                        <div class="clear"></div>
                    @endif
                    

                    @php
                        $is_displayed = false;
                        foreach ($checklists as $key => $value) {
                            if ($value->name == 'national_holiday') {
                                $is_displayed = true;
                            }
                        } 
                    @endphp
                    @if ($is_displayed)
                        <span class="text-left" style="float: left;display:inline-block: 0px; font-size: 10px">National Holiday</span>
                        <span class="text-right" style="float: right;margin: 0px; font-size: 10px">{{$attendanceSummary['national_holiday']}}</span>
                        <div class="clear"></div>
                    @endif
                    
                    @php
                        $is_displayed = false;
                        foreach ($checklists as $key => $value) {
                            if ($value->name == 'company_holiday') {
                                $is_displayed = true;
                            }
                        } 
                    @endphp
                    @if ($is_displayed)
                        <span class="text-left" style="float: left;display:inline-block: 0px; font-size: 10px">Company Holiday</span>
                        <span class="text-right" style="float: right;margin: 0px; font-size: 10px">{{$attendanceSummary['company_holiday']}}</span>
                        <div class="clear"></div>
                    @endif
                    
                    @php
                        $is_displayed = false;
                        foreach ($checklists as $key => $value) {
                            if ($value->name == 'timeoff_code') {
                                $is_displayed = true;
                            }
                        } 
                    @endphp
                    @if ($is_displayed)
                        <span class="text-left" style="float: left;display:inline-block: 0px; font-size: 10px">Attendance/Time Off Code</span>
                        <span class="text-right" style="float: right;margin: 0px; font-size: 10px">
                            @foreach ($timeOffCodes as $code => $value)
                                @if ($value > 0)
                                {{$code.': '.$value}}
                                @endif
                            @endforeach
                        </span>
                        <div class="clear"></div>
                    @endif
                </div>
            </div>

            <div class="mt-5" style=" padding: 5px 40px;">
                <div style="display: block;">
                    <table style="width: 100%">
                        <tbody>
                            <tr style="font-weight: 400">
                                <td class="fs-14"  style="display: inline-block;width: 90px">
                                    <div class="payroll text-center" style="border-bottom: 1px solid black">
                                        <p style="margin-bottom: 70px">Payroll</p>
                                    </div>
                                </td>
                                <td class="fs-14 text-right"  >
                                    <div class="payroll text-center" style="display: inline-block;width: 90px;">
                                        <p style="margin-bottom: 55px">Diterima Oleh,</p>
                                        <p class="text-bold">{{$employee->name}}</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

           
        </div>

    {{-- </div> --}}
</body>
</html>