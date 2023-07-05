<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let currentDate = new Date().toJSON().slice(0, 10);
        getData(currentDate,currentDate);
        function getData(from_date,to_date){
            $('#report_salary').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                    "url" : 'get-reporting-salary',
                },
                columns: [
                {
                    data: 'employee_id',
                    name: 'employee_id'
                },
                {
                    data: 'name',
                    name : 'name'
                },
                {
                    data: 'basic_salary',
                    name : 'basic_salary'
                },
                {
                    data: 'salary',
                    name: 'salary'
                },
                {
                    data: 'allowance_finance',
                    name : 'allowance_finance'
                },
                {
                    data: 'reimbursts',
                    name : 'reimbursts'
                },
                {
                    data: 'overtime',
                    name : 'overtime'
                },
                {
                    data: 'cash',
                    name : 'cash'
                },
                {
                    data: 'loan',
                    name : 'loan'
                },
                {
                    data: 'denda',
                    name : 'denda'
                }
                ],
            });
        }
        $('#filter_attandance').on('click', function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if (from_date !='' && to_date !=''){
                getData(from_date,to_date);
            }else{
                alert('Sorry, from date and to date empty !');
            }
        })
        $('#print_attandance').on('click',function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var type = $('#type_print').val();

            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if (from_date =='' && to_date ==''){
                alert('Sorry, from date and to date empty !');
            }
            if (type == 'PDF'){
                window.open('reporting-attandance-pdf?from_date='+from_date+'&to_date='+to_date)
            }
            else if (type == 'EXCEL'){
                window.location.href = 'reporting-attandance-excel?from_date='+from_date+'&to_date='+to_date;
            }
        })

    });
</script>
