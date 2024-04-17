<table>
    <thead>
        <tr>
            <th colspan="2">@if(isset($brch)){{($brch != null) ? strtoupper($brch->name) :'' }}@endif</th>
        </tr>
        <tr>
            <th>Name</th>
            <th class="text-center">Total</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($active))
        @foreach ($active as $active)
        <tr>
            <td>{{ $active->active }}</td>
            <td class="text-center">{{ $active->total }}</td>
        </tr>
        @endforeach
        @endif
        @if(isset($permanent))
        @foreach ($permanent as $permanent)
        <tr>
            <td>{{ $permanent->permanent }}</td>
            <td class="text-center">{{ $permanent->total }}</td>
        </tr>
        @endforeach
        @endif
        @if(isset($in))
        @foreach ($in as $enter)
        <tr>
            <td>{{ $enter->join }}</td>
            <td class="text-center">{{ $enter->total }}</td>
        </tr>
        @endforeach
        @endif
        @if(isset($out))
        @foreach ($out as $over)
        <tr>
            <td>{{ 'EMPLOYEE '.strtoupper($over->status) }}</td>
            <td class="text-center">{{ $over->total }}</td>
        </tr>   
        @endforeach
        @endif
    </tbody>
</table>