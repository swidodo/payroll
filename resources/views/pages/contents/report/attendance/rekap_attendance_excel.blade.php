<table border="1">
    <thead>
        <tr style="background:#cccccc;">
            <th class="border-top border-left" >Employee ID</th>
            <th class="border-top border-left">Employee Name</th>
            <th class="border-top border-left">Work Day</th>
            <th class="border-top border-left">Work Day Actual</th>
            <th class="border-top border-left">Alpha</th>
            <th class="border-top border-left">Ijin</th>
            <th class="border-top border-left">Sakit Dengan Surat</th>
            <th class="border-top border-left">Sakit Tanpa Surat</th>
            <th class="border-top border-left">Cuti</th>
            <th class="border-top border-left">Dispensasi</th>
        </tr>
    </thead>
    <tbody>
         @foreach ($attendance as $row)
        <tr>
            <td align="center" class="border-top border-left border-bottom">{{ $row->noemployee }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->nm }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->wd }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->wda }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->alpha }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->izn }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->sds }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->sts }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->cuti }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->disp }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
