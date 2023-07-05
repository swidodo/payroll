@extends('pages.dashboard')

@section('title', 'Setting Level Approval')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Setting Level Approval</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Setting Level Approval</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row justify-content-center">
            <div class="col-md-8" >
            
                <form action="{{route('level-approvals.store')}}" method="POST">
                    @csrf
                    {{-- {{dd($tiers)}} --}}
                    <div class="row justify-content-center">
                        <div class="col-md-6" >
                            <div class="form-group" >
                                <label>Tier 1</label>
                                <select name="level[]" id="level1" class="form-control select" required>
                                    <option value="0" >Select Tier</option>
                                    <option value="company_{{Auth::user()->creatorId()}}">This Company</option>
                                    @foreach ($employees as $e)
                                        <option value="employee_{{$e->id}}">{{$e->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6" >
                            <div class="form-group" >
                                <label>Tier 2</label>
                                <select name="level[]" id="level2" class="form-control select">
                                    <option value="0" >Select Tier</option>
                                    <option value="company_{{Auth::user()->creatorId()}}">This Company</option>
                                    @foreach ($employees as $e)
                                        <option value="employee_{{$e->id}}">{{$e->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6" >
                            <div class="form-group" >
                                <label>Tier 3</label>
                                <select name="level[]" id="level3" class="form-control select">
                                    <option value="0" >Select Tier</option>
                                    <option value="company_{{Auth::user()->creatorId()}}">This Company</option>
                                    @foreach ($employees as $e)
                                        <option value="employee_{{$e->id}}">{{$e->name}}</option>
                                    @endforeach
                                </select>
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

    <script>
        const tiers = JSON.parse('{!! json_encode($tiers) !!}')
        $.each(tiers, function (indexInArray, valueOfElement) { 
             console.log(valueOfElement);
             console.log($('#level' + valueOfElement.level + ' option[value=employee_'+ valueOfElement.employee_id +']'));
            //  console.log($('#level' + valueOfElement.level + 'option[value=employee_' + valueOfElement.employee_id +']'));
             if (valueOfElement.employee_id == null) {
                $('#level'+ valueOfElement.level +' option[value=company_' + valueOfElement.company_id +']').attr('selected','selected');
                // $('#level'+ valueOfElement.level).val(valueOfElement.company_id ? valueOfElement.company_id : 0).trigger('change');
             }else{
                $('#level' + valueOfElement.level + ' option[value=employee_'+ valueOfElement.employee_id +']').attr('selected','selected');
                // $('#level'+ valueOfElement.level).val(valueOfElement.employee_id ? valueOfElement.employee_id : 0).trigger('change');
             }
        }); 
    </script>
@endpush
