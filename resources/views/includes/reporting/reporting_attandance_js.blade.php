<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let startDate = new Date().toJSON().slice(0, 10);
        let endDate = new Date().toJSON().slice(0, 10);
        let branch = $('#branch_id').val();
        getData(branch,startDate,endDate);
        function getData(branch,from_date,to_date){
            $('#report_attandance').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                    "url" : 'get-reporting-attandance',
                    "data" : {branch_id:branch,from_date:from_date, to_date:to_date}
                },
                columns: [
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'no_employee',
                    name: 'no_employee'
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
            let branch = $('#branch_id').val();
            if (from_date !='' && to_date !=''){
                getData(branch,from_date,to_date);
            }else{
                alert('Sorry, from date and to date empty !');
            }
        })
        $('#print_attandance').on('click',function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            let branch = $('#branch_id').val();
            var type = $('#type_print').val();
            if (from_date =='' && to_date ==''){
                alert('Sorry, from date and to date empty !');
            }
            if (type == 'PDF'){
                window.open('reporting-attandance-pdf?branch_id='+branch+'&from_date='+from_date+'&to_date='+to_date)
            }
            else if (type == 'EXCEL'){
                window.location.href = 'reporting-attandance-excel?branch_id='+branch+'&from_date='+from_date+'&to_date='+to_date;
            }
        })

    });
</script>
