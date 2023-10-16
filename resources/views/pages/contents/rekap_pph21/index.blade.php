@extends('pages.dashboard')

@section('title', 'Deduction PPH21')

@section('dashboard-content')

<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Deduction PPH21</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Deduction PPH21</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
             <div class="card">
                <div class="card-header">
                    <div class="card-title-sm">
                        filter Periode
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <select class="form-control " id="branch_id" name="branch_id">
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
                                <th>PPH21 OWED 1 Year</th>
                                <th>PPH21 OWED 1 Month</th>
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
var to_date     = $('#to_date').val();

getRekapPph21(branch_id,from_date=null,to_date=null);
function getRekapPph21(branchId,from_date,to_date){
    $('#tblRekapPph21').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        ajax : {
                "url" : 'data-rekap-pph',
                "type" : 'POST',
                "data" : { branch_id : branchId, startdate : from_date, enddate :to_date},
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
                data: 'salary_pokok',
                name: 'salary_pokok'
            },
            {
                data: 'total_allowance_fixed',
                name: 'total_allowance_fixed'
            },
            {
                data: 'total_allowance_unfixed',
                name: 'total_allowance_unfixed'
            },
            {
                data: 'total_allowance_other',
                name: 'total_allowance_other'
            },
            {
                data: 'total_overtime',
                name: 'total_overtime'
            },
            {
                data: 'salary_in_month',
                name: 'salary_in_month'
            },
            {
                data: 'pay_bpjs_company',
                name: 'pay_bpjs_company'
            },
            {
                data: 'salary_brutto',
                name: 'salary_brutto'
            },
            {
                data: 'biaya_jabatan',
                name: 'biaya_jabatan'
            },
            {
                data: 'pay_bpjs_employee',
                name: 'pay_bpjs_employee'
            },
            {
                data: 'total_pengurangan',
                name: 'total_pengurangan'
            },
            {
                data: 'salary_netto',
                name: 'salary_netto'
            },
            {
                data: 'salary_1_tahun',
                name: 'salary_1_tahun'
            },
            {
                data: 'ptkp_1_tahun',
                name: 'ptkp_1_tahun'
            },
            {
                data: 'pkp',
                name: 'pkp'
            },
            {
                data: 'pph21_terhutang_1_tahun',
                name: 'pph21_terhutang_1_tahun'
            },
            {
                data: 'pph21_terhutang_1_bulan',
                name: 'pph21_terhutang_1_bulan'
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
                window.open('rekap-payroll-pdf?from_date='+from_date+'&to_date='+to_date+'&branch_id='+branch_id)
            }
            else if (type == 'EXCEL'){
                window.location.href = 'rekap-payroll-excel?from_date='+from_date+'&to_date='+to_date+'&branch_id='+branch_id;
            }
        })
}
</script>
@endpush
