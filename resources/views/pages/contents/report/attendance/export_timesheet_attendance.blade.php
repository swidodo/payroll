
<table class="table table-striped table-bordered table-hover table-sm" id="rekap_attendance">
    <thead>
        <tr>
            <th>No</th>
            <th>Employee ID</th>
            <th>Employee Name</th>
            @foreach ($header as $h)
                <th>{{$h}}</th>
            @endforeach
            @foreach ($headerEnd as $hE)
                <th>{{$hE}}</th>
            @endforeach
            <th>WDA</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($data as $key=>$dt)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $dt->employee_id }}</td>
                <td>{{ $dt->employee_name }}</td>
                @foreach ($header as $val)
                    @php
                        if($val != 'wda'){
                            $is = 's'.$val;
                        }
                    @endphp
                    <td>{{$dt->$is}}</td>
                @endforeach
                @foreach ($headerEnd as $hEl)
                    @php
                        if($val != 'wda'){
                            $ise = 'e'.$hEl;
                        }
                    @endphp
                    <td>{{$dt->$ise}}</td>
                @endforeach
                <td>{{$dt->wda}}</td>
            </tr>
            @php
                $i++;
            @endphp
        @endforeach                                       
    </tbody>
</table>
                    
