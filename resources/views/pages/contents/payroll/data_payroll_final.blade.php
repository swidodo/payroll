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
                    <h3 class="page-title">Payroll</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Payroll</li>
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
                                <label>branch</label>
                                <select class="form-select form-control" id="branch_id">
                                    @foreach($branch as $br)
                                    <option value="{{ $br->id }} ">{{ $br->name }}</option>
                                    @endforeach
                                </select>
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
                var startdate = $('#startdate').val();
                var enddate = $('#enddate').val();
                var branch_id = $('#branch_id').val();
                loadData(startdate,enddate,branch_id)
                // $(document).on('click','.cetak-payroll',function(e){
                //     e.preventDefault();
                //     var id          = $(this).attr('data-id');
                //     var employeeId  = $(this).attr('data-employeeid');
                //     $.ajax({
                //         url : 'generate_slip_payroll',
                //         type : 'post',
                //         data : {startdate:startdate,enddate:enddate,id:id,employee_id : employeeId},
                //         dataType : 'json',
                //         success : function(e){
                //             window.location
                //         }
                //     })
                // })
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
                            render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'allowance_fixed',
                            render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'allowance_unfixed',
                            render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'allowance_other',
                            render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'overtime',
                           render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'salary_this_month',
                            render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'company_pay_bpjs',
                            render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'total_salary',
                            render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'company_pay_bpjs_kesehatan',
                            render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'company_pay_bpjs_ketenagakerjaan',
                            render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'company_total_pay_bpjs',
                            render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'employee_pay_bpjs_kesehatan',
                            render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'employee_pay_bpjs_ketenagakerjaan',
                            render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'employee_total_pay_bpjs',
                            render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        {
                            data: 'installment',
                            render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'loans',
                            nrender : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'total_pay_loans',
                            render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'sanksi_adm',
                            render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'pph21',
                            render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'total_deduction',
                            render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        }, 
                        {
                            data: 'take_home_pay',
                            render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
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
