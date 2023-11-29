

<table>
    <thead>
        <tr>
            <th>EMPLOYEE ID</th>
            <th>NAME EMPLOYEE</th>
            <th>IDENTITY CARD</th>
            <th>FAMILY CARD</th>
            <th>NPWP</th>
            <th>BIRTH OF DATE</th>
            <th>GENDER</th>
            <th>RELIGION</th>
            <th>MARITAL STATUS</th>
            <th>PHONE</th>
            <th>ADDRESS</th>
            <th>EMAIL</th>
            <th>EMPLOYEE TYPE</th>
            <th>WORK TYPE</th>
            <th>DEPARTMENT NAME</th>
            <th>POSITION NAME</th>
            <th>ACCOUNT HOLDER NAME</th>
            <th>BANK NAME</th>
            <th>ACCOUNT NUMBER</th>
            <th>BANK CODE</th>
            <th>BRANCH BANK</th>
            <th>STATUS</th>
            <th>DATE OF JOINT</th>
            <th>DATE OF RESIGN</th>
            <th>BRANCH NAME</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employee as $employ)
        <tr>
            <td>{{$employ->no_employee}}</td>
            <td>{{$employ->name}}</td>
            <td>{{"'".$employ->identity_card}}</td>
            <td>{{ "'".$employ->family_card}}</td>
            <td>{{$employ->npwp_number}}</td>
            <td>{{$employ->dob}}</td>
            <td>{{$employ->gender}}</td>
            <td>{{$employ->religion}}</td>
            <td>{{$employ->marital_name}}</td>
            <td>{{$employ->phone}}</td>
            <td>{{$employ->address}}</td>
            <td>{{$employ->email}}</td>
            <td>{{$employ->employee_type}}</td>
            <td>{{$employ->work_type}}</td>
            <td>{{$employ->departement_code}}</td>
            <td>{{$employ->position_code}}</td>
            <td>{{$employ->account_holder_name}}</td>
            <td>{{$employ->bank_name}}</td>
            <td>{{$employ->account_number}}</td>
            <td>{{$employ->bank_identifier_code}}</td>
            <td>{{$employ->bank_location}}</td>
            <td>{{$employ->status}}</td>
            <td>{{$employ->company_doj}}</td>
            <td>{{$employ->company_doe}}</td>
            <td>{{$employ->branch_name}}</td>
        </tr>
    @endforeach
</tbody>
</table>
