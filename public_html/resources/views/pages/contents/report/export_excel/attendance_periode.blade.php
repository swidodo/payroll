@foreach ($mst as $mst)
<table>
    <tr>
        <td>Employee ID : {{ $mst->employee_id }}</td>
        <td></td>
    </tr>
    <tr>
        <td>Employee Name : {{ $mst->name }}</td>
        <td></td>
    </tr>
</table>
<table border="1">
    <thead>
        <tr>
            <th>Date</th>
            <th>Clock In</th>
            <th>Clock Out</th>
            <th>Scan In </th>
            <th>Scan Out</th>
            <th>Late</th>
            <th>Early Leaving</th>
            <th>Overtime</th>
            <th>Time Work</th>
            <th>Amount Attendance</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dtl as $row)
        @if ($row->employee_id == $mst->employee_id)
        <tr>
            <td>{{ $row->date }}</td>
            <td>{{ $row->jam_masuk }}</td>
            <td>{{ $row->jam_pulang }}</td>
            <td>{{ $row->scan_masuk }}</td>
            <td>{{ $row->scan_pulang }}</td>
            <td>{{ $row->terlambat }}</td>
            <td>{{ $row->pulang_cepat }}</td>
            <td>{{ $row->lembur }}</td>
            <td>{{ $row->jam_kerja }}</td>
            <td>{{ $row->jml_hadir }}</td>
        </tr>
        @endif
        @endforeach

    </tbody>
</table>
@endforeach
