<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>Offer Name</th>
            <th>Offer Code</th>
            <th>Offer in percentage (%) </th>
            <th>Description </th>
            <th>Created at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($getpromocode as $promocode) {
        ?>
        <tr id="dataid<?php echo e($promocode->id); ?>">
            <td><?php echo e($promocode->id); ?></td>
            <td><?php echo e($promocode->offer_name); ?></td>
            <td><?php echo e($promocode->offer_code); ?></td>
            <td><?php echo e($promocode->offer_amount); ?></td>
            <td><?php echo e($promocode->description); ?></td>
            <td><?php echo e($promocode->created_at); ?></td>
            <td>
                <span>
                    <a href="#" data-toggle="tooltip" data-placement="top" onclick="GetData('<?php echo e($promocode->id); ?>')" title="" data-original-title="Edit">
                        <span class="badge badge-success">Edit</span>
                    </a>
                    <a class="badge badge-danger px-2" onclick="StatusUpdate('<?php echo e($promocode->id); ?>','2')" style="color: #fff;">Delete</a>
                </span>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table><?php /**PATH D:\new-xampp\htdocs\app\resources\views/theme/promocodetable.blade.php ENDPATH**/ ?>