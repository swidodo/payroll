
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        var department_id = $('#department_id').val();
        var date = $('#date').val();
        getData(department_id,"","","");
        function getData(department_id,employee_id,startdate,enddate){
            $('#daily_report').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                    "url" : 'get-daily-report',
                    "type": 'post',
                    "data" : {
                            department_id:department_id,
                            employee_id:employee_id,
                            startdate:startdate,
                            enddate:enddate
                        }
                    },
                columns: [
                    { data: 'no', name:'employee_id', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                    }},
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'employee_name',
                        name: 'employee_name'
                    },
                    {
                        data: 'time',
                        name: 'time'
                    },
                    {
                        data: 'location_name',
                        name: 'location_name'
                    },
                    {
                        data: 'foto_url',
                        render : function(data,row,type){
                            var link = `<a href="`+data+`" class="btn btn-success w-100" target="_blank">view</a>`;
                            return link;
                        }
                    },
                    {
                        data: 'view_map',
                        name: 'view_map'
                    },
                    
                ],
                
            });
        }
        $('#department_id').on('change', function(){
                var department_id = $(this).val();
                $.ajax({
                    url : 'get-emp-depart',
                    type : 'post',
                    data : {department_id : department_id},
                    dataType: 'json',
                    success : function(respon){
                        html ='';
                        $.each(respon, function(key,val){
                            html +=`<option value="`+val.id+`">`+val.name+`</option>`
                        })
                        $('#employee_id').html(html);
                    }
                })
        })
        $('#filter_report_daily').on('click',function(e){
            e.preventDefault();
            var department_id = $('#department_id').val();
            var employee_id = $('#employee_id').val();
            var startdate = $('#startdate').val();
            var enddate = $('#enddate').val();
            getData(department_id,employee_id,startdate,startdate);
        })  
    });
</script>