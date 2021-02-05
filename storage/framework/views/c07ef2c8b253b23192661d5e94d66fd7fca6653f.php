<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>>
<?php if(Session::has('success')): ?>
    <div class="alert alert-success"> <?php echo e(Session::get('success')); ?></div>
<?php endif; ?>
<section class="favourite">
    <div class="container">
        <h2 class="sec-head">My Orders</h2>
        <div class="row">
            <?php if(count($orderdata) == 0): ?>
                <p>No Data found</p>
            <?php else: ?> 
                <?php $__currentLoopData = $orderdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4">
                    <a href="#" class="order-box">
                        <div class="order-box-no">
                            <?php echo e($orders->date); ?>

                            <h4>Order Number : <span><?php echo e($orders->order_number); ?></span></h4>
                            <p class="order-qty">QTY : <span><?php echo e($orders->qty); ?></span></p>
                            <?php if($orders->status == 1): ?>
                                <p class="order-status">Order Status : <span>Order Placed</span></p>
                            <?php elseif($orders->status == 2): ?>
                                <p class="order-status">Order Status : <span>Order Ready</span></p>
                            <?php elseif($orders->status == 3): ?>
                                <p class="order-status">Order Status : <span>Order on the way</span></p>
                            <?php else: ?>
                                <p class="order-status">Order Status : <span>Order Delivered</span></p>
                            <?php endif; ?>
                        </div>
                        <div class="order-box-price">
                            <h5><?php echo env('CURRENCY'); ?><?php echo e(number_format($orders->package_amount, 2)); ?></h5>
                            <?php if($orders->payment_type == 1): ?>
                                <p>Razorpay</p>
                            <?php elseif($orders->payment_type == 2): ?>
                                <p>Stripe</p>
                            <?php else: ?>
                                <p>COD</p>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
        <?php echo $orderdata->links(); ?>

    </div>
</section>

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\new-xampp\htdocs\app\resources\views/front/orders.blade.php ENDPATH**/ ?>