<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<table class="table ">
    <thead>
        <tr>
            <th style="font-weight: 700">Employee</th>
            <th style="font-weight: 700">Leave Type</th>
            <th style="font-weight: 700">Applied on</th>
            <th style="font-weight: 700">Start Date</th>
            <th style="font-weight: 700">End Date</th>
            <th style="font-weight: 700">Total Leave Days</th>
            <th style="font-weight: 700">Status</th>
            <th style="font-weight: 700">Reason</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($leaves as $leave)
            <tr>
                <td>{{$leave->employee->name}}</td>
                <td>{{ isset($leave->leave_type) ? $leave->leave_type->title : ''}}</td>
                <td>{{$leave->applied_on}}</td>
                <td>{{$leave->start_date}}</td>
                <td>{{$leave->end_date}}</td>
                <td>{{$leave->total_leave_days}}</td>
                <td>{{$leave->status}}</td>
                <td>{{$leave->leave_reason}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
