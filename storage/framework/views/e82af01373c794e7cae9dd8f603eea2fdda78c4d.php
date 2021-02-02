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
        <?php
        foreach ($getusers as $users) {
        ?>
        <tr id="dataid<?php echo e($users->id); ?>">
            <td><?php echo e($users->id); ?></td>
            <td><img src='<?php echo asset("public/images/profile/".$users->profile_image); ?>' style="width: 100px;"></td>
            <td><?php echo e($users->name); ?></td>
            <td><?php echo e($users->email); ?></td>
            <td><?php echo e($users->mobile); ?></td>
            <td><?php echo e($users->created_at); ?></td>
            <td>
                <?php if($users->is_available == '1'): ?>
                    <a class="badge badge-info px-2" onclick="StatusUpdate('<?php echo e($users->id); ?>','2')" style="color: #fff;">Block</a>
                <?php else: ?>
                    <a class="badge badge-primary px-2" onclick="StatusUpdate('<?php echo e($users->id); ?>','1')" style="color: #fff;">Unblock</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table><?php /**PATH D:\new-xampp\htdocs\app\resources\views/theme/userstable.blade.php ENDPATH**/ ?>