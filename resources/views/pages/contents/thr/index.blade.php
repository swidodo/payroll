@extends('pages.dashboard')

@section('title', 'Thr')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Manage THR</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">THR</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="javascript:void(0);" class="btn add-btn" id="add_position"><i class="fa fa-plus"></i>THR</a>
                </div> 
                <div class="col-auto float-end ms-auto">
                    <a href="javascript:void(0);" class="btn add-btn" id="add_position"><i class="fa fa-download"></i>Import</a>
                </div>
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
            <div class="card">
                    <div class="card-body">
                        <div class="row d-flex align-items-center">
                            <div class="col-md-3">
                                <label>Branch</label>
                                <select class="form-select form-control" id="branch_id">
                                    @foreach($branch as $br)
                                    <option value="{{ $br->id }} ">{{ $br->name }}</option>
                                    @endforeach
                                </select>
                            </div> 
            
                            <div class="col-md-3 d-flex align-items-center mt-4"> 
                                <button type="button" class="btn btn-primary" id="generate_thr">Generate THR</button>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="table-position">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Branch</th>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Bank Name</th>
                                <th>Account Number</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>service of years </th>
                                <th>Basic Salary</th>
                                <th>Allowance Position</th>
                                <th>Amount</th>
                                <th class="text-end">Action</th>
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
</div>
@endsection
 
@push('addon-style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2/sweetalert2.min.css')}}">
@endpush

@push('addon-script')
    <!-- Slimscroll JS -->
    <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>

    <!-- Datetimepicker JS -->
    <script src="{{asset('assets/js/moment.min.js')}}"></script>

    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
        var branchId = $('#branch_id').val();
        loadData(branchId)
        function loadData(branchId){
            $('#table-position').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                    url : "get-thr",
                    type : 'post',
                    data :{branch_id : branchId}
                },
                columns: [
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'branch_name',
                        name: 'branch_name'
                    },
                    {
                        data: 'no_employee',
                        name : 'no_employee'
                    },
                    {
                        data: 'employee_name',
                        name : 'employee_name'
                    },
                    {
                        data: 'bank_name',
                        name : 'bank_name'
                    },
                    {
                        data: 'account_number',
                        name : 'account_number'
                    },
                    {
                        data: 'position_name',
                        name: 'position_name'
                    }, 
                    {
                        data: 'departement_name',
                        name: 'departement_name'
                    }, 
                    {
                        data: 'service_of_year',
                        name: 'service_of_year'
                    },
                    {
                        data: 'basic_salary',
                        name: 'basic_salary'
                    },
                    {
                        data: 'amount_allowance_position',
                        name: 'amount_allowance_position'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                ],

            });
        }
        $('#generate_thr').on('click',function(e){
            var branch = $('#branch_id').val()
            $.ajax({
                url :'generate-thr',
                type :'post',
                data :{branch_id : branch},
                dataType : 'json',
                beforeSend : function(){

                },
                success:function(respon){
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg
                    })

                },
                error : function(){
                    alert('Sameting went wrong !')
                }
            })
        })
        //     $('#add_position').on('click', function(e){
        //         e.preventDefault();
        //         $.ajax({
        //             url : 'add-position',
        //             type : 'get',
        //             dataType : 'json',
        //             beforeSend : function(){

        //             },
        //             success : function(respon){
        //                 var branch = '';
        //                 $.each(respon.branch, function(key,val){
        //                     branch += `<option value="`+val.id+`">`+val.name+`</option>`
        //                 })
        //                 $('#branchId').html(branch);
        //                 $('#add_modal_position').modal('show');
        //             }
        //         })
        //     })
           
        //     $('#addFormPosition').on('submit', function(e){
        //         e.preventDefault()
        //         var data = $('#addFormPosition').serialize();

        //         $.ajax({
        //             url : 'store-position',
        //             type : 'post',
        //             data : data,
        //             dataType : 'json',
        //             beforeSend : function(){

        //             },
        //             success : function(respon){
        //                 if (respon.status == "success"){
        //                     $('#add_modal_position').modal('hide');
        //                     $('#addFormPosition')[0].reset()
        //                     table.ajax.reload();
        //                 }
        //                 swal.fire({
        //                     icon : respon.status,
        //                     text : respon.msg
        //                 })
        //             },
        //             error : function(){
        //                 alert('Someting went wrong !');
        //             }
        //         })
        //     })
        //     $(document).on('click','.edit-position',function(e){
        //        e.preventDefault();
        //        var id = $(this).attr('data-id')
        //         $.ajax({
        //             url : 'edit-position',
        //             type : 'post',
        //             data : {id : id},
        //             dataType : 'json',
        //             beforeSend : function(){

        //             },
        //             success : function(respon){
        //                 $('#id').val(respon.data.id);
        //                 $('#editBranchId').val(respon.data.branch_id);
        //                 $('#editBranchName').val(respon.data.branch_name);
        //                 $('#editPositionCode').val(respon.data.position_code);
        //                 $('#editPositionName').val(respon.data.position_name);
        //                 $('#editDescription').html(respon.data.description)
                       
        //                 $('#edit_position').modal('show');
        //             }
        //         })
        //     })
        //     $('#updateFormPotision').on('submit', function(e){
        //         e.preventDefault()
        //         var data = $('#updateFormPotision').serialize();
        //         $.ajax({
        //             url : 'update-position',
        //             type : 'post',
        //             data : data,
        //             dataType : 'json',
        //             beforeSend : function(){

        //             },
        //             success : function(respon){
        //                 if (respon.status == "success"){
        //                     $('#edit_position').modal('hide');
        //                     table.ajax.reload();
        //                 }
        //                 swal.fire({
        //                     icon : respon.status,
        //                     text : respon.msg
        //                 })
        //             },
        //             error : function(){
        //                 alert('Someting went wrong !');
        //             }
        //         })
        //     })
        //     $(document).on('click','.delete-position',function(e){
        //         e.preventDefault()
        //         var id = $(this).attr('data-id')
        //         Swal.fire({
        //                     title: 'Are you sure?',
        //                     text: "You won't be able to revert this!",
        //                     icon: 'warning',
        //                     showCancelButton: true,
        //                     confirmButtonColor: '#3085d6',
        //                     cancelButtonColor: '#d33',
        //                     confirmButtonText: 'Yes, delete it!'
        //                 }).then(function(confirm){
        //                 if (confirm.value == true){
        //                     $.ajax({
        //                         url : 'destroy-position',
        //                         type :'post',
        //                         data : {id : id},
        //                         dataType : 'json',
        //                         beforeSend : function (){

        //                         },
        //                         success : function(respon){
        //                             swal.fire({
        //                                 icon : respon.status,
        //                                 text : respon.msg
        //                             })
        //                             table.ajax.reload();
        //                         },
        //                         error : function(){
        //                             alert('Someting went wrong !');
        //                         }
        //                     })
        //                 }
        //             })
        //     })
        });
    </script>
@endpush
