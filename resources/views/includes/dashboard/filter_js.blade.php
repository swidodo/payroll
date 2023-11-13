<script>
     // default load halaman
    var defaultbranch = $('#branch_id').val();
    parse_employee_gander(defaultbranch)
    employee_status(defaultbranch)
    department(defaultbranch)
    monthly_turnover(defaultbranch)
    employee_report(defaultbranch)
    employee_report_year(defaultbranch)
    var arr = [];
    $('#branch_id').on('change',function(){
        var branch = $('#branch_id').val();
        parse_employee_gander(defaultbranch)
        employee_status(defaultbranch)
        department(defaultbranch)
        monthly_turnover(defaultbranch)
        employee_report(defaultbranch)
        employee_report_year(defaultbranch)
    })
    // process get data
    function header(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }
    function employee_status(branch){
        header();
        $. ajax({
            url :'chart-employee-status',
            type : 'GET',
            data : {branch_id:branch},
            dataType : 'json',
            success : function(response){
                var data = response.data;
                if (data.length > 0){
                    var total = parseInt(data[0].contract) + parseInt(data[0].permanent) + parseInt(data[0].probation) + parseInt(data[0].daily_work) + parseInt(data[0].freelance);
                    var contract = parseInt(data[0].contract)
                    var permanent = parseInt(data[0].permanent)
                    var daily_work = parseInt(data[0].daily_work)
                    var probation = parseInt(data[0].probation)
                    // var freelance = parseInt(data[0].freelance) 
                    $('#totalEmployee').text(total);
                    $('#totalJobholder').text(permanent);
                    $('#totalContractEmployee').text(contract);
                    $('#totalWorkerDayEmployee').text(daily_work);
                    $('#totalProbationEmployee').text(probation);                  
                }
            },
        })
    }
    
    function parse_employee_gander(branch){
        header();
        $. ajax({
            url :'chart-employee-gender',
            type : 'GET',
            data : {branch_id : branch},
            dataType : 'json',
            success : function(response){
                var data = response.data;
                if (data.length > 0){
                    var male = '0';
                    var female = '0';
                    $.each(data,function(key,val){
                        if(val.label == 'MALE')
                        {
                            male = val.value;
                        }
                        if(val.label == 'FEMALE'){
                            female = val.value;
                        }
                    })
                    gender(parseInt(male),parseInt(female));
                }
            },
            error :function(){
                alert('terjadi kesalahan jaringan !');
            }
        })
    }
    function monthly_turnover(branch){
        header();
        $.ajax({
            url :'chart-employee_monthly_turnover',
            type : 'GET',
            data :{branch_id :branch},
            dataType : 'json',
            success :function (response){
                var data = (response.data[0].turnover == null) ? 0 : response.data[0].turnover;
                turnover(data);
            },
        });
    }
    function department(branch){
        header();
        $.ajax({
            url :'chart-employee_department',
            type : 'GET',
            data :{branch_id :branch},
            dataType : 'json',
            success :function (respon){
                chartdepartment(respon.data)
            }
        })
    }
    function employee_report(branch){
        header();
        $.ajax({
            url :'chart-report-employee',
            type : 'GET',
            data :{branch_id :branch},
            dataType : 'json',
            success :function (respon){
                rep_employee(respon)
            }
        })
    }
    function employee_report_year(branch){
        header();
        $.ajax({
            url :'chart-report-employee-year',
            type : 'GET',
            data :{branch_id :branch},
            dataType : 'json',
            success :function (respon){
                reportEmployeeYear(respon)
            }
        })
    }
    </script>
