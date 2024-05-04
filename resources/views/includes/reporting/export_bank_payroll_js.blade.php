
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
            $('#data_export_payroll').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                    "url" : 'get-bank-payroll',
                    "type": 'post',
                    "data" : {branch_id:branch_id, start_date:start_date,end_date:end_date}
                },
                columns: [
                    {
                        data: 'account_number',
                        name: 'account_number'
                    },
                    {
                        data: 'take_home_pay',
                        render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                    }, 
                    {
                        data: 'no_employee',
                        name: 'no_employee'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'department',
                        name: 'department'
                    },
                    {
                        data: 'date',
                        name: 'date'
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