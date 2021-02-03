<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <!-- <th>Image</th> -->
            <th>User Detail</th>
            <th>Package Detail</th>
            <th>Item Detail</th>
            <th>Status</th>
            <th>Created at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($getSubscribepackages) {
            foreach ($getSubscribepackages as $package) {
                ?>
        <tr id="dataid<?php echo e($package->package_id); ?>">
            <td><?php echo e($package->product_id); ?></td>
            <!-- <td><img src='<?php echo asset("public/images/packages/".$package->image); ?>' class='img-fluid' style='max-height: 50px;'></td> -->
            <td><?php echo e($package->name); ?>

            <br>
            <?php echo e($package->email); ?>

            <br>
            <?php echo e($package->mobile); ?>

        
            </td>
            <td>
            <?php echo e($package->category_name); ?>

            <br>
            <?php echo e($package->delivery_time); ?>

            

            </td>
            <td>
            <?php echo e($package->item_name); ?><br>
            <?php echo e($package->item_price); ?><br>
            <?php echo e($package->item_description); ?>

            </td>
            <td>    
             <select  onchange="updatePackageStatus(this.value,<?php echo $package->user_id ?>,<?= $package->product_id?>)">
              <option value="Request initiate"  <?=$package->status=='Request initiate' ? 'selected': ''?>>Initiate</option>
              <option value="Request Approved" <?=$package->status=='Request Approved' ? 'selected': ''?>>Approved</option>
             </select>
            </td>
            <td>
            <?php echo e($package->created_at); ?>

            </td>
            <!-- <td><?php echo e($package->package_validity); ?> day</td>
            <td><?php echo e($package->meals); ?> </td>
            <td><?php echo e($package->package_amount); ?> </td>
            <td><?php echo e($package->created_at); ?> </td> -->
            

            <td>
                
                <span>
                <a href="#" class="badge badge-info px-2" onclick="StatusUpdate('<?php echo $package->product_id ?>','<?php echo $package->user_id ?>','2')" style="color: #fff;">Delete</a>
                </span>
            </td>
           
        </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table><?php /**PATH D:\new-xampp\htdocs\app\resources\views/theme/packageSubscribetable.blade.php ENDPATH**/ ?>