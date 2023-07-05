<table>
    <thead>
    <tr>
        <th style="font-weight: 700">Employee</th>
        <th style="font-weight: 700">Shift</th>
        <th style="font-weight: 700">Break Time</th>
        <th style="font-weight: 700">Date</th>
        <th style="font-weight: 700">Status</th>
        <th style="font-weight: 700">Clock In</th>
        <th style="font-weight: 700">Clock Out</th>
        <th style="font-weight: 700">Late</th>
        <th style="font-weight: 700">Early Leaving</th>
        <th style="font-weight: 700">Overtime</th>
    </tr>
    </thead>
    <tbody>
    @foreach($attendances as $att)
        <tr>
            <td>
                {{$att->employee->name}}
            </td>
            <td>
                {{isset($att->shift) && $att->shift->status == 'Approved' ? $att->shift->shift_type->name : '-'}}
            </td>
            <td>
                {{isset($att->shift->shift_type->break_time) && $att->shift->status == 'Approved' ? date('H:i', strtotime($att->shift->shift_type->break_time->first()->start_time)).' - ' .date('H:i', strtotime($att->shift->shift_type->break_time->first()->end_time))  : '-'}}
            </td>
            <td>
                {{$att->date}}
            </td>
            <td>
                {{$att->status}}
            </td>
            <td>
                {{\Carbon\Carbon::parse(  $att->clock_in)->format('H:i') }}
            </td>
            <td>
                {{\Carbon\Carbon::parse(  $att->clock_out)->format('H:i')}}
            </td>
            <td>
                {{\Carbon\Carbon::parse(  $att->late)->format('H:i')}}
            </td>
            <td>
                {{\Carbon\Carbon::parse(  $att->early_leaving)->format('H:i')}}
            </td>
            <td>
                {{\Carbon\Carbon::parse(  $att->overtime)->format('H:i')}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
