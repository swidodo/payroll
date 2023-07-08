@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="main-wrapper">
    <div class="account-content">
        <div class="container">

            <!-- Account Logo -->
            <div class="d-flex justify-content-center mt-3 mb-3">
                <img src="{{asset('assets/img/logo-pehadir.jpg')}}" width="150" alt="Dreamguy's Technologies">
            </div>
            <!-- /Account Logo -->

            <div class="account-box">
                <div class="account-wrapper">
                    <h3 class="account-title">Login</h3>
                    <p class="account-subtitle">Access to our dashboard</p>

                    @if (Session::get('failed'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>{{Session::get('failed')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    @endif

                    <!-- Account Form -->
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Email Address</label>
                            <input class="form-control" type="email" name="email">

                            @if ($errors->has('email'))
                            <div class="text-danger" role="alert">
                                <small><strong>{{ $errors->get('email')[0] }}</strong></small>
                            </div>
                            @endif

                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Password</label>
                                </div>
                                <div class="col-auto">
                                    <a class="text-muted" href="#">
                                        Forgot password?
                                    </a>
                                </div>
                            </div>
                            <div class="position-relative">
                                <input class="form-control" id="pass" type="password" name="password">
                                <span class="fa fa-eye-slash" id="toggle-password" onclick="return change();"></span>
                            </div>

                            @if ($errors->has('password'))
                                    <div class="text-danger" role="alert">
                                      <small><strong>{{ $errors->get('password')[0] }}</strong></small>
                                    </div>
                            @endif
                        </div>
                        <div class="form-group text-center">
                            {{-- <a href="{{route('dashboard')}}" class="btn btn-primary account-btn" >Login</a> --}}
                            <button class="btn btn-primary account-btn" type="submit">Login</button>
                        </div>
                        <div class="account-footer">
                            <p>Don't have an account yet? <a href="register.html">Register</a></p>
                        </div>
                    </form>
                    <!-- /Account Form -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('addon-script')
<script>
    // membuat fungsi change
    function change() {
        var x = document.getElementById('pass').type;
        if (x == 'password') {
            document.getElementById('pass').type = 'text';
        }
        else {
            document.getElementById('pass').type = 'password';
        }
    }
</script>
@endpush
