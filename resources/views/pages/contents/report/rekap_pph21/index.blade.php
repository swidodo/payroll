@extends('pages.dashboard')

@section('title', 'Rekap PPH21')

@section('dashboard-content')

<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Rekap PPh21</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Rekap PPh21</li>
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
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <select class="form-control form-select" id="branch_id" name="branch_id">
                                @foreach($branch as $branches)
                                <option value="{{ $branches->id }}">{{ $branches->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <input type="date" name="from_date" id="from_date" class="form-control">
                        </div>
                        <div class="col-md-2 mb-2">
                            <input type="date" name="to_date" id="to_date" class="form-control">
                        </div>
                        <div class="col-md-2 mb-2">
                            <select class="form-control form-select" name="type" id="type_print">
                                <option value="PDF">PDF</option>
                                <option value="EXCEL">EXCEL</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex justify-content-start mb-2">
                            <button type="button" id="filter_rekap_pph21" class="btn btn-success btn-sm me-1"><span class="fa fa-filter"></span> Filter</button>
                            <button type="button" id="print_rekap_pph21" class="btn btn-primary btn-sm"> <span class="fa fa-print"></span> Print</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="tblRekapPph21" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Position</th>
                                <th>Basic Salary</th>
                                <th>Allowance Fixed</th>
                                <th>Allowance unfixed</th>
                                <th>Allowance other</th>
                                <th>Overtime</th>
                                <th>Salary In Month</th>
                                <th>Company Bpjs</th>
                                <th>Salary Brutto</th>
                                <th>Position Allowance</th>
                                <th>Employee Bpjs</th>
                                <th>Total Subtraction</th>
                                <th>Salary Netto</th>
                                <th>Salary 1 Year</th>
                                <th>PTKP 1 Year</th>
                                <th>PKP</th>
                                <th>PPh21 OWED 1 Year</th>
                                <th>PPh21 OWED 1 Month</th>
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
$.ajaxSetup({
    headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
});
var branch_id = $('#branch_id').val();
var start_date = $('#from_date').val();
var end_date = $('#to_date').val();
getRekapPph21(branch_id,start_date,end_date);
function getRekapPph21(branchId,start_date,end_date){
    $('#tblRekapPph21').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        ajax : {
                "url" : 'data-rekap-pph',
                "type" : 'POST',
                "data" : { branch_id : branchId, startdate : start_date, enddate :end_date},
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
                data: 'no_employee',
                name: 'no_employee'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'position_name',
                name: 'position_name'
            },
            {
                data: 'salary_pokok',
                render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                        if(base.lastIndexOf(".") != -1)
                            base = base.substring(0, base.lastIndexOf("."));
                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            },
            {
                data: 'total_allowance_fixed',
                render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                        if(base.lastIndexOf(".") != -1)
                            base = base.substring(0, base.lastIndexOf("."));
                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            },
            {
                data: 'total_allowance_unfixed',
                render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                        if(base.lastIndexOf(".") != -1)
                            base = base.substring(0, base.lastIndexOf("."));
                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            },
            {
                data: 'total_allowance_other',
               render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                        if(base.lastIndexOf(".") != -1)
                            base = base.substring(0, base.lastIndexOf("."));
                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            },
            {
                data: 'total_overtime',
                render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                        if(base.lastIndexOf(".") != -1)
                            base = base.substring(0, base.lastIndexOf("."));
                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            },
            {
                data: 'salary_in_month',
                render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                        if(base.lastIndexOf(".") != -1)
                            base = base.substring(0, base.lastIndexOf("."));
                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            },
            {
                data: 'pay_bpjs_company',
                render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                        if(base.lastIndexOf(".") != -1)
                            base = base.substring(0, base.lastIndexOf("."));
                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            },
            {
                data: 'salary_brutto',
                render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                        if(base.lastIndexOf(".") != -1)
                            base = base.substring(0, base.lastIndexOf("."));
                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            },
            {
                data: 'biaya_jabatan',
                render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                        if(base.lastIndexOf(".") != -1)
                            base = base.substring(0, base.lastIndexOf("."));
                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            },
            {
                data: 'pay_bpjs_employee',
                render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                        if(base.lastIndexOf(".") != -1)
                            base = base.substring(0, base.lastIndexOf("."));
                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            },
            {
                data: 'total_pengurangan',
                render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                        if(base.lastIndexOf(".") != -1)
                            base = base.substring(0, base.lastIndexOf("."));
                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            },
            {
                data: 'salary_netto',
                render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                        if(base.lastIndexOf(".") != -1)
                            base = base.substring(0, base.lastIndexOf("."));
                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            },
            {
                data: 'salary_1_tahun',
                render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                        if(base.lastIndexOf(".") != -1)
                            base = base.substring(0, base.lastIndexOf("."));
                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            },
            {
                data: 'ptkp_1_tahun',
                render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                        if(base.lastIndexOf(".") != -1)
                            base = base.substring(0, base.lastIndexOf("."));
                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            },
            {
                data: 'pkp',
                render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                        if(base.lastIndexOf(".") != -1)
                            base = base.substring(0, base.lastIndexOf("."));
                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            },
            {
                data: 'pph21_terhutang_1_tahun',
                render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                        if(base.lastIndexOf(".") != -1)
                            base = base.substring(0, base.lastIndexOf("."));
                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            },
            {
                data: 'pph21_terhutang_1_bulan',
                render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                        if(base.lastIndexOf(".") != -1)
                            base = base.substring(0, base.lastIndexOf("."));
                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            },
            
        ],

    })
    $('#filter_rekap_pph21').on('click',function(e){
        e.preventDefault();
        var branch_id = $('#branch_id').val();
        var start_date = $('#from_date').val();
        var end_date = $('#to_date').val();
        getRekapPph21(branch_id,start_date,end_date);
    })
         $('#print_rekap_pph21').on('click',function(){
            var branch_id = $('#branch_id').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var type = $('#type_print').val();

            if (from_date =='' || to_date ==''){
                alert('Sorry, from date and to date empty !');
                return false;
            }
            if (type == 'PDF'){
                window.open('rekap-pph-pdf?from_date='+from_date+'&to_date='+to_date+'&branch_id='+branch_id)
            }
            else if (type == 'EXCEL'){
                window.location.href = 'rekap-pph-excel?from_date='+from_date+'&to_date='+to_date+'&branch_id='+branch_id;
            }
        })
}
</script>
@endpush
