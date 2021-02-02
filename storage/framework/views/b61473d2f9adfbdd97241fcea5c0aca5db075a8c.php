<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Category Name</th>
            <th>Created at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($getcategory as $category) {
        ?>
        <tr id="dataid<?php echo e($category->id); ?>">
            <td><?php echo e($category->id); ?></td>
            <td><img src='<?php echo asset("public/images/category/".$category->image); ?>' class='img-fluid' style='max-height: 50px;'></td>
            <td><?php echo e($category->category_name); ?></td>
            <td><?php echo e($category->created_at); ?></td>
            <td>
                <span>
                    <a href="#" data-toggle="tooltip" data-placement="top" onclick="GetData('<?php echo e($category->id); ?>')" title="" data-original-title="Edit">
                        <span class="badge badge-success">Edit</span>
                    </a>
                    <?php if($category->is_available == '1'): ?>
                        <a class="badge badge-info px-2" onclick="StatusUpdate('<?php echo e($category->id); ?>','2')" style="color: #fff;">Delete</a>
                    <?php else: ?>
                        <a class="badge badge-primary px-2" onclick="StatusUpdate('<?php echo e($category->id); ?>','1')" style="color: #fff;">Unavailable</a>
                    <?php endif; ?>
                </span>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table><?php /**PATH /home/ab0ve3twa7yy/public_html/healthyandyummy.digitaltechs.co/resources/views/theme/categorytable.blade.php ENDPATH**/ ?>