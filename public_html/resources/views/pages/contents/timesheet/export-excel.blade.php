<table>
    <thead>
    <tr>
        <th style="font-weight: 700">Employee</th>
        <th style="font-weight: 700">Start Date</th>
        <th style="font-weight: 700">End Date</th>
        <th style="font-weight: 700">Duration</th>
        <th style="font-weight: 700">Task / Project</th>
        <th style="font-weight: 700">Client</th>
        <th style="font-weight: 700">Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($timesheets as $timesheet)
        <tr>
            <td>
                {{$timesheet->employee->name ?? '-'}}
            </td>
            <td>
                {{$timesheet->start_date ?? '-'}}
            </td>
            <td>
                {{$timesheet->end_date ?? '-'}}
            </td>
            <td>
                {{$timesheet->duration ?? '-'}}
            </td>
            <td>
                {{$timesheet->task_or_project ?? '-'}}
            </td>
            <td>
                {{$timesheet->client_company ?? '-'}}
            </td>
            <td>
                {{$timesheet->status ?? '-'}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
