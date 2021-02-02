<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>Profile Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Created at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $getdriver; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr id="dataid<?php echo e($driver->id); ?>">
            <td><?php echo e($driver->id); ?></td>
            <td><img src='<?php echo asset("public/images/profile/".$driver->profile_image); ?>' style="width: 100px;"></td>
            <td><?php echo e($driver->name); ?></td>
            <td><?php echo e($driver->email); ?></td>
            <td><?php echo e($driver->mobile); ?></td>
            <td><?php echo e($driver->created_at); ?></td>
            <td>
                <a href="#" data-toggle="tooltip" data-placement="top" onclick="GetData('<?php echo e($driver->id); ?>')" title="" data-original-title="Edit">
                    <span class="badge badge-success">Edit</span>
                </a>
                <?php if($driver->is_available == '1'): ?>
                    <a class="badge badge-info px-2" onclick="StatusUpdate('<?php echo e($driver->id); ?>','2')" style="color: #fff;">Block</a>
                <?php else: ?>
                    <a class="badge badge-primary px-2" onclick="StatusUpdate('<?php echo e($driver->id); ?>','1')" style="color: #fff;">Unblock</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table><?php /**PATH /home/ab0ve3twa7yy/public_html/healthyandyummy.digitaltechs.co/resources/views/theme/drivertable.blade.php ENDPATH**/ ?>