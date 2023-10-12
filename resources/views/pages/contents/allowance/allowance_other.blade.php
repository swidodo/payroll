@extends('pages.dashboard')

@section('title', 'Allowance Other')

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
                    <h3 class="page-title">Allowance Other</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Allowance Other</li>
                    </ul>
                </div>
                @can('create allowance')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" id="add-AllowanceOther"><i class="fa fa-plus"></i> New Allowance</a>
                    </div>
                @endcan
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="tblAllowanceother">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Employee ID</th>
                                <th>Employee</th>
                                <th>Type</th>
                                <th>Amount</th>
                                @if(Auth::user()->can('edit allowance') || Auth::user()->can('delete allowance'))
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
    @include('includes.modal.allowance_other.add_allowance')
    @include('includes.modal.allowance_other.edit_allowance')

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

    <script>
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
        var branchId ='';
        var employeeId ='';
        var table = $('#tblAllowanceother').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax : {
                    "url" : 'get-allowance-other',
                    "type" : 'POST',
                    "data" : {branch_id : branchId,employee_id :employeeId},
                },
            columns: [
                { data: 'no', name:'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'no_employee',
                    name: 'no_employee'
                },
                {
                    data: 'employee_name',
                    name: 'employee_name'
                },
                {
                    data: 'allowance_name',
                    name: 'allowance_name'
                },
                {
                    data: 'amount',
                    render : function(data, type, row){
                        return data.toLocaleString('en-US');
                    }
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
        })
        $('#add-AllowanceOther').click(function(e){
            e.preventDefault();
            $('#add_modal_allowance_other').modal('show')
        })
        $('#form-addallowanceOther').on('submit',function(e){
            e.preventDefault();
            var data = $('#form-addallowanceOther').serialize();
            $.ajax({
                url : 'store-allowance-other',
                type : 'post',
                data : data,
                dataType : 'json',
                beforeSend : function(){

                },
                success : function(respon){
                    table.ajax.reload();
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg
                    })
                    $('#add_modal_allowance_other').modal('hide')
                    $('#form-addallowanceOther')[0].reset();
                },
                error : function(e){
                    console.log(e.responseJSON.errors)
                    alert('There is an error !, please try again')
                }
            })
        })
        $(document).on('click','.edit-allowance-other',function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                url : 'edit-allowance-other',
                type : 'post',
                data : {id:id},
                dataType : 'json',
                beforeSend : function(){

                },
                success : function(respon){
                    var html ='';
                    var noemp = (respon.employee.no_employee !=null) ? respon.employee.no_employee :'';
                    $('#edit-date').val(respon.date);
                    $('#edit-id').val(respon.id);
                    $.each(respon.allowance_type, function(key,val){
                        var selected = (respon.allowance_option_id == val.id) ? 'selected' : '';
                        html += `<option value="`+val.id+`" `+selected+`>`+val.name+`</option>`;
                    })
                    $('#edit_employee_id').html(`<option value="`+ respon.employee_id +`">`+ noemp +` - `+respon.employee.name+`</option>`)
                    $('#edit-type_allowance').html(html);
                    $('#edit-amount').val(respon.amount);
                    $('#edit_modal_allowance_other').modal('show')
                },
                error : function(){
                    alert('terjadi kesalahan !');
                }
            })
        })
        $('#edit-addallowanceOther').on('submit',function(e){
            e.preventDefault();
            var data = $('#edit-addallowanceOther').serialize();
            $.ajax({
                url : 'update-allowance-other',
                type : 'post',
                data : data,
                dataType : 'json',
                beforeSend : function(){

                },
                success : function(respon){
                    table.ajax.reload();
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg
                    })
                    $('#edit_modal_allowance_other').modal('hide')
                     table.ajax.reload();
                },
                error : function(){
                    alert('There is an error !, please try again')
                }
            })
        })
        $(document).on('click','.delete-allowance-other',function(e){
            e.preventDefault();
            var id = $(this).attr('data-id')
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(confirm){
            if (confirm.value == true){
                $.ajax({
                    url : 'delete-allowance-other',
                    type : 'post',
                    data : {id : id},
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg,
                        })
                        table.ajax.reload();
                    },
                    error : function (){
                        alert('There is an error !, please try again')
                    }
                })
            }
    })
            
        })

    </script>
@endpush
