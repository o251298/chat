<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('/template/css/bootstrap.min.css')}}">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{asset('/template/css/typography.css')}}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('/template/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('/template/css/responsive.css')}}">
</head>
<body>
<!-- loader Start -->
<div id="loading">
    <div id="loading-center">
    </div>
</div>
<!-- loader END -->
<!-- Sign in Start -->
<section class="sign-in-page">
    <div id="container-inside">
        <div id="circle-small"></div>
        <div id="circle-medium"></div>
        <div id="circle-large"></div>
        <div id="circle-xlarge"></div>
        <div id="circle-xxlarge"></div>
    </div>
    <div class="container p-0">
        <div class="row no-gutters">
            <div class="col-md-6 text-center pt-5">
                <div class="sign-in-detail text-white">
                    <a class="sign-in-logo mb-5" href="#"></a>
                    <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                        <div class="item">

                            <h4 class="mb-1 text-white">Find new friends</h4>
                            <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                        </div>
                        <div class="item">

                            <h4 class="mb-1 text-white">Connect with the world</h4>
                            <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                        </div>
                        <div class="item">

                            <h4 class="mb-1 text-white">Create new events</h4>
                            <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 bg-white pt-5">
                <div class="sign-in-from">
                    <h1 class="mb-0">Sign in</h1>
                    <p>Enter your email address and password to access admin panel.</p>
                    <form class="mt-4" method="POST" action="{{ route('login') }}">
                        <div class="form-group">
                            @csrf
                            <label for="exampleInputEmail1">Email address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="d-inline-block w-100">
                            <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Sign in</button>
                        </div>
                        <div class="sign-info">
                            <span class="dark-color d-inline-block line-height-2">Don't have an account? <a href="{{ route('register') }}">{{ __('Register') }}</a></span>
                            <ul class="iq-social-media">
                                <li><a href="#"><i class="ri-facebook-box-line"></i></a></li>
                                <li><a href="#"><i class="ri-twitter-line"></i></a></li>
                                <li><a href="#"><i class="ri-instagram-line"></i></a></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Sign in END -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('/template/js/jquery.min.js')}}"></script>
<script src="{{asset('/template/js/popper.min.js')}}"></script>
<script src="{{asset('/template/js/bootstrap.min.js')}}"></script>
<!-- Appear JavaScript -->
<script src="{{asset('/template/js/jquery.appear.js')}}"></script>
<!-- Countdown JavaScript -->
<script src="{{asset('/template/js/countdown.min.js')}}"></script>
<!-- Counterup JavaScript -->
<script src="{{asset('/template/js/waypoints.min.js')}}"></script>
<script src="{{asset('/template/js/jquery.counterup.min.js')}}"></script>
<!-- Wow JavaScript -->
<script src="{{asset('/template/js/wow.min.js')}}"></script>
<!-- Apexcharts JavaScript -->
<script src="{{asset('/template/js/apexcharts.js')}}"></script>
<!-- Slick JavaScript -->
<script src="{{asset('/template/js/slick.min.js')}}"></script>
<!-- Select2 JavaScript -->
<script src="{{asset('/template/js/select2.min.js')}}"></script>
<!-- Owl Carousel JavaScript -->
<script src="{{asset('/template/js/owl.carousel.min.js')}}"></script>
<!-- Magnific Popup JavaScript -->
<script src="{{asset('/template/js/jquery.magnific-popup.min.js')}}"></script>
<!-- Smooth Scrollbar JavaScript -->
<script src="{{asset('/template/js/smooth-scrollbar.js')}}"></script>
<!-- lottie JavaScript -->
<script src="{{asset('/template/js/lottie.js')}}"></script>
<!-- am core JavaScript -->
<script src="{{asset('/template/js/core.js')}}"></script>
<!-- am charts JavaScript -->
<script src="{{asset('/template/js/charts.js')}}"></script>
<!-- am animated JavaScript -->
<script src="{{asset('/template/js/animated.js')}}"></script>
<!-- am kelly JavaScript -->
<script src="{{asset('/template/js/kelly.js')}}"></script>
<!-- am maps JavaScript -->
<script src="{{asset('/template/js/maps.js')}}"></script>
<!-- am worldLow JavaScript -->
<script src="{{asset('/template/js/worldLow.js')}}"></script>
<!-- Chart Custom JavaScript -->
<script src="{{asset('/template/js/chart-custom.js')}}"></script>
<!-- Custom JavaScript -->
<script src="{{asset('/template/js/custom.js')}}"></script>
</body>
</html>
