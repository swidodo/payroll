
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
    </style>
</head>
<body>
    <header> REPORT ATTENDANCE EMPLOYEES</header>
@foreach ($mst as $mst)
<table>
    <tr>
        <td>Employee ID : {{ $mst->no_employee }}</td>
        <td></td>
    </tr>
    <tr>
        <td>Employee Name : {{ $mst->name }}</td>
        <td></td>
    </tr>
</table>
<hr />
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="12%" class="border-top border-left">Date</th>
            <th class="border-top border-left">Clock In</th>
            <th class="border-top border-left">Clock Out</th>
            <th class="border-top border-left">Scan In </th>
            <th class="border-top border-left">Scan Out</th>
            <th class="border-top border-left">Late</th>
            <th class="border-top border-left">Early Leaving</th>
            <th class="border-top border-left">Overtime</th>
            <th class="border-top border-left">Time Work</th>
            <th class="border-top border-left border-right">Amount Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dtl as $row)
        @if ($row->employee_id == $mst->employee_id)
        <tr>
            <td align="center" class="border-top border-left border-bottom">{{ $row->date }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->jam_masuk }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->jam_pulang }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->scan_masuk }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->scan_pulang }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->terlambat }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->pulang_cepat }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->lembur }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->jam_kerja }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->jml_hadir }}</td>
        </tr>
        @endif
        @endforeach

    </tbody>
</table>
<br />
<br />
<br />
@endforeach

</body>
</html>


