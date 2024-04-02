@extends('pages.dashboard')

@section('title', 'Manage Announcement')

@section('dashboard-content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Manage Announcement</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Announcement</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="{{ route('create-announcement')}}" class="btn add-btn" ><i class="fa fa-plus"></i>Announcement</a>
                </div>
                @can('create announcement')
                @endcan
            </div>
        </div>
        <!-- /Page Header -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>Branch <i class="text-danger">*</i></label>
                        <select class="form-control" name="branch_id" id="branch_id" required>
                            @foreach ($branch as $branches)
                                @if(isset($data))
                                    <option value="{{ $branches->id}}" {{($branches->id == $data) ? 'selected':''}}>{{ $branches->name }}</option>
                                @else
                                    <option value="{{ $branches->id}}">{{ $branches->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="button" id="search" class="btn btn-primary mt-4">serach</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="table-information">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Status</th>
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

    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
            });
            $('#branch_id').select2({
                width: '100%'
            }) 
            var branch_id = $('#branch_id').val();
            loadData(branch_id);
            function loadData(branch_id=""){
                $('#table-information').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax : {
                        url : "get-data-announcement",
                        type : 'post',
                        data :{branch_id : branch_id },
                    },
                    columns: [
                        { data: 'no', name:'id', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }},
                        {
                            data: 'date',
                            name: 'date'
                        },
                        {
                            data: 'title',
                            name: 'title'
                        }, 
                        {
                            data: 'image',
                            render : function(data,row,type){
                                    var btn ='';
                                    if (data !=null){
                                        btn ="<a href='"+data+"' target='_blank' class='btn btn-sm btn-primary'>view file </a>";
                                    }
                                    return btn;
                                }
                        },
                        {
                            data: 'status',
                            render : function(data, row,type){
                                var status = '';
                                if (data == 0){
                                    status = '<span class="badge badge-warning">Waiting</span> ';
                                }else if(data == 1){
                                    status = '<span class="badge badge-success">Publish</span>';
                                }else{
                                    status = '<span class="badge badge-danger">Not Publish</span>'
                                }
                                return status;
                            }
                        },
                        {
                            data: 'action',
                            name : 'action'
                        },
                    ],

                });
            }
            $('#search').on('click',function(){
                var branch_id = $('#branch_id').val();
                loadData(branch_id);
            })
            $(document).on('click','.edit-announcement',function(e){
                e.preventDefault()
                var id = $(this).attr('data-id')
                window.location.href = 'edit-announcement/'+id;
                
            })
            $(document).on('click','.publish-announcement',function(e){
                e.preventDefault()
                var id = $(this).attr('data-id')
                var branch_id = $('#branch_id').val();
                Swal.fire({
                            title: 'Are you sure?',
                            text: "You Will Publish!",
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Publish'
                        }).then(function(confirm){
                        if (confirm.value == true){
                            $.ajax({
                                url : 'publish-announcement',
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
                                    loadData(branch_id)
                                },
                                error : function(){
                                    alert('Someting went wrong !');
                                }
                            })
                        }
                    })
            })
            $(document).on('click','.delete-announcement',function(e){
                e.preventDefault()
                var id = $(this).attr('data-id')
                var branch_id = $('#branch_id').val();
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
                                url : 'destroy-announcement',
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
                                    loadData(branch_id)
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
