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
    @foreach($salarys as $salary)
        <div class="container p-2" style="page-break-after: always">
            <div class="center" style="padding: 8px">
                <table style="width: 90%">
                    <tbody>
                        <tr style="font-weight: 900" >
                            <td class="fs-14" rowspan="2" >
                                <div class="text-center">
                                    <img src="{{ asset('assets/img/logo-pehadir.jpg') }}" width="70px"  alt="">
                                </div>
                            </td>
                            <td class="fs-5">
                                <h2 class="text-center">{{ $salary->company_name }}</h2>
                            </td>
                        </tr>
                        <tr>
                            <td class="">
                                <h4 class="text-center">Tangerang</h5>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row slip-gaji ">
                <div class="slip mb-2">
                    <div class="row justify-content-center">
                        <div class="col-12 d-flex justify-content-center">
                            <h4 class="">SLIP GAJI KARYAWAN</h4>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 d-flex justify-content-center">
                            <h4 class="">{{\Carbon\Carbon::parse($salary->enddate)->format('F Y')}}</h4>
                        </div>
                    </div>
                </div>
                <div class="employee-name">
                    <table style="width: 90%">
                        <tbody>
                            <tr> 
                                <td style="width: 18%;font-size: 14px">ID</td>
                                <td style="width: 2%">:</td>
                                <td style="font-size: 14px;text-align:start;font-weight: 400;">{{$salary->no_employee}}</td>
                            </tr>
                            <tr> 
                                <td style="width: 18%;font-size: 14px">Nama</td>
                                <td style="width: 2%">:</td>
                                <td style=" font-size: 14px;text-align:start;font-weight: 400;">{{ ucwords($salary->employee_name) }}</td>
                            </tr>
                            <tr> 
                                <td style="width: 18%;font-size: 14px">Cabang</td>
                                <td style="width: 2%">:</td>
                                <td style=" font-size: 14px;text-align:start;font-weight: 400;">{{ strtoupper($salary->branch_name) }}</td>
                            </tr>
                            <tr> 
                                <td style="width: 18%;font-size: 14px">Jabatan</td>
                                <td style="width: 2%">:</td>
                                <td style=" font-size: 14px;text-align:start;font-weight: 400;">{{ strtoupper($salary->position_name) }}</td>
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
                            
                                    <tr class="fs-14 " style="font-weight: 400">
                                        <td style="width: 45%">Gaji Pokok</td>
                                        <td>:</td>
                                        <td class="text-right">{{ ($salary->basic_salary == '') ? 0 : formatRupiah($salary->basic_salary) }}</td>
                                    </tr>
                                    <tr class="fs-14 " style="font-weight: 400">
                                        <td style="width: 45%">Overtime</td>
                                        <td>:</td>
                                        <td class="text-right">{{ ($salary->overtime == '') ? 0 : formatRupiah($salary->overtime) }}</td>
                                    </tr>
                                
                                    @foreach($allowance_fixed as $fixed)
                                        @if ($fixed->employeeid == $salary->employee_id)
                                            <tr class="fs-14 " style="font-weight: 400">
                                                <td style="width: 45%">{{ Ucwords(strtolower($fixed->allowance_name)) }}</td>
                                                <td>:</td>
                                                <td class="text-right">{{ ($fixed->allowance_amount =='' ) ? 0 : formatRupiah($fixed->allowance_amount) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach($allowance_unfixed as $unfixed)
                                        @if ($unfixed->employee_id == $salary->employee_id)
                                        <tr class="fs-14 " style="font-weight: 400">
                                            <td style="width: 45%">{{ Ucwords(strtolower($unfixed->allowance_name)) }}</td>
                                            <td>:</td>
                                            <td class="text-right">{{ ($unfixed->amount == '') ? 0 : formatRupiah($unfixed->amount)  }}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    @foreach($allowance_other as $other)
                                        @if ($other->employee_id == $salary->employee_id && $other->allowance_date >= $salary->startdate && $other->allowance_date <= $salary->enddate)
                                        <tr class="fs-14 " style="font-weight: 400">
                                            <td style="width: 45%">{{ strtolower($other->allowance_name) }}</td>
                                            <td>:</td>
                                            <td class="text-right">{{ ($other->allowance_amount =='' ) ? 0 : formatRupiah($other->allowance_amount)}}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    @foreach($reimbursement as $remburst)
                                        @if ($remburst->employee_id == $salary->employee_id)
                                            <tr class="fs-14 " style="font-weight: 400">
                                                <td style="width: 45%">{{ Ucwords(strtolower($remburst->reimburst_name)) }}</td>
                                                <td>:</td>
                                                <td class="text-right">{{ ($remburst->reimburst_amount == '' ) ? 0 : formatRupiah($remburst->reimburst_amount) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div style="display: inline-block; width: 49%; float: right">
                        <table style="width: 90%">
                            <tbody>
                            
                                    <tr class="fs-14 " style="font-weight: 400">
                                        <td style="width: 45%">Kasbon</td>
                                        <td>:</td>
                                        <td class="text-right">{{ ($salary->loans =='') ? 0 : formatRupiah($salary->loans) }}</td>
                                    </tr>
                            
                                    <tr class="fs-14 " style="font-weight: 400">
                                        <td style="width: 45%">Pinjaman(cicilan)</td>
                                        <td>:</td>
                                        <td class="text-right">{{ ($salary->installment =='') ? 0 : formatRupiah($salary->installment) }}</td>
                                    </tr>
                                    @if(isset($deduction_other))
                                        @foreach($deduction_other as $do)
                                        @if ($do->employeeid == $salary->employee_id && $do->date_deduction >= $salary->startdate && $do->date_deduction <= $salary->enddate)
                                        <tr class="fs-14 " style="font-weight: 400">
                                            <td style="width: 45%">{{ Ucwords($do->deduction_name) }}</td>
                                            <td>:</td>
                                            <td class="text-right">{{ ($do->amount_deduction == '') ? 0 : formatRupiah($do->amount_deduction) }}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    @endif
                                    <tr class="fs-14 " style="font-weight: 400">
                                        <td style="width: 45%">BPJS Kesehatan</td>
                                        <td>:</td>
                                        <td class="text-right">
                                           {{ ($salary->employee_pay_bpjs_kesehatan =='') ? 0 : formatRupiah($salary->employee_pay_bpjs_kesehatan) }}
                                        </td>
                                    </tr>
                                    <tr class="fs-14 " style="font-weight: 400">
                                        <td style="width: 45%">BPJS Ketenagakerjaan</td>
                                        <td>:</td>
                                        <td class="text-right">
                                            {{ ($salary->employee_pay_bpjs_ketenagakerjaan == '') ? 0 : formatRupiah($salary->employee_pay_bpjs_ketenagakerjaan) }}
                                            @endif
                                        </td>
                                    </tr>
                                
                                    <tr class="fs-14 " style="font-weight: 400">
                                        <td style="width: 45%">PPH21</td>
                                        <td>:</td>
                                        <td class="text-right">{{ ($salary->pph21 =='') ? 0 : formatRupiah($salary->pph21) }}</td>
                                    </tr>
                                
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
                            <td class=" fs-14 text-right pr-3" style="padding-right: 20px">{{ formatRupiah($salary->basic_salary + $salary->overtime + $salary->allowance_fixed + $salary->allowance_unfixed + $salary->allowance_other)}}</td>
                            <td class=" fs-14" style="width: 39%; padding-left: 35px">Sub Total</td>
                            <td class=" fs-14 text-center" style="padding-right: 20px">{{ formatRupiah($salary->total_pay_loans + $salary->employee_pay_bpjs_kesehatan + $salary->employee_pay_bpjs_ketenagakerjaan + $salary->pph21) }}</td>
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
                                <td class="text-right text-bold" style="padding-right: 25px">{{ ($salary->take_home_pay == '') ? 0 : formatRupiah($salary->take_home_pay)  }}</td>
                            </tr>
                            <tr>
                                <td class="text-italic text-center" style="font-size:10pt !important;" colspan="2">Terbilang : <span> {{ucwords(terbilang($salary->take_home_pay))}} Rupiah</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 15px;margin-right: 35px;">
                    <table style="width: 100%">
                        <tbody>
                        <tr >
                                <td style="width: 58%; padding: 0;margin:0;"></td>
                                <td class="text-left border-bottom"><p class="m-0 fs-11 text-bold pb-5">Attendance Summary</p></td>
                        </tr>
                            @foreach($attendance as $a)
                                @if($salary->employee_id == $a->employee_id)
                                    <tr style="padding: 0px; margin: 0px">
                                        <td class="p-0 m-0" style="width: 58%; padding: 0px; margin: 0px"></td>
                                        <td class="clearfix p-0 m-0" style="padding: 0px;padding-top: 8px; margin: 0px" >
                                            <p class=" text-left m-0 p-0" style="font-size: 11px;float: left;padding: 0px;  margin-bottom: -8px;">Actual Working Day</p>
                                            <p class="text-right m-0 p-0" style="font-size: 11px;padding: 0px; margin-bottom: -8px;">
                                                {{ ($a->work_actual_day == null )? 0 : $a->work_actual_day }}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr >
                                        <td class="p-0 m-0" style="width: 58%;"></td>
                                        <td class="clearfix m-0 p-0" style="">
                                            <p class=" text-left m-0 p-0" style="font-size: 11px;float: left; margin-bottom: -8px;">Schedule Working Day</p>
                                            <p class=" text-right m-0 p-0" style="font-size: 11px;  margin-bottom: -8px;">
                                                {{ ($a->work_day == null )? 0 : $a->work_day }}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 58%"></td>
                                        <td class="clearfix">
                                            <p class=" text-left m-0 " style="font-size: 11px;float: left">Attendance/Time Off Code  <br />
                                            Alpa : {{ ($a->alpa == null )? 0 : $a->alpa }},
                                            Izin : {{ ($a->izin == null )? 0 : $a->izin }},
                                            Sakit: {{ (($a->sds == null )? 0 : $a->sds) }},
                                            Cuti : {{ ($a->cuti == null )? 0 : $a->cuti }},
                                            Dispensasi : {{ ($a->disp == null )? 0 : $a->disp }}
                                            </p>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
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
                                            <p class="text-bold fs-14">{{ ucwords(strtolower($salary->employee_name)) }}</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>           
            </div>
        </div> 
    @endforeach
</body>
</html>