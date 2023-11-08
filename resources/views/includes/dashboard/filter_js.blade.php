<script>
     // default load halaman
    var defaultbranch = $('#branch_id').val();
    parse_employee_gander(defaultbranch)

   

    // process get data
    function header(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
                    // var total = male + female;
                    // console.log(female);
                    // var persenMale = Math.round(male/total * 100)
                    // var persenFemale = Math.round(female/total * 100)
                    gender(parseInt(male),parseInt(female));
                }
            },
            error :function(){
                alert('terjadi kesalahan jaringan !');
            }
        })
    }

    
    </script>
