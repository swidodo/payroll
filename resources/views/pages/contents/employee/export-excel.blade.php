

<table>
    <thead>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Identity Card Number</th>
            <th>Family Card Number</th>
            <th>NPWP Number</th>
            <th>Dob</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Email</th>
            <th>Password</th>
            <th>Employe ID</th>
            <th>Branch</th>
            <th>Department ID</th>
            <th>Designation ID</th>
            <th>Company Doj</th>
            <th>Company Doe</th>
            <th>Document</th>
            <th>Account Holder Name</th>
            <th>Account Number</th>
            <th>Bank Name</th>
            <th>Bank Code</th>
            <th>Branch Location</th>
            <th>Tax payer ID</th>
            <th>Salary Type</th>
            <th>Salary</th>
            <th>Net Salary</th>
            <th>Is Active</th>
            <th>Created By</th>
            <th>Level Approval</th>
            <th>Leave Type</th>
            <th>Employee Type</th>
            <th>Marital Status</th>
            <th>Total Leave</th>
            <th>Total Leave Remaining</th>
            <th>Out Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($employee as $employ)
        <tr>
            <td>{{$employ->user_id}}</td>
            <td>{{$employ->name}}</td>
            <td>{{$employ->identity_card}}</td>
            <td>{{$employ->family_card}}</td>
            <td>{{$employ->npwp_number}}</td>
            <td>{{$employ->dob}}</td>
            <td>{{$employ->gender}}</td>
            <td>{{$employ->phone}}</td>
            <td>{{$employ->address}}</td>
            <td>{{$employ->email}}</td>
            <td>{{$employ->password}}</td>
            <td>{{$employ->employee_id}}</td>
            <td>{{$employ->branch_id}}</td>
            <td>{{$employ->department_id}}</td>
            <td>{{$employ->designation_id}}</td>
            <td>{{$employ->company_doj}}</td>
            <td>{{$employ->company_doe}}</td>
            <td>{{$employ->documents}}</td>
            <td>{{$employ->account_holder_name}}</td>
            <td>{{$employ->account_number}}</td>
            <td>{{$employ->bank_name}}</td>
            <td>{{$employ->bank_identifier_code}}</td>
            <td>{{$employ->branch_location}}</td>
            <td>{{$employ->tax_payer_id}}</td>
            <td>{{$employ->salary_type}}</td>
            <td>{{$employ->salary}}</td>
            <td>{{$employ->net_salary}}</td>
            <td>{{$employ->is_active}}</td>
            <td>{{$employ->created_by}}</td>
            <td>{{$employ->level_approval}}</td>
            <td>{{$employ->leave_type}}</td>
            <td>{{$employ->employee_type}}</td>
            <td>{{$employ->marital_status}}</td>
            <td>{{$employ->total_leave}}</td>
            <td>{{$employ->total_leave_remaining}}</td>
            <td>{{$employ->out_date}}</td>
            <td>{{$employ->status}}</td>
        </tr>
    @endforeach
</tbody>
</table>
