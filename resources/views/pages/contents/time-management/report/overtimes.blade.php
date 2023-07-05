    <table>
        <thead>
            <tr>
                <th style="font-weight: 700">Employee</th>
                <th style="font-weight: 700">Overtime Type</th>
                <th style="font-weight: 700">Day type</th>
                <th style="font-weight: 700">Start Date</th>
                <th style="font-weight: 700">End Date</th>
                <th style="font-weight: 700">Start Time</th>
                <th style="font-weight: 700">End Time</th>
                <th style="font-weight: 700">Notes</th>
                <th style="font-weight: 700">Status</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($overtimes as $overtime)
            <tr>
                <td>{{$overtime->employee->name}}</td>
                <td>{{ isset($overtime->overtime_type) ? $overtime->overtime_type->name : ''}}</td>
                <td>{{ isset($overtime->day_type) ? $overtime->day_type->name : ''}}</td>
                <td>{{$overtime->start_date}}</td>
                <td>{{$overtime->end_date}}</td>
                <td>{{$overtime->start_time}}</td>
                <td>{{$overtime->end_time}}</td>
                <td>{{$overtime->notes}}</td>
                <td>{{$overtime->status}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
