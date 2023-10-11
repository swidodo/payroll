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
                @can('create payroll')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_payroll"><i class="fa fa-plus"></i> New Payroll</a>
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
            <div class="col-md-12">
                <div class="table-responsive" style="overflow-x: visible">
                    <table class="table table-striped custom-table" id="payrollData">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Type Salary</th>
                                <th>Salary</th>
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

    @include('includes.modal.payroll-modal')

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
                loadData(branchId ="" ,employeeId="")
                $('.itemAmount').attr('disabled',true)
                $(document).on('change','.itemCheck', function(){
                    var id = $(this).attr('data-id')
                    if($(this).prop("checked")==true){
                       $('.'+id).attr('disabled',false)
                    }else{
                        $('.'+id).attr('disabled',true)
                    }
                })
                $('#checkAll').on('change',function(){
                    if($(this).prop("checked")==true){
                        $('.itemCheck').prop('checked',true)
                        $('.itemAmount').attr('disabled',false)
                    }else{
                        $('.itemCheck').prop('checked',false)
                        $('.itemAmount').attr('disabled',true)
                    }
                })
                $('#checkAllEdit').on('change',function(){
                    if($(this).prop("checked")==true){
                        $('.itemCheck').prop('checked',true)
                        $('.itemAmount').attr('disabled',false)
                    }else{
                        $('.itemCheck').prop('checked',false)
                        $('.itemAmount').attr('disabled',true)
                    }
                })

                /* When click show user */

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
                        dropdownParent: $('#add_payroll')
                    });
                }

                if($('.select-payroll-type').length > 0) {
                    $('.select-payroll-type').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#add_payroll')
                    });
                }

                //edit
                if($('.select-employee-edit').length > 0) {
                    $('.select-employee-edit').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#edit_reimburst')
                    });
                }

                if($('.select-payroll-type-edit').length > 0) {
                    $('.select-payroll-type-edit').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#edit_reimburst')
                    });
                }

                    // $('body').on('click', '#edit-payroll', function () {
                    //     const editUrl = $(this).data('url');

                    //     $.get(editUrl, (data) => {
                    //         $('#amount_edit').val(data.amount)

                    //         $('#employee_id_edit option[value='+ data.employee_id +']').attr('selected','selected');
                    //         $('#employee_id_edit').val(data.employee_id ? data.employee_id : 0).trigger('change');

                    //         $('#payslip_type_id_edit option[value='+ data.payslip_type_id +']').attr('selected','selected');
                    //         $('#payslip_type_id_edit').val(data.payslip_type_id ? data.payslip_type_id : 0).trigger('change');

                    //         const urlNow = '{{ Request::url() }}'
                    //         $('#edit-form-payroll').attr('action', urlNow + '/' + data.id);
                    //     })
                    // });

                $('body').on('click', '#delete-payroll-btn', function(){
                    const deleteURL = $(this).data('url');
                    $('#form-delete-payroll').attr('action', deleteURL);
                })

            });
            function loadData(branchId ="" ,employeeId=""){

                $('#payrollData').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax : {
                            "url" : 'get-data-payroll',
                            "type" : 'POST',
                            "data" : {branch_id : branchId,employee_id :employeeId},
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
                            data: 'employee_name',
                            name: 'employee_name'
                        },
                        {
                            data: 'type',
                            name: 'type'
                        },
                        {
                            data: 'salary',
                            name: 'salary'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ],
                })
            }
            $('#payroll_submit').on('submit',function(e){
                e.preventDefault();
                var data = $('#payroll_submit').serialize();
                $.ajax({
                    url : 'payroll-addNew',
                    type : 'post',
                    data : data,
                    dataType : 'json',
                    beforeSend:function(){

                    },
                    success : function(respon){
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg
                        })
                        $('#add_payroll').modal('hide')
                        loadData(branchId ="" ,employeeId="");
                        $('#payroll_submit')[0].reset();

                    },
                    error: function(){
                        alert('There is an error !, please try again')
                    }
                })
            })
            $(document).on('click','.view-payroll',function(e){
                e.preventDefault()
                var id = $(this).attr('data-id');
                $.ajax({
                    url : 'edit-data-payroll',
                    type : 'post',
                    data :{id :id },
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        $('#view_payroll').modal('show');
                        $('#empCode').html(respon.payroll.employee.employee_id)
                        $('#empID').html(respon.payroll.employee.no_employee)
                        $('#empName').html(respon.payroll.employee.name)
                        $('#empSalaryType').html(respon.payroll.payslip_type.name)
                        $('#empSalary').html(respon.payroll.amount)
                        if(respon.valAllowance.length > 0 ){
                            var html ='';
                            var totallowance = 0;
                            $.each(respon.valAllowance,function(key,val){
                                html += `<tr>
                                <td width="50%">`+val.allowance_type.name+`</td>
                                <td>:</td>
                                <td>`+val.amount+`</td>
                                </tr>`;
                                totallowance += val.amount; 
                            })
                            $('#allowanceDtl').html(html)
                            $('#total').html(respon.payroll.amount + totallowance)
                        }else{
                            $('#allowanceDtl').html('<tr><td>No Data</td></tr>')
                        }
                    }
                })

            })
            $(document).on('click','.edit-payroll',function(e){
                e.preventDefault();
                var id = $(this).attr('data-id');
                $.ajax({
                    url : 'edit-data-payroll',
                    type : 'post',
                    data :{id :id },
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        $('#edit_payroll').modal('show');
                        var payslip ='';
                        $.each(respon.payslip_type,function(key,val){
                            var selected = (val.id == respon.payroll.payslip_type_id) ? 'selected':'';
                            payslip +='<option value="'+ val.id +'"" '+selected+'>'+val.name+'</option>';
                        })
                        var bpjs = '';
                        var bpjsChecked = [];
                        var nominal_bpjs_kes = 0;
                        var nominal_bpjs_jp = 0;
                        $.each(respon.bpjs,function(key,val){
                            if(val.salary_kes >0 ){
                                nominal_bpjs_kes = val.value_kes
                            }
                            if(val.salary_tk_jp > 0){
                                nominal_bpjs_jp = val.value_tk_jp
                            }
                            if(! bpjsChecked.includes(val.bpjs_id)){
                                bpjsChecked.push(val.bpjs_id)
                            }
                        })
                        $.each(respon.master_bpjs,function(key,val){

                        var checked = (bpjsChecked.includes(val.id)) ? 'checked' : '';
                        bpjs += ` <div class="col-md-6">
                                        <div class="form-check col-md-6 mb-3">
                                            <input class="form-check-input itemBpjs" data-id="`+val.id+`" type="checkbox" name="bpjs[]" value="`+val.id+`" id="flexCheckDefault" `+checked+`>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                `+val.bpjs_name+`
                                            </label>
                                        </div>
                                    </div>`;
                        })
                        var allowance ='';
                        $.each(respon.allowance,function(key,val){
                            var checked = '';
                            var status = 'disabled';
                            var amount = '';
                            $.each(respon.valAllowance,function(akey,aval){
                                if(aval.allowance_type_id == val.id){
                                    checked = "checked";
                                    status = 'enable';
                                    amount = aval.amount;
                                }
                            })
                            allowance +=  `<div class="row mx-4">
                                                    <div class="form-check col-md-6 mb-3">
                                                        <input class="form-check-input itemCheck" data-id="`+val.id+`" type="checkbox" name="allowance_id[]" value="`+val.id+`" id="flexCheckDefault" `+checked+`>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                           `+val.name+`
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <input type="text" class="form-control itemAmount `+val.id+`" data-id="`+val.id+`" name="amount[]" value="`+amount+`" `+status+`/>
                                                    </div>
                                                </div>`;
                        })





                        $('#employee_id_edit').html('<option value="'+respon.payroll.employee_id+'" selected>'+respon.payroll.employee.name+'</option>')
                        $('#payslip_type_id_edit').html(payslip)
                        $('#amount_edit').val(respon.payroll.amount)
                        $('#editId').val(respon.payroll.id)
                        $('#bpjs-list').html(bpjs);
                        $('#nominal_bpjs_kes_edit').val(nominal_bpjs_kes);
                        $('#nominal_bpjs_jp_edit').val(nominal_bpjs_jp);
                        $('#list-allowance').html(allowance);

                    },
                    error : function(){
                        alert('There is an error !, please try again')
                    }
                })
            })
            $('#update-payroll').on('submit',function(e){
                e.preventDefault();
                var data = $('#update-payroll').serialize();
                $.ajax({
                    url : 'update-data-payroll',
                    type :'post',
                    data :data,
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg
                        })
                        $('#edit_payroll').modal('hide')
                    },
                    error: function(){
                        alert('There is an error !, please try again')
                    }
                })
            })
            $(document).on('click','.delete-data-payroll',function(e){
                e.preventDefault();
                var id = $(this).attr('data-id');
                Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then(function(confirm){
                    if(confirm.value == true){
                        $.ajax({
                            url : 'delete-data-payroll',
                            type : 'post',
                            data :{id :id},
                            dataType : 'json',
                            beforeSend : function(){

                            },
                            success : function(respon){
                                swal.fire({
                                    icon : respon.status,
                                    text : respon.msg
                                })
                                loadData(branchId ="" ,employeeId="");
                            },
                            error:function(){
                                alert('There is an error !, please try again')
                            }
                        })
                    }
                })
            })
    </script>
@endpush
