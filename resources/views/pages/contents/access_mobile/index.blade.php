@extends('pages.dashboard')

@section('title', 'Access Mobile')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Access Mobile</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">access</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    @can('create access mobile')
                        <a href="{{ route('create-access-mobile')}}" class="btn add-btn ms-1"><i class="fa fa-plus"></i> Access</a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>Company <i class="text-danger">*</i></label>
                        <select class="form-control" name="company_id" id="filter-company" required>
                            <option value="" selected>-- Pilih --</option>
                            @foreach ($company as $comp)
                                <option value="{{ $comp->id}}">{{ $comp->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Branch <i class="text-danger">*</i></label>
                        <select class="form-control" name="branch_id" id="filter-branch" required>
                            
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-primary mt-4" id="search">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table w-100" id="table-access">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Branch</th>
                                <th>Menu</th>
                                <th>Access</th>
                                <th class="text-center">Action</th>
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
            $('#filter-company').select2({
                width: '100%'
            })          
            $('#filter-branch').select2({
                width: '100%'
            })  
            loadData("","")
            function loadData(company_id,branch_id){
                $('#table-access').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax : {
                        url : "get-access-mobile",
                        type : 'post',
                        data : {company_id : company_id,branch_id :branch_id}
                    },
                    columns: [
                        { data: 'no', name:'id', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }},
                        {
                            data: 'branch_name',
                            name: 'branch_name'
                        },
                        {
                            data: 'menu_name',
                            name: 'menu_name'
                        },
                        {
                            data: 'status',
                            render : function(data, row,type){
                                var status = '';
                                if (data == 1){
                                    status = '<input class="form-check-input" type="checkbox" id="flexCheckDefault" checked disabled>';
                                                    
                                }else{
                                    status = '<input class="form-check-input" type="checkbox" id="flexCheckDefault" disabled>'; 
                                }
                                return status;
                            },
                           
                        },
                        {
                            data: 'action',
                            name : 'action',

                        },
                    ],

                });
            }
            $('#search').on('click',function(){
                var company_id = $('#filter-company').val()
                var branch_id =$('#filter-branch').val()
                loadData(company_id,branch_id)
            })
            $('#filter-company').on('change',function(){
                var company_id = $(this).val();
                $.ajax({
                    url : 'get-company-filter',
                    type : 'post',
                    data : {company_id : company_id },
                    dataType : 'json',
                    success : function(respon){
                        var branch = '<option value="">-- Pili --</option>';
                        $.each(respon, function(key,val){
                            branch += `<option value="`+val.id+`">`+val.name+`</option>`;
                        })
                        $('#filter-branch').html(branch)
                    }
                })
            }) 
            $(document).on('click','.edit-access-mobile',function(e){
                e.preventDefault()
                var branch = $(this).attr('data-id')
                window.location.href = 'edit-access-mobile/'+branch;
                
            })
            $(document).on('click','.delete-access-mobile', function(e){
                e.preventDefault()
                var id = $(this).attr('data-id');
                Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!'
                    }).then(function(confirm){
                        if (confirm.value == true){
                            $.ajax({
                                url : 'delete-access-mobile',
                                type : 'post',
                                data : {id : id},
                                dataType : 'json',
                                beforeSend : function(){

                                },
                                success : function(respon){
                                    var company_id = $('#filter-company').val()
                                    var branch_id =$('#filter-branch').val()
                                    loadData(company_id,branch_id)
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
