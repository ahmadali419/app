<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- <section class="banner-sec">
    <div class="container-fluid px-0">
        <div class="banner-carousel owl-carousel owl-theme">
            <?php $__currentLoopData = $getslider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item">
                <img src='<?php echo asset("public/images/slider/".$slider->image); ?>' alt="">
                <div class="banner-contant">
                    <h1><?php echo e($slider->title); ?></h1>
                    <p><?php echo e($slider->description); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="feature-sec">
    <div class="container">
        <div class="feature-carousel owl-carousel owl-theme">
            <?php $__currentLoopData = $getbanner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item">
                <div class="feature-box">
                    <img src='<?php echo asset("public/images/banner/".$banner->image); ?>' alt="">
                    <div class="feature-contant">
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section> -->

<section class="product-prev-sec">
    <div class="container">
        <!-- <h2 class="sec-head">Our Packages</h2> -->
            <!-- Own Added Code -->

            <div class="container">

    <div class="jumbotron">

<!-- <div class="container" style="width:700px;"> -->
<div class="d-flex">


     <div>
         
         <div class="packages_list">
    <h5> list of packages</h5>
    <ul class="list-group">
      <li class="list-group-item"><a href="#">LifeStyle</a></li>
      <li class="list-group-item"><a href="#">Weight gain 1</a></li>
      <li class="list-group-item"><a href="#">Weight gain 2</a></li>
      <li class="list-group-item"><a href="#">Shred & Tone A</a></li>
      <li class="list-group-item"><a href="#">Shred & Tone B</a></li>
    </ul>
  </div>
         
      </div>


      <div class="ml-auto">
         
         <!-- <img src="coming_soon.jpg" width="850" height="300"> -->
          <div class="banner-carousel owl-carousel owl-theme">
           <!-- <?php $__currentLoopData = $getslider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="public/images/slider/slider-5ff342d2269d3.crdownload" alt="First slide">
    </div>
    
    
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
           <!-- <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
        </div>
         <!-- < --><!-- h4> Life-Style </h4>
      <p> <b>Description:- </b><br>2 meals, 2 snacks protein- 100g carb-300g </p> -->
      </div>

 </div>
<!-- </div> -->
</div>
</div>

<!-- <div class="container"> -->

    <!-- <div class="jumbotron"> -->

      
<div id="sync2" class="owl-carousel owl-theme">
    
<center> <h1> <u> Our Packages  </u> </h1> </center>
<div class="row" style="padding-left: 200px;">

  <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">LifeStyle</h5>
    <h6 class="card-subtitle mb-2 text-muted">6 Days</h6>
    <p class="card-text">Meal will be delivered to you for 6 days. 3 times in a day..</p>
    <!-- <a href="#" class="card-link">Card link</a> -->
    <a href="#" class="card-link">More Info</a>
  </div>
  </div>
  <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Weight gain 1</h5>
    <h6 class="card-subtitle mb-2 text-muted">20 Days</h6>
    <p class="card-text">Meal will be delivered to you for 20 days. 3 times in a day..</p>
    <!-- <a href="#" class="card-link">Card link</a> -->
    <a href="#" class="card-link">More Info</a>
  </div>
  </div>
  <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Weight gain 2</h5>
    <h6 class="card-subtitle mb-2 text-muted">6 Days</h6>
    <p class="card-text">Meal will be delivered to you for 6 days. 3 times in a day..</p>
    <!-- <a href="#" class="card-link">Card link</a> -->
    <a href="#" class="card-link">More Info</a>
  </div>
  </div>
  <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Shred & Tone A</h5>
    <h6 class="card-subtitle mb-2 text-muted">6 Days</h6>
    <p class="card-text">Meal will be delivered to you for 6 days. 3 times in a day..</p>
<a href="#" class="card-link">Card link</a> -->
    <a href="#" class="card-link">More Info</a>
  </div>
  </div>


  <!--Deleted-->
   <!-- <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Shred & Tone A</h5>
    <h6 class="card-subtitle mb-2 text-muted">6 Days</h6>
    <p class="card-text">Meal will be delivered to you for 6 days. 3 times in a day..</p> -->
    <!-- <a href="#" class="card-link">Card link</a> -->
    <!-- <a href="#" class="card-link">More Info</a>
  </div>
  </div>
   <div class="card" style="width: 18rem;">
  <div class="card-body"> -->
    <!-- <h5 class="card-title">Shred & Tone B</h5>
    <h6 class="card-subtitle mb-2 text-muted">6 Days</h6>
    <p class="card-text">Meal will be delivered to you for 6 days. 3 times in a day..</p> -->
    <!-- <a href="#" class="card-link">Card link</a> -->
    <!-- <a href="#" class="card-link">More Info</a>
  </div>
  </div> -->

</div>
</div>
<!-- </div> -->
<!-- </div> -->

<!-- Food packages -->

<!-- <div class="container"> -->

    <!-- <div class="jumbotron"> -->

    <!-- <div id="sync2" class="owl-carousel owl-theme"> -->

      <center> <h1> <u> Our Food Items </u> </h1></center>

<div class="row" style="padding:20px; width: 8000px;">

  <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Item 1</h5>
    <h6 class="card-subtitle mb-2 text-muted">6 Days</h6>
    <p class="card-text">Meal will be delivered to you for 6 days. 3 times in a day..</p>
    <!-- <a href="#" class="card-link">Card link</a> -->
    <a href="#" class="card-link">More Info</a>
  </div>
  </div>
  <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Item 2</h5>
    <h6 class="card-subtitle mb-2 text-muted">20 Days</h6>
    <p class="card-text">Meal will be delivered to you for 20 days. 3 times in a day..</p>
    <!-- <a href="#" class="card-link">Card link</a> -->
    <a href="#" class="card-link">More Info</a>
  </div>
  </div>
  <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Item 3</h5>
    <h6 class="card-subtitle mb-2 text-muted">6 Days</h6>
    <p class="card-text">Meal will be delivered to you for 6 days. 3 times in a day..</p>
    <!-- <a href="#" class="card-link">Card link</a> -->
    <a href="#" class="card-link">More Info</a>
  </div>
  </div>
  <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Item 4</h5>
    <h6 class="card-subtitle mb-2 text-muted">6 Days</h6>
    <p class="card-text">Meal will be delivered to you for 6 days. 3 times in a day..</p>
    <!-- <a href="#" class="card-link">Card link</a> -->
    <a href="#" class="card-link">More Info</a>
  </div>
  </div>
  <!--Deleted-->
   <!-- <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Shred & Tone A</h5>
    <h6 class="card-subtitle mb-2 text-muted">6 Days</h6>
    <p class="card-text">Meal will be delivered to you for 6 days. 3 times in a day..</p> -->
    <!-- <a href="#" class="card-link">Card link</a> -->
    <!-- <a href="#" class="card-link">More Info</a>
  </div>
  </div>
   <div class="card" style="width: 18rem;">
  <div class="card-body"> -->
    <!-- <h5 class="card-title">Shred & Tone B</h5>
    <h6 class="card-subtitle mb-2 text-muted">6 Days</h6>
    <p class="card-text">Meal will be delivered to you for 6 days. 3 times in a day..</p> -->
    <!-- <a href="#" class="card-link">Card link</a> -->
    <!-- <a href="#" class="card-link">More Info</a>
  </div>
  </div> -->

</div>

<!--Own added code finished-->


        <div id="sync2" class="owl-carousel owl-theme">


            
            <?php $i=1; ?>
            <?php $__currentLoopData = $getcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item product-tab">
                <img src='<?php echo asset("public/images/category/".$category->image); ?>' alt=""> <?php echo e($category->category_name); ?>

            </div>
            <?php $i++; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div id="sync1" class="owl-carousel owl-theme">
            <?php $i=1; ?>
            <?php $__currentLoopData = $getcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item">
                <div class="tab-pane">
                    <div class="row">
                        
                        <?php $__currentLoopData = $getitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($item->cat_id==$category->id): ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="pro-box">
                                <div class="pro-img">
                                    <a href="<?php echo e(URL::to('product-details/'.$item->id)); ?>">
                                        <img src='<?php echo e($item["itemimage"]->image); ?>' alt="">
                                    </a>
                                    <?php if(Session::get('id')): ?>
                                        <?php if($item->is_favorite == 1): ?>
                                            <i class="fas fa-heart i"></i>
                                        <?php else: ?>
                                            <i class="fal fa-heart i" onclick="MakeFavorite('<?php echo e($item->id); ?>','<?php echo e(Session::get('id')); ?>')"></i>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a class="i" href="<?php echo e(URL::to('/signin')); ?>"><i class="fal fa-heart"></i></a>
                                    <?php endif; ?>
                                </div>
                                <div class="product-details-wrap">
                                    <div class="product-details">
                                        <a href="<?php echo e(URL::to('product-details/'.$item->id)); ?>">
                                            <h4><?php echo e($item->item_name); ?></h4>
                                        </a>
                                        <p class="pro-pricing"><?php echo env('CURRENCY'); ?><?php echo e(number_format($item->item_price, 2)); ?></p>
                                    </div>
                                    <div class="product-details">
                                        <p><?php echo e(Str::limit($item->item_description, 60)); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <a href="<?php echo e(URL::to('product/')); ?>" class="btn">View More</a>
                </div>
            </div>
            <?php $i++; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="about-sec">
    <div class="container">
        <div class="about-box">
            <div class="about-img">
                <img src='<?php echo asset("public/images/about/".$getabout->image); ?>' alt="">
            </div>
            <div class="about-contant">
                <h2 class="sec-head text-left">About Us</h2>
                <p><?php echo \Illuminate\Support\Str::limit(htmlspecialchars($getabout->about_content, ENT_QUOTES, 'UTF-8'), $limit = 500, $end = '...'); ?></p>
            </div>
        </div>
    </div>
</section>

<section class="review-sec">
    <div class="container">
        <h2 class="sec-head">Our Food Review</h2>
        <div class="review-carousel owl-carousel owl-theme">
            <?php $__currentLoopData = $getreview; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item">
                <div class="review-profile">
                    <img src='<?php echo asset("public/images/profile/".$review["users"]->profile_image); ?>' alt="">
                </div>
                <h3><?php echo e($review['users']->name); ?></h3>
                <p><?php echo e($review->comment); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>
</section>

<section class="our-app">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                
                <h2 class="sec-head">Choose the Package that better suits you</h2>
                <br>
                <h3>Confirm your order & pick it up </h3>
                <h5>Enjoy your food on the go!</h5>
            </div>
            <div class="col-lg-6">
               <?php if($getabout->ios != ""): ?>
                    <a href="<?php echo e($getabout->ios); ?>" class="our-app-icon" target="_blank"> 
                       <img src="<?php echo asset('public/front/images/apple-store.svg'); ?>" alt="">
                    </a>
               <?php endif; ?>

                <?php if($getabout->android != ""): ?>
                    <a href="<?php echo e($getabout->android); ?>" class="our-app-icon" target="_blank"> </a> -->
                    <a>    <img src="<?php echo asset('public/front/images/Group 1.png'); ?>" alt="">
                    </a>
                 <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="contact-from">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="sec-head">Contact Us</h2>
                <?php if($getabout->mobile != ""): ?>
                    <a href="tel:<?php echo e($getabout->mobile); ?>" class="contact-box">
                        <i class="fas fa-phone-alt"></i>
                        <p><?php echo e($getabout->mobile); ?></p>
                    </a>
                <?php endif; ?>

                <?php if($getabout->email != ""): ?>
                    <a href="mailto:<?php echo e($getabout->email); ?>" class="contact-box">
                        <i class="fas fa-envelope"></i>
                        <p><?php echo e($getabout->email); ?></p>
                    </a>
                <?php endif; ?>

                <?php if($getabout->address != ""): ?>
                    <div class="contact-box">
                        <i class="fas fa-home"></i>
                        <p><?php echo e($getabout->address); ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-6">
                <form class="contact-form" id="contactform" method="post">
                    <?php echo e(csrf_field()); ?>

                    <input type="text" name="firstname" placeholder="First Name*" id="firstname" required="">
                    <input type="text" name="lastname" placeholder="Last Name*" id="lastname" required="">
                    <input type="email" name="email" placeholder="Email*" id="email" required="">
                    <textarea name="message" placeholder="Message" id="message" required=""></textarea>
                    <button type="button" name="submit" class="btn" onclick="contact()">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\new-xampp\htdocs\app\resources\views/home.blade.php ENDPATH**/ ?>