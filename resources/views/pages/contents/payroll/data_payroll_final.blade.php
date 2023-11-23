@extends('pages.dashboard')

@section('title', 'Pay Slip')

@section('dashboard-content')
@php
    function formatRupiah($angka){
	$hasil_rupiah = "IDR " . number_format($angka,0,',','.');
	return $hasil_rupiah;
    }
@endphp
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Pay Slip</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pay Slip</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex align-items-center">
                            <div class="col-md-2">
                                <label>Start Date</label>
                                <input type="date" id="startdate" class="form-control" name="datestart" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-2">
                                <label>End Date</label>
                                <input type="date" id="enddate" class="form-control" name="dateend" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-3">
                                <label>Branch</label>
                                <select class="form-select form-control" id="branch_id">
                                    @foreach($branch as $br)
                                    <option value="{{ $br->id }} ">{{ $br->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-center mt-4"> 
                                <button type="button" class="btn btn-primary me-1" id="searchBranch">Search</button>
                                <button type="button" class="btn btn-primary" id="ExportdataSlip">Export</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="payrollDataFinal">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="form-check-input" id="checkedAll"></th>
                                <th>Date</th>
                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Position</th>
                                <th>Bank Name</th>
                                <th>Account Number</th>
                                <th>Basic Salary</th>
                                <th>Allowance fixed</th>
                                <th>Allowance Unfixed</th>
                                <th>Allowance Other</th>
                                <th>Overtime</th>
                                <th>Salary in Month</th>
                                <th>Company Pay Bpjs</th>
                                <th>Total salary</th>
                                <th>Company Bpjs Kesehatan</th>
                                <th>Company Bpjs Ketenegakerjaan</th>
                                <th>Company Bpjs Total</th>
                                <th>Employee Bpjs Kesehatan</th>
                                <th>Employee Bpjs Ketenegakerjaan</th>
                                <th>Employee Bpjs Total</th>
                                <th>Loan Installment</th>
                                <th>Loan Kasbon</th>
                                <th>Total Loan</th>
                                <th>Total Deduction Other</th>
                                <th>Pph21</th>
                                <th>Total Deduction</th>
                                <th>Take Home Pay</th>
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

    @if (Session::has('edit-show'))
    <script>
        $(window).on('load', function(){
            $('#edit_reimburst').modal('show')
        });
    </script>
    @endif

    <script>
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
            $(document).ready(function () {
                var startdate = $('#startdate').val();
                var enddate = $('#enddate').val();
                var branch_id = $('#branch_id').val();
                loadData(startdate,enddate,branch_id)
            });
            function loadData(startdate,enddate,branch_id){
                $('#payrollDataFinal').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax : {
                            "url" : 'payroll-final',
                            "type" : 'POST',
                            "data" : {startdate:startdate,enddate:enddate,branch_id:branch_id},
                        },
                    columns: [
                        {
                            data: 'employee_id',
                            render : function( data,row,type){
                               return '<input type="checkbox" class="form-check-input itemsCheck" name="empid[]" value="'+data+'">';
                            },
                        },
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
                            data: 'bank_name',
                            name: 'bank_name'
                        },
                        {
                            data: 'account_number',
                            name: 'account_number'
                        },
                        {
                            data: 'basic_salary',
                            render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        },
                        {
                            data: 'allowance_fixed',
                            render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        },
                        {
                            data: 'allowance_unfixed',
                            render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        },
                        {
                            data: 'allowance_other',
                            render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        },
                        {
                            data: 'overtime',
                           render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        },
                        {
                            data: 'salary_this_month',
                            render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        },
                        {
                            data: 'company_pay_bpjs',
                            render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        },
                        {
                            data: 'total_salary',
                            render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        },
                        {
                            data: 'company_pay_bpjs_kesehatan',
                            render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        },
                        {
                            data: 'company_pay_bpjs_ketenagakerjaan',
                            render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        },
                        {
                            data: 'company_total_pay_bpjs',
                            render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        },
                        {
                            data: 'employee_pay_bpjs_kesehatan',
                            render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        },
                        {
                            data: 'employee_pay_bpjs_ketenagakerjaan',
                            render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        },
                        {
                            data: 'employee_total_pay_bpjs',
                            render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        },
                        {
                            data: 'installment',
                            render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        },
                        {
                            data: 'loans',
                            nrender : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        },
                        {
                            data: 'total_pay_loans',
                            render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        },
                        {
                            data: 'total_deduction_other',
                            render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        },
                        {
                            data: 'pph21',
                            render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        },
                        {
                            data: 'total_deduction',
                            render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        }, 
                        {
                            data: 'take_home_pay',
                            render : function(data, type, row){
                                if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                            }
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ],
                    columnDefs: [
                        { orderable: false, targets: 0 },
                        
                    ],
                    "lengthMenu": [ 10,30,50 ],
                    "pageLength": 50,
                })
            }
            $('#searchBranch').on('click',function(){
                var startdate = $('#startdate').val();
                var enddate = $('#enddate').val();
                var branch_id = $('#branch_id').val();
                loadData(startdate,enddate,branch_id)
            })
            var checkedData = [];
            $('#checkedAll').on('change',function(){
                if($(this).prop('checked')){
                    $('.itemsCheck').prop('checked',true);
                    $('.itemsCheck').each(function(){
                        // if($('.itemsCheck').prop('checked')){
                            // if(!(checkedData.includes($('.itemsCheck').val())))
                            checkedData.push($('.itemsCheck').val());
                        // }
                    });
                }else{
                    $('.itemsCheck').prop('checked',false);
                    checkedData=[];
                }
                console.log(checkedData)
            })
            $(document).on('change','.itemsCheck',function(){
                if($(this).prop('checked')){
                    if(!(checkedData.includes($(this).val())))
                    checkedData.push($(this).val());
                }else{
                    const index = checkedData.indexOf($(this).val());
                    if (index > -1) { 
                        checkedData.splice(index, 1); 
                    }
                }
                console.log(checkedData)
            })
            $('#ExportdataSlip').on('click',function(){
               var employee_id=  checkedData;
                var startdate = $('#startdate').val()
                var enddate = $('#enddate').val()
                var branch_id = $('#branch_id').val()
               
                $('.containerLoader').attr('hidden',false)
                window.location.href = 'export-payroll-pdf?branch_id='+branch_id+'&startdate='+startdate+'&enddate='+enddate+'&employee_id='+employee_id;
                setTimeout(function(){ $('.containerLoader').attr('hidden',true);}, 7000);
                
            })
    </script>
@endpush
