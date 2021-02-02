<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>Pincode</th>
            <th>Created at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($getpincode as $pincode) {
        ?>
        <tr id="dataid<?php echo e($pincode->id); ?>">
            <td><?php echo e($pincode->id); ?></td>
            <td><?php echo e($pincode->pincode); ?></td>
            <td><?php echo e($pincode->created_at); ?></td>
            <td>
                <span>
                    <a href="#" data-toggle="tooltip" data-placement="top" onclick="GetData('<?php echo e($pincode->id); ?>')" title="" data-original-title="Edit">
                        <span class="badge badge-success">Edit</span>
                    </a>
                    <a href="#" data-toggle="tooltip" data-placement="top" onclick="DeleteData('<?php echo e($pincode->id); ?>')" title="" data-original-title="Delete">
                        <span class="badge badge-danger">Delete</span>
                    </a>
                </span>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table><?php /**PATH D:\new-xampp\htdocs\app\resources\views/theme/pincodetable.blade.php ENDPATH**/ ?>