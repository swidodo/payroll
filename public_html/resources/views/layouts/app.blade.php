<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        {{-- <meta name="description" content="Smarthr - Bootstrap Admin Template"> --}}
		{{-- <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects"> --}}
        {{-- <meta name="author" content="Dreamguys - Bootstrap Admin Template"> --}}
        <meta name="robots" content="noindex, nofollow">
        <title>@yield('title') - Pehadir</title>

		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.png')}}">

        @include('includes.style')
        @stack('addon-style')

        <!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    </head>
    <body class="">

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
    </body>
</html>
