@extends('pages.dashboard')

@push('addon-style')
    <style>
        #donut-chart svg {
            height: 240px !important;
            /* top: -100px; */
        }

        .dropstart .dropdown-toggle::before {
            display: inline-block;
            margin-right: 0.255em;
            vertical-align: 0.255em;
            content: none;
        }

        .dropdown-menu-chart {
            height: 200px !important;
            overflow-y: scroll;
            width: 1px !important;
            border-radius: 15px !important;
            background-color: lightgrey;
            scrollbar-width: thin !important;
        }

        .card-header button {
            float: right;
        }
        .chartdonat--container {
            height: 100%;
            width: 100%;
            min-height: 30px;
        }
        .chartgauge--container {
            height: 100%;
            width: 100%;
            min-height: 350px;
        }
        .chart--container {
            min-height: 350px;
            width: 100%;
            height: 100%;
        }
        .chartleft--container {
            min-height: 285px;
            width: 100%;
            height: 100%;
        }

        .zc-ref {
        display: none;
        }
        .spece{
            margin-top:-20px;
            background-color: #FBFCFE;
        }
        #diagramChart-license-text a{
            display :none;
        }
    </style>
@endpush

@section('dashboard-content')
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">
            <div id="loader-wrapper" style="display: none;">
                <div id="loader">
                    <div class="loader-ellips">
                        <span class="loader-ellips__dot"></span>
                        <span class="loader-ellips__dot"></span>
                        <span class="loader-ellips__dot"></span>
                        <span class="loader-ellips__dot"></span>
                    </div>
                </div>
            </div>

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-9">
                        <h3 class="page-title">Dashboard</h3>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-focus select-focus">
                            <select class="select floating" id="branch_id">
                                <option value="0" selected>All Branch</option>
                                @foreach ($branches as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <label class="focus-label">Branch</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            {{-- Karyawan Baru --}}
            @foreach ($newEmployee as $data)
                <div class="card">
                    <div class="card-body"
                        style="border-left-style: solid; border-radius: 4px; border-width: 5px;border-color: #295967; background-color: #8eccdb57">
                        <div class="row">
                            <div class="col-8 fs-6">
                                Halo semua, Saya senang mengumumkan bahwa kami memiliki karyawan baru! bernama
                                {{ $data->nama }}.
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn-close btn-sm float-end .bg-info-subtle"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="row">
                <div class="col-md-3">
                    <div class="col-md-12">
                        <div class="card" style="margin-top:-30px;background-color:#FBFCFE;">
                            <div class="card-body">
                                <div class="dash-widget-info text-center">
                                    <span>Employees</span>
                                    <h3 id="totalEmployee"></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card spece">
                            <div class="card-body">
                                <div class="dash-widget-info text-center">
                                    <span>Permanent</span>
                                    <h3 id="totalJobholder"></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card spece">
                            <div class="card-body">
                                <div class="dash-widget-info text-center">
                                    <span>Contract</span>
                                    <h3 id="totalContractEmployee"></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card spece">
                            <div class="card-body">
                                <div class="dash-widget-info text-center">
                                    <span>Probation</span>
                                    <h3 id="totalProbationEmployee"></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card spece">
                            <div class="card-body">
                                <div class="dash-widget-info text-center">
                                    <h3 id="totalWorkerDayEmployee"></h3>
                                    <span>Worker day</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        {{-- <div class="card spece">
                            <div class="card-body"> --}}
                                <div id="cilinderChart" class="chartleft--container">
                                </div>
                            {{-- </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6" style="margin-left:-10px;">
                            <div id="gaugeChart" class="chartgauge--container">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="myChart" class="chartdonat--container" style="margin-left:-10px;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="diagramChart" class="chart--container" style="margin-left:-10px;">
                        </div>
                    </div>
                </div>
                
            </div>

            {{-- <div class="row">
                <div class="col-md-3 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10 col-10">
                                    <h4 id="header_1"></h4>
                                </div>
                                <div class="col-md-2 col-2">
                                    <div class="dropdown dropstart dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle filter_1"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <ul class="dropdown-menu dropdown-menu-chart shadow-lg" id="result_filter_1">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div id="filter_area_1" class="mt-4"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10 col-10">
                                    <h4 id="header_2"></h4>
                                </div>
                                <div class="col-md-2 col-2">
                                    <div class="dropdown dropstart dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle filter_2"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <ul class="dropdown-menu dropdown-menu-chart shadow-lg" id="result_filter_2">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div id="filter_area_2" class="mt-4"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10 col-10">
                                    <h4 id="header_3"></h4>
                                </div>
                                <div class="col-md-2 col-2">
                                    <div class="dropdown dropstart dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle filter_3"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <ul class="dropdown-menu dropdown-menu-chart shadow-lg" id="result_filter_3">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div id="filter_area_3" class="mt-4"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10 col-10">
                                    <h4 id="header_4"></h4>
                                </div>
                                <div class="col-md-2 col-2">
                                    <div class="dropdown dropstart dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle filter_4"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <ul class="dropdown-menu dropdown-menu-chart shadow-lg" id="result_filter_4">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div id="filter_area_4" class="mt-4"></div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                
                
                <!-- Statistics Widget -->
                
                <div class="row">
                    <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
                        <div id="departChart" class="chart--container">
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-4 d-flex">
                        <div class="card flex-fill dash-statistics">
                            <div class="card-body">
                                <h5 class="card-title">Statistics</h5>
                                <div class="stats-list">
                                    <div class="stats-info">
                                        <p>Today Sick <strong> <span id="totalTodaySick">0</span> / <small
                                                    id="totalEmployeeStatistic">0</small></strong></p>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" id="progress-bar-sick"
                                                role="progressbar" style="width: 0%" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="stats-info">
                                        <p>Today Leave <strong><span id="totalTodayLeave">0</span> / <small
                                                    id="totalEmployeeStatistic">0</small></strong></p>
                                        <div class="progress">
                                            <div class="progress-bar bg-danger" id="progress-bar-leave"
                                                role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="stats-info">
                                        <p>Today Permit <strong><span id="totalTodayPermit">0</span> / <small
                                                    id="totalEmployeeStatistic">0</small></strong></p>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" id="progress-bar-permit" role="progressbar"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="stats-info">
                                        <p>Today Alpha <strong><span id="totalTodayAlpha">0</span> / <small
                                                    id="totalEmployeeStatistic">0</small></strong></p>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" id="progress-bar-alpha" role="progressbar"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
                        <div class="card flex-fill">
                            <div class="card-body">
                                <h4 class="card-title">Task Statistics</h4>
                                <div>
                                    <p><i class="fa fa-dot-circle-o text-purple me-2"></i>Timesheets <span
                                            class="float-end" id="totalTimesheets">0</span></p>
                                    <p><i class="fa fa-dot-circle-o text-warning me-2"></i>Dinas Dalam Kota<span
                                            class="float-end" id="timesheetsInCity">0</span></p>
                                    <p><i class="fa fa-dot-circle-o text-success me-2"></i>Dinas Luar Kota <span
                                            class="float-end" id="timesheetsOutCity">0</span></p>
                                    <p><i class="fa fa-dot-circle-o text-success me-2"></i>Late <span class="float-end"
                                            id="totalLate">0</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Statistics Widget -->      
               <div class="row">
                <div class="card shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr colspan="6" class="text-center">UNISMENT</tr>
                                <tr>
                                    <th>No</th>
                                    <th>employee Id</th>
                                    <th>employee</th>
                                    <th>Department</th>
                                    <th>position</th>
                                    <th>Branch</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
               </div>
            </div>
            <!-- /Page Content -->

        </div>
    @endsection

    @push('addon-style')
        <!-- Chart CSS -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">
        <!-- Datatable CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
        <!-- Datetimepicker CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
        <!-- Select2 CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">



        <script nonce="undefined" src="https://cdn.zingchart.com/zingchart.min.js"></script>
        <style>
            @import 'https://fonts.googleapis.com/css?family=Montserrat';
            @import 'https://fonts.googleapis.com/css?family=Lato:400';
        </style>
    @endpush

    @push('addon-script')
    <script>
        function gender(male,female){
            ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
            let chartConfig = {
            gui: {
                contextMenu: {
                backgroundColor: '#306EAA', // sets background for entire contextMenu
                },
            },
            graphset: [{
                type: 'ring',
                backgroundColor: '#FBFCFE',
                title: {
                text: 'Gender',
                fontColor: '#1E5D9E',
                fontFamily: 'Lato',
                fontSize: '12px',
                padding: '5px',
                },
                
                plot: {
                tooltip: {
                    text: '<span style="color:%color">%t</span><br><span style="color:%color">%v</span>',
                    anchor: 'c',
                    backgroundColor: 'none',
                    borderWidth: '0px',
                    fontSize: '12px',
                    mediaRules: [{
                    maxWidth: '500px',
                    y: '54%',
                    }, ],
                    sticky: true,
                    thousandsSeparator: ',',
                    x: '50%',
                    y: '50%',
                },
                valueBox: [{
                    type: 'all',
                    text: '%t',
                    fontSize: '10px',
                    placement: 'out',
                    },
                    {
                    // type: 'all',
                    text: '%npv%',
                    fontSize: '10px',
                    placement: 'in',
                    },
                ],
                animation: {
                    effect: 'ANIMATION_EXPAND_VERTICAL',
                    sequence: 'ANIMATION_BY_PLOT_AND_NODE',
                },
                backgroundColor: '#FBFCFE',
                borderWidth: '0px',
                hoverState: {
                    cursor: 'hand',
                },
                slice: '40%',
                },
                series: [{
                    text: 'Female',
                    fontSize: '9px',
                    values: [female],
                    backgroundColor: '#00BAF2',
                    lineColor: '#00BAF2',
                    lineWidth: '1px',
                    marker: {
                    backgroundColor: '#00BAF2',
                    },
                },
                {
                    text: 'Male',
                    fontSize: '9px',
                    values: [male],
                    backgroundColor: '#E80C60',
                    lineColor: '#E80C60',
                    lineWidth: '1px',
                    marker: {
                    backgroundColor: '#E80C60',
                    },
                },
                
                ],
                noData: {
                text: 'No Selection',
                alpha: 0.6,
                backgroundColor: '#20b2db',
                bold: true,
                fontSize: '12px',
                textAlpha: 0.9,
                },
            }, ],
            };

            zingchart.render({
            id: 'myChart',
            data: chartConfig,
            height: '90%',
            width: '100%',
            });
        }
    </script>
    <script>
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
        window.feed = function(callback) {
        var tick = {};
        // tick.plot0 = Math.ceil(350 + (Math.random() * 500));
        callback(JSON.stringify(tick));
        };
 
        var myConfig = {
            type: "gauge",
            title: {
            text: 'Turnover',
            bold: true,
            fontColor: '#515151',
            backgroundColor : '#FBFCFE',
        },
        globals: {
            fontSize: 12
        },
        plotarea: {
            // csize: '4px',
            backgroundColor: 'none',
            borderWidth: '0px',
            margin: '50px 5px 0px 5px',
        },
        backgroundColor: '#FBFCFE',
        scaleR: {
            aperture: 180,
            minValue: 0,
            maxValue: 100,
            center: {
                backgroundColor: '#CDCDCD',
                size : '8px',
                borderWidth: '0px',
            },
            borderWidth: '0px',
            tick: {
                visible: false
            },
            item: {
                fontColor: '#1E5D9E',
                fontFamily: 'Montserrat',
                offsetR: 0,
                padding: '5px',
            },
            step: 50,
            ring: {
                size: '40px',
                },
        },
        series: [{
            values: [50], // starting value
            backgroundColor: 'black',
            animation: {
            effect: 2,
            method: 1,
            sequence: 4,
            speed: 900
            },
        }]
        };
 
        zingchart.render({
        id: 'gaugeChart',
        data: myConfig,
        height: '90%',
        width: '100%'
        });
    </script>
    <script>
        function rep_employee(data){
            var jan = parseInt(data.jan_male[0].count) + parseInt(data.jan_female[0].count)
            var feb = parseInt(data.feb_male[0].count) + parseInt(data.feb_female[0].count)
            var mart = parseInt(data.mart_male[0].count) + parseInt(data.mart_female[0].count)
            var april = parseInt(data.april_male[0].count) + parseInt(data.april_female[0].count)
            var mei = parseInt(data.mei_male[0].count) + parseInt(data.mei_female[0].count)
            var juni = parseInt(data.juni_male[0].count) + parseInt(data.juni_female[0].count)
            var july = parseInt(data.july_male[0].count) + parseInt(data.july_female[0].count)
            var agust = parseInt(data.agust_male[0].count) + parseInt(data.agust_female[0].count)
            var sept = parseInt(data.sept_male[0].count) + parseInt(data.sept_female[0].count)
            var okt = parseInt(data.okt_male[0].count) + parseInt(data.okt_female[0].count)
            var nov = parseInt(data.nov_male[0].count) + parseInt(data.nov_female[0].count)
            var des = parseInt(data.des_male[0].count) + parseInt(data.des_female[0].count)
            ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
            let chartData = [
                {
                type: 'line',
                values: [
                    jan, feb, mart,april, mei, juni, july, agust, sept, okt, nov, des,
                ],
                scales: 'scale-x,scale-y',
                lineColor: '#0D47A1',
                legendMarker: {
                type: 'circle',
                },
                marker: {
                backgroundColor: '#0D47A1',
                },
            },
            {
                type: 'bar',
                values: [
                    data.jan_male[0].count, 
                    data.feb_male[0].count, 
                    data.mart_male[0].count, 
                    data.april_male[0].count,
                    data.mei_male[0].count,
                    data.juni_male[0].count,
                    data.july_male[0].count,
                    data.agust_male[0].count,
                    data.sept_male[0].count,
                    data.okt_male[0].count, 
                    data.nov_male[0].count,
                    data.des_male[0].count,
                ],
                scales: 'scale-x,scale-y',
                backgroundColor: '#1B5E20',
                tooltip: {
                text: 'Male',
                width: '50px',
                wrapText: true,
                },
                valueBox: {
                fontAngle: 90,
                fontColor: '#fff',
                offsetY: '5px',
                placement: 'top-in',
                },
            },
            {
            type: 'bar',
            values: [
            data.jan_female[0].count, 
            data.feb_female[0].count, 
            data.mart_female[0].count, 
            data.april_female[0].count,
            data.mei_female[0].count,
            data.juni_female[0].count,
            data.july_female[0].count,
            data.agust_female[0].count,
            data.sept_female[0].count,
            data.okt_female[0].count, 
            data.nov_female[0].count,
            data.des_female[0].count,
            ],
            scales: 'scale-x,scale-y',
            backgroundColor: '#E65100',
            text: 'Dell',
            tooltip: {
            text: 'Female',
            width: '50px',
            wrapText: true,
            },
            valueBox: {
            bold: true,
            fontAngle: 90,
            fontColor: '#fff',
            offsetY: '5px',
            placement: 'top-in',
            short: true,
            },
            },
        ];
    
        let barchartConfig = {
          type: 'mixed',
          backgroundColor: '#FBFCFE',
          title: {
            text: 'employee report',
            align: 'left',
            backgroundColor: '#FBFCFE',
            fontSize: '14px',
            height: '5%',
          },
       
          scaleX: {
            values: [
              'Jan',
              'Feb',
              'Mar',
              'Apr',
              'May',
              'Jun',
              'Jul',
              'Aug',
              'Sep',
              'Oct',
              'Nov',
              'Dec',
            ],
           
            label: {
              text: 'Employee/month',
            },
            
          },
        
       
            zoom: {
                alpha: 0.2,
                backgroundColor: '#B71C1C',
                label: {
                borderColor: '#B71C1C',
                visible: true,
                },
            },
        
            series: chartData,
            };
    
            zingchart.render({
            id: 'diagramChart',
            data: barchartConfig,
            height: '97%',
            width: '100%',
            });
        }
    </script>
    <script>
        function chartdepartment(data){
            var html = [];
            var i = 0;
            $.each(data,function(key,val){
                if (i == 1){
                    color = '#2870B1';
                }else if(i == 2){
                    color = '#FF9900';
                }else if(i == 3){
                    color = '#4CB150';
                }else if(i == 4){
                    color = '#A14BC9';
                }else if(i == 5){
                    color = '#E91767';
                }else if(i == 6){
                    color = '#000000';
                }else if(i == 7){
                    color = '#A05F18';
                }else if(i == 8){
                    color = '#F9F9F9';
                }else if(i == 9){
                    color = '#BDE7F7';
                }else if(i == 10){
                    color = '#3ABE4D';
                }else{
                    color = '#9E1C38';
                }
                // html.push(val.name)
                html.push( {
                    text : val.name,
                    values: [val.count],
                    backgroundColor: color
                })
                i++;
            })
            if (html.length <= 0 ){
              html =  [{
                    text : 'No department',
                    values: [0],
                    backgroundColor: '#2870B1'
                }]
            }
            ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
            let departchartConfig = {
                type: 'pie',
                backgroundColor: '#FBFCFE',
                title: {
                text: 'Department',
                backgroundColor: '#FBFCFE',
                fontColor: '#1A1B26',
                fontSize: '12px',
                height: '20px'
                },
                legend: {
                backgroundColor: 'none',
                borderWidth: '0px',
                item: {
                    fontColor: '#000'
                },
                layout: 'h',
                marker: {
                    type: 'circle',
                    borderColor: 'white'
                },
                shadow: true,
                toggleAction: 'remove',
                y: '40px'
                },
                plotarea: {
                margin: '90px 30px 25px 30px'
                },
                tooltip: {
                borderColor: '#fff',
                borderRadius: '3px',
                borderWidth: '1px',
                fontColor: '#1A1B26',
                fontSize: '12px',
                shadow: true
                },
                series: html
                
            };
        
            zingchart.render({
                id: 'departChart',
                data: departchartConfig,
                height: '90%',
                width: '100%',
            });
        }
    </script>

    <script>
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
        let cilinderchartConfig = {
        backgroundColor: '#ecf2f6',
        graphset: [
       
        {
          type: 'line',
          backgroundColor: '#fff',
          borderColor: '#dae5ec',
          borderWidth: '1px',
          width: '100%',
          height: '100%',
       
          title: {
            text: "TODAY'S SALES",
            marginTop: '7px',
            marginLeft: '12px',
            backgroundColor: 'none',
            fontColor: '#707d94',
            fontFamily: 'Arial',
            fontSize: '11px',
            shadow: false,
            textAlign: 'left',
          },
          legend: {
            margin: 'auto auto 15 auto',
            backgroundColor: 'none',
            borderWidth: '0px',
            item: {
              margin: '0px',
              padding: '0px',
              fontColor: '#707d94',
              fontFamily: 'Arial',
              fontSize: '9px',
            },
            layout: 'x4',
            marker: {
              type: 'match',
              padding: '3px',
              fontFamily: 'Arial',
              fontSize: '10px',
              lineWidth: '2px',
              showLine: 'true',
              size: 4,
            },
            shadow: false,
          },
          plot: {
            tooltip: {
              visible: false,
            },
            animation: {
              delay: 500,
              effect: 'ANIMATION_SLIDE_LEFT',
            },
          },
          plotarea: {
            margin: '50px 25px 70px 46px',
          },
       
          series: [{
              text: 'Kenmore',
              values: [69, 68, 54, 48, 70],
              lineColor: '#4dbac0',
              lineWidth: '2px',
              marker: {
                backgroundColor: '#fff',
                borderColor: '#36a2a8',
                borderWidth: '1px',
                shadow: false,
                size: 3,
              },
              palette: 0,
              shadow: false,
            },
            {
              text: 'Craftsman',
              values: [51, 53, 47, 60, 48],
              lineColor: '#25a6f7',
              lineWidth: '2px',
              marker: {
                backgroundColor: '#fff',
                borderColor: '#1993e0',
                borderWidth: '1px',
                shadow: false,
                size: 3,
              },
              palette: 1,
              shadow: false,
              visible: true,
            },
            {
              text: 'DieHard',
              values: [42, 43, 30, 50, 31],
              lineColor: '#ad6bae',
              lineWidth: '2px',
              marker: {
                backgroundColor: '#fff',
                borderColor: '#975098',
                borderWidth: '1px',
                shadow: false,
                size: 3,
              },
              palette: 2,
              shadow: false,
              visible: true,
            },
            {
              text: "Land's End",
              values: [25, 15, 26, 21, 24],
              lineColor: '#f3950d',
              lineWidth: '2px',
              marker: {
                backgroundColor: '#fff',
                borderColor: '#d37e04',
                borderWidth: '1px',
                shadow: false,
                size: 3,
              },
              palette: 3,
              shadow: false,
            },
          ],
        },
      ],
        };

        zingchart.render({
        id: 'cilinderChart',
        data: cilinderchartConfig,
        height: '100%',
        width: '100%',
        });
    </script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Datatable JS -->
        <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Slimscroll JS -->
        <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>

        <!-- Select2 JS -->
        <script src="{{ asset('assets/js/select2.min.js') }}"></script>

        <!-- Chart JS -->
        <script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
        {{-- <script src="{{asset('assets/js/chart.js')}}"></script> --}}
        <script src="{{ asset('assets/js/greedynav.js') }}"></script>

        <!-- Datetimepicker JS -->
        <script src="{{ asset('assets/js/moment.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
        <!-- jquery -->
        <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
        {{-- <script src="{{ asset('assets/plugins/modules/zingchart-pie.min.js') }} defer></script> --}}

        @include('includes.dashboard.filter_js');
        <script>
            //info
            $('.card').on('load', function() {
                $(this).show();
            });
            $('.card .btn-close').on('click', function() {
                $(this).closest('.card').hide();
            });
            //end

            $(document).ready(function() {
                // const dateNow = new Date();
                // const yKeysAttendance = ['onTime', 'totalLate', 'alpha', 'leave', 'sick'];
                // const labelAttendance = ['On Time', 'Late', 'Alpha', 'Leave', 'Sick'];

                // const yKeysEmployeeStatus = ['newEmployee', 'outEmployee', 'jobholder', 'contract', 'freelance'];
                // const labelEmployeeStatus = ['New', 'Out', 'Jobholder', 'Contract', 'Freelance'];



                // function convertDate(year, month) {
                //     return new Date(year, month, 1);
                // }

                // function drawDonutChart(data) {
                //     $('#donut-chart').empty()
                //     Morris.Donut({
                //         element: 'donut-chart',
                //         redrawOnParentResize: true,
                //         data: data,
                //         redraw: true
                //     });
                // }

                // function updateDataChartAttendance(data) {
                //     return data;
                // }

                // function addIndicators(chart_type) {
                //     $('#wrapper-indicator').empty()
                //     if (chart_type == 'attendance') {
                //         const indicators = `<div class="form-group d-flex justify-content-start">
                //                             <input id="chartIndicator" checked data-label="On Time" value="onTime" type="checkbox" class="checkmail me-2">
                //                             <label class="label">On Time</label>
                //                         </div>
                //                         <div class="form-group d-flex justify-content-start">
                //                             <input id="chartIndicator" checked data-label="Late" value="totalLate" type="checkbox" class="checkmail me-2">
                //                             <label class="label">Late</label>
                //                         </div>
                //                         <div class="form-group d-flex justify-content-start">
                //                             <input id="chartIndicator" checked data-label="Alpha" value="alpha" type="checkbox" class="checkmail me-2">
                //                             <label class="label">Alpha</label>
                //                         </div>
                //                         <div class="form-group d-flex justify-content-start">
                //                             <input id="chartIndicator" checked data-label="Leave" value="leave" type="checkbox" class="checkmail me-2">
                //                             <label class="label">Leave</label>
                //                         </div>
                //                         <div class="form-group d-flex justify-content-start">
                //                             <input id="chartIndicator" checked data-label="Sick" value="sick" type="checkbox" class="checkmail me-2">
                //                             <label class="label">Sick</label>
                //                         </div>`;
                //         $('#wrapper-indicator').append(indicators)
                //     } else if (chart_type == 'employee_status') {
                //         const indicators = `<div class="form-group d-flex justify-content-start">
                //                                 <input id="chartIndicator" checked data-label="New" value="newEmployee" type="checkbox" class="checkmail me-2">
                //                                 <label class="label">New</label>
                //                             </div>
                //                             <div class="form-group d-flex justify-content-start">
                //                                 <input id="chartIndicator" checked data-label="Out" value="outEmployee" type="checkbox" class="checkmail me-2">
                //                                 <label class="label">Out</label>
                //                             </div>
                //                             <div class="form-group d-flex justify-content-start">
                //                                 <input id="chartIndicator" checked data-label="Jobholder" value="jobholder" type="checkbox" class="checkmail me-2">
                //                                 <label class="label">Jobholder</label>
                //                             </div>
                //                             <div class="form-group d-flex justify-content-start">
                //                                 <input id="chartIndicator" checked data-label="Contract" value="contract" type="checkbox" class="checkmail me-2">
                //                                 <label class="label">Contract</label>
                //                             </div>
                //                             <div class="form-group d-flex justify-content-start">
                //                                 <input id="chartIndicator" checked data-label="Freelance" value="freelance" type="checkbox" class="checkmail me-2">
                //                                 <label class="label">Freelance</label>
                //                             </div>`;
                //         $('#wrapper-indicator').append(indicators)
                //     }
                // }

                // function initiateEventsChartIfIndicatorChanged() {
                //     $('input[id="chartIndicator"]').click(function(e) {
                //         let yKeysArr = [];
                //         let labels = [];
                //         const dateFrom = $('.datepickerFrom').val();
                //         const dateTo = $('.datepickerTo').val();
                //         const branch_id = $('#branch_id').val();
                //         const chart_type = $('#chart_type').val();

                //         $('input[id="chartIndicator"]:checked').each(function(index, element) {
                //             yKeysArr.push($(this).val());
                //             labels.push($(this).data('label'));
                //         });
                //         $.post("{{ route('dashboard.filter-chart-attendance') }}", {
                //                 "_token": "{{ csrf_token() }}",
                //                 "dateFrom": dateFrom,
                //                 "dateTo": dateTo,
                //                 "branch_id": branch_id,
                //                 "chart_type": chart_type,
                //                 "yKeysArr": yKeysArr,
                //                 "labels": labels,
                //             })
                //             .done(function(data) {
                //                 $('#bar-charts').empty()

                //                 if (chart_type == 'attendance') {
                //                     const chartAttendance = Morris.Bar({
                //                         element: 'bar-charts',
                //                         redrawOnParentResize: true,
                //                         data: updateDataChartAttendance(data),
                //                         xkey: 'month',
                //                         ykeys: yKeysArr,
                //                         // ykeys: yKeysAttendance,
                //                         labels: labels,
                //                         // labels: labelAttendance,
                //                         lineColors: ['#ff9b44', '#fc6075', '#0000FF', '#808080',
                //                             '#0ad0FF'
                //                         ],
                //                         lineWidth: '5px',
                //                         barColors: ['#ff9b44', '#fc6075', '#0000FF', '#808080',
                //                             '#0ad0FF'
                //                         ],
                //                         resize: true,
                //                         redraw: true
                //                     });
                //                 } else if (chart_type == 'employee_status') {
                //                     const chartAttendance = Morris.Bar({
                //                         element: 'bar-charts',
                //                         redrawOnParentResize: true,
                //                         data: updateDataChartAttendance(data),
                //                         xkey: 'month',
                //                         ykeys: yKeysArr,
                //                         // ykeys: yKeysEmployeeStatus,
                //                         labels: labels,
                //                         // labels: labelEmployeeStatus,
                //                         lineColors: ['#ff9b44', '#fc6075', '#0000FF', '#808080',
                //                             '#ddd'
                //                         ],
                //                         lineWidth: '5px',
                //                         barColors: ['#ff9b44', '#fc6075', '#0000FF', '#808080',
                //                             '#ddd'
                //                         ],
                //                         resize: true,
                //                         redraw: true
                //                     });
                //                 }
                //                 // chartAttendance.setData(updateDataChartAttendance(JSON.parse(data)))
                //             });
                //     });
                // }

                // function chart(chart_type, data) {
                //     $('#bar-charts').empty()

                //     if (chart_type == 'attendance') {
                //         const chartAttendance = Morris.Bar({
                //             element: 'bar-charts',
                //             redrawOnParentResize: true,
                //             data: updateDataChartAttendance(data),
                //             xkey: 'month',
                //             ykeys: yKeysAttendance,
                //             labels: labelAttendance,
                //             lineColors: ['#ff9b44', '#fc6075', '#0000FF', '#808080', '#0ad0FF'],
                //             lineWidth: '5px',
                //             barColors: ['#ff9b44', '#fc6075', '#0000FF', '#808080', '#0ad0FF'],
                //             resize: true,
                //             redraw: true
                //         });
                //     } else if (chart_type == 'employee_status') {
                //         const chartAttendance = Morris.Bar({
                //             element: 'bar-charts',
                //             redrawOnParentResize: true,
                //             data: updateDataChartAttendance(data),
                //             xkey: 'month',
                //             ykeys: yKeysEmployeeStatus,
                //             labels: labelEmployeeStatus,
                //             lineColors: ['#ff9b44', '#fc6075', '#0000FF', '#808080', '#ddd'],
                //             lineWidth: '5px',
                //             barColors: ['#ff9b44', '#fc6075', '#0000FF', '#808080', '#ddd'],
                //             resize: true,
                //             redraw: true
                //         });
                //     }
                // }

                // const tblTimesheet = $('.tbl-timesheet-schedule').DataTable({
                //     processing: true,
                //     serverSide: true,
                //     paging: false,
                //     ordering: false,
                //     info: false,
                //     searching: false,
                //     ajax: {
                //         url: `{{ route('dashboard.filter-timesheet-schedules') }}`,
                //         data: function(d) {
                //             d.branch_id = $('#branch_id').val();
                //         }
                //     },
                //     columns: [{
                //             data: 'label_project'
                //         },
                //         {
                //             data: 'client_company',
                //         },
                //         {
                //             data: 'start_date',
                //         },
                //         {
                //             data: 'end_date',
                //         },
                //         {
                //             data: 'status',
                //         },
                //     ],
                // });

                // const tblResume = $('.tbl-employee-resume').DataTable({
                //     processing: true,
                //     serverSide: true,
                //     paging: false,
                //     ordering: false,
                //     info: false,
                //     searching: false,
                //     ajax: {
                //         url: `{{ route('dashboard.filter-employee-resume') }}`,
                //         data: function(d) {
                //             d.branch_id = $('#branch_id').val();
                //         }
                //     },
                //     columns: [{
                //             data: 'date'
                //         },
                //         {
                //             data: 'activity'
                //         },
                //     ],
                // });

                // function loadData() {
                //     let branch_id = $('#branch_id').val();
                //     const chart_type = $('#chart_type').val();
                //     addIndicators(chart_type)

                //     let yKeysArr = [];
                //     let labels = [];

                //     $('input[id="chartIndicator"]:checked').each(function(index, element) {
                //         yKeysArr.push($(this).val());
                //         labels.push($(this).data('label'));
                //     });

                //     $('#totalEmployee').html("0");
                //     $('#totalJobholder').html("0");
                //     $('#totalContractEmployee').html("0");
                //     $('#totalFreelanceEmployee').html("0");

                //     $.post("{{ route('dashboard.filter-branch') }}", {
                //             "_token": "{{ csrf_token() }}",
                //             "branch_id": branch_id,
                //             "chart_type": chart_type,
                //             "yKeysArr": yKeysArr,
                //             "labels": labels,
                //         })
                //         .done(function(data) {
                //             const res = data.data
                //             console.log(res);
                //             $('#totalEmployee').html(res.totalEmployees);
                //             $('#totalJobholder').html(res.totalEmployeesJobholder);
                //             $('#totalContractEmployee').html(res.totalEmployeesContract);
                //             $('#totalFreelanceEmployee').html(res.totalEmployeesFreelance);
                //             $('small[id="totalEmployeeStatistic"]').each(function() {
                //                 $(this).html(res.totalEmployees)
                //             });

                //             $('#totalTodaySick').html(res.totalTodaySick);
                //             $('#progress-bar-sick').css("width", (res.totalTodaySick / res.totalEmployees) * 100 +
                //                 '%');

                //             $('#totalTodayLeave').html(res.totalTodayLeave);
                //             $('#progress-bar-leave').css("width", (res.totalTodayLeave / res.totalEmployees) * 100 +
                //                 '%');

                //             $('#totalTodayPermit').html(res.totalTodayPermit);
                //             $('#progress-bar-permit').css("width", (res.totalTodayPermit / res.totalEmployees) *
                //                 100 + '%');

                //             $('#totalTodayAlpha').html(res.totalTodayAlpha);
                //             $('#progress-bar-alpha').css("width", (res.totalTodayAlpha / res.totalEmployees) * 100 +
                //                 '%');

                //             $('#totalClockIn').html(res.totalClockIn);
                //             $('#totalAbsent').html(res.totalAbsent);
                //             $('#totalTimesheets').html(res.totalTimesheets);
                //             $('#timesheetInCity').html(res.timesheetInCity);
                //             $('#timesheetsOutCity').html(res.timesheetsOutCity);
                //             $('#totalLate').html(res.totalLate);

                //             const esJobholder = (res.totalEmployeesJobholder / res.totalEmployees) * 100;
                //             $('#es-jobholder').html(res.totalEmployeesJobholder);
                //             $('#es-progress-jobholder').css("width", esJobholder + '%');
                //             $('#es-progress-jobholder').html(esJobholder + '%');

                //             const esContract = (res.totalEmployeesContract / res.totalEmployees) * 100;
                //             $('#es-contract').html(res.totalEmployeesContract);
                //             $('#es-progress-contract').css("width", esContract + '%');
                //             $('#es-progress-contract').html(esContract + '%');

                //             const esFreelance = (res.totalEmployeesFreelance / res.totalEmployees) * 100;
                //             $('#es-freelance').html(res.totalEmployeesFreelance);
                //             $('#es-progress-freelance').css("width", esFreelance + '%');
                //             $('#es-progress-freelance').html(esFreelance + '%');

                //             $('#es-total-employee').html(res.totalEmployees);

                //             $('#es-gender-male').html(res.male);
                //             $('#es-gender-female').html(res.female);

                //             $.each(res.logNewestAttendance, function(i, v) {
                //                 const d = new Date(v.date);
                //                 let content = `<div class="leave-info-box">
                //                             <div class="media d-flex align-items-center">
                //                                 <div class="media-body flex-grow-1">
                //                                     <div class="text-sm my-0">${v.name}</div>
                //                                 </div>
                //                             </div>
                //                             <div class="row align-items-center mt-3">
                //                                 <div class="col-8">
                //                                     <span class="text-sm text-muted">${v.activity}</span>
                //                                 </div>
                //                                 <div class="col-4">
                //                                     <h6 class="mb-0 text-end">${d.toLocaleTimeString()}</h6>
                //                                 </div>
                //                             </div>
                //                         </div>`;
                //                 $('.body-content').append(content)
                //             });
                //             chart(chart_type, res.dataChart)
                //             initiateEventsChartIfIndicatorChanged();
                //             drawDonutChart(res.dataChartGenderDiversity);


                //         });



                // }
                // loadData();

                // $("#branch_id").change(function() {
                //     $('#loader-wrapper').css('display', 'block')
                //     let branch_id = $(this).val();
                //     const chart_type = $('#chart_type').val();
                //     addIndicators(chart_type)

                //     let yKeysArr = [];
                //     let labels = [];

                //     $('input[id="chartIndicator"]:checked').each(function(index, element) {
                //         yKeysArr.push($(this).val());
                //         labels.push($(this).data('label'));
                //     });

                //     $.post("{{ route('dashboard.filter-branch') }}", {
                //             "_token": "{{ csrf_token() }}",
                //             "branch_id": branch_id,
                //             "chart_type": chart_type,
                //             "yKeysArr": yKeysArr,
                //             "labels": labels,
                //         })
                //         .done(function(data) {
                //             const res = data.data
                //             // console.log(res);
                //             $('.body-content').empty()

                //             $('#totalEmployee').html(res.totalEmployees);
                //             $('#totalJobholder').html(res.totalEmployeesJobholder);
                //             $('#totalContractEmployee').html(res.totalEmployeesContract);
                //             $('#totalFreelanceEmployee').html(res.totalEmployeesFreelance);

                //             $('small[id="totalEmployeeStatistic"]').each(function() {
                //                 $(this).html(res.totalEmployees)
                //             });

                //             $('#totalTodaySick').html(res.totalTodaySick);
                //             $('#progress-bar-sick').css("width", (res.totalTodaySick / res.totalEmployees) *
                //                 100 + '%');

                //             $('#totalTodayLeave').html(res.totalTodayLeave);
                //             $('#progress-bar-leave').css("width", (res.totalTodayLeave / res
                //                 .totalEmployees) * 100 + '%');

                //             $('#totalTodayPermit').html(res.totalTodayPermit);
                //             $('#progress-bar-permit').css("width", (res.totalTodayPermit / res
                //                 .totalEmployees) * 100 + '%');

                //             $('#totalTodayAlpha').html(res.totalTodayAlpha);
                //             $('#progress-bar-alpha').css("width", (res.totalTodayAlpha / res
                //                 .totalEmployees) * 100 + '%');

                //             $('#totalClockIn').html(res.totalClockIn);
                //             $('#totalAbsent').html(res.totalAbsent);
                //             $('#totalTimesheets').html(res.totalTimesheets);
                //             $('#timesheetInCity').html(res.timesheetsInCity);
                //             $('#timesheetsOutCity').html(res.timesheetsOutCity);
                //             $('#totalLate').html(res.totalLate);

                //             const esJobholder = (res.totalEmployeesJobholder / res.totalEmployees) * 100;
                //             $('#es-jobholder').html(res.totalEmployeesJobholder);
                //             $('#es-progress-jobholder').css("width", esJobholder + '%');
                //             $('#es-progress-jobholder').html(esJobholder + '%');

                //             const esContract = (res.totalEmployeesContract / res.totalEmployees) * 100;
                //             $('#es-contract').html(res.totalEmployeesContract);
                //             $('#es-progress-contract').css("width", esContract + '%');
                //             $('#es-progress-contract').html(esContract + '%');

                //             const esFreelance = (res.totalEmployeesFreelance / res.totalEmployees) * 100;
                //             $('#es-freelance').html(res.totalEmployeesFreelance);
                //             $('#es-progress-freelance').css("width", esFreelance + '%');
                //             $('#es-progress-freelance').html(esFreelance + '%');

                //             $('#es-total-employee').html(res.totalEmployees);

                //             $.each(res.logNewestAttendance, function(i, v) {
                //                 const d = new Date(v.date);
                //                 let content = `<div class="leave-info-box">
                //                             <div class="media d-flex align-items-center">
                //                                 <div class="media-body flex-grow-1">
                //                                     <div class="text-sm my-0">${v.name}</div>
                //                                 </div>
                //                             </div>
                //                             <div class="row align-items-center mt-3">
                //                                 <div class="col-8">
                //                                     <span class="text-sm text-muted">${v.activity}</span>
                //                                 </div>
                //                                 <div class="col-4">
                //                                     <h6 class="mb-0 text-end">${d.toLocaleTimeString()}</h6>
                //                                 </div>
                //                             </div>
                //                         </div>`;
                //                 $('.body-content').append(content)
                //             });

                //             $('#es-gender-male').html(res.male);
                //             $('#es-gender-female').html(res.female);

                //             tblResume.draw();
                //             tblTimesheet.draw();
                //             chart(chart_type, res.dataChart)
                //             initiateEventsChartIfIndicatorChanged();
                //             drawDonutChart(res.dataChartGenderDiversity);
                //         });


                //     setTimeout(() => {
                //         $('#loader-wrapper').css('display', 'none')
                //     }, 400);
                // });

                // $('#apply-filter').click(function(e) {
                //     e.preventDefault();
                //     const dateFrom = $('.datepickerFrom').val();
                //     const dateTo = $('.datepickerTo').val();
                //     const branch_id = $('#branch_id').val();
                //     const chart_type = $('#chart_type').val();
                //     addIndicators(chart_type)

                //     let yKeysArr = [];
                //     let labels = [];

                //     $('input[id="chartIndicator"]:checked').each(function(index, element) {
                //         yKeysArr.push($(this).val());
                //         labels.push($(this).data('label'));
                //     });

                //     $.post("{{ route('dashboard.filter-chart-attendance') }}", {
                //             "_token": "{{ csrf_token() }}",
                //             "dateFrom": dateFrom,
                //             "dateTo": dateTo,
                //             "branch_id": branch_id,
                //             "chart_type": chart_type,
                //             "yKeysArr": yKeysArr,
                //             "labels": labels,
                //         })
                //         .done(function(data) {
                //             chart(chart_type, data)

                //             initiateEventsChartIfIndicatorChanged();
                //         });
                // });

                // $(".datepickerFrom").datetimepicker({
                //     useCurrent: false,
                //     format: 'MMM YYYY',
                //     defaultDate: convertDate(dateNow.getFullYear(), 0),
                // });

                // $(".datepickerTo").datetimepicker({
                //     useCurrent: false,
                //     format: 'MMM YYYY',
                //     defaultDate: dateNow,
                // });
            });
        </script>
    @endpush
