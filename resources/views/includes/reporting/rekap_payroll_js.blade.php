
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
                        render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                    if(base.lastIndexOf(".") != -1)
                                        base = base.substring(0, base.lastIndexOf("."));
                                    return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                    },
                    {
                        data: 'allowance_fixed',
                        render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                    if(base.lastIndexOf(".") != -1)
                                        base = base.substring(0, base.lastIndexOf("."));
                                    return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                    },
                    {
                        data: 'allowance_unfixed',
                        render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                    if(base.lastIndexOf(".") != -1)
                                        base = base.substring(0, base.lastIndexOf("."));
                                    return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                    },
                    {
                        data: 'allowance_other',
                        render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                    if(base.lastIndexOf(".") != -1)
                                        base = base.substring(0, base.lastIndexOf("."));
                                    return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                    },
                    {
                        data: 'overtime',
                        render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                    if(base.lastIndexOf(".") != -1)
                                        base = base.substring(0, base.lastIndexOf("."));
                                    return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                    },
                    {
                        data: 'salary_this_month',
                        render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                    if(base.lastIndexOf(".") != -1)
                                        base = base.substring(0, base.lastIndexOf("."));
                                    return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                    }, 
                    {
                        data: 'employee_pay_bpjs_kesehatan',
                        render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                    if(base.lastIndexOf(".") != -1)
                                        base = base.substring(0, base.lastIndexOf("."));
                                    return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                    },
                    {
                        data: 'employee_pay_bpjs_ketenagakerjaan',
                        render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                    if(base.lastIndexOf(".") != -1)
                                        base = base.substring(0, base.lastIndexOf("."));
                                    return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                    },
                    {
                        data: 'employee_total_pay_bpjs',
                        render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                    if(base.lastIndexOf(".") != -1)
                                        base = base.substring(0, base.lastIndexOf("."));
                                    return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                    }, 
                    {
                        data: 'installment',
                        render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                    if(base.lastIndexOf(".") != -1)
                                        base = base.substring(0, base.lastIndexOf("."));
                                    return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                    }, 
                    {
                        data: 'loans',
                        render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                    if(base.lastIndexOf(".") != -1)
                                        base = base.substring(0, base.lastIndexOf("."));
                                    return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                    }, 
                    {
                        data: 'pph21',
                        render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                    if(base.lastIndexOf(".") != -1)
                                        base = base.substring(0, base.lastIndexOf("."));
                                    return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                    },
                    {
                        data: 'total_deduction',
                        render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                    if(base.lastIndexOf(".") != -1)
                                        base = base.substring(0, base.lastIndexOf("."));
                                    return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                    },
                    {
                        data: 'take_home_pay',
                        render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                    if(base.lastIndexOf(".") != -1)
                                        base = base.substring(0, base.lastIndexOf("."));
                                    return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
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