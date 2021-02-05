<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="list-of-packages">
    <h3>Packages</h3>
    <?php $__currentLoopData = $getpackage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                    <a href="<?php echo e(URL::to('packages/'.$package->package_id)); ?>" class=" <?php if(request()->id == $package->package_id): ?> active <?php endif; ?>">
                       
                        <?php echo e($package->package_name); ?>

                    </a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

<section class="banner-sec">
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
</section>

<section class="product-prev-sec">
    <div class="container">
        <h2 class="sec-head">Subcribe Packages</h2>
        <div id="sync2" class="owl-carousel owl-theme">
            <?php $i=1; ?>
            <?php $__currentLoopData = $getpackage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item product-tab">
            <img src='<?php echo asset("public/images/slider/".$slider->image); ?>' alt=""> <?php echo e($package->package_name); ?>

            </div>
            <?php $i++; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div id="sync1" class="owl-carousel owl-theme">
            <?php $i=1; ?>
            <?php $__currentLoopData = $getpackage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item">
                <div class="tab-pane">
                    <div class="row">
                   
                       
                  
                        <div class="col-lg-4 col-md-6">
                            <div class="pro-box">
                                <div class="pro-img">
                                    <a href="<?php echo e(URL::to('package-details/'.$package->package_id)); ?>">
                                    <img src='<?php echo asset("public/images/slider/".$slider->image); ?>' alt="">
                                    </a>
                                  
                                </div>
                                <div class="product-details-wrap">
                                    <div class="product-details">
                                        <a href="<?php echo e(URL::to('package-details/'.$package->package_id)); ?>">
                                            <h4><?php echo e($package->package_name); ?></h4>
                                        </a>
                                        <p class="pro-pricing"><?php echo env('CURRENCY'); ?><?php echo e(number_format($package->package_amount, 2)); ?></p>
                                    </div>
                                    <div class="product-details">
                                        <p><?php echo e(Str::limit($package->package_description, 60)); ?></p>
                                    </div>
                                    <div class="float-right">
                                    <a class="btn btn-success btn-sm mt-3" href="<?php echo e(URL::to('package-details/'.$package->package_id)); ?>">View More</a>
                                      <!-- <button class="btn btn-success btn-sm mt-3" >Subscribe</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <a href="<?php echo e(URL::to('packages/'.$package->package_id)); ?>" class="btn">View More</a>
                </div>
            </div>
            <?php $i++; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<section class="product-prev-sec">
    <div class="container">
        <h2 class="sec-head">Food Items</h2>
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
                        <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
              <!--  <?php if($getabout->ios != ""): ?>
                    <a href="<?php echo e($getabout->ios); ?>" class="our-app-icon" target="_blank"> 
                       <img src="<?php echo asset('public/front/images/apple-store.svg'); ?>" alt="">
                    </a>
               <?php endif; ?>

                <?php if($getabout->android != ""): ?>
                    <a href="<?php echo e($getabout->android); ?>" class="our-app-icon" target="_blank"> </a> -->
                    <a>    <img src="<?php echo asset('public/front/images/Group 1.png'); ?>" alt="">
                    </a>
                <!-- <?php endif; ?> -->
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

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\new-xampp\htdocs\app\resources\views/front/home.blade.php ENDPATH**/ ?>