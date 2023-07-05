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
            $('#report_attandance').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                    "url" : 'get-reporting-attandance',
                    "data" : {from_date:from_date, to_date:to_date}
                },
                columns: [
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'employee_id',
                    name: 'employee_id'
                },
                {
                    data: 'name',
                    name : 'name'
                },
                {
                    data: 'jam_masuk',
                    name : 'jam_masuk'
                },
                {
                    data: 'jam_pulang',
                    name : 'jam_pulang'
                },
                {
                    data: 'scan_masuk',
                    name : 'scan_masuk'
                },
                {
                    data: 'scan_pulang',
                    name : 'scan_pulang'
                },
                {
                    data: 'terlambat',
                    name : 'terlambat'
                },
                {
                    data: 'pulang_cepat',
                    name : 'pulang_cepat'
                },
                {
                    data: 'lembur',
                    name : 'lembur'
                },
                {
                    data: 'jam_kerja',
                    name :'jam_kerja'
                },
                {
                    data: 'jml_hadir',
                    name : 'jml_hadir'
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
