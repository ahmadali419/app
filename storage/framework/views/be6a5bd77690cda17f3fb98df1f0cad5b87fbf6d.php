<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="product-details-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="product-details-img owl-carousel owl-theme">
                    <?php $__currentLoopData = $getimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <a data-fancybox="gallery" href="<?php echo e($images->image); ?>">
                            <img src='<?php echo e($images->image); ?>' alt="">
                        </a>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="col-lg-7 pro-details-display">
                <div class="pro-details-name-wrap">
                    <h3 class="sec-head mt-0"><?php echo e($getitem->item_name); ?></h3>
                    <input type="hidden" name="price" id="price" value="<?php echo e($getitem->item_price); ?>">
                    <?php if(Session::get('id')): ?>
                        <?php if($getitem->is_favorite == 1): ?>
                            <i class="fas fa-heart i"></i>
                        <?php else: ?>
                            <i class="fal fa-heart i" onclick="MakeFavorite('<?php echo e($getitem->id); ?>','<?php echo e(Session::get('id')); ?>')"></i>
                        <?php endif; ?>
                    <?php else: ?>
                        <a class="i" href="<?php echo e(URL::to('/signin')); ?>"><i class="fal fa-heart i"></i></a>
                    <?php endif; ?>
                </div>
                <small><?php echo e($getitem['category']->category_name); ?></small>
                <div class="extra-food-wrap">
                    <?php if(count($freeaddons) == 0 && count($paidaddons) == 0): ?>
                        No Addons found
                    <?php endif; ?>
                    <?php if(count($freeaddons) != 0): ?>
                        <ul class="list-unstyled extra-food">
                            <?php if($freeaddons != ""): ?>
                                <h3>Free Addons</h3>
                                <?php $__currentLoopData = $freeaddons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addons): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <input type="checkbox" name="addons[]" class="Checkbox" value="<?php echo e($addons->id); ?>" price="<?php echo e($addons->price); ?>">
                                    <p><?php echo e($addons->name); ?></p>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>

                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>
                    <?php if(count($paidaddons) != 0): ?>
                        <ul class="list-unstyled extra-food">
                            <h3>Paid Addons</h3>
                            <div id="pricelist">
                            <?php $__currentLoopData = $paidaddons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addons): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <input type="checkbox" name="addons[]" class="Checkbox" value="<?php echo e($addons->id); ?>" price="<?php echo e($addons->price); ?>">
                                <p><?php echo e($addons->name); ?> : <?php echo env('CURRENCY'); ?><?php echo e(number_format($addons->price, 2)); ?></p>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </ul>
                    <?php endif; ?>

                    <div class="pro-details-add-wrap">
                        <p class="pricing"><?php echo env('CURRENCY'); ?><?php echo e(number_format($getitem->item_price, 2)); ?></p>
                        <p class="open-time"><i class="far fa-clock"></i> <?php echo e($getitem->delivery_time); ?></p>
                        <?php if(Session::get('id')): ?>
                            <?php if($getitem->item_status == '1'): ?>
                                <button class="btn" onclick="AddtoCart('<?php echo e($getitem->id); ?>','<?php echo e(Session::get('id')); ?>')">Add to Cart</button>
                            <?php else: ?> 
                                <button class="btn" disabled="">Item currently unavailable</button>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if($getitem->item_status == '1'): ?>
                                <a class="btn" href="<?php echo e(URL::to('/signin')); ?>">Add to Cart</a>
                            <?php else: ?> 
                                <button class="btn" disabled="">Item currently unavailable</button>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <textarea id="item_notes" name="item_notes" placeholder="Write Notes..."></textarea>
            </div>
            <div class="col-12">
                <h4 class="sec-head">Details</h4>
                <p><?php echo e($getitem->item_description); ?></p>

                <?php if($getingredients != ""): ?>
                <h4 class="sec-head">Ingredients</h4>
                    <div class="ingredients-carousel owl-carousel owl-theme">
                        <?php $__currentLoopData = $getingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredients): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item">
                            <div class="ingredients-box">
                                <img src='<?php echo e($ingredients->image); ?>' alt="">
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <p class="no-data">No Data Ingredients</p>
                <?php endif; ?>
            </div>
            <div class="col-12">
                <h2 class="sec-head text-center">Related Food</h2>
                <div class="pro-ref-carousel owl-carousel owl-theme">
                    <?php $__currentLoopData = $relatedproduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <div class="pro-box">
                            <div class="pro-img">
                                <a href="<?php echo e(URL::to('product-details/'.$item->id)); ?>">
                                    <img src='<?php echo e($item["itemimage"]->image); ?>' alt="">
                                </a>
                                <?php if(Session::get('id')): ?>
                                    <?php if($item->is_favorite == 1): ?>
                                        <i class="fas fa-heart i"></i>
                                    <?php else: ?>
                                        <i class="fal fa-heart i"  onclick="MakeFavorite('<?php echo e($item->id); ?>','<?php echo e(Session::get('id')); ?>')"></i>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <a href="<?php echo e(URL::to('/signin')); ?>"><i class="fal fa-heart i"></i></a>
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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>
        </div>
    </div>
</section>

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script type="text/javascript">
var total = parseInt($("#price").val()); 

$('input[type="checkbox"]').change(function() {
    if($(this).is(':checked')){
        total += parseFloat($(this).attr('price')) || 0;
    }
    else{
        total -= parseFloat($(this).attr('price')) || 0;
    }
$('p.pricing').text('$'+total.toFixed(2));
$('#price').val(total.toFixed(2));
})

</script><?php /**PATH /home/ab0ve3twa7yy/public_html/healthyandyummy.digitaltechs.co/resources/views/front/product-details.blade.php ENDPATH**/ ?>