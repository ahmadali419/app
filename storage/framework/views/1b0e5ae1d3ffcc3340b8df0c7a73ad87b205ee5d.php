
<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<section class="product-prev-sec product-list-sec">
    <div class="container">
        <div class="product-rev-wrap">
            <div class="cat-aside">
                
                <h3 class="text-center">Food Packages</h3>
                <div class="cat-aside-wrap">
                    <?php $__currentLoopData = $getpackages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(URL::to('packages/'.$package->package_id)); ?>" class="cat-check border-top-no <?php if(request()->id == $package->package_id): ?> active <?php endif; ?>">
                        <img src='<?php echo asset("public/images/packages/".$package->image); ?>' alt="">
                        <p><?php echo e($package->package_name); ?></p>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="cat-product">
                <div class="cart-pro-head">
                    <h2 class="sec-head">Our Quality Food</h2>
                    <div class="btn-wrap" data-toggle="buttons">
                        <label id="list" class="btn">
                            <input type="radio" name="layout" id="layout1"> <i class="fas fa-list"></i>
                        </label>
                        <label id="grid" class="btn active">
                            <input type="radio" name="layout" id="layout2" checked> <i class="fas fa-th"></i>
                        </label>
                    </div>
                </div>
                <div class="row">
                    
                    <?php $__currentLoopData = $getpackage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spackage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $flag = 0; ?>
                    <div class="col-xl-4 col-md-6">
                        <div class="pro-box">
                            <div class="pro-img">
                                <a href="<?php echo e(URL::to('package-details/'.$spackage->package_id)); ?>">
                                <img src='<?php echo asset("public/images/packages/".$spackage->image); ?>' alt="">

                                </a>
                                <?php if(Session::get('id')): ?>
                                    <?php if($spackage->is_favorite == 1): ?>
                                        <i class="fas fa-heart i"></i>
                                    <?php else: ?>
                                        <i class="fal fa-heart i" onclick="MakeFavorite('<?php echo e($spackage->package_id); ?>','<?php echo e(Session::get('id')); ?>')"></i>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div> 
                            <div class="product-details-wrap">
                                <div class="product-details">
                                    <a href="<?php echo e(URL::to('package-details/'.$spackage->package_id)); ?>">
                                        <h4><?php echo e($spackage->package_name); ?></h4>
                                    </a>
                                    <p class="pro-pricing"><?php echo env('CURRENCY'); ?><?php echo e(number_format($spackage->package_amount, 2)); ?></p>
                                </div>
                                <div class="product-details">
                                        <?php $Date =date('Y-m-d'); ?>
                                    <p><?php echo e(Str::limit($spackage->package_description, 60)); ?></p>
                                   
                                    <a class="btn" href="<?php echo e(URL::to('package-details/'.$spackage->package_id)); ?>">View More</a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
               
            </div>
        </div>
    </div>
</section>

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\new-xampp\htdocs\app\resources\views/front/packages.blade.php ENDPATH**/ ?>