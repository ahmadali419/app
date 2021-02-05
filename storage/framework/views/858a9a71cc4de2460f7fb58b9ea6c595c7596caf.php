<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>User Name</th>
            <th>Order Number</th>
            <th>Address</th>
            <th>Payment Type</th>
            <th>Payment ID</th>
            <th>Order Type</th>
            <th>Order Status</th>
            <th>Order Assigned To</th>
            <th>Created at</th>
            <th>Change Order Status</th>
            <th>Date</th>
            <!-- <th>Action</th> -->
            <!-- <th>Delivery Time</th> -->
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($getorders as $orders) {
        ?>
        <tr id="dataid<?php echo e($orders->id); ?>">
            <td><?php echo e($i); ?></td>
            <td><?php echo e($orders['users']->name); ?></td>
            <td><?php echo e($orders->order_number); ?></td>
            <td><?php echo e($orders->address); ?></td>
            <td>
                <?php if($orders->payment_type =='0'): ?>
                      COD
                <?php else: ?>
                      Online
                <?php endif; ?>
            </td>
            <td>
                <?php if($orders->razorpay_payment_id == ''): ?>
                    --
                <?php else: ?>
                    <?php echo e($orders->razorpay_payment_id); ?>

                <?php endif; ?>
            </td>
            <td>
                <?php if($orders->order_type == 1): ?>
                    Delivery
                <?php else: ?>
                    Pickup
                <?php endif; ?>
            </td>
            <td>
                <?php if($orders->status == '1'): ?>
                    Order Received
                <?php elseif($orders->status == '2'): ?>
                    On the way
                <?php elseif($orders->status == '3'): ?>
                    Assigned to Driver
                <?php elseif($orders->status == '4'): ?>
                    Delivered
                <?php else: ?>
                    Cancelled
                <?php endif; ?>
            </td>
            <td>
                <?php if($orders->name == ""): ?>
                    --
                <?php else: ?>
                    <?php echo e($orders->name); ?>

                <?php endif; ?>
            </td>
            <td><?php echo e($orders->created_at); ?></td>
            <td>
                <?php if($orders->status == '1'): ?>
                    <a ddata-toggle="tooltip" data-placement="top" onclick="StatusUpdate('<?php echo e($orders->id); ?>','2')" title="" data-original-title="Order Received">
                        <span class="badge badge-secondary px-2" style="color: #fff;">Order Received</span>
                    </a>
                <?php elseif($orders->status == '2'): ?>
                    <?php if($orders->order_type == '2'): ?>
                        <a class="badge badge-primary px-2" onclick="StatusUpdate('<?php echo e($orders->id); ?>','4')" style="color: #fff;">Pickup</a>
                    <?php else: ?>
                        <a class="open-AddBookDialog badge badge-primary px-2" data-toggle="modal" data-id="<?php echo e($orders->id); ?>" data-target="#myModal" style="color: #fff;">Assign To Driver</a>
                    <?php endif; ?>
                <?php elseif($orders->status == '3'): ?>
                    <a ddata-toggle="tooltip" data-placement="top" title="" data-original-title="Out for Delivery">
                        <span class="badge badge-success px-2" style="color: #fff;">Assigned to Driver</span>
                    </a>
                <?php elseif($orders->status == '4'): ?>
                    <a ddata-toggle="tooltip" data-placement="top" title="" data-original-title="Out for Delivery">
                        <span class="badge badge-success px-2" style="color: #fff;">Delivered</span>
                    </a>
                <?php else: ?>
                    <span class="badge badge-danger px-2">Cancelled</span>
                <?php endif; ?>
            </td>
            <td><?php echo e($orders->delivery_time); ?></td>
            <td>
                <!-- <span>
                    <a data-toggle="tooltip" href="<?php echo e(URL::to('admin/invoice/'.$orders->id)); ?>" data-original-title="View">
                        <span class="badge badge-warning">View Order Detail</span>
                    </a>
                </span> -->
            </td>
        </tr>
        <?php
        $i++;
        }
        ?>
    </tbody>
</table><?php /**PATH D:\new-xampp\htdocs\app\resources\views/theme/orderstable.blade.php ENDPATH**/ ?>