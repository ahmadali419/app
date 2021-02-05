<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>>

<section class="order-details">
    <div class="container">
        <h2 class="sec-head">Order Details</h2>
        <p>(<?php echo e($summery['order_number']); ?> - <?php echo e($summery['created_at']); ?>)</p>
        <?php if($summery['order_type'] == 1): ?>
            <?php if($summery['status'] == 1): ?>
                <ul class="progressbar">
                    <li class="active">Order Placed</li>
                    <li>Order Ready</li>
                    <li>Order on the way</li>
                    <li>Order Delivered</li>
                </ul>
            <?php elseif($summery['status'] == 2): ?>
                <ul class="progressbar">
                    <li class="active">Order Placed</li>
                    <li class="active">Order Ready</li>
                    <li>Order on the way</li>
                    <li>Order Delivered</li>
                </ul>
            <?php elseif($summery['status'] == 3): ?>
                <ul class="progressbar">
                    <li class="active">Order Placed</li>
                    <li class="active">Order Ready</li>
                    <li class="active">Order on the way</li>
                    <li>Order Delivered</li>
                </ul>
            <?php elseif($summery['status'] == 4): ?>
                <ul class="progressbar">
                    <li class="active">Order Placed</li>
                    <li class="active">Order Ready</li>
                    <li class="active">Order on the way</li>
                    <li class="active">Order Delivered</li>
                </ul>
            <?php endif; ?>
        <?php else: ?>
            <?php if($summery['status'] == 1): ?>
                <ul class="progressbar" style="text-align: center;">
                    <li class="active">Order Placed</li>
                    <li>Order Ready</li>
                    <li>Order Delivered</li>
                </ul>
            <?php elseif($summery['status'] == 2): ?>
                <ul class="progressbar" style="text-align: center;">
                    <li class="active">Order Placed</li>
                    <li class="active">Order Ready</li>
                    <li>Order Delivered</li>
                </ul>
            <?php elseif($summery['status'] == 4): ?>
                <ul class="progressbar" style="text-align: center;">
                    <li class="active">Order Placed</li>
                    <li class="active">Order Ready</li>
                    <li class="active">Order Delivered</li>
                </ul>
            <?php endif; ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-8">
                <?php $__currentLoopData = $orderdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="order-details-box">
                    <div class="order-details-img">
                        <img src='<?php echo e($orders["itemimage"]->image); ?>' alt="">
                    </div>
                    <div class="order-details-name">
                        <a href="javascript:void(0)">
                            <a href="<?php echo e(URL::to('product-details/'.$orders->id)); ?>">
                                <h3><?php echo e($orders->item_name); ?> <span><?php echo env('CURRENCY'); ?><?php echo e(number_format($orders->total_price, 2)); ?></span></h3>
                            </a>
                        </a>
                        <p>QTY : <?php echo e($orders->qty); ?></p>

                        <?php $__currentLoopData = $orders['addons']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addons): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="cart-addons-wrap">
                            <div class="cart-addons">
                                <b><?php echo e($addons['name']); ?></b> : <?php echo env('CURRENCY'); ?><?php echo e(number_format($addons['price'], 2)); ?>

                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($orders->item_notes != ""): ?>
                            <p class="cart-pro-note"><?php echo e($orders->item_notes); ?></p>
                        <?php endif; ?>
                        
                    </div>
                </div>
                <?php
                    $data[] = array(
                        "total_price" => $orders->total_price
                    );
                ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="order-details-box">
                <h2 class="sec-head">Order Place</h2>
                </div>
                
            </div>
            <div class="col-lg-4">
                <div class="order-payment-summary">
                    <h3>Payment Summary</h3>
                    <p>Order Total <span><?php echo env('CURRENCY'); ?><?php echo e(number_format(array_sum(array_column(@$data, 'total_price')), 2)); ?></span></p>
                    
                    <p>Tax (<?php echo e($summery['tax']); ?>%) <span><?php echo env('CURRENCY'); ?><?php echo e(number_format($summery['tax_amount'], 2)); ?></span></p>

                    <?php if($summery['delivery_charge'] != "0"): ?>
                    
                    <p>Delivery charge <span><?php echo env('CURRENCY'); ?><?php echo e(number_format(@$summery['delivery_charge'], 2)); ?></span></p>

                    <?php endif; ?>

                    <?php if($summery['promocode'] !=""): ?>
                    <p>Discount (<?php echo e($summery['promocode']); ?>) <span>- <?php echo env('CURRENCY'); ?><?php echo e(number_format($summery['discount_amount'], 2)); ?></span></p>
                    <?php endif; ?>
                    <?php
                    $a = array_sum(array_column(@$data, 'total_price'));
                    $b = array_sum(array_column(@$data, 'total_price'))*$summery['tax']/100;
                    $c = $summery['delivery_charge'];
                    $d = $summery['discount_amount'];
                    
                    if ($d == "NaN") {
                        $total = $a+$b+$c;
                    } else {
                        $total = $a+$b+$c-$d;
                    }
                    
                    ?>
                    <p class="order-details-total">Total Amount <span><?php echo env('CURRENCY'); ?><?php echo e(number_format($total, 2)); ?></span></p>
                </div>

                <?php if($summery['driver_name'] != ""): ?>
                
                    <div class="order-add">
                        <h6>Driver Information</h6>
                            <div class="order-details-img">
                                <img src='<?php echo e($summery["driver_profile_image"]); ?>' alt="">
                            </div>
                        <p class="mt-3"><?php echo e($summery['driver_name']); ?></p>
                        <p>
                            <a href="tel:<?php echo e($summery['driver_mobile']); ?>"> <?php echo e($summery['driver_mobile']); ?></a>
                        </p>
                    </div>

                <?php endif; ?>

                <?php if($summery['order_type'] == 1): ?>
                
                    <div class="order-add">
                        <h6>Delivery Address</h6>
                        <p><?php echo e($summery['address']); ?></p>
                        <h6>Door / Flat no.</h6>
                        <p><?php echo e($summery['building']); ?></p>
                        <h6>Landmark</h6>
                        <p><?php echo e($summery['landmark']); ?></p>
                        <h6>Pincode</h6>
                        <p><?php echo e($summery['pincode']); ?></p>
                    </div>

                <?php endif; ?>
                
                <?php if($summery['order_notes'] !=""): ?>
                <div class="order-add">
                    <h6>Notes</h6>
                    <p><?php echo e($summery['order_notes']); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\new-xampp\htdocs\app\resources\views/front/order-details.blade.php ENDPATH**/ ?>