
<table border="1">
    <thead>
        <tr>
            <th border="1">Employee ID</th>
            <th border="1">Employee</th>
            <th border="1">Position</th>
            <th border="1">Department</th>
            <th border="1">Status </th>
            <th border="1">Start Date</th>
            <th border="1">End Date</th>
            <th border="1">Remainder</th>
           
        </tr>
    </thead>
    <tbody>
        @foreach ($contract as $row)
        <tr>
            <td border="1">{{ $row->no_employee }}</td>
            <td border="1">{{ $row->employee_name }}</td>
            <td border="1">{{ $row->position_name }}</td>
            <td border="1">{{ $row->department_name }}</td>
            <td border="1">{{ $row->status }}</td>
            <td border="1">{{ $row->startdate }}</td>
            <td border="1">{{ $row->enddate }}</td>
            <td border="1">
                @if ($row->remainder <= 31 && $row->status_contract =='AVAILABLE')
                <span class="badge badge-warning  p-3 text-dark fw-bold w-100">{{$row->remainder}} DAY</span>
                @endif
                @if($row->remainder > 31 && $row->status_contract =='AVAILABLE')
                    <span class="badge badge-success p-3 text-dark fw-bold w-100">{{ $row->remainder}} DAY</span>
                @endif
                @if($row->remainder <= 0 && $row->status_contract =='EXPIRED CONTRACT')
                    <span class="badge badge-danger p-3 text-dark fw-bold w-100">EXPIRED</span>
                @endif  
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
