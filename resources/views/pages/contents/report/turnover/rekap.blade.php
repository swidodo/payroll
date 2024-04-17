@extends('pages.dashboard')
@section('title', 'Report Turnover')
@section('dashboard-content')

@push('addon-style')    
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
@endpush
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Report</a></li>
                        <li class="breadcrumb-item active">turnover</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="card-title-sm">
                        Filter Periode
                    </div>
                </div>
                <div class="card-body">
                    <form id="FormSearch" action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label>Branch</label>
                                <select class="form-control form-select" id="branch_id" name="branch_id">
                                    @foreach($branch as $branches)
                                    @if($branches->id == $brch->id)
                                    <option value="{{ $branches->id }}" selected>{{ $branches->name }}</option>
                                    @else
                                    <option value="{{ $branches->id }}">{{ $branches->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label>Start Date</label>
                                <input type="date" name="from_date" id="from_date" class="form-control" required>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label>End Date</label>
                                <input type="date" name="to_date" id="to_date" class="form-control" required>
                            </div>
                            <div class="col-md-3  mb-2">
                                <button type="button" id="filter-search" class="btn btn-primary me-1 mt-4">Search</button>
                                <button type="button" id="export-turnover" class="btn btn-success me-1 mt-4"><span class="fa fa-file-excel"></span> Export</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover table-sm w-100">
                            <thead>
                                <tr>
                                    <th colspan="2">@if(isset($brch)){{($brch != null) ? strtoupper($brch->name) :'' }}@endif</th>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($active))
                                @foreach ($active as $active)
                                <tr>
                                    <td>{{ $active->active }}</td>
                                    <td class="text-center">{{ $active->total }}</td>
                                </tr>
                                @endforeach
                                @endif
                                @if(isset($permanent))
                                @foreach ($permanent as $permanent)
                                <tr>
                                    <td>{{ $permanent->permanent }}</td>
                                    <td class="text-center">{{ $permanent->total }}</td>
                                </tr>
                                @endforeach
                                @endif
                                @if(isset($in))
                                @foreach ($in as $enter)
                                <tr>
                                    <td>{{ $enter->join }}</td>
                                    <td class="text-center">{{ $enter->total }}</td>
                                </tr>
                                @endforeach
                                @endif
                                @if(isset($out))
                                @foreach ($out as $over)
                                <tr>
                                    <td>{{ 'EMPLOYEE '.strtoupper($over->status) }}</td>
                                    <td class="text-center">{{ $over->total }}</td>
                                </tr>   
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()
@push('addon-script')

 <!-- Slimscroll JS -->
 <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
 <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
 <script src="{{asset('assets/js/select2.min.js')}}"></script>
<script>
    $('#branch_id').select2({
        width: '100%',
    })
    $('#filter-search').on('click',function(){
        var from = $('#from_date').val();
        var to = $('#to_date').val()
        if(from == ''){
            alert("Start date not empty !");
            return false;
        }
        if(to == ''){
            alert("End date not empty !");
            return false;
        }
        $('#FormSearch').attr("action", "{{route('get-rekap-turnover')}}");
        document.getElementById("FormSearch").submit();
    })
    $('#export-turnover').on('click',function(){
        var from = $('#from_date').val();
        var to = $('#to_date').val()
        if(from == ''){
            alert("Start date not empty !");
            return false;
        }
        if(to == ''){
            alert("End date not empty !");
            return false;
        }
        $('#FormSearch').attr("action", "{{route('export-turnover')}}");
        document.getElementById("FormSearch").submit();
    })
</script>
@endpush
