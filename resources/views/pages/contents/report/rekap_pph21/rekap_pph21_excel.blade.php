<table border="1">
    <thead>
        <tr style="background:#cccccc;">
            <th class="border-top border-left" >Employee ID</th>
            <th class="border-top border-left">Employee Name</th>
            <th class="border-top border-left">Position</th>
            <th class="border-top border-left">Basic Salary</th>
            <th class="border-top border-left">Allowance Fixed</th>
            <th class="border-top border-left">Allowance Unfixed</th>
            <th class="border-top border-left">Allowance Other</th>
            <th class="border-top border-left">Overtime</th>
            <th class="border-top border-left">Salary In Month</th>
            <th class="border-top border-left">Company BPJS</th>
            <th class="border-top border-left">Salary Brutto</th>
            <th class="border-top border-left">Position Allowance</th>
            <th class="border-top border-left">Employee Bpjs</th>
            <th class="border-top border-left">Total Subtraction</th>
            <th class="border-top border-left">Salary Netto</th>
            <th class="border-top border-left">Salary 1 Year</th>
            <th class="border-top border-left">PTKP 1 Year</th>
            <th class="border-top border-left">PKP</th>
            <th class="border-top border-left">PPH21 Owned 1 Year</th>
            <th class="border-top border-left">PPH21 Owned 1 Month</th>
        </tr>
    </thead>
    <tbody>
         @foreach ($pph as $row)
        <tr>
            <td align="left" class="border-top border-left border-bottom">{{ $row->no_employee }}</td>
            <td align="left" class="border-top border-left border-bottom">{{ $row->name }}</td>
            <td align="left" class="border-top border-left border-bottom">{{ $row->position_name }}</td>
            <td align="right" class="border-top border-left border-bottom">{{ $row->salary_pokok }}</td>
            <td align="right" class="border-top border-left border-bottom">{{ $row->total_allowance_fixed }}</td>
            <td align="right" class="border-top border-left border-bottom">{{ $row->total_allowance_unfixed }}</td>
            <td align="right" class="border-top border-left border-bottom">{{ $row->total_allowance_other }}</td>
            <td align="right" class="border-top border-left border-right border-bottom">{{ $row->total_overtime }}</td>
            <td align="right" class="border-top border-left border-right border-bottom">{{ $row->salary_in_month }}</td>
            <td align="right" class="border-top border-left border-right border-bottom">{{ $row->pay_bpjs_company }}</td>
            <td align="right" class="border-top border-left border-right border-bottom">{{ $row->salary_brutto }}</td>
            <td align="right" class="border-top border-left border-right border-bottom">{{ $row->biaya_jabatan }}</td>
            <td align="right" class="border-top border-left border-right border-bottom">{{ $row->pay_bpjs_employee }}</td>
            <td align="right" class="border-top border-left border-right border-bottom">{{ $row->total_pengurangan }}</td>
            <td align="right" class="border-top border-left border-right border-bottom">{{ $row->salary_netto }}</td>
            <td align="right" class="border-top border-left border-right border-bottom">{{ $row->salary_1_tahun }}</td>
            <td align="right" class="border-top border-left border-right border-bottom">{{ $row->ptkp_1_tahun }}</td>
            <td align="right" class="border-top border-left border-right border-bottom">{{ $row->pkp }}</td>
            <td align="right" class="border-top border-left border-right border-bottom">{{ $row->pph21_terhutang_1_tahun }}</td>
            <td align="right" class="border-top border-left border-right border-bottom">{{ $row->pph21_terhutang_1_bulan }}</td>
        </tr>
        @endforeach
        <tr><td  colspan="19" class="border-top border-left border-right border-bottom">Total</td><td class="border-top border-left border-right border-bottom" align="right">{{ $total->total }}</td></tr>

    </tbody>
</table>
