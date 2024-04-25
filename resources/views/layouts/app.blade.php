<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        {{-- <meta name="description" content="Smarthr - Bootstrap Admin Template"> --}}
		{{-- <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects"> --}}
        {{-- <meta name="author" content="Dreamguys - Bootstrap Admin Template"> --}}
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') - Pehadir</title>

		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/logo-pehadir.jpg')}}">

        @include('includes.style')
        @stack('addon-style')

        <!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
        <style>
            .loader {
                border: 16px solid #7B7B7B;
                border-radius: 50%;
                border-top: 16px solid #f7770f;
                border-bottom: 16px solid #f7770f;
                width: 100px;
                height: 100px;
                -webkit-animation: spin 1.5s linear infinite;
                animation: spin 1.5s linear infinite;
                }
            .loader2{
                z-index:[1-100];
                position : absolute;
                border: 12px solid #7B7B7B;
                border-radius: 50%;
                border-top: 12px solid #29b6f6;
                border-bottom: 12px solid #29b6f6;
                width: 70px;
                height: 70px;
                -webkit-animation: spin 2s linear infinite;
                animation: spin2 2s linear infinite;
            }

            @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
            }

            @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
            }
            @keyframes spin2 {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(-360deg); }
            }
        .containerLoader{
            position: fixed;
            top: 0;
            width: 100%;
            height: 100%;
            background: #222222;
            z-index: 13000;
            display: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            background:rgba(0, 0, 0, 0.5);
        }
        </style>
    </head>
    <body class="">
        {{-- loader --}}
        <div class="containerLoader" hidden>
            <div class="loader"></div>
            <div class="loader2"></div>
        </div>

		<!-- Main Wrapper -->
			@yield('content')
		<!-- /Main Wrapper -->
        
        <!-- jQuery -->
        <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>

        <!-- Bootstrap Core JS -->
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

		{{-- @include('includes.script') --}}
        @stack('addon-script')

        <!-- Theme Settings JS -->
        <script src="{{asset('assets/js/layout.js')}}"></script>
        <script src="{{asset('assets/js/theme-settings.js')}}"></script>
        <script src="{{asset('assets/js/greedynav.js')}}"></script>

        <!-- Custom JS -->
        <script src="{{asset('assets/js/app.js')}}"></script>
        @include('sweetalert::alert')
        <script>
            $('.containerLoader').attr('hidden',false)
            $(document).ready(function () {
                $('.containerLoader').attr('hidden',true)
            })
            $('#lonceng').on('click',function(){
                $.ajax({
                    url : 'get-notif',
                    type : 'post',
                    dataType : 'json',
                    success : function(respon){
                        var html ='';
                        $.each(respon,function(key,val){
                            html += `<li class="notification-message">
                                        <a href="view-inbox/`+val.id+`">
                                            <div class="media d-flex">
                                                <span class="avatar flex-shrink-0">
                                                    <img alt="" src="assets/img/profiles/avatar-02.jpg">
                                                </span>
                                                <div class="media-body flex-grow-1">
                                                    <p class="noti-details"><span class="noti-title">`+val.title+`</span></p>
                                                    <p class="noti-time"><span class="notification-time">`+val.date+`</span></p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>`;
                        })
                        $('.noti-content').html(`<ul class="notification-list">`+ html + `</ul>`)
                    }
                })
            })
            $('#clear').on('click',function(){
                $.ajax({
                    url : 'clear-notif',
                    type : 'post',
                    dataType : 'json',
                    success : function(respon){
                    }
                })
            })
        </script>
    </body>
</html>
