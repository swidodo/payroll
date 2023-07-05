@extends('pages.dashboard')

@section('title', 'Setting Kecelakaan Kerja')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Setting Kecelakaan Kerja</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Setting Kecelakaan Kerja</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row justify-content-center">
            <div class="col-md-8" >
            
                <form action="{{route('setting.jkk.post')}}" method="POST">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-md-6 col-lg-3" >
                            <div class="form-group" >
                                <label>Type</label>
                                <input class="form-control" name="jkk[0][risk]" type="text" value="{{isset($jkk_val[0]) ? $jkk_val[0]['risk'] : 'Resiko sangat rendah'}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">Percentage (%)</label>
                                <input class="form-control" name="jkk[0][percentage]" type="text" value="{{isset($jkk_val[0]) ? $jkk_val[0]['percentage'] : '0.24'}}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-md-6 col-lg-3" >
                            <div class="form-group" >
                                <label>Type</label>
                                <input class="form-control" name="jkk[1][risk]" type="tex" value="{{isset($jkk_val[1]) ? $jkk_val[1]['risk'] : 'Resiko rendah'}}">
                                
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">Percentage (%)</label>
                                <input class="form-control" name="jkk[1][percentage]" type="text" value="{{isset($jkk_val[1]) ? $jkk_val[1]['percentage'] : '0.54'}}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-md-6 col-lg-3" >
                            <div class="form-group" >
                                <label>Type</label>
                                <input class="form-control" name="jkk[2][risk]" type="text" value="{{ isset($jkk_val[2]) ? $jkk_val[2]['risk'] : 'Resiko sedang'}}">
                               
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">Percentage (%)</label>
                                <input class="form-control" name="jkk[2][percentage]" type="text" value="{{isset($jkk_val[2]) ? $jkk_val[2]['percentage'] : '0.89'}}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-md-6 col-lg-3" >
                            <div class="form-group" >
                                <label>Type</label>
                                <input class="form-control" name="jkk[3][risk]" type="text" value="{{isset($jkk_val[3]) ? $jkk_val[3]['risk'] : 'Resiko tinggi'}}">
                               
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">Percentage (%)</label>
                                <input class="form-control" name="jkk[3][percentage]" type="text" value="{{isset($jkk_val[3]) ? $jkk_val[3]['percentage'] : '1.27'}}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-md-6 col-lg-3" >
                            <div class="form-group" >
                                <label>Type</label>
                                <input class="form-control" name="jkk[4][risk]" type="text" value="{{isset($jkk_val[4]) ? $jkk_val[4]['risk'] : 'Resiko sangat tinggi'}}">
                                
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">Percentage (%)</label>
                                <input class="form-control" name="jkk[4][percentage]" type="text" value="{{isset($jkk_val[4]) ? $jkk_val[4]['percentage'] : '1.74'}}">
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
