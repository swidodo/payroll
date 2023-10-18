@extends('pages.dashboard')

@section('title', 'company')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Manage Company</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">company</li>
                    </ul>
                </div>
                @can('create company')
                <div class="col-auto float-end ms-auto">
                    <a href="javascript:void(0);" class="btn add-btn" id="add_groupPosition"><i class="fa fa-plus"></i>company</a>
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
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="table-company">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Address</th>
                                <th>Code</th>
                                <th>Logo</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection

@push('addon-style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2/sweetalert2.min.css')}}">
@endpush

@push('addon-script')
    <!-- Slimscroll JS -->
    <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>

    <!-- Datetimepicker JS -->
    <script src="{{asset('assets/js/moment.min.js')}}"></script>

    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
            var table = $('#table-company').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                    url : "get-data",
                    type : 'post',
                },
                columns: [
                    {
                        data: 'name',
                        name: 'name'
                    },
                     {
                        data: 'address',
                        name: 'address'
                    }, 
                    
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'logo',
                        name: 'logo'
                    },
                   {
                        data: 'action',
                        name : 'action'
                    },
                ],

            });
           //  $('#add_groupPosition').on('click', function(e){
           //      e.preventDefault();
           //      $.ajax({
           //          url : 'add-group-position',
           //          type : 'get',
           //          dataType : 'json',
           //          beforeSend : function(){

           //          },
           //          success : function(respon){
           //              var branch = '';
           //              var employee = '<option value="" selected></option>';
           //              var departement = '<option value="" selected></option>';
           //              var position = '<option value="" selected></option>';
           //              $.each(respon.branch, function(key,val){
           //                  branch += `<option value="`+val.id+`">`+val.name+`</option>`
           //              })
           //              $.each(respon.position, function(key,val){
           //                  position += `<option value="`+val.id+`">`+val.position_name+`</option>`
           //              })
           //              $.each(respon.employee, function(key,val){
           //                  employee += `<option value="`+val.id+`">`+val.name+`</option>`
           //              }) 
           //              $.each(respon.departement, function(key,val){
           //                  departement += `<option value="`+val.id+`">`+val.name+`</option>`
           //              })
           //              $('#branchId').html(branch);
           //              $('#employeeId').html(employee);
           //              $('#departementId').html(departement);
           //              $('#positionId').html(position);
           //              $('#addGroupPosition').modal('show');
           //          }
           //      })
           //  })
           // $('#addFormGroupPosition').on('submit', function(e){
           //      e.preventDefault()
           //      var data = $('#addFormGroupPosition').serialize();

           //      $.ajax({
           //          url : 'store-group-position',
           //          type : 'post',
           //          data : data,
           //          dataType : 'json',
           //          beforeSend : function(){

           //          },
           //          success : function(respon){
           //              if (respon.status == "success"){
           //                  $('#addGroupPosition').modal('hide');
           //                  table.ajax.reload();
           //              }
           //              swal.fire({
           //                  icon : respon.status,
           //                  text : respon.msg
           //              })
           //          },
           //          error : function(){
           //              alert('Someting went wrong !');
           //          }
           //      })
           //  })
           //  $(document).on('click','.edit-group-position',function(e){
           //     e.preventDefault();
           //     var id = $(this).attr('data-id')
           //      $.ajax({
           //          url : 'edit-group-position',
           //          type : 'post',
           //          data : {id : id},
           //          dataType : 'json',
           //          beforeSend : function(){

           //          },
           //          success : function(respon){
           //              var departement = '';
           //              var position = '';
           //              $.each(respon.departement, function(key,val){
           //                  if (respon.data.departement_id == val.id){
           //                       departement += `<option value="`+val.id+`" selected>`+val.name+`</option>`
           //                  }else{
           //                      departement += `<option value="`+val.id+`">`+val.name+`</option>`
           //                  }
           //              }) 
           //              $.each(respon.position, function(key,val){
           //                  if (respon.data.position_id == val.id){
           //                       position += `<option value="`+val.id+`" selected>`+val.position_name+`</option>`
           //                  }else {
           //                      position += `<option value="`+val.id+`">`+val.position_name+`</option>`
           //                  }
           //              })
           //              $('#id').val(respon.data.id);
           //              $('#editBranchId').val(respon.data.branch_id);
           //              $('#editBranchName').val(respon.data.branch_name);
           //              $('#editEmployeeId').val(respon.data.employee_id);
           //              $('#editEmployeeName').val(respon.data.employee_name);
           //              $('#editDepartementId').html(departement)
           //              $('#editPositionId').html(position)
                      
           //              $('#edit_groupPosition').modal('show');
           //          }
           //      })
           //  })
           //  $('#updateFormGroupPotision').on('submit', function(e){
           //      e.preventDefault()
           //      var data = $('#updateFormGroupPotision').serialize();
           //      $.ajax({
           //          url : 'update-group-position',
           //          type : 'post',
           //          data : data,
           //          dataType : 'json',
           //          beforeSend : function(){

           //          },
           //          success : function(respon){
           //              if (respon.status == "success"){
           //                  $('#edit_groupPosition').modal('hide');
           //                  table.ajax.reload();
           //              }
           //              swal.fire({
           //                  icon : respon.status,
           //                  text : respon.msg
           //              })
           //          },
           //          error : function(){
           //              alert('Someting went wrong !');
           //          }
           //      })
           //  })
           //  $(document).on('click','.delete-group-position',function(e){
           //      e.preventDefault()
           //      var id = $(this).attr('data-id')
           //      Swal.fire({
           //                  title: 'Are you sure?',
           //                  text: "You won't be able to revert this!",
           //                  icon: 'warning',
           //                  showCancelButton: true,
           //                  confirmButtonColor: '#3085d6',
           //                  cancelButtonColor: '#d33',
           //                  confirmButtonText: 'Yes, delete it!'
           //              }).then(function(confirm){
           //              if (confirm.value == true){
           //                  $.ajax({
           //                      url : 'destroy-group-position',
           //                      type :'post',
           //                      data : {id : id},
           //                      dataType : 'json',
           //                      beforeSend : function (){

           //                      },
           //                      success : function(respon){
           //                          swal.fire({
           //                              icon : respon.status,
           //                              text : respon.msg
           //                          })
           //                          table.ajax.reload();
           //                      },
           //                      error : function(){
           //                          alert('Someting went wrong !');
           //                      }
           //                  })
           //              }
           //          })
           //  })
        });
    </script>
@endpush
