<div class="header" style="background: linear-gradient(to right, #ff9b44 0%, #fc6075 100%)">

    <!-- Logo -->
    <div class="header-left">
        <a href="{{route('dashboard')}}" class="logo">
            <img src="{{asset('assets/img/logo-pehadir.jpg')}}" width="100"  alt="">
        </a>
        <a href="{{route('dashboard')}}" class="logo2">
            <img src="{{asset('assets/img/logo-pehadir.jpg')}}" width="40" height="40" alt="">
        </a>
    </div>
    <!-- /Logo -->

    <a id="toggle_btn" href="javascript:void(0);">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

    <!-- Header Menu -->
    <ul class="nav user-menu">
        <!-- Notifications -->
        <li class="nav-item dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown" id="lonceng">
                <i class="fa fa-bell-o"></i> <span class="badge rounded-pill">{{(Session::get('notif') !=0) ? Session::get('notif') :''}}</span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Notifications</span>
                    <a href="javascript:void(0)" class="clear-noti" id="clear"> Clear All </a>
                </div>
                <div class="noti-content">
                    
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="{{route('list-inbox')}}">View all Notifications</a>
                </div>
            </div>
        </li>
        <!-- /Notifications -->
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img"><img src="assets/img/profiles/avatar-21.jpg" alt="">
                <span class="status online"></span></span>
                <span>{{Auth::user()->name}}</span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('get-my-profile')}}">My Profile</a>
                <a class="dropdown-item" href="{{ route('change_password')}}">Change Password</a>
                <form action="{{route('logout')}}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">Logout</button>
                </form>
            </div>
        </li>
    </ul>
    <!-- /Header Menu -->

    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{route('get-my-profile')}}">My Profile</a>
            <a class="dropdown-item" href="{{ route('change_password')}}">Change Password</a>
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">Logout</button>
                </form>
        </div>
    </div>
    <!-- /Mobile Menu -->

</div>
