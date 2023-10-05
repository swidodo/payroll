
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
            $('#report_rekap_attendance').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                    "url" : 'get-rekap-attendance',
                    "type": 'post',
                    "data" : {branch_id:branch_id, startdate:start_date,enddate:end_date}
                },
                columns: [
                    {
                        data: 'noemployee',
                        name: 'noemployee'
                    },
                    {
                        data: 'nm',
                        name: 'nm'
                    },
                    {
                        data: 'wd',
                        name: 'wd'
                    },
                    {
                        data: 'wda',
                        name: 'wda'
                    },
                    {
                        data: 'alpha',
                        name: 'alpha'
                    },
                    {
                        data: 'izn',
                        name: 'izn'
                    },
                    {
                        data: 'sds',
                        name: 'sds'
                    },
                    {
                        data: 'sts',
                        name: 'sts'
                    },
                    {
                        data: 'cuti',
                        name: 'cuti'
                    },
                    {
                        data: 'disp',
                        name: 'disp'
                    },
                 ],
            });
        }
        $('#filter_rekap_attendance').on('click',function(e){
            e.preventDefault();
            var branch_id = $('#branch_id').val();
            var start_date = $('#from_date').val();
            var end_date = $('#to_date').val();
            getData(branch_id,start_date,end_date);
        })
         $('#print_rekap_attendance').on('click',function(){
            var branch_id = $('#branch_id').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var type = $('#type_print').val();

            if (from_date =='' || to_date ==''){
                alert('Sorry, from date and to date empty !');
                return false;
            }
            if (type == 'PDF'){
                window.open('rekap-attendance-pdf?from_date='+from_date+'&to_date='+to_date+'&branch_id='+branch_id)
            }
            else if (type == 'EXCEL'){
                window.location.href = 'rekap-attendance-excel?from_date='+from_date+'&to_date='+to_date+'&branch_id='+branch_id;
            }
        })
    });
</script>