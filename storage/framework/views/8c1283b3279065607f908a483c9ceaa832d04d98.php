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
    
    <?php if($errors->login->first('email') && $errors->login->first('mobile')): ?>
        <div class="alert alert-danger" style="text-align: center;">
            <?php echo e($errors->login->first('email')); ?> <?php echo e($errors->login->first('mobile')); ?>

        </div>
    <?php elseif($errors->login->first('email')): ?>
        <div class="alert alert-danger" style="text-align: center;">
            <?php echo e($errors->login->first('email')); ?>

        </div>
    <?php elseif($errors->login->first('mobile')): ?>
        <div class="alert alert-danger" style="text-align: center;">
            <?php echo e($errors->login->first('mobile')); ?>

        </div>
    <?php endif; ?>
    <?php if($errors->login->first('name')): ?>
        <div class="alert alert-danger" style="text-align: center;">
            <?php echo e($errors->login->first('name')); ?>

        </div>
    <?php endif; ?>
    <?php if($errors->login->first('password')): ?>
        <div class="alert alert-danger" style="text-align: center;">
            <?php echo e($errors->login->first('password')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger" style="text-align: center;">
            <?php echo e($errors->first()); ?>

        </div>
    <?php endif; ?>
    <div class="container">
        <div class="signup-logo">
            <a href="<?php echo e(URL::to('/')); ?>">
                <img src="<?php echo asset('public/front/images/logo.png'); ?>" alt="">
                <p>Healthy and Yummy</p> <!-- Food App -->
            </a>
        </div>
        <form action="<?php echo e(URL::to('/signup/signup')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <input type="text" name="name" placeholder="Full Name" class="w-100" value="<?php echo e(old('name')); ?>">
            <input type="text" name="email" placeholder="Email Address" class="w-50" value="<?php echo e(old('email')); ?>">
            <input type="text" name="mobile" placeholder="Mobile Number" class="w-50" value="<?php echo e(old('mobile')); ?>">
            <input type="password" name="password" placeholder="Password" class="w-50">
            <input type="password" name="password_confirmation" placeholder="Confirm password" class="w-50">
            <label class="accept-check w-100" for="accept">
                <input type="checkbox" name="accept" id="accept" required="">
                <p class="already-p">I accept <a href="<?php echo e(URL::to('/terms')); ?>"> terms & conditions </a></p>
            </label>

            <button class="btn">Create Account</button>
            <p class="already">I have <a href="<?php echo e(URL::to('/signin')); ?>">already account</a></p>
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

</html><?php /**PATH D:\new-xampp\htdocs\app\resources\views/front/signup.blade.php ENDPATH**/ ?>