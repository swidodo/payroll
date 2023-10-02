
<script>
  $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var branch_id = $('#branch_id').val();
        var start_date = $('#from_date').val();
        var end_date = $('#to_date').val();
        getData(branch_id,start_date,end_date);
        function getData(branch_id,start_date,end_date){
            $('#report_rekap_payroll').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                    "url" : 'get-rekap-payroll',
                    "type": 'post',
                    "data" : {branch_id:branch_id, start_date:start_date,end_date:end_date}
                },
                columns: [
                    {
                        data: 'no_employee',
                        name: 'no_employee'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'position',
                        name: 'position'
                    },
                    {
                        data: 'bank_name',
                        name: 'bank_name'
                    },
                    {
                        data: 'account_number',
                        name: 'account_number'
                    },
                    {
                        data: 'basic_salary',
                        name: 'basic_salary'
                    },
                    {
                        data: 'allowance_fixed',
                        name: 'allowance_fixed'
                    },
                    {
                        data: 'allowance_unfixed',
                        name: 'allowance_unfixed'
                    },
                    {
                        data: 'allowance_other',
                        name: 'allowance_other'
                    },
                    {
                        data: 'overtime',
                        name: 'overtime'
                    },
                    {
                        data: 'salary_this_month',
                        name: 'salary_this_month'
                    }, 
                    {
                        data: 'company_pay_bpjs',
                        name: 'company_pay_bpjs'
                    },
                    {
                        data: 'total_salary',
                        name: 'total_salary'
                    },
                    {
                        data: 'company_pay_bpjs_kesehatan',
                        name: 'company_pay_bpjs_kesehatan'
                    },
                    {
                        data: 'company_pay_bpjs_ketenagakerjaan',
                        name: 'company_pay_bpjs_ketenagakerjaan'
                    },
                    {
                        data: 'company_total_pay_bpjs',
                        name: 'company_total_pay_bpjs'
                    },
                    {
                        data: 'employee_pay_bpjs_kesehatan',
                        name: 'employee_pay_bpjs_kesehatan'
                    },
                    {
                        data: 'employee_pay_bpjs_ketenagakerjaan',
                        name: 'employee_pay_bpjs_ketenagakerjaan'
                    },
                    {
                        data: 'employee_total_pay_bpjs',
                        name: 'employee_total_pay_bpjs'
                    }, 
                    {
                        data: 'installment',
                        name: 'installment'
                    }, 
                    {
                        data: 'loans',
                        name: 'loans'
                    }, 
                    {
                        data: 'pph21',
                        name: 'pph21'
                    },
                    {
                        data: 'total_deduction',
                        name: 'total_deduction'
                    },
                    {
                        data: 'take_home_pay',
                        name: 'take_home_pay'
                    }, 
                 ],
            });
        }
        $('#filter_rekap_payroll').on('click',function(e){
            e.preventDefault();
            var branch_id = $('#branch_id').val();
            var start_date = $('#from_date').val();
            var end_date = $('#to_date').val();
            getData(branch_id,start_date,end_date);
        })
         $('#print_rekap_payroll').on('click',function(){
            var branch_id = $('#branch_id').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var type = $('#type_print').val();

            if (from_date =='' || to_date ==''){
                alert('Sorry, from date and to date empty !');
                return false;
            }
            if (type == 'PDF'){
                window.open('rekap-payroll-pdf?from_date='+from_date+'&to_date='+to_date+'&branch_id='+branch_id)
            }
            else if (type == 'EXCEL'){
                window.location.href = 'rekap-payroll-excel?from_date='+from_date+'&to_date='+to_date+'&branch_id='+branch_id;
            }
        })
    });
</script>