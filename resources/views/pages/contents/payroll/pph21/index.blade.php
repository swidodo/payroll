@extends('pages.dashboard')

@section('title', 'Setting PPH21')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Setting PPh21</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Setting PPh21</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row justify-content-center">
            <div class="col-md-8" >
            
                <form action="{{route('setting.pph21.post')}}" method="POST">
                    @csrf

                    <div class="row justify-content-center mb-3">
                        <div class="col-md-9">
                                <div class="task-wrapper p-0 pt-2">
                                    <div class="task-list-container">
                                        <div class="task-list-body">
                                            <ul id="task-list">
                                                <li class="task">
                                                    <div class="task-container d-flex">
                                                        @php
                                                            $is_paid_by_employee_themselve = \App\Models\Utility::where('name', 'is_paid_by_employee_themselve')->first();
                                                        @endphp
                                                        <span class="task-action-btn task-check d-flex align-items-center me-2">
                                                            <input {{ $is_paid_by_employee_themselve->value ? 'checked' : ''}} type="checkbox" name="is_paid_by_employee_themselve" id="" class="action-circle large complete-btn">
                                                        </span>
                                                        <span >Is it paid by the employees themselves?</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-md-6 col-lg-3" >
                            <div class="form-group" >
                                <label>Income 1 ( < 60M )</label>
                                <input class="form-control" name="pph21[0][income]" type="number" value="{{isset($pph21_val[0]) ? $pph21_val[0]['income'] : '-'}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">Percentage (%)</label>
                                <input class="form-control" name="pph21[0][percentage]" type="number" value="{{isset($pph21_val[0]) ? $pph21_val[0]['percentage'] : '-'}}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-md-6 col-lg-3" >
                            <div class="form-group" >
                                <label>Income 2 ( 60M - 250M )</label>
                                <input class="form-control" name="pph21[1][income]" type="number" value="{{isset($pph21_val[1]) ? $pph21_val[1]['income'] : '-'}}">
                                
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">Percentage (%)</label>
                                <input class="form-control" name="pph21[1][percentage]" type="number" value="{{isset($pph21_val[1]) ? $pph21_val[1]['percentage'] : '-'}}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-md-6 col-lg-3" >
                            <div class="form-group" >
                                <label>Income 3 ( 250M - 500M )</label>
                                <input class="form-control" name="pph21[2][income]" type="number" value="{{ isset($pph21_val[2]) ? $pph21_val[2]['income'] : '-'}}">
                               
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">Percentage (%)</label>
                                <input class="form-control" name="pph21[2][percentage]" type="number" value="{{isset($pph21_val[2]) ? $pph21_val[2]['percentage'] : '-'}}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-md-6 col-lg-3" >
                            <div class="form-group" >
                                <label>Income 4 ( 500M - 5B )</label>
                                <input class="form-control" name="pph21[3][income]" type="number" value="{{isset($pph21_val[3]) ? $pph21_val[3]['income'] : '-'}}">
                               
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">Percentage (%)</label>
                                <input class="form-control" name="pph21[3][percentage]" type="number" value="{{isset($pph21_val[3]) ? $pph21_val[3]['percentage'] : '-'}}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-md-6 col-lg-3" >
                            <div class="form-group" >
                                <label>Income 5 ( > 5B )</label>
                                <input class="form-control" name="pph21[4][income]" type="number" value="{{isset($pph21_val[4]) ? $pph21_val[4]['income'] : '-'}}">
                                
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">Percentage (%)</label>
                                <input class="form-control" name="pph21[4][percentage]" type="number" value="{{isset($pph21_val[4]) ? $pph21_val[4]['percentage'] : '-'}}">
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    {{-- @include('includes.modal.payroll-modal') --}}

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

    @if (Session::has('edit-show'))
    <script>
        $(window).on('load', function(){
            $('#edit_reimburst').modal('show')
        });
    </script>
    @endif

    <script>
            $(document).ready(function () {
                /* When click show user */

                $('select#type').change(function(){
                    let val = $(this).val()

                    if(val == 'Fixed'){
                        $('#label-type').html('Amount')
                    }else{
                        $('#label-type').html('Percentage %')

                    }

                })

                
            });
    </script>
@endpush
