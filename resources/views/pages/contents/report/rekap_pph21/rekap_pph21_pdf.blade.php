
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
         header {
                position: fixed;
                top: -50px;
                left: 0px;
                right: 0px;
                height: 40px;

                /** Extra personal styles **/
                background-color: #2C97CD;
                color: white;
                text-align: center;
                line-height: 35px;
            }
        .border-top {
           border-top: 0.2px solid;
        }
        .border-bottom{
            border-bottom: 0.2px solid;
        }
        .border-left{
            border-left: 0.2px solid;
        }
        .border-right{
            border-right: 0.2px solid;
        }
        table {
            border-collapse: collapse;
        }
        th{
            font-size: 9pt;
        }
        td{
            font-size: 9pt;
        }
    </style>
</head>
<body>
    <header> REKAP PAYROLL EMPLOYEES</header>

<table>
    <tr>
        <td>Branch : </td>
        <td>{{ $branch->name }}</td>
    </tr>
    <tr>
        <td>Periode : </td>
        <td> {{ $start_date  }} s/d {{ $end_date}}</td>
    </tr>
</table>
<hr />
<table class="table table-bordered" width="100%">
    <thead>
        <tr style="background:#cccccc;">
            <th class="border-top border-left" >Employee ID</th>
            <th class="border-top border-left">Employee Name</th>
            <th class="border-top border-left">Position</th>
            <th class="border-top border-left">Basic Salary</th>
            <th class="border-top border-left">Allowance Fixed</th>
            <th class="border-top border-left">Allowance Unfixed</th>
            <th class="border-top border-left">Allowance Other</th>
            <th class="border-top border-left">Overtime</th>
            <th class="border-top border-left">Salary In Month</th>
            <th class="border-top border-left">Company BPJS</th>
            <th class="border-top border-left">Salary Brutto</th>
            <th class="border-top border-left">Position Allowance</th>
            <th class="border-top border-left">Employee Bpjs</th>
            <th class="border-top border-left">Total Subtraction</th>
            <th class="border-top border-left">Salary Netto</th>
            <th class="border-top border-left">Salary 1 Year</th>
            <th class="border-top border-left">PTKP 1 Year</th>
            <th class="border-top border-left">PKP</th>
            <th class="border-top border-left">PPH21 Owned 1 Year</th>
            <th class="border-top border-left">PPH21 Owned 1 Month</th>
        </tr>
    </thead>
    <tbody>
         @foreach ($pph as $row)
        <tr>
            <td align="center" class="border-top border-left border-bottom">{{ $row->no_employee }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->name }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->position_name }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->salary_pokok }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->allowance_fixed }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->allowance_unfixed }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->allowance_other }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->total_overtime }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->salary_in_month }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->pay_bpjs_company }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->salary_brutto }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->biaya_jabatan }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->pay_bpjs_employee }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->total_pengurangan }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->salary_netto }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->salary_1_tahun }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->ptkp_1_tahun }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->pkp }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->pph21_terhutang_1_tahun }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->pph21_terhutang_1_bulan }}</td>
        </tr>
        @endforeach
        <tr><td  colspan="19" class="border-top border-left border-right border-bottom">Total</td><td class="border-top border-left border-right border-bottom">{{ $total->total }}</td></tr>

    </tbody>
</table>
</body>
</html>


