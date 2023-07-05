@extends('pages.dashboard')

@section('title', 'Setting PTKP')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Setting PTKP</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Setting PTKP</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row justify-content-center">
            <div class="col-md-8" >
            
                <form action="{{route('setting.ptkp.post')}}" method="POST">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">PTKP Amount (TK 0)</label>
                                <input hidden class="form-control" name="pph21[tk][0][status]" type="text" value="tk_0">
                                <input class="form-control" name="pph21[tk][0][amount]" type="number" value="{{ isset($ptkp[0]) && $ptkp[0]->status_name == 'tk_0' ? $ptkp[0]->ptkp_amount : 0}}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">PTKP Amount (TK 1)</label>
                                <input hidden class="form-control" name="pph21[tk][1][status]" type="text" value="tk_1">
                                <input class="form-control" name="pph21[tk][1][amount]" type="number" value="{{isset($ptkp[1]) && $ptkp[1]->status_name == 'tk_1' ? $ptkp[1]->ptkp_amount : 0}}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">PTKP Amount (TK 2)</label>
                                <input hidden class="form-control" name="pph21[tk][2][status]" type="text" value="tk_2">
                                <input class="form-control" name="pph21[tk][2][amount]" type="number" value="{{isset($ptkp[2]) && $ptkp[2]->status_name == 'tk_2' ? $ptkp[2]->ptkp_amount : 0}}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">PTKP Amount (TK 3)</label>
                                <input hidden class="form-control" name="pph21[tk][3][status]" type="text" value="tk_3">
                                <input class="form-control" name="pph21[tk][3][amount]" type="number" value="{{isset($ptkp[3]) && $ptkp[3]->status_name == 'tk_3' ? $ptkp[3]->ptkp_amount : 0}}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">PTKP Amount (K 0)</label>
                                <input hidden class="form-control" name="pph21[k][0][status]" type="text" value="k_0">
                                <input class="form-control" name="pph21[k][0][amount]" type="number" value="{{isset($ptkp[4]) && $ptkp[4]->status_name == 'k_0' ? $ptkp[4]->ptkp_amount : 0}}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">PTKP Amount (K 1)</label>
                                <input hidden class="form-control" name="pph21[k][1][status]" type="text" value="k_1">
                                <input class="form-control" name="pph21[k][1][amount]" type="number" value="{{ isset($ptkp[5]) && $ptkp[5]->status_name == 'k_1' ? $ptkp[5]->ptkp_amount : 0}}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">PTKP Amount (K 2)</label>
                                <input hidden class="form-control" name="pph21[k][2][status]" type="text" value="k_2">
                                <input class="form-control" name="pph21[k][2][amount]" type="number" value="{{isset($ptkp[6]) && $ptkp[6]->status_name == 'k_2' ? $ptkp[6]->ptkp_amount : 0}}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">PTKP Amount (K 3)</label>
                                <input hidden class="form-control" name="pph21[k][3][status]" type="text" value="k_3">
                                <input class="form-control" name="pph21[k][3][amount]" type="number" value="{{isset($ptkp[7]) && $ptkp[7]->status_name == 'k_3' ? $ptkp[7]->ptkp_amount : 0}}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">PTKP Amount (K/I/0)</label>
                                <input hidden class="form-control" name="pph21[k/i][0][status]" type="text" value="ki0">
                                <input class="form-control" name="pph21[k/i][0][amount]" type="number" value="{{isset($ptkp[8]) && $ptkp[8]->status_name == 'ki0' ? $ptkp[8]->ptkp_amount : 0}}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">PTKP Amount (K/I/1)</label>
                                <input hidden class="form-control" name="pph21[k/i][1][status]" type="text" value="ki1">
                                <input class="form-control" name="pph21[k/i][1][amount]" type="number" value="{{isset($ptkp[9]) && $ptkp[9]->status_name == 'ki1' ? $ptkp[9]->ptkp_amount : 0}}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">PTKP Amount (K/I/2)</label>
                                <input hidden class="form-control" name="pph21[k/i][2][status]" type="text" value="ki2">
                                <input class="form-control" name="pph21[k/i][2][amount]" type="number" value="{{isset($ptkp[10]) && $ptkp[10]->status_name == 'ki2' ? $ptkp[10]->ptkp_amount : 0}}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="label-type">PTKP Amount (K/I/3)</label>
                                <input hidden class="form-control" name="pph21[k/i][3][status]" type="text" value="ki3">
                                <input class="form-control" name="pph21[k/i][3][amount]" type="number" value="{{isset($ptkp[11]) && $ptkp[11]->status_name == 'ki3' ? $ptkp[11]->ptkp_amount : 0}}">
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
