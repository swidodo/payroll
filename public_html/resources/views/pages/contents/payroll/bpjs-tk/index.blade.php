@extends('pages.dashboard')

@section('title', 'Setting BPJS Kesehatan')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Setting BPJS Kesehatan</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Setting BPJS Kesehatan</li>
                    </ul>
                </div>
                {{-- @can('create payroll')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_payroll"><i class="fa fa-plus"></i> New Payroll</a>
                    </div>
                @endcan --}}
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

        <div class="row justify-content-center">
            <div class="col-md-8" >
            
                <form action="{{route('setting.bpjs-tk.post')}}" method="POST">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-md-6 col-lg-3" >
                            <div class="form-group" >
                                <label>Type</label>
                                <select class="form-control" name="type" id="type">
                                    @if ($bpjs_tk_val != null)
                                        @if ($bpjs_tk_val['type'] == 'Fixed')
                                            <option value="Fixed" selected>Fixed</option>
                                            <option value="Percentage">Percentage</option>

                                        @elseif ($bpjs_tk_val['type'] == 'Percentage')
                                            <option value="Fixed">Fixed</option>
                                            <option value="Percentage" selected>Percentage</option>
                                        @endif
                                    @else
                                        <option value="Fixed" selected>Select Type</option>
                                        <option value="Fixed" >Fixed</option>
                                        <option value="Percentage" >Percentage</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">{{$bpjs_tk_val != null && $bpjs_tk_val['type'] == 'Fixed' ? 'Amount' : 'Percentage %'}}</label>
                                <input class="form-control" name="number_value" type="number" value="{{$bpjs_tk_val['value'] ?? '-'}}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label id="label-type">Maximum Salary</label>
                                <input class="form-control" name="maximum_salary" type="number" value="{{$bpjs_tk_val['maximum_salary'] ?? '-'}}">
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
