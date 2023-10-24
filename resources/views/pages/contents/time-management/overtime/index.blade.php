@extends('pages.dashboard')

@section('title', 'Overtime')

@section('dashboard-content')
@php
    function formatRupiah($angka){
	$hasil_rupiah = "IDR " . number_format($angka,2,',','.');
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
                    <h3 class="page-title">List of Overtime</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Overtime</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#modal_export"> Report</a>
                </div>
                @can('create overtime')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" id="newOvertime" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_overtime"><i class="fa fa-plus"></i>Overtime</a>
                    </div>
                @endcan
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
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h4>Filter Data</h4>
                        <hr />
                        <div class="col-md-4">
                            <label for="branchId" class="form-label">Branch</label>
                            <select class="form-control form-control-sm select" id="branchId" name="branch">
                                @foreach ($branch as $branch)
                                    <option value="{{$branch->id}}" {{($branch->id == Auth::user()->branch_id) ? 'selected':''}}>{{$branch->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" id="date" value="{{ $date}}" class="form-control">
                        </div>
                        <div class="col-md-4 d-flex align-items-center">
                        <button type="button" class="btn btn-primary mt-4" id="searchData"> Search </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped custom-table" id="tblOvertimes" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Employee ID</th>
                            <th>Employee</th>
                            <th>Date</th>
                            {{-- <th>End Date</th> --}}
                            <th>Day Type</th>
                            <th>Overtime Type</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Multiplier</th>
                            <th>Duration</th>
                            <th>nominal/hour</th>
                            <th>Amount Fee</th>
                            <th>Status</th>
                            <th>Notes</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    @include('includes.modal.overtime-modal')

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
    {{-- <script src="{{asset('assets/js/moment.min.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script> --}}

    <!-- timepicker JS -->
    <script src="{{asset('assets/js/jquery.timepicker.min.js')}}"></script>

    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

    @if (Session::has('edit-show'))
    <script>
        $(window).on('load', function(){
            $('#edit_overtime').modal('show')
        });
    </script>
    @endif

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
            });
            // load datatable
            var branchId = $('#branchId').val();
            var date = "";
            loadData(branchId,date)
            /* When click show user */
            $('input[id*="time_add"]').each(function( index ) {
                    $(this).timepicker({
                        timeFormat: 'HH:mm',
                        // minTime: '05:00'
                    });
                })

            $('select#status_edit').change(function(){
                let selectedItem = $(this).children('option:selected').val()

                if (selectedItem == 'Rejected') {
                    $('#rejected-reason').show()
                }else{
                    $('#rejected-reason').hide()
                }
            })

            if($('.select-employee').length > 0) {
                $('.select-employee').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#add_overtime')
                });
            }

            if($('.select-day-type').length > 0) {
                $('.select-day-type').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#add_overtime')
                });
            }

            if($('.select-overtime').length > 0) {
                $('.select-overtime').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#add_overtime')
                });
            }

            //edit
            if($('.select-employee-edit').length > 0) {
                $('.select-employee-edit').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#edit_overtime')
                });
            }

            if($('.select-overtime-edit').length > 0) {
                $('.select-overtime-edit').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#edit_overtime')
                });
            }
            if($('.select-day-type-edit').length > 0) {
                $('.select-day-type-edit').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#edit_overtime')
                });
            }
               
            $('#searchData').on('click',function(){
                var branchId = $('#branchId').val();
                var date = $('#date').val();
                loadData(branchId,date)
            })

        });
        function loadData(branch_id,date){
           $('#tblOvertimes').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                        "url" : 'get-list-overtime',
                        "type" : 'post',
                        "data" : {branch_id : branch_id, date : date},
                    },
                columns: [
                        { data: 'no', name:'id', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }},
                        {
                            data: 'no_employee',
                            name: 'no_employee'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'start_date',
                            name: 'start_date'
                        },
                        {
                            data: 'day_name',
                            name: 'day_name'
                        },
                        {
                            data: 'overtime_type',
                            name: 'overtime_type'
                        },
                        {
                            data: 'start_time',
                            name: 'start_time'
                        },
                        {
                            data: 'end_time',
                            name: 'end_time'
                        },
                        {
                            data: 'multiplier',
                            render : function(data, type, row){
                                if(data !=null){
                                    return data;
                                }else{
                                    return 'culculative'
                                }
                            }
                        },
                        {
                            data: 'duration',
                            name: 'duration'
                        },
                        {
                            data: 'nominal_per_hour',
                            render : function(data, type, row){
                                if(data != null){
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                    if(base.lastIndexOf(",") != -1)
                                        base = base.substring(0, base.lastIndexOf(","));
                                    return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                }else{
                                    return 'culculative';
                                }
                               
                            }
                        },
                        {
                            data: 'amount_fee',
                            render : function(data, type, row){
                                if(data != null){
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                    if(base.lastIndexOf(",") != -1)
                                        base = base.substring(0, base.lastIndexOf(","));
                                    return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                }else{
                                    return 0;
                                }
                            }
                        },
                        
                        {
                            data: 'status',
                            render : function(data,type,row){
                                var btn ='';
                                if (data === "pending"){
                                    btn = '<span class="badge badge-warning">Pending</span>'
                                }
                                if (data === "approve"){
                                    btn = '<span class="badge badge-success">Approve</span>'
                                }
                                if (data === "reject"){
                                    btn = '<span class="badge badge-danger">Reject</span>'
                                }
                                return btn;
                            }
                        },
                        {
                            data: 'notes',
                            name: 'notes'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                ],
            })
        }
        $('#newOvertime').on('click',function(e){
            e.preventDefault();
            var branchId = $('#branchId').val();
            $.ajax({
                url : 'get-overtime-employee',
                type : 'post',
                data : {branch_id : branchId },
                dataType : 'json',
                beforeSend : function(){

                },
                success : function(respon){
                    var emp = '<option value="">-- Select Employee --</option>';
                    $.each(respon.employee,function(key,val){
                        emp +=`<option value="`+val.id+`">`+val.name+`</option>`
                    })
                    $('#employee_id_add').html(emp)
                    $('#branch_id_overtime').val($('#branchId').val())
                },
                error : function(){

                }
            })
        })
        $(document).on('click','.edit-overtime',function(e){
            var id = $(this).attr('data-id')
            $.ajax({
                url : 'edit-overtime',
                type : 'post',
                data : {id : id },
                dataType : 'json',
                beforeSend : function(){

                },
                success : function(respon){
                    $('#id').val(respon.data.id)
                    $('#branchInput').val(respon.data.branch_id)
                    $('#viewEmployee').val(respon.data.employee.name)
                    $('#employee_id_edit').val(respon.data.employee_id)
                    $('#start_date_edit').val(respon.data.start_date)
                    $('#start_time_edit').val(respon.data.start_time)
                    $('#end_time_edit').val(respon.data.end_time)
                    $('#notes_edit').val(respon.data.notes)
                    var type ='';
                    $.each(respon.dayTypes, function(key,val){
                        if(respon.data.day_type_id ==val.id){
                            type += `<option value="`+val.id+`" selected>`+val.name+`</option>`
                        }else{
                            type += `<option value="`+val.id+`">`+val.name+`</option>`
                        }
                    })
                    $('#day_type_id_edit').html(type);

                    if (respon.data.overtime_type == "unnormal"){
                       $('#edit_unnorlamOvertime').prop('checked',true);
                       if (respon.data.multiplier == 1){
                            $aop =`<option value="1" selected>1 x</option>
                                   <option value="2">2 x</option>`;
                        }else if (respon.data.multiplier == 2){
                            $aop =`<option value="1">1 x</option>
                                   <option value="2" selected>2 x</option>`;
                       }else{
                            $aop =`<option value="" selected> -- Multiplier --</option>
                                    <option value="1">1 x</option>
                                   <option value="2">2 x</option>`;
                       }
                       var input = `<div class="col-md-3">
                                            <div class="form-group">
                                                <label for="multiplier" class="control-label" required="">Multiplier(x)</label>
                                                 <select class="form-control form-select" name="multiplier" id="edit_multiplier" onchange="return multiAutoedit()" required >
                                                     `+$aop+`
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="edit_jml_overtime" class="control-label" required="">Duration</label>
                                                <input type="text" name="duration_overtime" class="form-control" id="edit_jml_overtime" onkeyup="return durationAutoedit()" onkeypress="return angka()" value="`+respon.data.duration+`" required>
                                            </div>
                                        </div> 
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="edit_Overtime_hour" class="control-label">Nominal/Hour</label>
                                                <input type="text" name="nominal" class="form-control" id="edit_Overtime_hour" onkeyup="return autoTotaledit()" onkeypress="return angka()" value="`+respon.data.nominal_per_hour+`" required>
                                            </div>
                                        </div> 
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="edit_totalNominal" class="control-label">Total Nominal</label>
                                                <input type="text" name="total_nominal" class="form-control" id="edit_totalNominal" value="`+respon.data.amount_fee+`" onkeypress="return angka()">
                                            </div>
                                        </div>`;
                        $('.edit_unnormal').html(input);

                    }else{
                       $('.edit_unnormal').html('');
                    }
                },
                error : function(){

                }
            })
        })
        $('#edit_unnorlamOvertime').on('change',function(){
            if(!($(this).prop('checked'))){
                $('.edit_unnormal').attr("hidden",true)
            }
            else if($(this).prop('checked')){
                $('.edit_unnormal').removeAttr("hidden")
            }
        })
        $('#unnorlamOvertime').on('change',function(){
            var input = `
                    <div class="col-md-3">
                            <div class="form-group">
                                <label for="multiplier" class="control-label" required="">Multiplier(x)</label>
                                 <select class="form-control form-select" name="multiplier" id="multiplier" onchange="return multiAuto()" required >
                                    <option value="" selected>-- Multiplier --</option>
                                    <option value="1">1 x</option>
                                    <option value="2">2 x</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="jml_overtime" class="control-label" required="">Duration</label>
                                <input type="text" name="duration_overtime" class="form-control" id="jml_overtime" onkeyup="return durationAuto()"  onkeypress="return angka()" required>
                            </div>
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nominalOvertime" class="control-label">Nominal/Hour</label>
                                <input type="text" name="nominal" class="form-control" id="Overtime_hour" onkeyup="return autoTotal()"  onkeypress="return angka()" required>
                            </div>
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="totalNominal" class="control-label">Total Nominal</label>
                                <input type="text" name="total_nominal" class="form-control" id="totalNominal"  onkeypress="return angka()">
                            </div>
                        </div>
            `;
            if($(this).prop("checked")){
                $('.unnormal').html(input);
            }else{
                $('.unnormal').html('');
            }
        })
        $('#formAddOvertime').on('submit',function(e){
            e.preventDefault()
            var data = $('#formAddOvertime').serialize();
            var branchId = $('#branchId').val()
            var date = $('#date').val()
            $.ajax({
                url : '{{route('overtimes.store')}}',
                type : 'post',
                data : data,
                dataType : 'json',
                beforeSend : function(){

                },
                success : function(respon){
                    if(respon.status == 'success'){
                         $('#formAddOvertime')[0].reset();
                         $('#add_overtime').modal('hide')
                         loadData(branchId,date)
                    }
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg
                    })
                },
                error : function(){
                    alert('Sameting went wrong !')
                }
            })
        })

        $('#edit-form-overtime').on('submit',function(e){
            e.preventDefault()
            var branchId = $('#branchId').val()
            var date = $('#date').val()
            var data = $('#edit-form-overtime').serialize()
            $.ajax({
                url : 'update-overtime',
                type : 'post',
                data :data,
                dataType : 'json',
                beforeSend : function(){

                },
                success : function(respon){
                    if (respon.status == "success"){
                        $('#edit_overtime').modal('hide')
                        loadData(branchId,date);
                    }
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg
                    })
                },
                error : function(){
                    alert('Sameting went wrong !')
                }
            })
        })
        function angka(){
            var charCode = (e.which) ? e.which : event.keyCode
                if (charCode >31 && (charCode < 48 || charCode >57 ))
                return false;
            return true;
        }
        function multiAuto(){
            var Overtime_hour = $('#Overtime_hour').val()
            var duration = $('#jml_overtime').val()
            var multi = $('#multiplier').val();
            var total = (multi * duration) * Overtime_hour;
            $('#totalNominal').val(total)
        }
        function durationAuto(){
            var Overtime_hour = $('#Overtime_hour').val()
            var duration = $('#jml_overtime').val()
            var multi = $('#multiplier').val();
            var total = (multi * duration) * Overtime_hour;
            $('#totalNominal').val(total)
        }
        function autoTotal(){
            var Overtime_hour = $('#Overtime_hour').val()
            var duration = $('#jml_overtime').val()
            var multi = $('#multiplier').val();
            var total = (multi * duration) * Overtime_hour;
            $('#totalNominal').val(total)
        }
        function multiAutoedit(){
            var Overtime_hour = $('#edit_Overtime_hour').val()
            var duration = $('#edit_jml_overtime').val()
            var multi = $('#edit_multiplier').val();
            var total = (multi * duration) * Overtime_hour;
            $('#edit_totalNominal').val(total)
        }
        function durationAutoedit(){
            var Overtime_hour = $('#edit_Overtime_hour').val()
            var duration = $('#edit_jml_overtime').val()
            var multi = $('#edit_multiplier').val();
            var total = (multi * duration) * Overtime_hour;
            $('#edit_totalNominal').val(total)
        }
        function autoTotaledit(){
            var Overtime_hour = $('#edit_Overtime_hour').val()
            var duration = $('#edit_jml_overtime').val()
            var multi = $('#edit_multiplier').val();
            var total = (multi * duration) * Overtime_hour;
            $('#edit_totalNominal').val(total)
        }
        
    </script>
@endpush
