<script>
    $('.filter_1').attr('data-bs-toggle',"dropdown");
    $('.filter_2').attr('data-bs-toggle',"dropdown");
    $('.filter_3').attr('data-bs-toggle',"dropdown");
    $('.filter_4').attr('data-bs-toggle',"dropdown");

    // default load halaman
    var defaultbranch = $('#branch_id').val();
    var text1 = "Active Staff";
    $('#header_1').text(text1)
    var area1 = '#filter_area_1';
    active_staff(area1, defaultbranch);
    var text2 = "Age Average";
    $('#header_2').text(text2)
    var area2 = '#filter_area_2';
    age_average(area2, defaultbranch)
    var text3 = "Education Level";
    $('#header_3').text(text3)
    var area3 = '#filter_area_3';
    parse_employee_education(area3, defaultbranch);
    var text4 = "Employee Religion";
    $('#header_4').text(text4)
    var area4 = '#filter_area_4';
    employee_religion(area4, defaultbranch)

    $('.filter_1').on('click',function(e){
        e.preventDefault();
        var menu = `
        <a href="" class="dropdown-item">View on insight</a>
        <a href="" class="dropdown-item">Refresh data</a>
        <hr style="margin-top:-3px;">
        <a href="" class="dropdown-item disabled" style="margin-top:-12px !important;font-size:9pt;font-weight:bold">CHANGE CHART</a>
        <a href="#" id="active_staff1" class="dropdown-item `+validate_at()+`">Active Staff</a>
        <a href="" id="age_average1" class="dropdown-item `+validate_aa()+`">Age Average</a>
        <a href="" id="education_level1" class="dropdown-item `+validate_el()+`">Education Level</a>
        <a href="" id="employee_religion1" class="dropdown-item `+validate_er()+`">Employee Religion</a>
        <a href="" id="employee_status1" class="dropdown-item `+validate_es()+`">Employee Status</a>
        <a href="" id="gender_diversity1" class="dropdown-item `+validate_gd()+`">Gender Diversity</a>
        <a href="" id="job_level1" class="dropdown-item `+validate_jl()+`">Job Level</a>
        <a href="" id="length_of_service1" class="dropdown-item `+validate_los()+`">Length Of Service</a>
        <a href="" id="monthly_turnover1" class="dropdown-item `+validate_mt()+`">Monthly Turnover</a>
        `;
        $('#result_filter_1').html(menu)
    })
    $('.filter_2').on('click',function(e){
        e.preventDefault();
        var menu = `
        <a href="" class="dropdown-item">View on insight</a>
        <a href="" class="dropdown-item">Refresh data</a>
        <hr style="margin-top:-3px;">
        <a href="" class="dropdown-item disabled" style="margin-top:-12px !important;font-size:9pt;font-weight:bold">CHANGE CHART</a>
        <a href="#" id="active_staff2" class="dropdown-item `+validate_at()+`">Active Staff</a>
        <a href="" id="age_average2" class="dropdown-item `+validate_aa()+`">Age Average</a>
        <a href="" id="education_level2" class="dropdown-item `+validate_el()+`">Education Level</a>
        <a href="" id="employee_religion2" class="dropdown-item `+validate_er()+`">Employee Religion</a>
        <a href="" id="employee_status2" class="dropdown-item `+validate_es()+`">Employee Status</a>
        <a href="" id="gender_diversity2" class="dropdown-item `+validate_gd()+`">Gender Diversity</a>
        <a href="" id="job_level2" class="dropdown-item  `+validate_jl()+`">Job Level</a>
        <a href="" id="length_of_service2" class="dropdown-item `+validate_los()+`">Length Of Service</a>
        <a href="" id="monthly_turnover2" class="dropdown-item `+validate_mt()+`">Monthly Turnover</a>
        `;
        $('#result_filter_2').html(menu)
    })
    $('.filter_3').on('click',function(e){
        e.preventDefault();
        var menu = `
        <a href="" class="dropdown-item">View on insight</a>
        <a href="" class="dropdown-item">Refresh data</a>
        <hr style="margin-top:-3px;">
        <a href="" class="dropdown-item disabled" style="margin-top:-12px !important;font-size:9pt;font-weight:bold">CHANGE CHART</a>
        <a href="#" id="active_staff3" class="dropdown-item `+validate_at()+`">Active Staff</a>
        <a href="" id="age_average3" class="dropdown-item `+validate_aa()+`">Age Average</a>
        <a href="" id="education_level3" class="dropdown-item `+validate_el()+`">Education Level</a>
        <a href="" id="employee_religion3" class="dropdown-item `+validate_er()+`">Employee Religion</a>
        <a href="" id="employee_status3" class="dropdown-item `+validate_es()+`">Employee Status</a>
        <a href="" id="gender_diversity3" class="dropdown-item `+validate_gd()+`">Gender Diversity</a>
        <a href="" id="job_level3" class="dropdown-item  `+validate_jl()+`">Job Level</a>
        <a href="" id="length_of_service3" class="dropdown-item `+validate_los()+`">Length Of Service</a>
        <a href="" id="monthly_turnover3" class="dropdown-item `+validate_mt()+`">Monthly Turnover</a>
        `;
        $('#result_filter_3').html(menu)
    })
    $('.filter_4').on('click',function(e){
        e.preventDefault();
        var menu = `
        <a href="" class="dropdown-item">View on insight</a>
        <a href="" class="dropdown-item">Refresh data</a>
        <hr style="margin-top:-3px;">
        <a href="" class="dropdown-item disabled" style="margin-top:-12px !important;font-size:9pt;font-weight:bold">CHANGE CHART</a>
        <a href="#" id="active_staff4" class="dropdown-item `+validate_at()+`">Active Staff</a>
        <a href="" id="age_average4" class="dropdown-item `+validate_aa()+`">Age Average</a>
        <a href="" id="education_level4" class="dropdown-item `+validate_el()+`">Education Level</a>
        <a href="" id="employee_religion4" class="dropdown-item `+validate_er()+`">Employee Religion</a>
        <a href="" id="employee_status4" class="dropdown-item `+validate_es()+`">Employee Status</a>
        <a href="" id="gender_diversity4" class="dropdown-item  `+validate_gd()+`">Gender Diversity</a>
        <a href="" id="job_level4" class="dropdown-item `+validate_jl()+`">Job Level</a>
        <a href="" id="length_of_service4" class="dropdown-item `+validate_los()+`">Length Of Service</a>
        <a href="" id="monthly_turnover4" class="dropdown-item `+validate_mt()+`">Monthly Turnover</a>
        `;
        $('#result_filter_4').html(menu)
    })
    // action filter 1
    $(document).on('click','#active_staff1',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_1').text(text);
        var area = '#filter_area_1';
        active_staff(area,branch);
    })
    $(document).on('click','#age_average1',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_1').text(text)
        var area = '#filter_area_1';
        age_average(area,branch);

    })
    $(document).on('click','#education_level1',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_1').text(text)
        var area = '#filter_area_1';
        parse_employee_education(area,branch);
    })
    $(document).on('click','#employee_religion1',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_1').text(text)
        var area = '#filter_area_1';
        employee_religion(area,branch)
    })
    $(document).on('click','#employee_status1',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_1').text(text)
        var area = '#filter_area_1';
        employee_status(area,branch);

    })
    $(document).on('click','#gender_diversity1',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_1').text(text)
        var area = '#filter_area_1';
        parse_employee_gander(area,branch);
    })
    $(document).on('click','#job_level1',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_1').text(text)
        var area = '#filter_area_1';
        job_level(area,branch);
    })
    $(document).on('click','#length_of_service1',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_1').text(text)
        var area = '#filter_area_1';
        lenght_service(area,branch);
    })
    $(document).on('click','#monthly_turnover1',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_1').text(text)
        var area = '#filter_area_1';
        monthly_turnover(area,branch);
    })
    // end filter 1
    // start filter 2
    $(document).on('click','#active_staff2',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_2').text(text)
        var area = '#filter_area_2';
        active_staff(area,branch);
    })
    $(document).on('click','#age_average2',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_2').text(text);
        var area = '#filter_area_2';
        age_average(area,branch);
    })
    $(document).on('click','#education_level2',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_2').text(text)
        var area = '#filter_area_2';
        parse_employee_education(area,branch);
    })
    $(document).on('click','#employee_religion2',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_2').text(text)
        var area = '#filter_area_2';
        employee_religion(area,branch)
    })
    $(document).on('click','#employee_status2',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text2 = $(this).text();
        $('#header_2').text(text2)
        var area = '#filter_area_2';
        employee_status(area,branch);
    })
    $(document).on('click','#gender_diversity2',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_2').text(text)
        var area = '#filter_area_2';
        parse_employee_gander(area,branch);
    })
    $(document).on('click','#job_level2',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_2').text(text)
        var area = '#filter_area_2';
        job_level(area,branch);
    })
    $(document).on('click','#length_of_service2',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_2').text(text)
        var area = '#filter_area_2';
        lenght_service(area,branch);
    })
    $(document).on('click','#monthly_turnover2',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_2').text(text)
        var area = '#filter_area_2';
        monthly_turnover(area,branch);
    })
    // end filter 2
    // start filter 3
    $(document).on('click','#active_staff3',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_3').text(text)
        var area = '#filter_area_3';
        active_staff(area,branch);
    })
    $(document).on('click','#age_average3',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_3').text(text)
        var area = '#filter_area_3';
        age_average(area,branch);
    })
    $(document).on('click','#education_level3',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_3').text(text)
        var area = '#filter_area_3';
        parse_employee_education(area,branch);
    })
    $(document).on('click','#employee_religion3',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_3').text(text)
        var area = '#filter_area_3';
        employee_religion(area,branch)
    })
    $(document).on('click','#employee_status3',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text3 = $(this).text();
        $('#header_3').text(text3)
        var area = '#filter_area_3';
        employee_status(area,branch);
    })
    $(document).on('click','#gender_diversity3',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_3').text(text)
        var area = '#filter_area_3';
        parse_employee_gander(area,branch);
    })
    $(document).on('click','#job_level3',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_3').text(text)
        var area = '#filter_area_3';
        job_level(area,branch);
    })
    $(document).on('click','#length_of_service3',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_3').text(text)
        var area = '#filter_area_3';
        lenght_service(area,branch);
    })
    $(document).on('click','#monthly_turnover3',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_3').text(text)
        var area = '#filter_area_3';
        monthly_turnover(area,branch);
    })
    // end filter 3
    // start filter 4
    $(document).on('click','#active_staff4',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_4').text(text)
        var area = '#filter_area_4';
        active_staff(area,branch);
    })
    $(document).on('click','#age_average4',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_4').text(text)
        var area = '#filter_area_4';
        age_average(area,branch);
    })
    $(document).on('click','#education_level4',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_4').text(text)
        var area = '#filter_area_4';
        parse_employee_education(area,branch);
    })
    $(document).on('click','#employee_religion4',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_4').text(text)
        var area = '#filter_area_4';
        employee_religion(area,branch)
    })
    $(document).on('click','#employee_status4',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text4 = $(this).text();
        $('#header_4').text(text4)
        var area = '#filter_area_4';
        employee_status(area,branch);
    })
    $(document).on('click','#gender_diversity4',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_4').text(text)
        var area = '#filter_area_4';
        parse_employee_gander(area,branch);
    })
    $(document).on('click','#job_level4',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_4').text(text)
        var area = '#filter_area_4';
        job_level(area,branch);
    })
    $(document).on('click','#length_of_service4',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_4').text(text)
        var area = '#filter_area_4';
        lenght_service(area,branch);
    })
    $(document).on('click','#monthly_turnover4',function(e){
        e.preventDefault();
        var branch = $('#branch_id').val();
        var text = $(this).text();
        $('#header_4').text(text)
        var area = '#filter_area_4';
        monthly_turnover(area,branch);
    })
    // end filter 4

    function validate_at(){
        var h_1 = $('#header_1').text();
        var h_2 = $('#header_2').text();
        var h_3 = $('#header_3').text();
        var h_4 = $('#header_4').text();
        if (h_1 ==="Active Staff" | h_2 ==="Active Staff" | h_3 ==="Active Staff" | h_4 ==="Active Staff"){
            var link = 'disabled';
        }else{
            var link = '';
        }
        return link;
    }
    function validate_aa(){
        var h_1 = $('#header_1').text();
        var h_2 = $('#header_2').text();
        var h_3 = $('#header_3').text();
        var h_4 = $('#header_4').text();
        if (h_1 ==="Age Average" | h_2 ==="Age Average" | h_3 ==="Age Average" | h_4 ==="Age Average"){
            var link = 'disabled';
        }else{
            var link = '';
        }
        return link;
    }
    function validate_el(){
        var h_1 = $('#header_1').text();
        var h_2 = $('#header_2').text();
        var h_3 = $('#header_3').text();
        var h_4 = $('#header_4').text();
        if (h_1 ==="Education Level" | h_2 ==="Education Level" | h_3 ==="Education Level" | h_4 ==="Education Level"){
            var link = 'disabled';
        }else{
            var link = '';
        }
        return link;
    }
    function validate_er(){
        var h_1 = $('#header_1').text();
        var h_2 = $('#header_2').text();
        var h_3 = $('#header_3').text();
        var h_4 = $('#header_4').text();
        if (h_1 ==="Employee Religion" | h_2 ==="Employee Religion" | h_3 ==="Employee Religion" | h_4 ==="Employee Religion"){
            var link = 'disabled';
        }else{
            var link = '';
        }
        return link;
    }
    function validate_es(){
        var h_1 = $('#header_1').text();
        var h_2 = $('#header_2').text();
        var h_3 = $('#header_3').text();
        var h_4 = $('#header_4').text();
        if (h_1 ==="Employee Status" | h_2 ==="Employee Status" | h_3 ==="Employee Status" | h_4 ==="Employee Status"){
            var link = 'disabled';
        }else{
            var link = '';
        }
        return link;
    }
    function validate_gd(){
        var h_1 = $('#header_1').text();
        var h_2 = $('#header_2').text();
        var h_3 = $('#header_3').text();
        var h_4 = $('#header_4').text();
        if (h_1 ==="Gender Diversity" | h_2 ==="Gender Diversity" | h_3 ==="Gender Diversity" | h_4 ==="Gender Diversity"){
            var link = 'disabled';
        }else{
            var link = '';
        }
        return link;
    }
    function validate_jl(){
        var h_1 = $('#header_1').text();
        var h_2 = $('#header_2').text();
        var h_3 = $('#header_3').text();
        var h_4 = $('#header_4').text();
        if (h_1 ==="Job Level" | h_2 ==="Job Level" | h_3 ==="Job Level" | h_4 ==="Job Level"){
            var link = 'disabled';
        }else{
            var link = '';
        }
        return link;
    }
    function validate_los(){
        var h_1 = $('#header_1').text();
        var h_2 = $('#header_2').text();
        var h_3 = $('#header_3').text();
        var h_4 = $('#header_4').text();
        if (h_1 ==="Length Of Service" | h_2 ==="Length Of Service" | h_3 ==="Length Of Service" | h_4 ==="Length Of Service"){
            var link = 'disabled';
        }else{
            var link = '';
        }
        return link;
    }
    function validate_mt(){
        var h_1 = $('#header_1').text();
        var h_2 = $('#header_2').text();
        var h_3 = $('#header_3').text();
        var h_4 = $('#header_4').text();
        if (h_1 ==="Monthly Turnover" | h_2 ==="Monthly Turnover" | h_3 ==="Monthly Turnover" | h_4 ==="Monthly Turnover"){
            var link = 'disabled';
        }else{
            var link = '';
        }
        return link;
    }

    // process get data
    function header(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }
    function employee_status(area,branch){
        header();
        $. ajax({
            url :'chart-employee-status',
            type : 'GET',
            data : {branch_id:branch},
            dataType : 'json',
            beforeSend : function(){
                $(area).html(`
                <div class="d-flex justify-content-center align-items-center mt-5 mt-2">
                    <div class="spinner-grow text-dark" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>`);
            },
            success : function(response){
                $(area).html(`@include("pages.contents.dashboard.filter_data.employee_status")`)
                var data = response.data;
                if (data.length > 0){
                    var total = parseInt(data[0].contract) + parseInt(data[0].permanent) + parseInt(data[0].freelance);
                    var contract = parseInt(data[0].contract) / total * 100;
                    var permanent = parseInt(data[0].permanent) / total * 100;
                    var freelance = parseInt(data[0].freelance) / total * 100;
                    $('#ides-total-employee').text(total)
                    $('#ides-contract').text(data[0].contract)
                    $('#ides-progress-contract').text(Math.round(contract)+'%')
                    $('#ides-progress-contract').attr('aria-valuenow',Math.round(contract))
                    $('#ides-progress-contract').css("width", Math.round(contract)+'%');

                    $('#ides-jobholder').text(data[0].permanent)
                    $('#ides-progress-jobholder').text(Math.round(permanent)+'%')
                    $('#ides-progress-jobholder').attr('aria-valuenow',Math.round(permanent))
                    $('#ides-progress-jobholder').css("width",Math.round(permanent) +'%');

                    $('#ides-freelance').text(data[0].freelance)
                    $('#ides-progress-freelance').text(Math.round(freelance)+'%')
                    $('#ides-progress-freelance').attr('aria-valuenow',Math.round(freelance))
                    $('#ides-progress-freelance').css("width", Math.round(freelance)+'%');
                }
            },
            error : function(){
                alert('Terjadi Kesalahan !')
            }

        })
    }
    function parse_employee_gander(area,branch){
        header();
        $. ajax({
            url :'chart-employee-gender',
            type : 'GET',
            data : {branch_id : branch},
            dataType : 'json',
            beforeSend : function(){
                $(area).html(`
                <div class="d-flex justify-content-center align-items-center mt-5 mt-2">
                    <div class="spinner-grow text-dark" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>`);
            },
            success : function(response){
                $(area).html(`@include("pages.contents.dashboard.filter_data.gender_diversity")`)
                var data = response.data;
                if (data.length > 0){
                    drawDonutChart(data);
                    var male = '0';
                    var female = '0';
                    $.each(data,function(key,val){
                        if(val.label == 'Male')
                        {
                            male = val.value;
                        }
                        if(val.label == 'Female'){
                            female = val.value;
                        }
                    })
                    $('#ides-gender-male').text(male);
                    $('#ides-gender-female').text(female);
                }
            },
            error :function(){
                alert('terjadi kesalahan jaringan !');
            }
        })
    }
    function drawDonutChart(data) {
        $('#donut-chart').empty()
        Morris.Donut({
            element: 'donut-chart',
            redrawOnParentResize: true,
            data: data,
            redraw: true
        });
    }
    function parse_employee_education(area,branch){
        header();
        $.ajax({
            url :'chart-employee-education',
            type : 'GET',
            data : {branch_id : branch},
            dataType : 'json',
            beforeSend : function(){
                $(area).html(`
                <div class="d-flex justify-content-center align-items-center mt-5 mt-2">
                    <div class="spinner-grow text-dark" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>`);
            },
            success :function (response){
                $(area).html(`@include('pages.contents.dashboard.filter_data.education_level')`)
                var data        = response.data;
                var dataTotal   = response.total;
                var total       = 0;
                if (dataTotal.length > 0 ){
                    $.each(dataTotal,function(key,val){
                        total = val.count;
                    })
                }
                if (data.length > 0 ){
                    var chart ='';
                    var html = '';
                    var no =0;
                    $.each(data,function(key,val){
                        if (no == 1){
                            var bg = "bg-danger";
                            var color = "text-danger"
                        }
                        if (no == 2){
                            var bg = "bg-warning"
                            var color = "text-warning"
                        }
                        if (no == 3){
                            var bg = "bg-dark"
                            var color = "text-dark"
                        }
                        if (no == 4){
                            var bg = "bg-purple"
                            var color = "text-purple"
                        }
                        if (no == 5){
                            var bg = "bg-primary"
                            var color = "text-primary"
                        }
                        if (no == 6){
                            var bg = "bg-success"
                            var color = "text-success"
                        }
                        var persen = parseInt(val.count) / parseInt(total) * 100;
                        chart += `<div class="progress mb-2">
                                    <div id="id-progress-smp" class="progress-bar `+bg+`" style="width : `+Math.round(persen)+`%" role="progressbar" aria-valuenow="`+Math.round(persen)+`" aria-valuemin="0" aria-valuemax="100">`+Math.round(persen)+`%</div>
                                </div>`;
                        html += `<div class="col-md-6">
                                    <i class="fa fa-dot-circle-o `+color+` me-2"></i>`+val.level+`<span class="float-end" id="ides-jobholder">`+val.count+`</span>
                                </div>`;
                        no ++;
                    })
                    $('#chart_education-js').html(chart);
                    $('#des_education').html(html);
                    $('#ides-total-employee').text(total);
                }
            },
            error: function(){
                alert("Terjadi kesalahan !")
            }
        })
    }
    function age_average(area,branch){
        header();
        $.ajax({
            url :'chart-employee-age_average',
            type : 'GET',
            data :{branch_id:branch},
            dataType : 'json',
            beforeSend : function(){
                $(area).html(`
                <div class="d-flex justify-content-center align-items-center mt-5 mt-2">
                    <div class="spinner-grow text-dark" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>`);
            },
            success :function (response){
                $(area).html(`@include('pages.contents.dashboard.filter_data.age_average')`)
            var data = response.data;
            if (data.length > 0){
                $.each(data,function(key,val){
                    var arr_data = [ Math.round(val.range_18),Math.round(val.range_20_30),Math.round(val.range_31_40),Math.round(val.range_41_50) ];
                    chart_age_average(arr_data);
                })
            }

            },
            error : function(){
                alert('terjadi kesalahan !')
            }

        })
    }
    function chart_age_average(data){
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: ['<=18', '20-30', '31-40', '41-50'],
            datasets: [{
                    label: '%',
                    data: data,
                    borderRadius :5,
                    borderColor : '#ffcdd2',
                    backgroundColor: '#2979ff',
                    barPercentage: 0.5,
                    minBarLength: 2,
            }],
            borderRadius: 5,
            },
            options: {
                scales: {
                        x: {
                            grid: {
                            display: false,
                            offset :true,
                            }
                        },
                        y: {
                            grid: {
                            display: true,
                            lineWidth :1.2
                            },
                        },

                    },
                elements: {
                    bar: {
                        borderWidth: 2,
                        width : 2,
                    }
                },
            responsive: true,
            plugins: {
            legend: {
                display: false
            },

            }
            }
        });
    }
    function active_staff(area,branch){
        header();
        $.ajax({
            url :'chart-employee_active_staff',
            type : 'GET',
            data : {branch_id :branch},
            dataType : 'json',
            beforeSend : function(){
                $(area).html(`
                <div class="d-flex justify-content-center align-items-center mt-5 mt-2">
                    <div class="spinner-grow text-dark" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>`);
            },
            success :function (response){
                var data = response.data;
                $(area).html(`@include('pages.contents.dashboard.filter_data.active_staff')`)
                active_staf_chart(data);
            },
            error : function(){
                alert('Terjadi kesalahan jaringan !')
            }
        });
    }
    function active_staf_chart(data){
        var label =[];
        var value =[];
        $.each(data,function(key,val){
            label.push(val.bulan_des);
            value.push(val.subtotal);
        })
        const ctx = document.getElementById('activeChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: label,
            datasets: [{
                    label: '',
                    data: value,
                    borderRadius :5,
                    borderColor : '#ffcdd2',
                    backgroundColor: '#76ff03',
                    barPercentage: 0.3,
                    minBarLength: 2,
            }],
            borderRadius: 5,
            },
            options: {
                scales: {
                        x: {
                            grid: {
                            display: false,
                            offset :true,
                            }
                        },
                        y: {
                            grid: {
                            display: true,
                            lineWidth :1.2
                            },
                        },

                    },
                elements: {
                    bar: {
                        borderWidth: 2,
                        width : 2,
                    }
                },
            responsive: true,
            plugins: {
            legend: {
                display: false
            },

            }
            }
        });
    }
    function job_level(area,branch){
        header();
        $.ajax({
            url :'chart-employee_jobLevel',
            type : 'GET',
            data :{branch_id:branch},
            dataType : 'json',
            beforeSend : function(){
                $(area).html(`
                <div class="d-flex justify-content-center align-items-center mt-5 mt-2">
                    <div class="spinner-grow text-dark" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>`);
            },
            success :function (response){
             $(area).html(`@include("pages.contents.dashboard.filter_data.job_level")`)
                var data = response.data;
                job_level_chart(data);
            },
            error : function(){
                alert('Terjadi kesalahan jaringan !')
            }
        });
    }
    function job_level_chart(data){
        var label =[];
        var value =[];
        $.each(data,function(key,val){
            label.push(val.job_level);
            value.push(Math.round(val.subtotal));
        })
        const ctx = document.getElementById('jobChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: label,
            datasets: [{
                    label: '%',
                    data: value,
                    borderRadius :5,
                    borderColor : '#ffccbc',
                    backgroundColor: '#ff3d00',
                    barPercentage: 0.2,
                    minBarLength: 2,
            }],
            borderRadius: 5,
            },
            options: {
                scales: {
                        x: {
                            grid: {
                            display: false,
                            offset :true,
                            }
                        },
                        y: {
                            grid: {
                            display: true,
                            lineWidth :1.2
                            },
                        },

                    },
                elements: {
                    bar: {
                        borderWidth: 2,
                        width : 2,
                    }
                },
            responsive: true,
            plugins: {
            legend: {
                display: false
            },

            }
            }
        });
    }
    function lenght_service(area){
        header();
        $.ajax({
            url :'chart-employee_lenght_of_service',
            type : 'GET',
            dataType : 'json',
            beforeSend : function(){
                $(area).html(`
                <div class="d-flex justify-content-center align-items-center mt-5 mt-2">
                    <div class="spinner-grow text-dark" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>`);
            },
            success :function (response){
                $(area).html(`@include("pages.contents.dashboard.filter_data.lenght_of_service")`)
                var lenght_3    = (response.lenght_3[0].tot != null) ? Math.round(response.lenght_3[0].tot) : '0';
                var lenght_5    = (response.lenght_5[0].tot != null) ? Math.round(response.lenght_5[0].tot) : '0';
                var lenght_10   = (response.lenght_10[0].tot != null) ? Math.round(response.lenght_10[0].tot) : '0';
                var lenght_15   = (response.lenght_15[0].tot != null) ? Math.round(response.lenght_15[0].tot) : '0';
                var lenght_20   = (response.lenght_20[0].tot != null) ? Math.round(response.lenght_20[0].tot) : '0';
                var lenght_30   = (response.lenght_30[0].tot != null) ? Math.round(response.lenght_30[0].tot) : '0';
                var val_data = [lenght_3,lenght_5,lenght_10,lenght_15,lenght_20,lenght_30];
                ofservice_chart(val_data);
            },
            error : function(){
                alert('Terjadi kesalahan jaringan !')
            }
        });
    }

    function ofservice_chart(data){
        const ctx = document.getElementById('lenghtChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: ['<3yr', '<5yr', '<10yr', '<15yr','<20yr','>20yr'],
            datasets: [{
                    label: '%',
                    data: data,
                    borderRadius :5,
                    borderColor : '#ffcdd2',
                    backgroundColor: '#2979ff',
                    barPercentage: 0.5,
                    minBarLength: 2,
            }],
            borderRadius: 5,
            },
            options: {
                scales: {
                        x: {
                            grid: {
                            display: false,
                            offset :true,
                            }
                        },
                        y: {
                            grid: {
                            display: true,
                            lineWidth :1.2
                            },
                        },

                    },
                elements: {
                    bar: {
                        borderWidth: 2,
                        width : 2,
                    }
                },
            responsive: true,
            plugins: {
            legend: {
                display: false
            },

            }
            }
        });
    }

    function monthly_turnover(area,branch){
        header();
        $.ajax({
            url :'chart-employee_monthly_turnover',
            type : 'GET',
            data :{branch_id :branch},
            dataType : 'json',
            beforeSend : function(){
                $(area).html(`
                <div class="d-flex justify-content-center align-items-center mt-5 mt-2">
                    <div class="spinner-grow text-dark" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>`);
            },
            success :function (response){
                $(area).html(`@include("pages.contents.dashboard.filter_data.monthly_turnover")`)
                var data = response.data;
                var label = [0,];
                var value = [0,];
                if (data.length > 0 ){
                    $.each(data,function(key,val){
                        label.push(val.bulan);
                        value.push(val.turnover);
                    })
                }
                turnover_chart(label,value);
            },
            error : function(){
                alert('Terjadi kesalahan jaringan !')
            }
        });
    }

    function turnover_chart(label,data){
        const ctx = document.getElementById('turnoverChart');
        new Chart(ctx, {
            type: 'line',
            data: {
            labels: label,
            datasets: [{
                    label: '%',
                    data: data,
                    borderRadius :5,
                    borderColor : '#ffcdd2',
                    backgroundColor: '#2979ff',
                    pointStyle: 'circle',
                    pointRadius: 5,
                    pointHoverRadius: 10
            }],
            borderRadius: 5,
            },
            options: {
                scales: {
                        x: {
                            grid: {
                            display: false,
                            offset :true,
                            }
                        },
                        y: {
                            grid: {
                            display: true,
                            lineWidth :1.2
                            },
                        },

                    },
                elements: {
                    bar: {
                        borderWidth: 2,
                        width : 2,
                    }
                },
            responsive: true,
            plugins: {
            legend: {
                display: false
            },

            }
            }
        });
    }

    function employee_religion(area,branch){
        header();
        $.ajax({
            url :'chart-employee_religion',
            type : 'GET',
            data : {branch_id : branch},
            dataType : 'json',
            beforeSend : function(){
                $(area).html(`
                <div class="d-flex justify-content-center align-items-center mt-5 mt-2">
                    <div class="spinner-grow text-dark" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>`);
            },
            success :function (response){
                $(area).html(`@include('pages.contents.dashboard.filter_data.employee_religion')`)
                var data = response.data;
                var label = ['islam','katholik','kristen','hindu','budha','lain'];
                var value = [];
                if (data.length > 0 ){
                    value.push(data[0].islam,data[0].khatolik,data[0].kristen,data[0].hindu,data[0].budha,data[0].lain);
                }
                employee_religion_chart(label,value);
            },
            error : function(){
                alert('Terjadi kesalahan jaringan !')
            }
        });
    }

    function employee_religion_chart(label,data){
        const ctx = document.getElementById('religionChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: label,
            datasets: [{
                    label: '%',
                    data: data,
                    borderRadius :5,
                    borderColor : '#ffcdd2',
                    backgroundColor: '#2979ff',
                    barPercentage: 0.5,
                    minBarLength: 2,
            }],
            borderRadius: 5,
            },
            options: {
                scales: {
                        x: {
                            grid: {
                            display: false,
                            offset :true,
                            }
                        },
                        y: {
                            grid: {
                            display: true,
                            lineWidth :1.2
                            },
                        },

                    },
                elements: {
                    bar: {
                        borderWidth: 2,
                        width : 2,
                    }
                },
            responsive: true,
            plugins: {
            legend: {
                display: false
            },

            }
            }
        });
    }
    </script>
