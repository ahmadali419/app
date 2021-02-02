<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="product-prev-sec product-list-sec">
    <div class="container">
        <div class="product-rev-wrap">
            <div class="cat-aside">
                
                <h3 class="text-center">Food Category</h3>
                <div class="cat-aside-wrap">
                    <?php $__currentLoopData = $getcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(URL::to('/product/'.$category->id)); ?>" class="cat-check border-top-no <?php if(request()->id == $category->id): ?> active <?php endif; ?>">
                        <img src='<?php echo asset("public/images/category/".$category->image); ?>' alt="">
                        <p><?php echo e($category->category_name); ?></p>
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
                    
                    <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $flag = 0; ?>
                    <div class="col-xl-4 col-md-6">
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
                                    <?php $__currentLoopData = $subsRequest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                     <?php if(Session::get('id')): ?>
                                        
                                        
                                        <?php if($request->action == 0 && $request->product_id == $item->id): ?>    
                                        <?php $flag = 1; ?>
                                        <button class="btn" disabled>Subscribe Request Pending</button>
                                        
                                        <?php elseif($request->action == 1 && $request->product_id == $item->id): ?>
                                        <?php $flag = 1; ?>
                                        <a class="btn" href="<?php echo e(URL::to('/cart')); ?>">Check Out</a>
                                        
                                        <?php elseif($request->action == 2 && $request->product_id == $item->id): ?>
                                        <?php $flag = 1; ?>
                                        <p class="label label-danger"><small>*Your Subscription request has been decline.</small></p>
                                        <a class="btn" disable href="<?php echo e(URL::to('/product/subscribe')); ?>/<?php echo e($item->id); ?>">Subscribe Again</a>
                                        
                                        <?php elseif($request->product_id == $item->id && $request->action == 3): ?>
                                        <?php $flag = 1; ?>
                                       <a href="<?php echo e(URL::to('/product/subscribe')); ?>/<?php echo e($item->id); ?>">Subscribe</a>
                                        <?php endif; ?>
                                        
                                    <?php else: ?>
                                        <a class="btn" href="<?php echo e(URL::to('/signin')); ?>">Subscribe</a>
                                    <?php endif; ?> 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($flag == 0): ?>
                                    <a class="btn" href="<?php echo e(URL::to('/product/subscribe')); ?>/<?php echo e($item->id); ?>">Subscribe</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php echo $getitem->links(); ?>

            </div>
        </div>
    </div>
</section>

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ab0ve3twa7yy/public_html/healthyandyummy.digitaltechs.co/resources/views/front/product.blade.php ENDPATH**/ ?>