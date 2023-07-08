@extends('pages.dashboard')

@section('title', 'Company Holiday')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Company Holiday</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"> Company Holiday</li>
                    </ul>
                </div>
                    {{-- @can('create company holiday')
                        <div class="col-auto float-end ms-auto">
                            <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_company_holiday"><i class="fa fa-plus"></i> New Holiday</a>
                        </div>
                    @endcan --}}
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_import">Import Excel</a>
                    </div>
            </div>
        </div>
        <!-- /Page Header -->


        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                            
                                <!-- Calendar -->
                                <div id="calendar"></div>
                                <!-- /Calendar -->
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Import comp holiday Modal -->
    <div id="add_import" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-l" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Company Holiday</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('import.excel.company-holiday')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>File <span class="text-danger">*</span></label>
                                    <input class="form-control" type="file" name="file-excel">
                                    {{-- <a style="font-size: 11px;" download href="{{asset('file/template-excel-attendance/AttendanceReport.xlsx')}}">Click here for template</a> --}}

                                    @if ($errors->has('file-excel'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('file-excel')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Import comp holiday Modal -->

</div>
@endsection

@push('addon-style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">

       <!-- Jquery timepicker -->
    <link rel="stylesheet" href="{{asset('assets/css/jquery.timepicker.min.css')}}">


    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">

    <!-- Calendar CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/fullcalendar.min.css')}}">
@endpush

@push('addon-script')
    <!-- Slimscroll JS -->
    <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>

    <!-- Select2 JS -->
    <script src="{{asset('assets/js/select2.min.js')}}"></script>

    <!-- Datetimepicker JS -->
    <script src="{{asset('assets/js/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>

    <!-- timepicker JS -->
    {{-- <script src="{{asset('assets/js/jquery.timepicker.min.js')}}"></script> --}}

    <!-- Calendar JS -->
    <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/js/fullcalendar.min.js')}}"></script>
    {{-- <script src="{{asset('assets/js/jquery.fullcalendar.js')}}"></script> --}}

    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        !function ($) {
            "use strict";

            var CalendarApp = function () {
                this.$body = $("body")
                this.$modal = $('#event-modal'),
                    this.$event = ('#external-events div.external-event'),
                    this.$calendar = $('#calendar'),
                    this.$saveCategoryBtn = $('.save-category'),
                    this.$categoryForm = $('#add-category form'),
                    this.$extEvents = $('#external-events'),
                    this.$calendarObj = null
            };

            /* Initializing */
            CalendarApp.prototype.init = function () {
                /*  Initialize the calendar  */
                var today = new Date($.now());

                var defaultEvents = JSON.parse('{!! json_encode($holidays, JSON_HEX_TAG) !!}');

                var $this = this;
                $this.$calendarObj = $this.$calendar.fullCalendar({
                    // slotDuration: '00:15:00', /* If we want to split day time each 15minutes */
                    minTime: '05:00:00',
                    maxTime: '23:59:00',
                    defaultView: 'month',
                    handleWindowResize: true,
                    height: $(window).height() - 200,
                    header: {
                        left: 'prev,next',
                        center: 'title',
                        right: ''
                        // 'month,agendaWeek,agendaDay'
                    },
                    events: defaultEvents,
                });

            },
                //init CalendarApp
                $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp

        }(window.jQuery),

            //initializing CalendarApp
            function ($) {
                "use strict";
                $.CalendarApp.init()
            }(window.jQuery);
    </script>

@endpush
