@extends('pages.dashboard')

@section('title', 'Set Payroll')

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
                    <h3 class="page-title">Set Payroll</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Set Payroll</li>
                    </ul>
                </div>
                @can('create payroll')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" id="NewSetPayroll" data-bs-toggle="modal" data-bs-target="#add_payroll"><i class="fa fa-plus"></i>Payroll</a>
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
                    <div class="row d-flex align-items-center">
                        <div class="col-md-3">
                            <label>Branch</label>
                            <select class="form-select form-control" id="branch_id">
                                @foreach($branches as $br)
                                <option value="{{ $br->id }} ">{{ $br->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-center mt-4"> 
                            <button type="button" class="btn btn-primary" id="searchBranch">Search</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
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
        $('.containerLoader').attr('hidden',false)
            $(document).ready(function () {
                $('.containerLoader').attr('hidden',true)
                var branchId = $('#branch_id').val();
                loadData(branchId ,employeeId="")
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

                $('body').on('click', '#delete-payroll-btn', function(){
                    const deleteURL = $(this).data('url');
                    $('#form-delete-payroll').attr('action', deleteURL);
                })

            });

            function loadData(branchId ,employeeId=""){
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
                            render : function(data,type,row){
                                if (data !=null){
                                    return data.toLocaleString('en-US');
                                }else{
                                    return 0;
                                }
                            }
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ],
                })
            }
             $('#searchBranch').on('click',function(e){
                var branchId = $('#branch_id').val();
                loadData(branchId ,employeeId="");
            })
            $('#NewSetPayroll').on('click',function(){
                var branch_id = $('#branch_id').val()
                $.ajax({
                    url : 'get-data-setpayroll',
                    type : 'post',
                    data : {branch_id : branch_id },
                    dataType : 'json',
                    beforeSend : function (){
                        $('.containerLoader').attr('hidden',false)
                    },
                    success : function(respon){
                        $('#costumeView').html('');
                        var emp = `<option value="">-- Select Employee --</option>`;
                        $.each(respon.employee,function(key,val){
                            emp += `<option value="`+val.id+`">`+val.no_employee+` - `+val.name+`</option>`
                        })
                        $('#employee_id').html(emp)

                        var allowance = '';
                         $.each(respon.allowanceTypes,function(key,val){
                            allowance += `<div class="row mx-4">
                                            <div class="form-check col-md-6 mb-3">
                                                <input class="form-check-input itemCheck" data-id="`+val.id+`" type="checkbox" name="allowance_id[]" value="`+val.id+`" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    `+val.name+`
                                                </label>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control itemAmount `+val.id+`" data-id="`+val.id+`" name="amount[]" disabled/>
                                            </div>
                                        </div>`
                         })
                        $('#ListAllowance').html(allowance)
                        $('#branchInput').val($('#branch_id').val())

                        var bpjs = '';
                        $.each(respon.data_bpjs,function(key,val){
                            bpjs += `<div class="col-md-6">
                                        <div class="form-check col-md-6 mb-3">
                                            <input class="form-check-input itemBpjs" data-id="`+val.id+`" type="checkbox" name="bpjs[]" value="`+val.id+`" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                             `+val.bpjs_name+`
                                            </label>
                                        </div>
                                    </div>`;
                        })
                         $('#ListBpjs').html(bpjs)
                         $('.containerLoader').attr('hidden',true)
                    },
                    error : function (){
                        alert('Sameting went wrong!');
                        $('.containerLoader').attr('hidden',true)
                    }
                })
            })
            $('#payroll_submit').on('submit',function(e){
                e.preventDefault();
                var branchId = $('#branch_id').val();
                var data = $('#payroll_submit').serialize();
                $.ajax({
                    url : 'payroll-addNew',
                    type : 'post',
                    data : data,
                    dataType : 'json',
                    beforeSend:function(){
                        $('.containerLoader').attr('hidden',false)
                    },
                    success : function(respon){
                        $('.containerLoader').attr('hidden',true)
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg
                        })
                        $('#add_payroll').modal('hide')
                        loadData(branchId,employeeId="");
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
                        $('.containerLoader').attr('hidden',false)
                    },
                    success : function(respon){
                        var bs = respon.payroll.amount;
                        $('#view_payroll').modal('show');
                        // $('#empCode').html(respon.payroll.employee.employee_id)
                        $('#empID').html(respon.payroll.employee.no_employee)
                        $('#empName').html(respon.payroll.employee.name)
                        $('#empSalaryType').html(respon.payroll.payslip_type.name)
                        $('#empSalary').html(bs.toLocaleString('en-US'))
                        if(respon.valAllowance.length > 0 ){
                            var html ='';
                            var totallowance = 0;
                            $.each(respon.valAllowance,function(key,val){
                                var va = val.amount;
                                html += `<tr>
                                <td width="50%">`+val.allowance_type.name+`</td>
                                <td>:</td>
                                <td>`+ va.toLocaleString('en-US')+`</td>
                                </tr>`;
                                totallowance += val.amount; 
                            })
                            $('#allowanceDtl').html(html)
                            var tot = respon.payroll.amount + totallowance;
                            $('#total').html(tot.toLocaleString('en-US'))
                        }else{
                            $('#allowanceDtl').html('<tr><td>No Data</td></tr>')
                        }
                        $('.containerLoader').attr('hidden',true)
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
                        $('.containerLoader').attr('hidden',false)
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
                        if(respon.payroll.status_bpjs == "normatif"){
                            var checked = (bpjsChecked.includes(val.id)) ? 'checked' : '';
                        }else{
                            var checked = (bpjsChecked.includes(val.id)) ? '' : '';
                        }
                        bpjs += ` <div class="col-md-6">
                                        <div class="form-check col-md-6 mb-3">
                                            <input class="form-check-input itemBpjs editItemBpjs" data-id="`+val.id+`" data-code = "`+val.bpjs_code+`" data-empId ="`+respon.payroll.employee_id+`" type="checkbox" name="bpjs[]" value="`+val.id+`" id="flexCheckDefault" `+checked+`>
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
                        $('#editbranchInput').val(respon.payroll.branch_id)
                        $('#bpjs-list').html(bpjs);
                        $('#nominal_bpjs_kes_edit').val(nominal_bpjs_kes);
                        $('#nominal_bpjs_jp_edit').val(nominal_bpjs_jp);
                        $('#list-allowance').html(allowance);
                        if (respon.payroll.status_pph21 == 1){
                            $('#status_pph21').prop('checked',true)
                        }else{
                            $('#status_pph21').prop('checked',false)
                        }
                        if(respon.payroll.status_bpjs == "unnormatif"){
                            var jht = []; 
                            var jkk = [];
                            var jkm = [];
                            var jp = [];
                            var ksht = [];
                            $.each(respon.bpjs,function(key,val){
                                if(val.bpjs_name == "BPJS JHT"){
                                    jht.push(val.is_employee);
                                }else if(val.bpjs_name == "BPJS JKK"){
                                    jkk.push(val.is_employee);
                                }else if(val.bpjs_name == "BPJS JKm"){
                                    jkm.push(val.is_employee);
                                }else if(val.bpjs_name == "BPJS JP"){
                                    jp.push(val.is_employee);
                                }else if(val.bpjs_name == "BPJS KESEHATAN"){
                                    ksht.push(val.is_employee);
                                }
                            })
                            var valjht = (jht.length > 0) ? jht[0] : '';
                            var valjkk = (jkk.length > 0) ? jkk[0] : '';
                            var valjkm = (jkm.length > 0) ? jkm[0] : '';
                            var valjp = (jp.length > 0) ? jp[0] : '';
                            var valksht = (ksht.length > 0) ? ksht[0] : '';

                            var jhtenable = (jht.length > 0) ? '' : 'disabled';
                            var jkkenable = (jkk.length > 0 ) ? '' : 'disabled';
                            var jkmenable = (jkm.length > 0 ) ? '' : 'disabled';
                            var jpenable  = (jp.length > 0) ? '' : 'disabled';
                            var kshtenable = (ksht.length > 0) ? '' : 'disabled';

                            var jhtselected = (jht.length > 0) ? 'checked' : '';
                            var jkkselected = (jkk.length > 0 ) ? 'checked' : '';
                            var jkmselected = (jkm.length > 0 ) ? 'checked' : '';
                            var jpselected  = (jp.length > 0) ? 'checked' : '';
                            var kshtselected = (ksht.length > 0) ? 'checked' : '';
                            let input = `<div class="row mx-4" id="cusbpjs">
                                            <div class="form-check col-md-6 mb-3">
                                                <input class="form-check-input itemsBPJS" data-id="jht" type="checkbox" id="flexCheckDefault" `+jhtselected+`>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    BPJS JHT
                                                </label>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="number" class="form-control jht" name="bpjs_jht" value="`+valjht+`" `+jhtenable+`/>
                                            </div>

                                            <div class="form-check col-md-6 mb-3">
                                                <input class="form-check-input itemsBPJS" data-id="jkk" type="checkbox" id="flexCheckDefault" `+jkkselected+`>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    BPJS JKK
                                                </label>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="number" class="form-control jkk" name="bpjs_jkk" value="`+valjkk+`" `+jkkenable+`/>
                                            </div>

                                            <div class="form-check col-md-6 mb-3">
                                                <input class="form-check-input itemsBPJS" data-id="jkm" type="checkbox" id="flexCheckDefault" `+jkmselected+`>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    BPJS JKM
                                                </label>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="number" class="form-control jkm" name="bpjs_jkm" value="`+valjkm+`" `+jkmenable+`/>
                                            </div>

                                            <div class="form-check col-md-6 mb-3">
                                                <input class="form-check-input itemsBPJS" data-id="jp" type="checkbox" id="flexCheckDefault" `+jpselected+`>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                   BPJS JP
                                                </label>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="number" class="form-control jp" name="bpjs_jp" value="`+valjp+`" `+jpenable+`/>
                                            </div>

                                            <div class="form-check col-md-6 mb-3">
                                                <input class="form-check-input itemsBPJS" data-id="kesehatan" type="checkbox" id="flexCheckDefault" `+kshtselected+`>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                   BPJS KESEHATAN
                                                </label>
                                            </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="number" class="form-control kesehatan" name="bpjs_kesehatan" value="`+valksht+`" `+kshtenable+`/>
                                        </div>
                                    </div>`;
                            $('#edit-customeBpjs').prop("checked",true)
                            $('#editcostumeView').html(input);
                            $('#editcostumeView').attr('hidden',false);
                        }else{
                            $('#edit-customeBpjs').prop("checked",false)
                            let input = `<div class="row mx-4" id="cusbpjs">
                                            <div class="form-check col-md-6 mb-3">
                                                <input class="form-check-input itemsBPJS" data-id="jht" type="checkbox" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    BPJS JHT
                                                </label>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="number" class="form-control jht" name="bpjs_jht" value="" disabled/>
                                            </div>

                                            <div class="form-check col-md-6 mb-3">
                                                <input class="form-check-input itemsBPJS" data-id="jkk" type="checkbox" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    BPJS JKK
                                                </label>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="number" class="form-control jkk" name="bpjs_jkk" value="" disabled/>
                                            </div>

                                            <div class="form-check col-md-6 mb-3">
                                                <input class="form-check-input itemsBPJS jkm" data-id="jkm" type="checkbox" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    BPJS JKM
                                                </label>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="number" class="form-control" name="bpjs_jkm" value="" disabled/>
                                            </div>

                                            <div class="form-check col-md-6 mb-3">
                                                <input class="form-check-input itemsBPJS" data-id="jp" type="checkbox" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                   BPJS JP
                                                </label>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="number" class="form-control jp" name="bpjs_jp" value="" disabled/>
                                            </div>

                                            <div class="form-check col-md-6 mb-3">
                                                <input class="form-check-input itemsBPJS" data-id="kesehatan" type="checkbox" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                   BPJS KESEHATAN
                                                </label>
                                            </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="number" class="form-control kesehatan" name="bpjs_kesehatan" value="" disabled/>
                                        </div>
                                    </div>`;
                            $('#editcostumeView').html(input);
                            $('#editcostumeView').attr('hidden',true);
                        }
                        $('.containerLoader').attr('hidden',true)
                    },
                    error : function(){
                        alert('There is an error !, please try again')
                        $('.containerLoader').attr('hidden',true)
                    }
                })
            })
            $(document).on('change','.editItemBpjs',function(){
                var id = $(this).attr('data-code');
                var empId = $(this).attr('data-empId');
                var data = { 
                    'id': id,
                    'employee_id': empId
                }
                var bpjs =[];
                if(($(this).prop("checked"))) {

                    if (bpjs.includes(id)){
                        obj = {key : id }
                        delete obj["key"];
                    }
                    if (bpjs.includes(empId)){

                    }
                    
                }else{
                    bpjs.push(data)
                }
                console.log(bpjs);
            })
            $('#update-payroll').on('submit',function(e){
                e.preventDefault();
                var branchId = $('#branch_id').val();
                var data = $('#update-payroll').serialize();
                $.ajax({
                    url : 'update-data-payroll',
                    type :'post',
                    data :data,
                    dataType : 'json',
                    beforeSend : function(){
                        $('.containerLoader').attr('hidden',false)
                    },
                    success : function(respon){
                        $('.containerLoader').attr('hidden',true)
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg
                        })
                        $('#edit_payroll').modal('hide')
                        loadData(branchId,employeeId="");
                    },
                    error: function(){
                        alert('There is an error !, please try again')
                    }
                })
            })
            $(document).on('click','.delete-data-payroll',function(e){
                e.preventDefault();
                var id = $(this).attr('data-id');
                var branchId = $('#branch_id').val();
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
                                $('.containerLoader').attr('hidden',false)
                            },
                            success : function(respon){
                                $('.containerLoader').attr('hidden',true)
                                swal.fire({
                                    icon : respon.status,
                                    text : respon.msg
                                })
                                loadData(branchId ,employeeId="");
                            },
                            error:function(){
                                alert('There is an error !, please try again')
                            }
                        })
                    }
                })
            })
            $('#customeBpjs').on('change',function(){
                let input = `<div class="row mx-4" id="cusbpjs">
                                <div class="form-check col-md-6 mb-3">
                                    <input class="form-check-input additemsBPJS" data-id="jht" type="checkbox" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        BPJS JHT
                                    </label>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="number" class="form-control jht" name="bpjs_jht" disabled/>
                                </div>

                                <div class="form-check col-md-6 mb-3">
                                    <input class="form-check-input additemsBPJS" data-id="jkk" type="checkbox" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        BPJS JKK
                                    </label>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="number" class="form-control jkk" name="bpjs_jkk" disabled/>
                                </div>

                                <div class="form-check col-md-6 mb-3">
                                    <input class="form-check-input additemsBPJS" data-id="jkm" type="checkbox" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        BPJS JKM
                                    </label>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="number" class="form-control jkm" name="bpjs_jkm" disabled/>
                                </div>

                                <div class="form-check col-md-6 mb-3">
                                    <input class="form-check-input additemsBPJS" data-id="jp" type="checkbox" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                       BPJS JP
                                    </label>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="number" class="form-control jp" name="bpjs_jp" disabled/>
                                </div>

                                <div class="form-check col-md-6 mb-3">
                                    <input class="form-check-input additemsBPJS" data-id="kesehatan" type="checkbox" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                       BPJS KESEHATAN
                                    </label>
                                </div>
                            <div class="col-md-6 mb-3">
                                <input type="number" class="form-control kesehatan" name="bpjs_kesehatan" disabled/>
                            </div>
                        </div>`;
                if($(this).prop("checked")){
                    $('#costumeView').html(input);
                    $('.itemBpjs').attr('disabled',true)
                }else{
                    $('#costumeView').html('');
                    $('.itemBpjs').attr('disabled',false)
                }
            })
            $(document).on('change','.additemsBPJS',function(){
                var id = $(this).attr('data-id');
                if ($(this).prop('checked')){
                    $('.'+id).attr('disabled',false);
                }else{
                    $('.'+id).attr('disabled',true);
                }
            })
            $(document).on('change','.itemsBPJS',function(){
                var id = $(this).attr('data-id');
                if ($(this).prop('checked')){
                    $('.'+id).attr('disabled',false);
                }else{
                    $('.'+id).attr('disabled',true);
                }
            })
            $(document).on('change','#edit-customeBpjs',function(){
                if ($(this).prop("checked")){
                    $('#editcostumeView').attr('hidden', false)
                    $('.editItemBpjs').attr('disabled',true)
                }else{
                    $('#editcostumeView').attr('hidden', true)
                    $('.editItemBpjs').attr('disabled',false)
                }
            })
    </script>
@endpush
