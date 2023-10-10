@extends('pages.dashboard')

@section('title', 'Payroll')

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
                                <label>start Date</label>
                                <input type="date" id="startdate" class="form-control" name="datestart" >
                                <input type="hidden" id="startdateId" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-2">
                                <label>End Date</label>
                                <input type="date" id="enddate" class="form-control" name="dateend">
                                <input type="date" id="enddateId" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-3">
                                <label>branch</label>
                                <select class="form-select form-control" id="branch_id">
                                    @foreach($branch as $br)
                                    <option value="{{ $br->id }} ">{{ $br->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-center mt-4"> 
                                <button type="button" class="btn btn-primary" id="generate_run_payroll">RUN PAYROLL</button>
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
                                <th>Installment</th>
                                <th>Loan</th>
                                <th>Installment + Loan</th>
                                <th>Saksi Adm</th>
                                <th>Pph21</th>
                                <th>Total Deduction</th>
                                <th>Take Home Pay</th>
                                @if(Auth::user()->can('edit payroll') || Auth::user()->can('delete payroll'))
                                    <th class="text-end">Action</th>
                                @endif
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
                var startdate       = $('#startdateId').val();
                var enddate        = $('#enddateId').val();
                var branch_id   = $('#branch_id').val();
                loadData(startdate,enddate,branch_id)
                $('#generate_run_payroll').on('click',function(){
                    $.ajax({
                        url : 'generate_run_payroll',
                        type : 'post',
                        data : {startdate:startdate,enddate:enddate,branch_id:branch_id},
                        dataType : 'json',
                        success: function(e){
                            swal.fire({
                                icon : e.status,
                                text : e.msg,
                            })
                            loadData(startdate,enddate,branch_id)
                        }
                    })
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
                            data: 'position',
                            name: 'position'
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
                            name: 'basic_salary'
                        },
                        {
                            data: 'allowance_fixed',
                            name: 'allowance_fixed'
                        },
                        {
                            data: 'allowance_unfixed',
                            name: 'allowance_unfixed'
                        },
                        {
                            data: 'allowance_other',
                            name: 'allowance_other'
                        },
                        {
                            data: 'overtime',
                            name: 'overtime'
                        },
                        {
                            data: 'salary_this_month',
                            name: 'salary_this_month'
                        },
                        {
                            data: 'company_pay_bpjs',
                            name: 'company_pay_bpjs'
                        },
                        {
                            data: 'total_salary',
                            name: 'total_salary'
                        },
                        {
                            data: 'company_pay_bpjs_kesehatan',
                            name: 'company_pay_bpjs_kesehatan'
                        },
                        {
                            data: 'company_pay_bpjs_ketenagakerjaan',
                            name: 'company_pay_bpjs_ketenagakerjaan'
                        },
                        {
                            data: 'company_total_pay_bpjs',
                            name: 'company_total_pay_bpjs'
                        },
                        {
                            data: 'employee_pay_bpjs_kesehatan',
                            name: 'employee_pay_bpjs_kesehatan'
                        },
                        {
                            data: 'employee_pay_bpjs_ketenagakerjaan',
                            name: 'employee_pay_bpjs_ketenagakerjaan'
                        },
                        {
                            data: 'employee_total_pay_bpjs',
                            name: 'employee_total_pay_bpjs'
                        }, 
                        {
                            data: 'installment',
                            name: 'installment'
                        },
                        {
                            data: 'loans',
                            name: 'loans'
                        },
                        {
                            data: 'total_pay_loans',
                            name: 'total_pay_loans'
                        },
                        {
                            data: 'sanksi_adm',
                            name: 'sanksi_adm'
                        },
                        {
                            data: 'pph21',
                            name: 'pph21'
                        },
                        {
                            data: 'total_deduction',
                            name: 'total_deduction'
                        }, 
                        {
                            data: 'take_home_pay',
                            name: 'take_home_pay'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ],
                })
            }

    </script>
@endpush
