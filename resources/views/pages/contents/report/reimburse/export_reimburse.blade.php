
<table border="1">
    <thead>
        <tr>
            <th border="1">Employee ID</th>
            <th border="1">Employee Name</th>
            <th border="1">Date</th>
            <th border="1">Reimbursement</th>
            <th border="1">Amount </th>
            <th border="1">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reimburse as $row)
        <tr>
            <td border="1">{{ $row->no_employee }}</td>
            <td border="1">{{ $row->employee_name }}</td>
            <td border="1">{{ $row->date }}</td>
            <td border="1">{{ $row->reimburst_name }}</td>
            <td border="1">{{ $row->amount }}</td>
            <td border="1">{{ $row->status }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4"><b>TOTAL</b></td>
            <td><b>{{ ($total->total !=null ) ? $total->total : '0' }}</b></td>
            <td></td>
        </tr>

    </tbody>
</table>
