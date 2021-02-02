<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Package Name</th>
            <th>Package Validity</th>
            <th>Meals</th>
            <th>Amount</th>
            <th>Created at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($getpackages) {
            foreach ($getpackages as $package) {
                ?>
        <tr id="dataid<?php echo e($package->package_id); ?>">
            <td><?php echo e($package->package_id); ?></td>
            <td><img src='<?php echo asset("public/images/packages/".$package->image); ?>' class='img-fluid' style='max-height: 50px;'></td>
            <td><?php echo e($package->package_name); ?></td>
            <td><?php echo e($package->package_validity); ?> day</td>
            <td><?php echo e($package->meals); ?> </td>
            <td><?php echo e($package->package_amount); ?> </td>
            <td><?php echo e($package->created_at); ?> </td>
            

            <td>
                <span>
                    <a href="#" data-toggle="tooltip" data-placement="top" onclick="GetData('<?php echo e($package->package_id); ?>')" title="" data-original-title="Edit">
                        <span class="badge badge-success">Edit</span>
                    </a>
                    
                </span>
                <span>
                <a href="#" class="badge badge-info px-2" onclick="StatusUpdate('<?php echo $package->package_id ?>','2')" style="color: #fff;">Delete</a>
                </span>
            </td>
           
        </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table><?php /**PATH D:\new-xampp\htdocs\app\resources\views/theme/packagetable.blade.php ENDPATH**/ ?>