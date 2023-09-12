@extends('pages.dashboard')

@section('title', 'Master Bpjs')

@section('dashboard-content')

<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Master Bpjs</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Master Bpjs</li>
                    </ul>
                </div>
                @can('create allowance')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_master_bpjs"><i class="fa fa-plus"></i>New Bpjs</a>
                    </div>
                @endcan
            </div>
        </div>
        <!-- /Page Header -->


        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{Session::get('success')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="tblMasterBpjs" width="100%">
                        <thead>
                            <tr>
                                <th>Bpjs Name</th>
                                <th>Company %</th>
                                <th>Employee %</th>
                                <th>Total %</th>
                                {{-- @if(Auth::user()->can('edit bpjs') || Auth::user()->can('delete bpjs')) --}}
                                    <th class="text-center">Action</th>
                                {{-- @endif --}}
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
    <input type="hidden" name="branch_id" value={{ Auth::user()->branch_id }} id="branch_id">
    @include('includes.modal.bpjs.master-bpjs')

</div>
@endsection
@push('addon-style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2/sweetalert2.min.css')}}">
@endpush
@push('addon-script')
<!-- Slimscroll JS -->
<script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>

<!-- Select2 JS -->
<script src="{{asset('assets/js/select2.min.js')}}"></script>

<!-- Datetimepicker JS -->
<script src="{{asset('assets/js/moment.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>

<!-- Datatable JS -->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
$.ajaxSetup({
    headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
});
var branch_id = $('#branch_id').val();
getListMasterBpjs(branch_id);
function getListMasterBpjs(branchId){
    $('#tblMasterBpjs').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        ajax : {
                "url" : 'get-master-bpjs',
                "type" : 'POST',
                "data" : {branch_id : branchId},
            },
        columns: [
            {
                data: 'bpjs_name',
                name: 'bpjs_name'
            },
            {
                data: 'is_company',
                name: 'is_company'
            },
            {
                data: 'is_employee',
                name: 'is_employee'
            },
            {
                data: 'total_value',
                name: 'total_value'
            },
            {
                data: 'action',
                name: 'action'
            },
        ],

    })
}
$('#company_pay').on('keyup',function(){
    var company_pay = $('#company_pay').val();
    var employee_pay = $('#employee_pay').val();
    var total = parseFloat((company_pay !="") ? company_pay : 0) + parseFloat((employee_pay != "" ) ? employee_pay : 0);
    $('#total_value').val(total)
})
$('#employee_pay').on('keyup',function(){
    var company_pay = $('#company_pay').val();
    var employee_pay = $('#employee_pay').val();
    var total = parseFloat((company_pay != "") ? company_pay : 0) + parseFloat((employee_pay != "" ) ? employee_pay : 0);
    $('#total_value').val(total)
})
$('#editCompanyPay').on('keyup',function(){
    var company_pay = $('#editCompanyPay').val();
    var employee_pay = $('#editEmployeePay').val();
    var total = parseFloat((company_pay !="") ? company_pay : 0) + parseFloat((employee_pay != "" ) ? employee_pay : 0);
    $('#editTotalValue').val(total)
})
$('#editEmployeePay').on('keyup',function(){
    var company_pay = $('#editCompanyPay').val();
    var employee_pay = $('#editEmployeePay').val();
    var total = parseFloat((company_pay != "") ? company_pay : 0) + parseFloat((employee_pay != "" ) ? employee_pay : 0);
    $('#editTotalValue').val(total)
})
$('#addMasterBpjs').on('submit',function(e){
    e.preventDefault();
    var data = $('#addMasterBpjs').serialize();
    $.ajax({
        url : 'store-master-bpjs',
        type : 'post',
        data : data,
        dataType : 'json',
        beforeSend : function(){

        },
        success : function(respon){
            swal.fire({
                icon : respon.status,
                text : respon.msg,
            })
            getListMasterBpjs(branch_id);
            $('#add_master_bpjs').modal('hide')
            $('#addMasterBpjs')[0].reset()
        },
        error : function(){
            alert('There is an error !, please try again')
        }
    })
})
$(document).on('click','.edit-master-bpjs',function(e){
    e.preventDefault()
    var id = $(this).attr('data-id')
    $.ajax({
        url : 'edit-master-bpjs',
        type : 'post',
        data : {id : id},
        dataType : 'json',
        beforeSend : function(){

        },
        success : function(respon){
            $('#id').val(respon.id)
            $('#editBpjsCode').html(`<option value="`+respon.bpjs_code+`" selected>`+respon.bpjs_name+`</option>`)
            $('#editEmployeePay').val(respon.is_employee)
            $('#editCompanyPay').val(respon.is_company)
            $('#editTotalValue').val(respon.total_value)
            $('#editMasterBpjs').modal('show')
        },
        error : function(){
            alert('There is an error !, please try again')
        }
    })
})
$('#updateMaterBpjs').on('submit',function(e){
    e.preventDefault();
    var data = $('#updateMaterBpjs').serialize();
    $.ajax({
        url : 'update-mater-bpjs',
        type : 'post',
        data : data,
        dataType : 'json',
        beforeSend : function(){

        },
        success : function(respon){
            swal.fire({
                icon : respon.status,
                text : respon.msg,
            })
            getListMasterBpjs(branch_id);
            $('#editMasterBpjs').modal('hide')
        },
        error : function(){
            alert('There is an error !, please try again')
        }
    })
})
$(document).on('click','.delete-master-bpjs', function(e){
    e.preventDefault()
    var id = $(this).attr('data-id')
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then(function(confirm){
        if (confirm.value == true){
            $.ajax({
                url : 'delete-master-bpjs',
                type : 'post',
                data : {id : id},
                dataType : 'json',
                beforeSend : function(){

                },
                success : function(respon){
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg,
                    })
                    getListMasterBpjs(branch_id);
                },
                error : function (){
                    alert('There is an error !, please try again')
                }
            })
        }
    })

})
</script>
@endpush
