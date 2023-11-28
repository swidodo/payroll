@extends('pages.dashboard')

@section('title', 'company')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Manage Company</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">company</li>
                    </ul>
                </div>
                @can('create company')
                <div class="col-auto float-end ms-auto">
                    <a href="javascript:void(0);" class="btn add-btn" id="add_company"><i class="fa fa-plus"></i>company</a>
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
                    <table class="table table-striped custom-table" id="table-company">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Address</th>
                                <th>Code</th>
                                <th>Logo</th>
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
</div>
  @include('includes.modal.company.add_company')
  @include('includes.modal.company.edit_company')
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
            var table = $('#table-company').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                    url : "get-data",
                    type : 'post',
                },
                columns: [
                    {
                        data: 'name',
                        name: 'name'
                    },
                     {
                        data: 'address',
                        name: 'address'
                    }, 
                    
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'logo',
                        render : function (data,row,type){
                            return `<img src="{{ asset('/storage/app/public') }}/`+data+`" id="">`;
                        }
                    },
                   {
                        data: 'action',
                        name : 'action'
                    },
                ],

            });
            $('#add_company').on('click', function(e){
                e.preventDefault();
                 $('#addCompany').modal('show');
               
            })
           $('#addFormCompany').on('submit', function(e){
                e.preventDefault()
                var data = $('#addFormCompany').serialize();

                $.ajax({
                    url : 'store-company',
                    type : 'post',
                    data : data,
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        if (respon.status == "success"){
                            $('#addCompany').modal('hide');
                            table.ajax.reload();
                        }
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg
                        })
                    },
                    error : function(){
                        alert('Someting went wrong !');
                    }
                })
            })
            $(document).on('click','.edit-company',function(e){
               e.preventDefault();
               var id = $(this).attr('data-id')
                $.ajax({
                    url : 'edit-company',
                    type : 'post',
                    data : {id : id},
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                       
                        $('#id_edit').val(respon.id);
                        $('#companyName_edit').val(respon.name);
                        $('#companyAddress_edit').val(respon.address);
                        $('#companycode_edit').val(respon.code);
                        $('#edit_company').modal('show');
                    }
                })
            })
            $('#updateFormCompany').on('submit', function(e){
                e.preventDefault()
                var id = $('#id_edit').val();
                var company_name = $('#companyName_edit').val();
                var address = $('#companyAddress_edit').val();
                var code = $('#companycode_edit').val();
                var logo = $('#logo')[0].files[0];
                var formData = new FormData();
                formData.append('id',id)
                formData.append('company_name',company_name)
                formData.append('address',address)
                formData.append('code',code)
                formData.append('logo',logo)
                $.ajax({
                    url : 'update-company',
                    type : 'post',
                    contentType: false,
                    processData: false,
                    cache: false,
                    data : formData,
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        if (respon.status == "success"){
                            $('#edit_company').modal('hide');
                            table.ajax.reload();
                        }
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg
                        })
                    },
                    error : function(){
                        alert('Someting went wrong !');
                    }
                })
            })
            $(document).on('click','.delete-company',function(e){
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
                                url : 'destroy-company',
                                type :'post',
                                data : {id : id},
                                dataType : 'json',
                                beforeSend : function (){

                                },
                                success : function(respon){
                                    swal.fire({
                                        icon : respon.status,
                                        text : respon.msg
                                    })
                                    table.ajax.reload();
                                },
                                error : function(){
                                    alert('Someting went wrong !');
                                }
                            })
                        }
                    })
            })
        });
    </script>
@endpush
