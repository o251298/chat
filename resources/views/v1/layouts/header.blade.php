<?php
$currentUser = \Illuminate\Support\Facades\Auth::user();
$currentRoute = \Illuminate\Support\Facades\Route::currentRouteName();
$messages = \App\Models\Message::query();
$messages = $messages->where('receiver_id', \Illuminate\Support\Facades\Auth::id())->where('status', 0);
$messages = $messages->get();
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Favicon -->
    <link rel="shortcut icon" href="#" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('/template/css/bootstrap.min.css')}}">
    <!-- Typography CSS -->Anna Sthesia
    <link rel="stylesheet" href="{{asset('/template/css/typography.css')}}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('/template/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('/template/css/responsive.css')}}">
</head>
<body class="right-column-fixed">
<!-- loader Start -->
{{--<div id="loading">--}}
{{--    <div id="loading-center">--}}
{{--    </div>--}}
{{--</div>--}}
<!-- loader END -->
<!-- Wrapper Start -->
<div class="wrapper" id="app">
    <!-- Sidebar  -->
    <div class="iq-sidebar">
        <div id="sidebar-scrollbar">
            <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu">
                    <li @if($currentRoute == 'profile') class="active" @else  @endif>
                        <a href="{{route('profile', [\Illuminate\Support\Facades\Auth::id()])}}" class="iq-waves-effect"><i class="las la-user"></i><span>Profile</span></a>
                    </li>
                    <li  @if($currentRoute == 'chat') class="active" @else @endif>
                        <a href="{{route('chat')}}" class="iq-waves-effect"><i class="lab la-rocketchat"></i><span>Chat</span></a>
                    </li>
                    <li  @if($currentRoute == 'news') class="active" @else  @endif>
                        <a href="{{route('news')}}" class="iq-waves-effect"><i class="las la-newspaper"></i><span>News</span></a>
                    </li>
                    <li  @if($currentRoute == 'users.list') class="active" @else  @endif>
                        <a href="{{route('users.list')}}" class="iq-waves-effect"><i class="ri-pages-line"></i><span>All users</span></a>
                    </li>
                    <li  @if($currentRoute == 'users.friends') class="active" @else  @endif>
                        <a href="{{route('users.friends')}}" class="iq-waves-effect"><i class="las la-user-friends"></i><span>Friends</span></a>
                    </li>
                </ul>
            </nav>
            <div class="p-3"></div>
        </div>
    </div>
    <!-- TOP Nav Bar -->
    <div class="iq-top-navbar">
        <div class="iq-navbar-custom">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <div class="iq-navbar-logo d-flex justify-content-between">
                    <a href="index.html">
                        <img src="#" class="img-fluid" alt="">
                        <span>SocialV</span>
                    </a>
                    <div class="iq-menu-bt align-self-center">
                        <div class="wrapper-menu">
                            <div class="main-circle"><i class="ri-menu-line"></i></div>
                        </div>
                    </div>
                </div>
                <search-component></search-component>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
                    <i class="ri-menu-3-line"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-list">
                        <li>
                            <a href="{{route('profile', [$currentUser->id])}}" class="iq-waves-effect d-flex align-items-center">
                                <img src="{{$currentUser->getIcon()}}" class="img-fluid rounded-circle mr-3" alt="user">
                                <div class="caption">
                                    <h6 class="mb-0 line-height">{{$currentUser->name}}</h6>
                                </div>
                            </a>
                        </li>
                            @if(count($messages) > 0)
                            <track-component :current_user="{{\Illuminate\Support\Facades\Auth::user()}}" :count_message="{{count($messages)}}"></track-component>
                            @else
                            <track-component :current_user="{{\Illuminate\Support\Facades\Auth::user()}}" :count_message="0"></track-component>
                            @endif
{{--                        <li>--}}
{{--                            <a href="index.html" class="iq-waves-effect d-flex align-items-center">--}}
{{--                                <i class="ri-home-line"></i>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="search-toggle iq-waves-effect" href="#"><i class="ri-group-line"></i></a>--}}
{{--                            <div class="iq-sub-dropdown iq-sub-dropdown-large">--}}
{{--                                <div class="iq-card shadow-none m-0">--}}
{{--                                    <div class="iq-card-body p-0 ">--}}
{{--                                        <div class="bg-primary p-3">--}}
{{--                                            <h5 class="mb-0 text-white">Friend Request<small class="badge  badge-light float-right pt-1">4</small></h5>--}}
{{--                                        </div>--}}
{{--                                        <div class="iq-friend-request">--}}
{{--                                            <div class="iq-sub-card iq-sub-card-big d-flex align-items-center justify-content-between" >--}}
{{--                                                <div class="d-flex align-items-center">--}}
{{--                                                    <div class="">--}}
{{--                                                        <img class="avatar-40 rounded" src="images/user/01.jpg" alt="">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="media-body ml-3">--}}
{{--                                                        <h6 class="mb-0 ">Jaques Amole</h6>--}}
{{--                                                        <p class="mb-0">40  friends</p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="d-flex align-items-center">--}}
{{--                                                    <a href="javascript:void();" class="mr-3 btn btn-primary rounded">Confirm</a>--}}
{{--                                                    <a href="javascript:void();" class="mr-3 btn btn-secondary rounded">Delete Request</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="iq-friend-request">--}}
{{--                                            <div class="iq-sub-card iq-sub-card-big d-flex align-items-center justify-content-between" >--}}
{{--                                                <div class="d-flex align-items-center">--}}
{{--                                                    <div class="">--}}
{{--                                                        <img class="avatar-40 rounded" src="images/user/02.jpg" alt="">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="media-body ml-3">--}}
{{--                                                        <h6 class="mb-0 ">Lucy Tania</h6>--}}
{{--                                                        <p class="mb-0">12  friends</p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="d-flex align-items-center">--}}
{{--                                                    <a href="javascript:void();" class="mr-3 btn btn-primary rounded">Confirm</a>--}}
{{--                                                    <a href="javascript:void();" class="mr-3 btn btn-secondary rounded">Delete Request</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="iq-friend-request">--}}
{{--                                            <div class="iq-sub-card iq-sub-card-big d-flex align-items-center justify-content-between" >--}}
{{--                                                <div class="d-flex align-items-center">--}}
{{--                                                    <div class="">--}}
{{--                                                        <img class="avatar-40 rounded" src="images/user/03.jpg" alt="">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="media-body ml-3">--}}
{{--                                                        <h6 class="mb-0 ">Manny Petty</h6>--}}
{{--                                                        <p class="mb-0">3  friends</p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="d-flex align-items-center">--}}
{{--                                                    <a href="javascript:void();" class="mr-3 btn btn-primary rounded">Confirm</a>--}}
{{--                                                    <a href="javascript:void();" class="mr-3 btn btn-secondary rounded">Delete Request</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="iq-friend-request">--}}
{{--                                            <div class="iq-sub-card iq-sub-card-big d-flex align-items-center justify-content-between" >--}}
{{--                                                <div class="d-flex align-items-center">--}}
{{--                                                    <div class="">--}}
{{--                                                        <img class="avatar-40 rounded" src="images/user/04.jpg" alt="">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="media-body ml-3">--}}
{{--                                                        <h6 class="mb-0 ">Marsha Mello</h6>--}}
{{--                                                        <p class="mb-0">15  friends</p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="d-flex align-items-center">--}}
{{--                                                    <a href="javascript:void();" class="mr-3 btn btn-primary rounded">Confirm</a>--}}
{{--                                                    <a href="javascript:void();" class="mr-3 btn btn-secondary rounded">Delete Request</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="text-center">--}}
{{--                                            <a href="#" class="mr-3 btn text-primary">View More Request</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="#" class="search-toggle iq-waves-effect">--}}
{{--                                <div id="lottie-beil"></div>--}}
{{--                                <span class="bg-danger dots"></span>--}}
{{--                            </a>--}}
{{--                            <div class="iq-sub-dropdown">--}}
{{--                                <div class="iq-card shadow-none m-0">--}}
{{--                                    <div class="iq-card-body p-0 ">--}}
{{--                                        <div class="bg-primary p-3">--}}
{{--                                            <h5 class="mb-0 text-white">All Notifications<small class="badge  badge-light float-right pt-1">4</small></h5>--}}
{{--                                        </div>--}}
{{--                                        <a href="#" class="iq-sub-card" >--}}
{{--                                            <div class="media align-items-center">--}}
{{--                                                <div class="">--}}
{{--                                                    <img class="avatar-40 rounded" src="images/user/01.jpg" alt="">--}}
{{--                                                </div>--}}
{{--                                                <div class="media-body ml-3">--}}
{{--                                                    <h6 class="mb-0 ">Emma Watson Bni</h6>--}}
{{--                                                    <small class="float-right font-size-12">Just Now</small>--}}
{{--                                                    <p class="mb-0">95 MB</p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                        <a href="#" class="iq-sub-card" >--}}
{{--                                            <div class="media align-items-center">--}}
{{--                                                <div class="">--}}
{{--                                                    <img class="avatar-40 rounded" src="images/user/02.jpg" alt="">--}}
{{--                                                </div>--}}
{{--                                                <div class="media-body ml-3">--}}
{{--                                                    <h6 class="mb-0 ">New customer is join</h6>--}}
{{--                                                    <small class="float-right font-size-12">5 days ago</small>--}}
{{--                                                    <p class="mb-0">Cyst Bni</p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                        <a href="#" class="iq-sub-card" >--}}
{{--                                            <div class="media align-items-center">--}}
{{--                                                <div class="">--}}
{{--                                                    <img class="avatar-40 rounded" src="images/user/03.jpg" alt="">--}}
{{--                                                </div>--}}
{{--                                                <div class="media-body ml-3">--}}
{{--                                                    <h6 class="mb-0 ">Two customer is left</h6>--}}
{{--                                                    <small class="float-right font-size-12">2 days ago</small>--}}
{{--                                                    <p class="mb-0">Cyst Bni</p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                        <a href="#" class="iq-sub-card" >--}}
{{--                                            <div class="media align-items-center">--}}
{{--                                                <div class="">--}}
{{--                                                    <img class="avatar-40 rounded" src="images/user/04.jpg" alt="">--}}
{{--                                                </div>--}}
{{--                                                <div class="media-body ml-3">--}}
{{--                                                    <h6 class="mb-0 ">New Mail from Fenny</h6>--}}
{{--                                                    <small class="float-right font-size-12">3 days ago</small>--}}
{{--                                                    <p class="mb-0">Cyst Bni</p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li>--}}

                    </ul>
                    <ul class="navbar-list">
                        <li>
                            <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                                <i class="ri-arrow-down-s-fill"></i>
                            </a>
                            <div class="iq-sub-dropdown iq-user-dropdown">
                                <div class="iq-card shadow-none m-0">
                                    <div class="iq-card-body p-0 ">
                                        <div class="bg-primary p-3 line-height">
                                            <h5 class="mb-0 text-white line-height">Hello {{$currentUser->name}}</h5>
                                            <span class="text-white font-size-12">Available</span>
                                        </div>
                                        <a href="#" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-file-user-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">My Profile</h6>
                                                    <p class="mb-0 font-size-12">View personal profile details.</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="iq-sub-card iq-bg-warning-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-warning">
                                                    <i class="ri-profile-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">Edit Profile</h6>
                                                    <p class="mb-0 font-size-12">Modify your personal details.</p>
                                                </div>
                                            </div>
                                        </a>
{{--                                        <a href="#" class="iq-sub-card iq-bg-info-hover">--}}
{{--                                            <div class="media align-items-center">--}}
{{--                                                <div class="rounded iq-card-icon iq-bg-info">--}}
{{--                                                    <i class="ri-account-box-line"></i>--}}
{{--                                                </div>--}}
{{--                                                <div class="media-body ml-3">--}}
{{--                                                    <h6 class="mb-0 ">Account settings</h6>--}}
{{--                                                    <p class="mb-0 font-size-12">Manage your account parameters.</p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                        <a href="#" class="iq-sub-card iq-bg-danger-hover">--}}
{{--                                            <div class="media align-items-center">--}}
{{--                                                <div class="rounded iq-card-icon iq-bg-danger">--}}
{{--                                                    <i class="ri-lock-line"></i>--}}
{{--                                                </div>--}}
{{--                                                <div class="media-body ml-3">--}}
{{--                                                    <h6 class="mb-0 ">Privacy Settings</h6>--}}
{{--                                                    <p class="mb-0 font-size-12">Control your privacy parameters.</p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
                                        <div class="d-inline-block w-100 text-center p-3">
                                            <a class="bg-primary iq-sign-btn" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                                <i class="ri-login-box-line ml-2"></i>
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- TOP Nav Bar END -->
    <!-- Right Sidebar Panel Start-->
{{--    <div class="right-sidebar-mini right-sidebar">--}}
{{--        <div class="right-sidebar-panel p-0">--}}
{{--            <div class="iq-card shadow-none">--}}
{{--                <div class="iq-card-body p-0">--}}
{{--                    <div class="media-height p-3">--}}
{{--                        <div class="media align-items-center mb-4">--}}
{{--                            <div class="iq-profile-avatar status-online">--}}
{{--                                <img class="rounded-circle avatar-50" src="images/user/01.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="media-body ml-3">--}}
{{--                                <h6 class="mb-0"><a href="#">Anna Sthesia</a></h6>--}}
{{--                                <p class="mb-0">Just Now</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="media align-items-center mb-4">--}}
{{--                            <div class="iq-profile-avatar status-online">--}}
{{--                                <img class="rounded-circle avatar-50" src="images/user/02.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="media-body ml-3">--}}
{{--                                <h6 class="mb-0"><a href="#">Paul Molive</a></h6>--}}
{{--                                <p class="mb-0">Admin</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="media align-items-center mb-4">--}}
{{--                            <div class="iq-profile-avatar status-online">--}}
{{--                                <img class="rounded-circle avatar-50" src="images/user/03.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="media-body ml-3">--}}
{{--                                <h6 class="mb-0"><a href="#">Anna Mull</a></h6>--}}
{{--                                <p class="mb-0">Admin</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="media align-items-center mb-4">--}}
{{--                            <div class="iq-profile-avatar status-online">--}}
{{--                                <img class="rounded-circle avatar-50" src="images/user/04.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="media-body ml-3">--}}
{{--                                <h6 class="mb-0"><a href="#">Paige Turner</a></h6>--}}
{{--                                <p class="mb-0">Admin</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="media align-items-center mb-4">--}}
{{--                            <div class="iq-profile-avatar status-online">--}}
{{--                                <img class="rounded-circle avatar-50" src="images/user/11.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="media-body ml-3">--}}
{{--                                <h6 class="mb-0"><a href="#">Bob Frapples</a></h6>--}}
{{--                                <p class="mb-0">Admin</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="media align-items-center mb-4">--}}
{{--                            <div class="iq-profile-avatar status-online">--}}
{{--                                <img class="rounded-circle avatar-50" src="images/user/02.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="media-body ml-3">--}}
{{--                                <h6 class="mb-0"><a href="#">Barb Ackue</a></h6>--}}
{{--                                <p class="mb-0">Admin</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="media align-items-center mb-4">--}}
{{--                            <div class="iq-profile-avatar status-online">--}}
{{--                                <img class="rounded-circle avatar-50" src="images/user/03.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="media-body ml-3">--}}
{{--                                <h6 class="mb-0"><a href="#">Greta Life</a></h6>--}}
{{--                                <p class="mb-0">Admin</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="media align-items-center mb-4">--}}
{{--                            <div class="iq-profile-avatar status-away">--}}
{{--                                <img class="rounded-circle avatar-50" src="images/user/12.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="media-body ml-3">--}}
{{--                                <h6 class="mb-0"><a href="#">Ira Membrit</a></h6>--}}
{{--                                <p class="mb-0">Admin</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="media align-items-center mb-4">--}}
{{--                            <div class="iq-profile-avatar status-away">--}}
{{--                                <img class="rounded-circle avatar-50" src="images/user/01.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="media-body ml-3">--}}
{{--                                <h6 class="mb-0"><a href="#">Pete Sariya</a></h6>--}}
{{--                                <p class="mb-0">Admin</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="media align-items-center">--}}
{{--                            <div class="iq-profile-avatar">--}}
{{--                                <img class="rounded-circle avatar-50" src="images/user/02.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="media-body ml-3">--}}
{{--                                <h6 class="mb-0"><a href="#">Monty Carlo</a></h6>--}}
{{--                                <p class="mb-0">Admin</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="right-sidebar-toggle bg-primary mt-3">--}}
{{--                        <i class="ri-arrow-left-line side-left-icon"></i>--}}
{{--                        <i class="ri-arrow-right-line side-right-icon"><span class="ml-3 d-inline-block">Close Menu</span></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- Right Sidebar Panel End-->
    <!-- Page Content  -->
