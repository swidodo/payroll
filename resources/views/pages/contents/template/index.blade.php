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
                    <h3 class="page-title">Setup Template</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">template</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="{{ route('create-access-template')}}" class="btn add-btn"><i class="fa fa-plus"></i>Create</a>
                    @can('create access template')
                    @endcan
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex align-items-center">
                            <div class="col-md-3">
                                <label>Company</label>
                                <select class="form-select form-control" id="company_id">
                                    <option value=""> --pilih-- </option>
                                    @foreach ($company as $comp)
                                        <option value="{{$comp->id}}">{{$comp->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Branch</label>
                                <select class="form-select form-control" id="branch_id">
                                
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-center mt-4"> 
                                <button type="button" class="btn btn-primary" id="search">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped custom-table w-100" id="table-template">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Company</th>
                                <th>Branch</th>
                                <th>Template Versi</th>
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
            loadData("","")
            function loadData(company_id,branch_id){
                $('#table-template').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax : {
                        url : "get-access-template",
                        type : 'post',
                        data : {company_id :company_id,branch_id:branch_id}
                    },
                    columns: [
                        { data: 'no', name:'id', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }},
                        {
                            data: 'company_name',
                            name: 'company_name'
                        },
                        {
                            data: 'branch_name',
                            name: 'branch_name'
                        },
                        {
                            data: 'versi',
                            render : function(data, row,type){
                                var versi = '';
                                for(var i = 1; i < 50; i++){
                                    var useVersi = 'V'+i;
                                    if (data == useVersi){
                                        versi = 'Versi '+i;
                                    }
                                }
                                return versi;
                            }
                        },
                    {
                            data: 'action',
                            name : 'action'
                        },
                    ],

                });
            }
            $('#company_id').on('change',function(){
                var comp_id = $(this).val();
                $.ajax({
                    url : 'get-branch-company',
                    type : 'post',
                    data : {company_id : comp_id },
                    dataType : 'json',
                    success : function(respon){
                        html = '<option value="all">All</option>';
                        $.each(respon, function(key,val){
                            html +=`<option value="`+val.id+`">`+val.name+`</option>`
                        })
                        $('#branch_id').html(html)
                    }
                })
            })
            $('#search').on('click',function(){
                var company_id = $('#company_id').val()
                var branch_id = $('#branch_id').val()
                loadData(company_id,branch_id)
            })
            $(document).on('click','.edit-access-template',function(e){
                e.preventDefault()
                var branch_id = $(this).attr('data-id')
                window.location.href = 'edit-access-template/'+branch_id;
                
            })
           
        })
      
    </script>
@endpush
