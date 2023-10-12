@extends('pages.dashboard')

@section('title', 'Master Max Limit Bpjs')

@section('dashboard-content')

<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Master Max Limit Bpjs</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Master max limit Bpjs</li>
                    </ul>
                </div>
                @can('create allowance')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_masterLimitbpjs"><i class="fa fa-plus"></i>New Bpjs</a>
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
                    <table class="table table-striped custom-table" id="tblLimitBpjs" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>value</th>
                                {{-- @if(Auth::user()->can('edit bpjs') || Auth::user()->can('delete bpjs')) --}}
                                    <th class="text-end">Action</th>
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
    @include('includes.modal.bpjs.master-max-limit-bpjs')

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
getListLimitBpjs(branch_id);
function getListLimitBpjs(branchId){
    $('#tblLimitBpjs').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        ajax : {
                "url" : 'get-master-limit-bpjs',
                "type" : 'POST',
                "data" : {branch_id : branchId},
            },
        columns: [
            {
                data: 'bpjs_name',
                name: 'bpjs_name'
            },
            {
                data: 'value',
                render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                    if(base.lastIndexOf(".") != -1)
                                        base = base.substring(0, base.lastIndexOf(","));
                                    return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
            },
            {
                data: 'action',
                name: 'action'
            },
        ],
    })
}

$('#addMasterLimitBpjs').on('submit',function(e){
    e.preventDefault();
    var data = $('#addMasterLimitBpjs').serialize();
    $.ajax({
        url : 'store-master-limit-bpjs',
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
            getListLimitBpjs(branch_id);
            $('#add_masterLimitbpjs').modal('hide')
            $('#addMasterLimitBpjs')[0].reset();
        },
        error : function(){
            alert('There is an error !, please try again')
        }
    })
})
$(document).on('click','.edit-masterLimit-bpjs',function(e){
    e.preventDefault()
    var id = $(this).attr('data-id')
    $.ajax({
        url : 'edit-master-limit-bpjs',
        type : 'post',
        data : {id : id},
        dataType : 'json',
        beforeSend : function(){

        },
        success : function(respon){
            $('#id').val(respon.id)
            $('#editBpjsCode').html(`<option value="`+respon.bpjs_code+`" selected>`+respon.bpjs_name+`</option>`)
            $('#editValue').val(respon.value)
            $('#editMasterLimitBpjs').modal('show')
        },
        error : function(){
            alert('There is an error !, please try again')
        }
    })
})
$('#updateMaterLimitBpjs').on('submit',function(e){
    e.preventDefault();
    var data = $('#updateMaterLimitBpjs').serialize();
    $.ajax({
        url : 'update-master-limit-bpjs',
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
            getListLimitBpjs(branch_id);
            $('#editMasterLimitBpjs').modal('hide')
        },
        error : function(){
            alert('There is an error !, please try again')
        }
    })
})
$(document).on('click','.delete-masterLimit-bpjs', function(e){
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
        if(confirm.value == true){
            $.ajax({
                url : 'delete-master-limit-bpjs',
                type : 'post',
                data : {id : id},
                beforeSend : function(){

                },
                success : function(respon){
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg,
                    })
                    getListLimitBpjs(branch_id);
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
