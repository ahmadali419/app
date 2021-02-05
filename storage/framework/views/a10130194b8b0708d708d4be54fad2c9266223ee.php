<?php echo $__env->make('front.theme.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="product-details-sec">
    <div class="container">
        <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $flag = 0; ?>
       <div class="row">
           <div class="col-md-12">
           <h3 class=" mb-4"><?php echo e(ucfirst($detail->package_name)); ?></h3>
           </div>
       </div>
        <div class="row">
            <div class="col-md-4">
            <a href="<?php echo e(URL::to('package-details/'.$detail->package_id)); ?>" class="mb-5 pb-5">
                                <img src='<?php echo asset("public/images/packages/".$detail->image); ?>' alt="">

                                </a>
                               <div class="mt-4">
                               <span class="mt-5">
                                 <?php echo e($detail->package_description); ?>

                                </span>
                                 <span class="float-right">Package Validity: <b><?php echo e($detail->package_validity); ?> days</b></span>
                               </div>
                                 <div class="row mt-4">
                                     <div class="col-md-12">
                                      <p class="pro-pricing"><?php echo env('CURRENCY'); ?>Package Amount: <span id="price"><?php echo e(number_format($detail->package_amount, 2)); ?></span></p>
                                     </div>
                                 </div>
            </div>
            <div class="col-md-8">
              <h3 class="text-center mb-3">Food Information</h3>
            <?php $__currentLoopData = $detail->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                  <div class="col-md-3 mb-3">
                  <div class="row">
                      <div class="col-2">
                      <span class="">   <input type="checkbox" name="foodItem[]" class="Checkbox" value="<?php echo e($category->category_id); ?>"></span>
                      </div>
                 
               
               
                             <div class="col-8">
                             
                             <span class="float-right">
                              <img src='<?php echo asset("public/images/packages/".$category->item_image); ?>' alt="">
                              </span>
                             </div>

                     </div>        
                  </div>
                  <div class="col-md-6">
                   <span><b><?php echo e(ucfirst($category->food_name)); ?></b></span>
                   <span class="float-right"><?php echo e($category->food_description); ?></span>
            </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
           
        </div>
        <textarea id="item_notes" name="item_notes" placeholder="Write Notes..."></textarea>
        <div class="product-details">
                                        <?php $Date =date('Y-m-d'); ?>
                                 
                                    <?php $__currentLoopData = $subsRequest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <?php if(Session::get('id')): ?>
                                    
                                        <?php if($request->action == 0 && $request->product_id == $detail->package_id): ?>    
                                        <?php $flag = 1; ?>
                                        <button class="btn" disabled>Subscribe Request Pending</button>
                                        
                                        <?php elseif($request->action == 1 && $request->product_id == $detail->package_id  && $request->end_date >= $Date): ?>
                                        <?php $flag = 1; ?>
                                        <?php //echo $Date.'End date'.$request->end_date;?>
                                        <button class="btn"  onclick="AddtoCart('<?php echo e($detail->package_id); ?>','<?php echo e(Session::get('id')); ?>')">Add to Cart</button>
                                        
                                        <?php elseif($request->action == 2 && $request->product_id == $detail->package_id): ?>
                                        <?php $flag = 1; ?>
                                        <p class="label label-danger"><small>*Your Subscription request has been decline.</small></p>
                                        <a class="btn" disable href="<?php echo e(URL::to('/package/subscribe')); ?>/<?php echo e($detail->id); ?>/<?php echo e($detail->package_validity); ?>">Subscribe Again</a>
                                        
                                        <?php elseif($request->product_id == $detail->id && $request->action == 3): ?>
                                        <?php $flag = 1; ?>
                                       <a href="<?php echo e(URL::to('/package/subscribe')); ?>/<?php echo e($detail->package_id); ?>/<?php echo e($detail->package_validity); ?>">Subscribe</a>
                                        
                                        <?php elseif($request->action == 1 && $request->product_id == $detail->package_id && $request->end_date < $Date): ?>
                                        <?php $flag = 1; ?>
                                       <a class="btn btn-success" href="<?php echo e(URL::to('/package/subscribe')); ?>/<?php echo e($detail->package_id); ?>/<?php echo e($detail->package_validity); ?>">Subscribe Again</a>
                                        <?php endif; ?>
                                        
                                    <?php else: ?>
                                        <a class="btn" href="<?php echo e(URL::to('/signin')); ?>">Subscribe</a>
                                    <?php endif; ?> 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <?php if($flag == 0): ?>
                                    <a class="btn" href="<?php echo e(URL::to('/package/subscribe')); ?>/<?php echo e($detail->package_id); ?>/<?php echo e($detail->package_validity); ?>">Subscribe</a>
                                    <?php endif; ?>
                                </div>  
          
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="row">
        <div class="col-md-2">
     <span>
   
        </div>
        </div>
    </div>
    </div>
</section>

<?php echo $__env->make('front.theme.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script type="text/javascript">
var total = parseInt($("#price").val());

$('input[type="checkbox"]').change(function() {
    if ($(this).is(':checked')) {
        total += parseFloat($(this).attr('price')) || 0;
    } else {
        total -= parseFloat($(this).attr('price')) || 0;
    }
    $('p.pricing').text('$' + total.toFixed(2));
    $('#price').val(total.toFixed(2));
})
</script><?php /**PATH D:\new-xampp\htdocs\app\resources\views/front/package-details.blade.php ENDPATH**/ ?>