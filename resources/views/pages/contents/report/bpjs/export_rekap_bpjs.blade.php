
<table border="1">
    <thead>
        <tr>
            <th border="1">Employee ID</th>
            <th border="1">Employee</th>
            <th border="1">BPJS Kesehatan</th>
            <th border="1">BPJS Ketenagakerjaan</th>
            <th border="1">Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bpjs as $row)
        <tr>
            <td border="1">{{ $row->employee_no }}</td>
            <td border="1">{{ $row->employee_name }}</td>
            <td border="1">{{ $row->bpjs_kesehatan }}</td>
            <td border="1">{{ $row->bpjs_ketenagakerjaan }}</td>
            <td border="1">{{ $row->total_bpjs }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4"><b>TOTAL</b></td>
            <td><b>{{ ($total->total !=null ) ? $total->total : '0' }}</b></td>
        </tr>

    </tbody>
</table>
