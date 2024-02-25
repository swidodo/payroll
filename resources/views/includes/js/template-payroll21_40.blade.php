<script>
    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
    });
    $(document).on('click','.import_run_V21',function(e){
        e.preventDefault();
        $('#modalImportPayroll_v21').modal('show')
    })
    $('#UploadDataPayroll_v21').on('submit',function(e){
        e.preventDefault();
        var startdate   = $('#startdate').val();
        var enddate     = $('#enddate').val();
        var branch_id   = $('#branch_id').val();
        
        var payroll  = $('#import-payroll-v21')[0].files[0];
        var formData = new FormData();
        formData.append('import-payroll',payroll)
            $.ajax({
                url : 'import-payroll-v21',
                type : 'post',
                contentType: false,
                processData: false,
                cache: false,
                data : formData,
                dataType : 'json',
                beforeSend : function(){
                    $('.containerLoader').attr('hidden',false)
                },
                success : function(respon){
                    $('.containerLoader').attr('hidden',true)
                    if (respon.status == 'success'){
                        $('#UploadDataPayroll_v21')[0].reset();
                        $('#modalImportPayroll_v21').modal('hide')
                        loadData(startdate,enddate,branch_id)
                    }
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg,
                    })
                },
                error : function(){
                    alert('Someting went wrong !');
                    $('.containerLoader').attr('hidden',true)
                }
            })
    }) 
</script>