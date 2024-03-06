



@extends('pages.dashboard')

@section('title', 'Ter-Montly-Rate')

@section('dashboard-content')
@push('addon-style')
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2/sweetalert2.min.css')}}">
<!-- Select2 CSS -->
<link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">

@endpush
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Manage TER Rate</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Ter Rate</li>
                    </ul>
                </div>
                    {{-- <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" id="addDataRotate"><i class="fa fa-plus"></i>Ter Montly Rate</a>
                    </div>
                @can('create rotation')
                @endcan --}}
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-sm w-100" id="tblTarif-monthly-rate">
                        <thead>
                            <tr>
                                <th colspan="5" class="text-center" style="background:#FE8C51">TER RATE</th>
                            </tr>
                            <tr>
                                <th colspan="5" class="text-center">Employee Absolute</th></th>
                            </tr>
                            <tr>
                                <th class="text-center">Start</th>
                                <th class="text-center"></th>
                                <th class="text-center">End</th>
                                <th class="text-center">Rate</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rate as $rates)
                                <tr>
                                    <td class="text-center">{{ ($rates->start_value !='' && $rates->start_value !=null ) ? number_format($rates->start_value) :''}} </td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">{{ ($rates->end_value !='' && $rates->end_value !=null ) ? number_format($rates->end_value) : '' }}</td>
                                    <td class="text-center">{{ $rates->tarif.' %' }}</td>
                                    <td class="text-center">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a  data-id='{{$rates->id}}' class="dropdown-item edit_ter fw-bold" href="javascript:void(0)"><i class="fa fa-pencil m-r-5 me-1"></i> Edit</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.modal.ter_edit_tarifpph21');
@endsection
@push('addon-script')
<script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/js/select2.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.containerLoader').attr('hidden',false)
    $(document).ready(function () {
        $('.containerLoader').attr('hidden',true)
        
        if($('.edit-to-depart').length > 0) {
            $('.edit-to-depart').select2({
                width: '100%',
                theme: 'bootstrap4',
                tags: true,
                // dropdownParent: $('#addDataRotate')
            });
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       
        $(document).on('click','.edit_ter', function(e){
            e.preventDefault();
            var id = $(this).attr('data-id')
            $.ajax({
                url : 'edit-data-rate',
                type : 'post',
                data : {id : id},
                dataType : 'json',
                beforeSend : function(){
                    $('.containerLoader').attr('hidden',false)
                },
                success : function(respon){
                    $('.containerLoader').attr('hidden',true)
                    $('#edit_modal_ter').modal('show');
                    $('#id').val(respon.id)
                    $('#starting_edit').val(respon.start_value)
                    $('#ending_edit').val(respon.end_value)
                    $('#tarif_edit').val(respon.tarif)
                    $('#heading').html('EDIT MONTHLY RATE')
                    
                },
                error : function(){
                    $('.containerLoader').attr('hidden',true)
                    alert('Something went wrong!')

                }
            })

        })
        $('#editFormCategoryTer').on('submit',function(e){
            e.preventDefault();
            var data = $(this).serialize();
            var category = $('#category_edit').val();
            $.ajax({
                url : 'update-data-ter-absolute',
                type : 'post',
                data : data,
                dataType : 'json',
                beforeSend : function(){
                    $('.containerLoader').attr('hidden',false)
                },
                success : function(respon){
                    $('.containerLoader').attr('hidden',true)
                    if(respon.status == 'success'){
                        $('#edit_modal_ter').modal('hide');
                        $('#editFormCategoryTer')[0].reset();
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg
                        }).then(function(confirm){
                            window.location.href = "{{route('ter-monthly-rate')}}";
                        })
                    }else{
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg
                        })
                    }
                },
                error : function(){
                    $('.containerLoader').attr('hidden',true)
                    alert('Something went wrong!')

                }
            })
        })
    });
       
</script>
@endpush
