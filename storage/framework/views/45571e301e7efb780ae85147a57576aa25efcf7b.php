<!DOCTYPE html>
<html>

<head>
    <title>Healthy and Yummy</title>

    <!-- meta tag -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" id="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- favicon-icon  -->
    <link rel="icon" href="<?php echo asset('public/assets/images/favicon.png'); ?>" type="image/x-icon">

    <!-- font-awsome css  -->
    <link rel="stylesheet" type="text/css" href="<?php echo asset('public/front/css/font-awsome.css'); ?>">

    <!-- fonts css -->
    <link rel="stylesheet" type="text/css" href="<?php echo asset('public/front/fonts/fonts.css'); ?>">

    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="<?php echo asset('public/front/css/bootstrap.min.css'); ?>">

    <!-- fancybox css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

    <!-- owl.carousel css -->
    <link rel="stylesheet" type="text/css" href="<?php echo asset('public/front/css/owl.carousel.min.css'); ?>">

    <link href="<?php echo asset('public/assets/plugins/sweetalert/css/sweetalert.css'); ?>" rel="stylesheet">
    <!-- style css  -->
    <link rel="stylesheet" type="text/css" href="<?php echo asset('public/front/css/style.css'); ?>">

    <!-- responsive css  -->
    <link rel="stylesheet" type="text/css" href="<?php echo asset('public/front/css/responsive.css'); ?>">

</head>

<body>

<div id="success-msg" class="alert alert-dismissible mt-3" style="display: none;">
    <span id="msg"></span>
</div>

<div id="error-msg" class="alert alert-dismissible mt-3" style="display: none;">
    <span id="ermsg"></span>
</div>

<section class="signup-sec">
    <img src='<?php echo asset("public/assets/images/bg.jpg"); ?>' class="bg-img" alt="">
    <div class="container">
        <div class="signup-logo">
            <a href="<?php echo e(URL::to('/')); ?>">
                <img src="<?php echo asset('public/front/images/logo.png'); ?>" alt="">
                <p>Healthy and Yummy</p>
            </a>
        </div>
        <form id="login" action="<?php echo e(URL::to('/forgot-password/forgot-password')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <input type="email" name="email" id="email" placeholder="Email Address" class="w-100" required="">
            <button type="submit" class="btn">Send mail</button>
            <p class="already">Already have an account ? <a href="<?php echo e(URL::to('/signin')); ?>">Login</a></p>
            <?php if(\Session::has('danger')): ?>
                <div class="alert alert-danger w-100">
                    <?php echo \Session::get('danger'); ?>

                </div>
            <?php endif; ?>
            <?php if(\Session::has('success')): ?>
                <div class="alert alert-success w-100">
                    <?php echo \Session::get('success'); ?>

                </div>
            <?php endif; ?>
        </form>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- bootstrap js -->
<script src="<?php echo asset('public/front/js/bootstrap.bundle.js'); ?>"></script>

<!-- owl.carousel js -->
<script src="<?php echo asset('public/front/js/owl.carousel.min.js'); ?>"></script>

<!-- lazyload js -->
<script src="<?php echo asset('public/front/js/lazyload.js'); ?>"></script>

<!-- custom js -->
<script src="<?php echo asset('public/front/js/custom.js'); ?>"></script>
</body>

</html><?php /**PATH D:\new-xampp\htdocs\app\resources\views/front/forgot-password.blade.php ENDPATH**/ ?>