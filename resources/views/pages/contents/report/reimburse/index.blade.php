@extends('pages.dashboard')
@section('title', 'Report Reimbursement')
@section('dashboard-content')

<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Report</a></li>
                        <li class="breadcrumb-item active">reimbursement</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="card-title-sm">
                        Filter Periode
                    </div>
                </div>
                <div class="card-body">
                    <form id="FormSearch" action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label>Branch</label>
                                <select class="form-control form-select" id="branch_id" name="branch_id">
                                    @foreach($branch as $branches)
                                        <option value="{{ $branches->id }}">{{ $branches->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label>Start Date</label>
                                <input type="date" name="startdate" id="from_date" class="form-control" required>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label>End Date</label>
                                <input type="date" name="enddate" id="to_date" class="form-control" required>
                            </div>
                            <div class="col-md-3  mb-2">
                                <button type="button" id="filter-search" class="btn btn-primary me-1 mt-4">Search</button>
                                <button type="button" id="export-reimburse" class="btn btn-success me-1 mt-4"><span class="fa fa-file-excel"></span> Export</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-striped custom-table w-100" id="tblReimburse">
                            <thead>
                               <tr>
                                    <th>No</th>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Date</th>
                                    <th>Reimbursement</th>
                                    <th>Amount</th>
                                    <th>Status</th>
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
</div>
@endsection()
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
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
        $('#branch_id').select2({
            width: '100%',
        })
        var branchId = $('#branch_id').val();
        LoadData(branchId,startdate=null,enddate=null);
        function LoadData(branchId,startdate,enddate){
            $('#tblReimburse').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                        url : 'get-report-reimbursment',
                        type : 'post',
                        data : {
                            branch_id : branchId,
                            startdate : startdate,
                            enddate : enddate
                        },
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
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'reimburst_name',
                        name: 'reimburst_name'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'status',
                        render : function(data,type,row){
                            var status = '';
                            if(data == "pending"){
                                status = "<span class ='badge badge-warning text-dark'>pending</span>"
                            }
                            if(data == "approved"){
                                status = "<span class ='badge badge-success text-dark'>approved</span>"
                            }
                            return status;
                        }
                    },
                ],
            })
        }
        $('#filter-search').on('click',function(){
            var branchId = $('#branch_id').val();
            var startdate = $('#from_date').val();
            var enddate = $('#to_date').val()
            if(startdate == ''){
                alert("Start date not empty !");
                return false;
            }
            if(enddate == ''){
                alert("End date not empty !");
                return false;
            }
            LoadData(branchId,startdate,enddate);
        })
        $('#export-reimburse').on('click',function(){
            var startdate = $('#from_date').val();
            var enddate = $('#to_date').val()
            if(startdate == ''){
                alert("Start date not empty !");
                return false;
            }
            if(enddate == ''){
                alert("End date not empty !");
                return false;
            }
            $('#FormSearch').attr("action", "{{route('export-reimbursment')}}");
            document.getElementById("FormSearch").submit();
        })
    })
</script>
@endpush
