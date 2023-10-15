
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
            <th class="border-top border-left">Employee ID</th>
            <th class="border-top border-left">Employee Name</th>
            <th class="border-top border-left">Position</th>
            <th class="border-top border-left">Bank Name</th>
            <th class="border-top border-left">Account Number</th>
            <th class="border-top border-left">Basic Salary</th>
            <th class="border-top border-left">Allowance Fixed</th>
            <th class="border-top border-left">Allowance Unfixed</th>
            <th class="border-top border-left">Allowance Other</th>
            <th class="border-top border-left">Overtime</th>
            <th class="border-top border-left">Salary This Month</th>
            <th class="border-top border-left">BPJS Kesehatan</th>
            <th class="border-top border-left">BPJS Ketenagakerjaan</th>
            <th class="border-top border-left">Total BPJS</th>
            <th class="border-top border-left">Installment</th>
            <th class="border-top border-left">Loans</th>
            <th class="border-top border-left">Pph21</th>
            <th class="border-top border-left">Total Deduction</th>
            <th class="border-top border-left border-right">Take Home Pay</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pay as $row)
        <tr>
            <td align="center" class="border-top border-left border-bottom">{{ $row->no_employee }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->name }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->position }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->bank_name }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->account_number }}</td>
            <td align="right" class="border-top border-right border-left border-bottom">{{ number_format($row->basic_salary) }}</td>
            <td align="right" class="border-top border-right border-bottom">{{ number_format($row->allowance_fixed) }}</td>
            <td align="right" class="border-top border-right border-bottom">{{ number_format($row->allowance_unfixed) }}</td>
            <td align="right" class="border-top border-right border-bottom">{{ number_format($row->allowance_other) }}</td>
            <td align="right" class="border-top border-right border-left border-bottom">{{ number_format($row->overtime) }}</td>
            <td align="right" class="border-top border-right border-left border-bottom">{{ number_format($row->salary_this_month) }}</td>
            <td align="right" class="border-top border-right border-left border-bottom">{{ number_format($row->employee_pay_bpjs_kesehatan) }}</td>
            <td align="right" class="border-top border-right border-left border-bottom">{{ number_format($row->employee_pay_bpjs_ketenagakerjaan) }}</td>
            <td align="right" class="border-top border-right border-left border-bottom">{{ number_format($row->employee_total_pay_bpjs) }}</td>
            <td align="right" class="border-top border-right border-left border-bottom">{{ number_format($row->installment) }}</td>
            <td align="right" class="border-top border-right border-left border-bottom">{{ number_format($row->loans) }}</td>
            <td align="right" class="border-top border-right border-left border-bottom">{{ number_format($row->pph21) }}</td>
            <td align="right" class="border-top border-right border-left border-bottom">{{ number_format($row->total_deduction) }}</td>
            <td align="right" class="border-top border-right border-left border-bottom">{{ number_format($row->take_home_pay) }}</td>
        </tr>
        @endforeach
        <tr><td  colspan="18" class="border-top border-right border-left border-bottom">Total</td><td class="border-top border-left border-right border-bottom" align="right">{{ number_format($total->total) }}</td></tr>

    </tbody>
</table>
</body>
</html>


