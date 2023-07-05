@extends('pages.dashboard')

@section('title', 'Payslip')

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
                    <h3 class="page-title">Payslip</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Payslip</li>
                    </ul>
                </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="{{asset('file/sample-payslip/sample payslip.pdf')}}" download class="btn add-btn">Sample</a>
                    </div>
            </div>
        </div>
        <!-- /Page Header -->


        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{Session::get('success')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive" style="overflow-x: visible">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Employee</th>
                                <th>Payslip Type</th>
                                <th>Salary</th>
                                <th>Net Salary</th>
                                @can('generate payslip')
                                    <th>Payslip</th>
                                @endcan
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>
                                        {{$employee->id  ?? '-'}}
                                    </td>
                                    <td>
                                        {{$employee->name ?? '-'}}
                                    </td>
                                    <td>
                                        {{$employee->salary_type  ?? '-' }}
                                    </td>
                                    <td>
                                        {{formatRupiah($employee->salary)  ?? '-' }}
                                    </td>
                                    <td>
                                        {{formatRupiah($employee->net_salary)  ?? '-' }}
                                    </td>
                                    @can('generate payslip')
                                        <td>
                                            <a class="btn btn-sm btn-primary" data-url="{{route('payslips.generate-slip', $employee->id)}}" href="javascript:void(0)" id="btn-generate" data-bs-toggle="modal" data-bs-target="#modal_pin">Generate Slip</a>
                                            <button {{$employee->status != 'active' ? 'disabled' : ''}} id="btn-show-payslip" data-url="{{ route('payslips.show-slip', $employee->id)}}" class="btn btn-secondary btn-sm" title="View Payslip" data-bs-toggle="modal" data-bs-target="#modal_pin">View</button>
                                        </td>
                                    @endcan
                                    <td class="text-end">
                                        <a title="Detail" id="detail-emp-request" class="btn btn-primary px-2 py-1 me-1" href="{{route('payslips.show', $employee->id)}}"><i class="fa-solid fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    @include('includes.modal.payslip-modal')

</div>
@endsection

@push('addon-style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
@endpush

@push('addon-script')
    <script src="https://kit.fontawesome.com/bbc31f3764.js" crossorigin="anonymous"></script>


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

    <script>
            $(document).ready(function () {
                $('body').on('click', '#btn-generate', function () {
                    const url = $(this).data('url');
                    
                    $('#form-pin').attr('action', url);
                });

                $('body').on('click', '#btn-show-payslip', function () {
                    const url = $(this).data('url');
                    
                    // $('#pin').val('');
                    $('#form-pin').attr('action', url);
                });

                $('body').on('click', '#delete-leave', function(){
                    const deleteURL = $(this).data('url');
                    $('#form-delete-leave').attr('action', deleteURL);
                })
            });
    </script>
@endpush
