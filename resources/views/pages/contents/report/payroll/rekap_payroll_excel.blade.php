<table border="1">
    <thead>
        <tr style="background:#cccccc;">
            <th class="border-top border-left" >Employee ID</th>
            <th class="border-top border-left">Employee Name</th>
            <th class="border-top border-left">Position</th>
            <th class="border-top border-left">Bank Name</th>
            <th class="border-top border-left">Account Number</th>
            <th class="border-top border-left">Basic Salary</th>
            <th class="border-top border-left">Allowance Fixed</th>
            <th class="border-top border-left">Allowance Unfixed</th>
            <th class="border-top border-left">Allowance Other</th>
            <th class="border-top border-left">Overtime</th>
            <th class="border-top border-left">Salary This Month</th>
            <th class="border-top border-left">Company Pay BPJS</th>
            <th class="border-top border-left">Total Salary</th>
            <th class="border-top border-left">Company Pay BPJS Kesehatan</th>
            <th class="border-top border-left">Company Pay BPJS Ketenagakerjaan</th>
            <th class="border-top border-left">Total Company Pay BPJS</th> 
            <th class="border-top border-left">Employee Pay BPJS Kesehatan</th>
            <th class="border-top border-left">Employee Pay BPJS Ketenagakerjaan</th>
            <th class="border-top border-left">Total Employee Pay BPJS</th>
            <th class="border-top border-left">Installment</th>
            <th class="border-top border-left">Loans</th>
            <th class="border-top border-left">Pph21</th>
            <th class="border-top border-left">Total Deduction</th>
            <th class="border-top border-left">Take Home Pay</th>
        </tr>
    </thead>
    <tbody>
         @foreach ($pay as $row)
        <tr>
            <td align="center" class="border-top border-left border-bottom">{{ $row->no_employee }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->name }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->position }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->bank_name }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->account_number }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->basic_salary }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->allowance_fixed }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->allowance_unfixed }}</td>
            <td align="center" class="border-top border-left border-bottom">{{ $row->allowance_other }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->overtime }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->salary_this_month }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->company_pay_bpjs }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->total_salary }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->company_pay_bpjs_kesehatan }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->company_pay_bpjs_ketenagakerjaan }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->company_total_pay_bpjs }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->employee_pay_bpjs_kesehatan }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->employee_pay_bpjs_ketenagakerjaan }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->employee_total_pay_bpjs }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->installment }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->loans }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->pph21 }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->total_deduction }}</td>
            <td align="center" class="border-top border-left border-right border-bottom">{{ $row->take_home_pay }}</td>
        </tr>
        @endforeach
        <tr><td  colspan="23" class="border-top border-left border-right border-bottom">Total</td><td class="border-top border-left border-right border-bottom">{{ $total->total }}</td></tr>

    </tbody>
</table>
