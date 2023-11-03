@extends('pages.dashboard')

@section('title', 'Run Payroll')

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
                    <h3 class="page-title">Run Payroll</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Run Payroll</li>
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
                                <input type="date" id="startdate" class="form-control" name="datestart" >
                                <input type="date" id="nowstart" value="{{ date('Y-m-d') }}" hidden>
                            </div>
                            <div class="col-md-2">
                                <label>End Date</label>
                                <input type="date" id="enddate" class="form-control" name="dateend">
                                <input type="date" id="nowend" value="{{ date('Y-m-d') }}" hidden>
                            </div>
                            <div class="col-md-3">
                                <label>Branch</label>
                                <select class="form-select form-control" id="branch_id">
                                    @foreach($branch as $br)
                                    <option value="{{ $br->id }} ">{{ $br->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5 d-flex align-items-center mt-4"> 
                                <button type="button" class="btn btn-primary  me-2" id="generate_run_payroll">RUN PAYROLL</button>
                                <button type="button" class="btn btn-primary" id="import_run_payroll"><i class="fa fa-download"></i> IMPORT AND RUN</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="payrollDataFinal">
                        <thead>
                            <tr>
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
                                <th>Total Deduction Onter</th>
                                <th>Pph21</th>
                                <th>Total Deduction</th>
                                <th>Take Home Pay</th>
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
@include('includes.modal.import_payroll')
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
            var nowstart       = $('#startdateId').val();
            var nowend        = $('#enddateId').val();
            var branch_id   = $('#branch_id').val();
            loadData(nowstart,nowend,branch_id)
            $('#generate_run_payroll').on('click',function(){
                var startdate       = $('#startdate').val();
                var enddate        = $('#enddate').val();
                var branch_id   = $('#branch_id').val();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will RUN PAYROLL !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then(function(confirm){
                    if (confirm.value == true){
                        $.ajax({
                            url : 'generate_run_payroll',
                            type : 'post',
                            data : {startdate:startdate,enddate:enddate,branch_id:branch_id},
                            dataType : 'json',
                            beforeSend : function(){
                                $('.containerLoader').attr('hidden',false)
                            },
                            success: function(e){
                                $('.containerLoader').attr('hidden',true)
                                swal.fire({
                                    icon : e.status,
                                    text : e.msg,
                                })
                                loadData(startdate,enddate,branch_id)
                            },
                            error: function(){
                                $('.containerLoader').attr('hidden',true)
                            }
                        })
                    }
                })
                // $.ajax({
                //     url : 'generate_run_payroll',
                //     type : 'post',
                //     data : {startdate:startdate,enddate:enddate,branch_id:branch_id},
                //     dataType : 'json',
                //     beforeSend : function(){
                //         $('.containerLoader').attr('hidden',false)
                //     },
                //     success: function(e){
                //         $('.containerLoader').attr('hidden',true)
                //         swal.fire({
                //             icon : e.status,
                //             text : e.msg,
                //         })
                //         loadData(startdate,enddate,branch_id)
                //     },
                //     error: function(){
                //         $('.containerLoader').attr('hidden',true)
                //     }
                // })
            })
        });
        function loadData(startdate,enddate,branch_id){
            $('#payrollDataFinal').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                        "url" : 'get_run_payroll',
                        "type" : 'POST',
                        "data" : {startdate:startdate,enddate:enddate,branch_id:branch_id},
                    },
                columns: [
                    
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
                ],
            })
        }
        $('#import_run_payroll').on('click',function(e){
            e.preventDefault();
            $('#modalImportPayroll').modal('show')
        })
        $('#UploadDataPayroll').on('submit',function(e){
            e.preventDefault();
            var startdate       = $('#startdate').val();
            var enddate        = $('#enddate').val();
            var branch_id   = $('#branch_id').val();
            
            var payroll  = $('#import-payroll')[0].files[0];
            var formData = new FormData();
            formData.append('import-payroll',payroll)
                $.ajax({
                    url : 'import-payroll',
                    type : 'post',
                    contentType: false,
                    processData: false,
                    cache: false,
                    data : formData,
                    dataType : 'json',
                    beforeSend : function(){
                        $('.containerLoader').attr('hidden',false)
                    },
                    success : function(respon){
                        $('.containerLoader').attr('hidden',true)
                        if (respon.status == 'success'){
                            $('#UploadDataPayroll')[0].reset();
                            $('#modalImportPayroll').modal('hide')
                            loadData(startdate,enddate,branch_id)
                        }
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg,
                        })
                    },
                    error : function(){
                        alert('Someting went wrong !');
                        $('.containerLoader').attr('hidden',true)
                    }

                })
        })

    </script>
@endpush
