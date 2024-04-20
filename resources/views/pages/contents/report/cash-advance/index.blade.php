@extends('pages.dashboard')

@section('title', 'Cash Advance')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Cash Advance Report</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Cash Advance Report</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <h4>Filter Data</h4>
                    <hr />
                    <div class="col-md-4">
                        <label for="attendance" class="form-label">Branch</label>
                        <select class="form-control form-control-sm select" id="branch-filter" name="branch">
                            @foreach ($branch as $branchs)
                                <option value="{{$branchs->id}}" {{($branchs->id == Auth::user()->branch_id) ? 'selected':''}}>{{$branchs->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="attendance" class="form-label">Status</label>
                        <select class="form-control form-control-sm select" id="status-filter" name="status-filter">
                            <option value="ongoing" selected>Ongoing</option>
                            <option value="pending" selected>Pending</option>
                            <option value="paid off">Paid Off</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-center">
                    <button type="button" class="btn btn-primary mt-4" id="searchData"> Search </button>
                    </div>
                </div>
            </div>
        </div>

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
                    <table class="table table-striped custom-table" id="tbLoan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employee ID</th>
                                <th>Employee</th>
                                <th>Nominal</th>
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

    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            /* When click show user */
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
            });
            $('#searchData').on('click', function(){
                var branch = $('#branch-filter').val();
                var status = $('#status-filter').val()
                loadData(branch,status)
            })                
            var branch = $('#branch-filter').val();
            var status = $('#status-filter').val();
            loadData(branch="",status="")
            
            function loadData(branch,status){
                $('#tbLoan').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax : {
                            "url" : 'cash-advance-report',
                            "type" : 'post',
                            "data" : {branch_id : branch, status : status},
                        },
                    columns: [
                        { data: 'no', name:'id', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }},
                        {
                            data: 'no_employee',
                            name: 'no_employee'
                        },
                        {
                            data: 'employee_name',
                            name: 'employee_name'
                        },
                        {
                            data: 'amount',
                            render : function(data, type, row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'status',
                            render : function(data,type,row){
                                 var bg ='';
                                if (data === "ongoing"){
                                    bg = "badge-warning";
                                }else if (data === "lunas"){
                                    bg = "badge-success";
                                }else{
                                    bg = "badge-danger";
                                }
                                return btn = '<span class="badge '+bg +'">'+data+'</span>';
                            }
                            // name: 'status'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ],
                    order: [[1, 'desc']]
                })
            }
        });    
    </script>
@endpush
