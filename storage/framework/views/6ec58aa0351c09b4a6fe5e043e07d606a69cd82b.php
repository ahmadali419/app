
<style type="text/css">
    @media    print {
      @page    { margin: 0; }
      body { margin: 1.6cm; }
    }
</style>
<?php $__env->startSection('content'); ?>
<!-- row -->

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/admin/home')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Invoice</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <!-- End Row -->
    <div class="card" id="printDiv">
        <div class="card-header">
            Invoice
            <strong><?php echo e($getusers->order_number); ?></strong> 
            <span class="float-right"> <strong>Status:</strong> 
                <?php if($getusers->status == '1'): ?>
                    Order Received
                <?php elseif($getusers->status == '2'): ?>
                    On the way
                <?php elseif($getusers->status == '3'): ?>
                    Delivered
                <?php else: ?>
                    Cancelled
                <?php endif; ?>
            </span>

        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-sm-8">
                    <h6 class="mb-3">To:</h6>
                    <div>
                        <strong><?php echo e($getusers['users']->name); ?></strong>
                    </div>
                    <div><?php echo e($getusers->address); ?></div>
                    <div>Email: <?php echo e($getusers['users']->email); ?></div>
                    <div>Phone: <?php echo e($getusers['users']->mobile); ?></div>
                </div>


                <?php if($getusers->order_notes !=""): ?>
                <div class="col-sm-4">
                    <h6 class="mb-3">Order Note:</h6>
                    <div><?php echo e($getusers->order_notes); ?></div>
                </div>
                <?php endif; ?>

            </div>

            <div class="table-responsive-sm">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="center">#</th>
                            <th>Item</th>
                            <th class="right">Unit Cost</th>
                            <th class="center">Qty</th>
                            <th class="right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        foreach ($getorders as $orders) {
                        ?>
                        <tr>
                            <td class="center"><?php echo e($i); ?></td>
                            <td class="left strong">
                                <?php echo e($orders->item_name); ?>

                                <?php $__currentLoopData = $orders['addons']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addons): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="cart-addons-wrap">
                                    <div class="cart-addons">
                                        <b><?php echo e($addons['name']); ?></b> : <?php echo env('CURRENCY'); ?><?php echo e(number_format($addons['price'], 2)); ?>

                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php if($orders->item_notes != ""): ?>
                                    <b>Item Notes</b> : <?php echo e($orders->item_notes); ?>

                                <?php endif; ?>
                            </td>
                            <td class="left"><?php echo env('CURRENCY').''.number_format($orders->item_price, 2); ?></td>
                            <td class="center"><?php echo e($orders->qty); ?></td>
                            <td class="right"><?php echo env('CURRENCY'); ?><?php echo e(number_format($orders->total_price, 2)); ?></td>
                        </tr>
                        <?php
                            $data[] = array(
                                "total_price" => $orders->total_price
                            );
                        ?>
                        <?php
                        $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-5">

                </div>

                <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                        <tbody>
                            <tr>
                                <td class="left">
                                    <strong>Tax</strong> (<?php echo e($getusers->tax); ?>%)
                                </td>
                                <td class="right">
                                    <strong><?php echo env('CURRENCY').''.number_format($getusers->tax_amount, 2); ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>Delivery Charge</strong>
                                </td>
                                <td class="right">
                                    <strong><?php echo env('CURRENCY').''.number_format($getusers->delivery_charge, 2); ?></strong>
                                </td>
                            </tr>
                            <?php if($getusers->discount_amount != 0): ?>
                            <tr>
                                <td class="left">
                                    <strong>Discount</strong> (<?php echo e($getusers->promocode); ?>)
                                </td>
                                <td class="right">
                                    <strong><?php echo env('CURRENCY').''.number_format($getusers->discount_amount, 2); ?></strong>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <td class="left">
                                    <strong>Total</strong>
                                </td>
                                <td class="right">
                                    <strong><?php echo env('CURRENCY').''.number_format($getusers->order_total, 2); ?></strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </div>
    <!-- End Row -->
    <button type="button" class="btn btn-primary float-right" id="doPrint">
        <i class="fa fa-print" aria-hidden="true"></i> Print
    </button>
</div>
<!-- #/ container -->

<!-- #/ container -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    document.getElementById("doPrint").addEventListener("click", function() {
         var printContents = document.getElementById('printDiv').innerHTML;
         var originalContents = document.body.innerHTML;
         document.body.innerHTML = printContents;
         window.print();
         document.body.innerHTML = originalContents;
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('theme.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\new-xampp\htdocs\app\resources\views/invoice.blade.php ENDPATH**/ ?>