@extends('pages.dashboard')

@section('title', 'Deduction Bpjs')

@section('dashboard-content')

<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Deduction Bpjs</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Deduction Bpjs</li>
                    </ul>
                </div>
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
                                @foreach($branch as $br)
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
                    <table class="table table-striped custom-table" id="tblBpjsValue" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employee ID</th>
                                <th>Employee</th>
                                <th>Bpjs Kesehatan</th>
                                <th>Bpjs Ketenagakerjaan</th>
                                <th>Amount</th>
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
    <input type="hidden" name="branch_id" value={{ Auth::user()->branch_id }} id="branch_id">
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
<script>
$.ajaxSetup({
    headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
});
var branch_id = $('#branch_id').val();
getListMasterBpjs(branch_id);
function getListMasterBpjs(branchId){
    $('#tblBpjsValue').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        ajax : {
                "url" : 'data-bpjs-value',
                "type" : 'POST',
                "data" : {branch_id : branchId},
            },
        columns: [
            { data: 'no', name:'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
            {
                data: 'employee_no',
                name: 'employee_no'
            },
            {
                data: 'employee_name',
                name: 'employee_name'
            },
            {
                data: 'bpjs_kesehatan',
                render : function(data, type, row){
                    if(data !=null){
                        var base = new String(data).substring(data.lastIndexOf('/') + 1);
                        if(base.lastIndexOf(".") != -1)
                            base = base.substring(0, base.lastIndexOf("."));
                            return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        
                    }else{
                        return 0;
                    }
                }
            },
            {
                data: 'bpjs_ketenagakerjaan',
                render : function(data, type, row){
                    if(data !=null){
                        var base = new String(data).substring(data.lastIndexOf('/') + 1);
                        if(base.lastIndexOf(".") != -1)
                            base = base.substring(0, base.lastIndexOf("."));
                            return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        
                    }else{
                        return 0;
                    }
                }
            },
            {
                data: 'total_bpjs',
                render : function(data, type, row){
                    if(data !=null){
                        var base = new String(data).substring(data.lastIndexOf('/') + 1);
                        if(base.lastIndexOf(".") != -1)
                            base = base.substring(0, base.lastIndexOf("."));
                            return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        
                    }else{
                        return 0;
                    }
                }
            },
        ],

    })
}
$('#searchBranch').on('click',function(e){
    var branch_id = $('#branch_id').val();
    getListMasterBpjs(branch_id);
})
</script>
@endpush
