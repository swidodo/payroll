
<table border="1">
    <thead>
        <tr>
            <th border="1">Date</th>
            <th border="1">Shift</th>
            <th border="1">Employee</th>
            <th border="1">Department</th>
            <th border="1">Time</th>
            <th border="1">Location Name </th>
            <th border="1">Longitude</th>
            <th border="1">Latitude</th>
            <th border="1">Description</th>
            <th border="1">Branch name</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($daily as $row)
        <tr>
            <td border="1">{{ $row->date }}</td>
            <td border="1">{{ $row->shift }}</td>
            <td border="1">{{ $row->employee_name }}</td>
            <td border="1">{{ $row->department_name }}</td>
            <td border="1">{{ $row->time }}</td>
            <td border="1">{{ $row->location_name }}</td>
            <td border="1">{{ $row->longitude }}</td>
            <td border="1">{{ $row->latitude }}</td>
            <td border="1">{{ $row->description }}</td>
            <td border="1">{{ $row->branch_name }}</td>
        </tr>
        @endforeach

    </tbody>
</table>
