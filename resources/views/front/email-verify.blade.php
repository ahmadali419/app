<!DOCTYPE html>
<html>

<head>
    <title>Healthy and Yummy</title>

    <!-- meta tag -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

    <!-- favicon-icon  -->
    <link rel="icon" href="{!! asset('public/assets/images/favicon.png') !!}" type="image/x-icon">

    <!-- font-awsome css  -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/front/css/font-awsome.css') !!}">

    <!-- fonts css -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/front/fonts/fonts.css') !!}">

    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/front/css/bootstrap.min.css') !!}">

    <!-- fancybox css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

    <!-- owl.carousel css -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/front/css/owl.carousel.min.css') !!}">

    <link href="{!! asset('public/assets/plugins/sweetalert/css/sweetalert.css') !!}" rel="stylesheet">
    <!-- style css  -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/front/css/style.css') !!}">

    <!-- responsive css  -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/front/css/responsive.css') !!}">

</head>

<body>

<div id="success-msg" class="alert alert-dismissible mt-3" style="display: none;">
    <span id="msg"></span>
</div>

<div id="error-msg" class="alert alert-dismissible mt-3" style="display: none;">
    <span id="ermsg"></span>
</div>

<section class="signup-sec">
    <img src='{!! asset("public/assets/images/bg.jpg") !!}' class="bg-img" alt="">
    <div class="container">
        <div class="signup-logo">
            <a href="{{URL::to('/')}}">
                <img src="{!! asset('public/front/images/logo.png') !!}" alt="">
                <p>Healthy and Yummy</p>
            </a>
        </div>
        <form id="login" action="{{ URL::to('/email-verification') }}" method="post">
            @csrf
            <input type="email" name="email" id="email" placeholder="Email Address" class="w-100" value="{{Session::get('email')}}" readonly="">
            <input type="number" name="otp" id="otp" min="1" maxlength="6" placeholder="Enter Email Verification Code" class="w-100" required="">
            <button type="submit" class="btn">Verify</button>
            <p class="already">Didn't get Email ? <a href="{{URL::to('/resend-email')}}">Resend</a></p>
            @if (\Session::has('danger'))
                <div class="alert alert-danger w-100">
                    {!! \Session::get('danger') !!}
                </div>
            @endif
            @if (\Session::has('success'))
                <div class="alert alert-success w-100">
                    {!! \Session::get('success') !!}
                </div>
            @endif
        </form>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- bootstrap js -->
<script src="{!! asset('public/front/js/bootstrap.bundle.js') !!}"></script>

<!-- owl.carousel js -->
<script src="{!! asset('public/front/js/owl.carousel.min.js') !!}"></script>

<!-- lazyload js -->
<script src="{!! asset('public/front/js/lazyload.js') !!}"></script>

<!-- custom js -->
<script src="{!! asset('public/front/js/custom.js') !!}"></script>
</body>

</html>