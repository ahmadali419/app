<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Slider Title</th>
            <th>Description</th>
            <th>Created at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($getslider as $slider) {
        ?>
        <tr id="dataid<?php echo e($slider->id); ?>">
            <td><?php echo e($slider->id); ?></td>
            <td><img src='<?php echo asset("public/images/slider/".$slider->image); ?>' class='img-fluid' style='max-height: 50px;'></td>
            <td><?php echo e($slider->title); ?></td>
            <td><?php echo e($slider->description); ?></td>
            <td><?php echo e($slider->created_at); ?></td>
            <td>
                <span>
                    <a href="#" data-toggle="tooltip" data-placement="top" onclick="GetData('<?php echo e($slider->id); ?>')" title="" data-original-title="Edit">
                        <span class="badge badge-success">Edit</span>
                    </a>
                    <a href="#" data-toggle="tooltip" data-placement="top" onclick="DeleteData('<?php echo e($slider->id); ?>')" title="" data-original-title="Delete">
                        <span class="badge badge-danger">Delete</span>
                    </a>
                </span>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table><?php /**PATH D:\new-xampp\htdocs\app\resources\views/theme/slidertable.blade.php ENDPATH**/ ?>