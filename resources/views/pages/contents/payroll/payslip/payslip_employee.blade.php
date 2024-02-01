@extends('pages.dashboard')

@section('title', 'Payslip-employee')

@section('dashboard-content')

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
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table border border-0">
                            <thead>
                                <th>
                                    <h4>LIST PAYSLIP</h4>
                                </th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action bg-succes" aria-current="true">
                                                PERIODE :
                                            </a>
                                            @foreach ($payslip as $slips)
                                                <a href="export-payroll-pdf?branch_id={{$slips->branch_id}}&startdate={{$slips->startdate}}&enddate={{$slips->enddate}}&employee_id={{ $slips->employee_id }}" class="list-group-item list-group-item-action py-3" title="open">{{ strtoupper(date('F Y', strtotime($slips->enddate))) }}</a>  
                                            @endforeach
                                        </div>
                                    
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
