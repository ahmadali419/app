<!DOCTYPE html>
<html>

<head>
	<title>Healthy and Yummy</title>    <!--Food Web-->

	<!-- meta tag -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" id="csrf-token" content="<?php echo e(csrf_token()); ?>">

	<!-- favicon-icon  -->
	<link rel="icon" href='<?php echo asset("public/images/about/".$getabout->favicon); ?>' type="image/x-icon">

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

	<!--*******************
	    Preloader start
	********************-->
	<div id="preloader" style="display: none;">
	    <div class="loader">
	        <img src="<?php echo asset('public/front/images/loader.gif'); ?>">
	    </div>
	</div>
	<!--*******************
	    Preloader end
	********************-->

	<!-- navbar -->
	<header>
		<nav class="navbar navbar-expand-lg">
			<div class="container">
				<a class="navbar-brand" href="<?php echo e(URL::to('/')); ?>"><img src='<?php echo asset("public/images/about/".$getabout->logo); ?>' alt=""></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<div class="menu-icon">
						<div class="bar1"></div>
						<div class="bar2"></div>
						<div class="bar3"></div>
					</div>
				</button>
				<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item <?php echo e(request()->is('/') ? 'active' : ''); ?>">
							<a class="nav-link" href="<?php echo e(URL::to('/')); ?>">Home</a>
						</li>
						<li class="nav-item <?php echo e(request()->is('product') ? 'active' : ''); ?>">
							<a class="nav-link" href="<?php echo e(URL::to('/product')); ?>">Eat quality food</a>
						</li>
						<li class="nav-item search">
							<form method="get" action="<?php echo e(URL::to('/search')); ?>">
								<div class="search-input">
									<input type="search" name="item" placeholder="Search here" required="">
								</div>
								<button type="submit" class="nav-link"><i class="far fa-search"></i></button>
							</form>
						</li>
						<?php if(Session::get('id')): ?>
						<li class="nav-item cart-btn">
							<a class="nav-link" href="<?php echo e(URL::to('/cart')); ?>"><i class="fas fa-shopping-cart"></i><span id="cartcnt"><?php echo e(Session::get('cart')); ?></span></a>
						</li>
						<?php else: ?> 
							<li class="nav-item cart-btn">
								<a class="nav-link" href="<?php echo e(URL::to('/signin')); ?>"><i class="fas fa-shopping-cart"></i></a>
							</li>
						<?php endif; ?>
						<?php if(Session::get('id')): ?>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="javascript:void(0)">
									<img src='<?php echo asset("public/images/profile/".Session::get("profile_image")); ?>' alt="">
								</a>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="javascript:void(0)">Hello, <?php echo e(Session::get('name')); ?></a>
									<a class="dropdown-item" data-toggle="modal" data-target="#ChangePasswordModal">Change Password</a>
									<a class="dropdown-item" data-toggle="modal" data-target="#AddReview">Add Review</a>
									<a class="dropdown-item" href="<?php echo e(URL::to('/favorite')); ?>">My Favourites</a>
									<a class="dropdown-item" href="<?php echo e(URL::to('/orders')); ?>">My Orders</a>
									<a class="dropdown-item" href="<?php echo e(URL::to('/logout')); ?>">Logout</a>
								</div>
							</li>
						<?php else: ?> 
							<li class="nav-item">
								<a class="nav-link btn sign-btn" href="<?php echo e(URL::to('/signin')); ?>">Login</a>
							</li>
						<?php endif; ?>
						
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<!-- navbar -->
	<div id="success-msg" class="alert alert-dismissible mt-3" style="display: none;">
	    <span id="msg"></span>
	</div>

	<div id="error-msg" class="alert alert-dismissible mt-3" style="display: none;">
	    <span id="ermsg"></span>
	</div><?php /**PATH /home/ab0ve3twa7yy/public_html/healthyandyummy.digitaltechs.co/resources/views/front/theme/header.blade.php ENDPATH**/ ?>