<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>User Details</th>
            <th>Order Details</th>
            <th>Validity Time Period</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <td><?php echo e($request->id); ?></td>
         <td><?php echo e($request->name); ?><br><?php echo e($request->email); ?><br><?php echo e($request->mobile); ?></td>
         <td><?php echo e($request->item_name); ?><br><?php echo e($request->item_description); ?><br> KD <?php echo e($request->item_price); ?></td>
         <td><?php echo e($request->delivery_time); ?></td>
         <td><p>
             <a type="btn" class="btn btn-success btn-sm btn-rounded" href="/admin/subscription_requests/approve/<?php echo e($request->id); ?>">Approved</a>
             <a type="btn" class="btn btn-danger btn-sm btn-rounded" href="">Decline</a>
         </p></td>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table><?php /**PATH D:\new-xampp\htdocs\app\resources\views/theme/SubscriptionRequestsTable.blade.php ENDPATH**/ ?>