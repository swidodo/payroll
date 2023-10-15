
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
    <header> REKAP ATTENDANCE EMPLOYEES</header>

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
            <th class="border-top border-left">Work Day</th>
            <th class="border-top border-left">Work Day Actual</th>
            <th class="border-top border-left">Alpha</th>
            <th class="border-top border-left">Permit</th>
            <th class="border-top border-left">Sick</th>
            <th class="border-top border-left">Leave</th>
            <th class="border-top border-left border-right">Dispensation</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($attendance as $row)
        <tr>
            <td align="center" class="border-top border-left border-bottom">{{ $row->noemployee }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->nm }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->wd }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->wda }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->alpha }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->izn }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->sds }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->cuti }}</td>
            <td align="center" class="border-top border-left border-bottom border-right">{{ $row->disp }}</td>
           
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>


