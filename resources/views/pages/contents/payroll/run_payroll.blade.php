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
                                    <option value="">-- pilih --</option>
                                    @foreach($branch as $br)
                                        <option value="{{ $br->id }} ">{{ $br->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 align-items-center text-right mt-4"> 
                                @can('run normatif payroll')
                                <button type="button" class="btn btn-primary  me-1" id="generate_run_payroll">RUN PAYROLL</button>
                                @endcan
                            @if (Auth::user()->branch_id == 30)
                                {{-- <button type="button" class="btn btn-primary me-1" id="import_run_auto"><i class="fa fa-download"></i> IMPORT AND RUN V2</button> --}}
                                {{-- <button type="button" class="btn btn-danger mt-1 me-1" id="import_run_v3" hidden><i class="fa fa-download"></i> IMPORT AND RUN V3</button> --}}
                                @can('run import Auto payroll')
                                @endcan
                            @else
                                @can('run import manual payroll')
                                    {{-- <button type="button" class="btn btn-primary" id="import_run_payroll"><i class="fa fa-download"></i> IMPORT AND RUN</button> --}}
                                @endcan
                            @endif
                            </div>
                            <div class="col-md-3 import-template align-items-center mt-4"></div>
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
                                <th>Rapel/koreksi +</th>
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

    <script>
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
        $(document).ready(function () {
            var nowstart    = $('#startdateId').val();
            var nowend      = $('#enddateId').val();
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
                
            })
        
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
                            data: 'rapel',
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
       
        $('#branch_id').on('change',function(){
            var branch_id = $(this).val();
            $.ajax({
                url : 'get-template-branch',
                type : 'post',
                data : {branch_id : branch_id},
                dataType : 'json',
                success : function(respon){
                    if(respon.versi !=null ) {
                        $('.import-template').html(`<button type="button" class="btn btn-primary mt-1 me-1 import_run_`+respon.versi+`"><i class="fa fa-download"></i> IMPORT AND RUN `+respon.versi+`</button>`);
                    }else{
                        $('.import-template').html('')
                    }
                }
            })
        })

        // show modal import
        $(document).on('click','.import_run_V1',function(e){
            e.preventDefault();
            $('#modalImportPayroll_v1').modal('show')
        })
        $(document).on('click','.import_run_V2',function(e){
            e.preventDefault();
            $('#modalImportPayroll_v2').modal('show')
        })
        $(document).on('click','.import_run_V3',function(e){
            e.preventDefault();
            $('#modalImportPayroll_v3').modal('show')
        })
        $(document).on('click','.import_run_V4',function(e){
            e.preventDefault();
            $('#modalImportPayroll_v4').modal('show')
        })
        $(document).on('click','.import_run_V5',function(e){
            e.preventDefault();
            $('#modalImportPayroll_v5').modal('show')
        })
        $(document).on('click','.import_run_V6',function(e){
            e.preventDefault();
            $('#modalImportPayroll_v6').modal('show')
        })
        $(document).on('click','.import_run_V7',function(e){
            e.preventDefault();
            $('#modalImportPayroll_v7').modal('show')
        })
        $(document).on('click','.import_run_V8',function(e){
            e.preventDefault();
            $('#modalImportPayroll_v8').modal('show')
        })
        $(document).on('click','.import_run_V9',function(e){
            e.preventDefault();
            $('#modalImportPayroll_v9').modal('show')
        })
        $(document).on('click','.import_run_V10',function(e){
            e.preventDefault();
            $('#modalImportPayroll_v10').modal('show')
        })
        $(document).on('click','.import_run_V11',function(e){
            e.preventDefault();
            $('#modalImportPayroll_v11').modal('show')
        })
        $(document).on('click','.import_run_V12',function(e){
            e.preventDefault();
            $('#modalImportPayroll_v12').modal('show')
        })
        $(document).on('click','.import_run_V13',function(e){
            e.preventDefault();
            $('#modalImportPayroll_v13').modal('show')
        })
        $(document).on('click','.import_run_V14',function(e){
            e.preventDefault();
            $('#modalImportPayroll_v14').modal('show')
        })
        $(document).on('click','.import_run_V15',function(e){
            e.preventDefault();
            $('#modalImportPayroll_v15').modal('show')
        })
        $(document).on('click','.import_run_V16',function(e){
            e.preventDefault();
            $('#modalImportPayroll_v16').modal('show')
        })
        $(document).on('click','.import_run_V17',function(e){
            e.preventDefault();
            $('#modalImportPayroll_v17').modal('show')
        })
        $(document).on('click','.import_run_V18',function(e){
            e.preventDefault();
            $('#modalImportPayroll_v18').modal('show')
        })
        // submit import
        // v1
        $('#UploadDataPayroll_v1').on('submit',function(e){
            e.preventDefault();
            var startdate   = $('#startdate').val();
            var enddate     = $('#enddate').val();
            var branch_id   = $('#branch_id').val();
            
            var payroll  = $('#import-payroll-v1')[0].files[0];
            var formData = new FormData();
            formData.append('import-payroll',payroll)
                $.ajax({
                    url : 'import-payroll-v1',
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
                            $('#UploadDataPayroll_v1')[0].reset();
                            $('#modalImportPayroll_v1').modal('hide')
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
        // v2
        $('#UploadDataPayroll_v2').on('submit',function(e){
            e.preventDefault();
            var startdate   = $('#startdate').val();
            var enddate     = $('#enddate').val();
            var branch_id   = $('#branch_id').val();
            
            var payroll  = $('#import-payroll-v2')[0].files[0];
            var formData = new FormData();
            formData.append('import-payroll',payroll)
                $.ajax({
                    url : 'import-payroll-v2',
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
                            $('#UploadDataPayroll_v2')[0].reset();
                            $('#modalImportPayroll_v2').modal('hide')
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
        // v3
        $('#UploadDataPayroll_v3').on('submit',function(e){
            e.preventDefault();
            var startdate   = $('#startdate').val();
            var enddate     = $('#enddate').val();
            var branch_id   = $('#branch_id').val();
            
            var payroll  = $('#import-payroll-v3')[0].files[0];
            var formData = new FormData();
            formData.append('import-payroll',payroll)
                $.ajax({
                    url : 'import-payroll-v3',
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
                            $('#UploadDataPayroll_v3')[0].reset();
                            $('#modalImportPayroll_v3').modal('hide')
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
        // v4
        $('#UploadDataPayroll_v4').on('submit',function(e){
            e.preventDefault();
            var startdate   = $('#startdate').val();
            var enddate     = $('#enddate').val();
            var branch_id   = $('#branch_id').val();
            
            var payroll  = $('#import-payroll-v4')[0].files[0];
            var formData = new FormData();
            formData.append('import-payroll',payroll)
                $.ajax({
                    url : 'import-payroll-v4',
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
                            $('#UploadDataPayroll_v4')[0].reset();
                            $('#modalImportPayroll_v4').modal('hide')
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
        // v5
        $('#UploadDataPayroll_v5').on('submit',function(e){
            e.preventDefault();
            var startdate   = $('#startdate').val();
            var enddate     = $('#enddate').val();
            var branch_id   = $('#branch_id').val();
            
            var payroll  = $('#import-payroll-v5')[0].files[0];
            var formData = new FormData();
            formData.append('import-payroll',payroll)
                $.ajax({
                    url : 'import-payroll-v5',
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
                            $('#UploadDataPayroll_v5')[0].reset();
                            $('#modalImportPayroll_v5').modal('hide')
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
        // v6
        $('#UploadDataPayroll_v6').on('submit',function(e){
            e.preventDefault();
            var startdate   = $('#startdate').val();
            var enddate     = $('#enddate').val();
            var branch_id   = $('#branch_id').val();
            
            var payroll  = $('#import-payroll-v6')[0].files[0];
            var formData = new FormData();
            formData.append('import-payroll',payroll)
                $.ajax({
                    url : 'import-payroll-v6',
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
                            $('#UploadDataPayroll_v6')[0].reset();
                            $('#modalImportPayroll_v6').modal('hide')
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
        // v7
        $('#UploadDataPayroll_v7').on('submit',function(e){
            e.preventDefault();
            var startdate   = $('#startdate').val();
            var enddate     = $('#enddate').val();
            var branch_id   = $('#branch_id').val();
            
            var payroll  = $('#import-payroll-v7')[0].files[0];
            var formData = new FormData();
            formData.append('import-payroll',payroll)
                $.ajax({
                    url : 'import-payroll-v7',
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
                            $('#UploadDataPayroll_v7')[0].reset();
                            $('#modalImportPayroll_v7').modal('hide')
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
        // v8
        $('#UploadDataPayroll_v8').on('submit',function(e){
            e.preventDefault();
            var startdate   = $('#startdate').val();
            var enddate     = $('#enddate').val();
            var branch_id   = $('#branch_id').val();
            
            var payroll  = $('#import-payroll-v8')[0].files[0];
            var formData = new FormData();
            formData.append('import-payroll',payroll)
                $.ajax({
                    url : 'import-payroll-v8',
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
                            $('#UploadDataPayroll_v8')[0].reset();
                            $('#modalImportPayroll_v8').modal('hide')
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
        // v9
        $('#UploadDataPayroll_v9').on('submit',function(e){
            e.preventDefault();
            var startdate   = $('#startdate').val();
            var enddate     = $('#enddate').val();
            var branch_id   = $('#branch_id').val();
            
            var payroll  = $('#import-payroll-v9')[0].files[0];
            var formData = new FormData();
            formData.append('import-payroll',payroll)
                $.ajax({
                    url : 'import-payroll-v9',
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
                            $('#UploadDataPayroll_v9')[0].reset();
                            $('#modalImportPayroll_v9').modal('hide')
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
        // v10
        $('#UploadDataPayroll_v10').on('submit',function(e){
            e.preventDefault();
            var startdate   = $('#startdate').val();
            var enddate     = $('#enddate').val();
            var branch_id   = $('#branch_id').val();
            
            var payroll  = $('#import-payroll-v10')[0].files[0];
            var formData = new FormData();
            formData.append('import-payroll',payroll)
                $.ajax({
                    url : 'import-payroll-v10',
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
                            $('#UploadDataPayroll_v10')[0].reset();
                            $('#modalImportPayroll_v10').modal('hide')
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
        // v11
        $('#UploadDataPayroll_v11').on('submit',function(e){
            e.preventDefault();
            var startdate   = $('#startdate').val();
            var enddate     = $('#enddate').val();
            var branch_id   = $('#branch_id').val();
            
            var payroll  = $('#import-payroll-v11')[0].files[0];
            var formData = new FormData();
            formData.append('import-payroll',payroll)
                $.ajax({
                    url : 'import-payroll-v11',
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
                            $('#UploadDataPayroll_v11')[0].reset();
                            $('#modalImportPayroll_v11').modal('hide')
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
         // v12
        $('#UploadDataPayroll_v12').on('submit',function(e){
            e.preventDefault();
            var startdate   = $('#startdate').val();
            var enddate     = $('#enddate').val();
            var branch_id   = $('#branch_id').val();
            
            var payroll  = $('#import-payroll-v12')[0].files[0];
            var formData = new FormData();
            formData.append('import-payroll',payroll)
                $.ajax({
                    url : 'import-payroll-v12',
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
                            $('#UploadDataPayroll_v12')[0].reset();
                            $('#modalImportPayroll_v12').modal('hide')
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
         // v13
         $('#UploadDataPayroll_v13').on('submit',function(e){
            e.preventDefault();
            var startdate   = $('#startdate').val();
            var enddate     = $('#enddate').val();
            var branch_id   = $('#branch_id').val();
            
            var payroll  = $('#import-payroll-v13')[0].files[0];
            var formData = new FormData();
            formData.append('import-payroll',payroll)
                $.ajax({
                    url : 'import-payroll-v13',
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
                            $('#UploadDataPayroll_v13')[0].reset();
                            $('#modalImportPayroll_v13').modal('hide')
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
         // v14
        $('#UploadDataPayroll_v14').on('submit',function(e){
            e.preventDefault();
            var startdate   = $('#startdate').val();
            var enddate     = $('#enddate').val();
            var branch_id   = $('#branch_id').val();
            
            var payroll  = $('#import-payroll-v14')[0].files[0];
            var formData = new FormData();
            formData.append('import-payroll',payroll)
                $.ajax({
                    url : 'import-payroll-v14',
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
                            $('#UploadDataPayroll_v14')[0].reset();
                            $('#modalImportPayroll_v14').modal('hide')
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
        // v15
        $('#UploadDataPayroll_v15').on('submit',function(e){
            e.preventDefault();
            var startdate   = $('#startdate').val();
            var enddate     = $('#enddate').val();
            var branch_id   = $('#branch_id').val();
            
            var payroll  = $('#import-payroll-v15')[0].files[0];
            var formData = new FormData();
            formData.append('import-payroll',payroll)
                $.ajax({
                    url : 'import-payroll-v15',
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
                            $('#UploadDataPayroll_v15')[0].reset();
                            $('#modalImportPayroll_v15').modal('hide')
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
        // v16
        $('#UploadDataPayroll_v16').on('submit',function(e){
            e.preventDefault();
            var startdate   = $('#startdate').val();
            var enddate     = $('#enddate').val();
            var branch_id   = $('#branch_id').val();
            
            var payroll  = $('#import-payroll-v16')[0].files[0];
            var formData = new FormData();
            formData.append('import-payroll',payroll)
                $.ajax({
                    url : 'import-payroll-v16',
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
                            $('#UploadDataPayroll_v16')[0].reset();
                            $('#modalImportPayroll_v16').modal('hide')
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
        // v17
        $('#UploadDataPayroll_v17').on('submit',function(e){
            e.preventDefault();
            var startdate   = $('#startdate').val();
            var enddate     = $('#enddate').val();
            var branch_id   = $('#branch_id').val();
            
            var payroll  = $('#import-payroll-v17')[0].files[0];
            var formData = new FormData();
            formData.append('import-payroll',payroll)
                $.ajax({
                    url : 'import-payroll-v17',
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
                            $('#UploadDataPayroll_v17')[0].reset();
                            $('#modalImportPayroll_v17').modal('hide')
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
        // v18
        $('#UploadDataPayroll_v18').on('submit',function(e){
            e.preventDefault();
            var startdate   = $('#startdate').val();
            var enddate     = $('#enddate').val();
            var branch_id   = $('#branch_id').val();
            
            var payroll  = $('#import-payroll-v18')[0].files[0];
            var formData = new FormData();
            formData.append('import-payroll',payroll)
                $.ajax({
                    url : 'import-payroll-v18',
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
                            $('#UploadDataPayroll_v18')[0].reset();
                            $('#modalImportPayroll_v18').modal('hide')
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
    }); 
        
    </script>
@endpush
