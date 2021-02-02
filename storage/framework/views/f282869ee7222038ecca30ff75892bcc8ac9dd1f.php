<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Ratting</th>
            <th>Comment</th>
            <th>Created at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        foreach ($getreview as $reviews) {
        ?>
        <tr id="dataid<?php echo e($reviews->id); ?>">
            <td><?php echo e($i); ?></td>
            <td><?php echo e($reviews['users']->name); ?></td>
            <td><i class="fa fa-star"></i> <?php echo e($reviews->ratting); ?></td>
            <td><?php echo e($reviews->comment); ?></td>
            <td><?php echo e($reviews->created_at); ?></td>
            <td>
                <span>
                    <a href="#" data-toggle="tooltip" data-placement="top" onclick="DeleteData('<?php echo e($reviews->id); ?>')" title="" data-original-title="Delete">
                        <span class="badge badge-danger">Delete</span>
                    </a>
                </span>
            </td>
        </tr>
        <?php
        $i++;
        }
        ?>
    </tbody>
</table><?php /**PATH D:\new-xampp\htdocs\app\resources\views/theme/reviewstable.blade.php ENDPATH**/ ?>