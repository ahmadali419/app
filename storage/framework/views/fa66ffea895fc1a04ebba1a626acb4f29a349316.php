<div class="row" style="margin-top: 20px;">
<?php
// dd($getitemimages);
foreach ($getitemimages as $itemimage) {

?>
<div class="col-md-6 col-lg-3 dataid<?php echo e($itemimage->id); ?>" id="table-image">
    <div class="card">
        <img class="img-fluid" src='<?php echo asset("public/images/item/".$itemimage->image); ?>' style="max-height: 255px; min-height: 255px;" >
        <div class="card-body">
            <button type="button" onClick="EditDocument('<?php echo e($itemimage->id); ?>')" class="btn mb-2 btn-sm btn-primary">Edit</button>
            <button type="button" onclick="DeleteImage('<?php echo e($itemimage->id); ?>')" class="btn mb-2 btn-sm btn-danger">Delete</button>
        </div>
    </div>
</div>
<?php
}
?>
</div><?php /**PATH /home/ab0ve3twa7yy/public_html/healthyandyummy.digitaltechs.co/resources/views/theme/itemimage.blade.php ENDPATH**/ ?>