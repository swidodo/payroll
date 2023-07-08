<table>
    <thead>
    <tr>
        <th style="font-weight: 700">Employee</th>
        <th style="font-weight: 700">Start Date</th>
        <th style="font-weight: 700">End Date</th>
        <th style="font-weight: 700">Purpose of Trip</th>
        <th style="font-weight: 700">Country</th>
        <th style="font-weight: 700">Description</th>
        <th style="font-weight: 700">Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($travels as $travel)
        <tr>
            <td>
                {{$travel->employee->name ?? '-'}}
            </td>
            <td>
                {{$travel->start_date ?? '-'}}
            </td>
            <td>
                {{$travel->end_date ?? '-'}}
            </td>
            <td>
                {{$travel->purpose_of_visit ?? '-'}}
            </td>
            <td>
                {{$travel->place_of_visit ?? '-'}}
            </td>
            <td>
                {{$travel->description ?? '-'}}
            </td>
            <td>
                {{$travel->status ?? '-'}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
