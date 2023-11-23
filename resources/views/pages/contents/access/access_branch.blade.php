@extends('pages.dashboard')

@section('title', 'Access Branch')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">User Access Branch</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">access</li>
                    </ul>
                </div>
                @can('create allowance option')
                    <div class="col-auto float-end ms-auto">
                        @can('create access branch')
                            <a href="{{ route('create-access-branch')}}" class="btn add-btn"><i class="fa fa-plus"></i>Create</a>
                        @endcan
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
                    <table class="table table-striped custom-table w-100" id="table-access">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employee</th>
                                <th>Branch</th>
                                <th>Total Access</th>
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
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>


    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
            });
            var table = $('#table-access').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                    url : "get-access-branch",
                    type : 'post',
                },
                columns: [
                    { data: 'no', name:'id', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }},
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'branch_name',
                        name: 'branch_name'
                    },
                    {
                        data: 'jml',
                        render : function(data, row,type){
                            return data + ' Branch';
                        }
                    },
                   {
                        data: 'action',
                        name : 'action'
                    },
                ],

            });
            $(document).on('click','.edit-access-branch',function(e){
                e.preventDefault()
                var emp = $(this).attr('data-id')
                window.location.href = 'edit-access-branch/'+emp;
                
            })
            $(document).on('click','.delete-access-branch', function(e){
                e.preventDefault()
                var id = $(this).attr('data-id');
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
                                url : 'delete-access-branch',
                                type : 'post',
                                data : {id : id},
                                dataType : 'json',
                                beforeSend : function(){

                                },
                                success : function(respon){
                                    table.ajax.reload();
                                    swal.fire({
                                        icon : respon.status,
                                        text : respon.msg,
                                    })
                                },
                                error : function (){
                                    alert('There is an error !, please try again')
                                }
                            })
                        }
                    })
            })
        })
      
    </script>
@endpush
