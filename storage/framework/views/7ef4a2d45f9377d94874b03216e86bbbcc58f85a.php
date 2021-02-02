


<?php $__env->startSection('content'); ?>

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/admin/home')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Settings</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <span id="msg"></span>
                    <h4 class="card-title">Settings</h4>
                    <p class="text-muted"><code></code>
                    </p>
                    <div id="privacy-policy-three" class="privacy-policy">
                        <form method="post" name="about" id="about" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <p>About Settings</p>
                            <div class="form-group">
                                <label for="about_content" class="col-form-label">About Content:</label>
                                <textarea class="form-control" id="about_content" rows="5" name="about_content"><?php echo e($getabout->about_content); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-form-label">About Image:</label>
                                <input type="file" class="form-control" name="image" id="image" value="<?php echo e($getabout->image); ?>">
                                <img src='<?php echo asset("public/images/about/".$getabout->image); ?>' class='img-fluid mt-3' style='max-height: 150px;'>
                            </div>
                            <p>Footer Settings</p>
                            <div class="form-group">
                                <label for="fb" class="col-form-label">Facebook Link:</label>
                                <input type="text" class="form-control" name="fb" id="fb" value="<?php echo e($getabout->fb); ?>">
                            </div>
                            <div class="form-group">
                                <label for="twitter" class="col-form-label">Twitter Link:</label>
                                <input type="text" class="form-control" name="twitter" id="twitter" value="<?php echo e($getabout->twitter); ?>">
                            </div>
                            <div class="form-group">
                                <label for="insta" class="col-form-label">Instagram Link:</label>
                                <input type="text" class="form-control" name="insta" id="insta" value="<?php echo e($getabout->insta); ?>">
                            </div>
                            <div class="form-group">
                                <label for="android" class="col-form-label">Android App Link:</label>
                                <input type="text" class="form-control" name="android" id="android" value="<?php echo e($getabout->android); ?>">
                            </div>
                            <div class="form-group">
                                <label for="ios" class="col-form-label">iOS App Link:</label>
                                <input type="text" class="form-control" name="ios" id="ios" value="<?php echo e($getabout->ios); ?>">
                            </div>

                            <div class="form-group">
                                <label for="copyright" class="col-form-label">Copyright:</label>
                                <input type="text" class="form-control" name="copyright" id="copyright" value="<?php echo e($getabout->copyright); ?>">
                            </div>
                            <div class="form-group">
                                <label for="logo" class="col-form-label">Logo:</label>
                                <input type="file" class="form-control" name="logo" id="logo" value="<?php echo e($getabout->logo); ?>">
                                <img src='<?php echo asset("public/images/about/".$getabout->logo); ?>' class='img-fluid mt-3' style='max-height: 150px;'>
                            </div>
                            <div class="form-group">
                                <label for="footer_logo" class="col-form-label">Footer Logo:</label>
                                <input type="file" class="form-control" name="footer_logo" id="footer_logo" value="<?php echo e($getabout->footer_logo); ?>">
                                <img src='<?php echo asset("public/images/about/".$getabout->footer_logo); ?>' class='img-fluid mt-3' style='max-height: 150px;'>
                            </div>
                            <div class="form-group">
                                <label for="favicon" class="col-form-label">Favicon:</label>
                                <input type="file" class="form-control" name="favicon" id="favicon" value="<?php echo e($getabout->favicon); ?>">
                                <img src='<?php echo asset("public/images/about/".$getabout->favicon); ?>' class='img-fluid mt-3' style='max-height: 150px;'>
                            </div>
                            <hr>
                            <p>Contacts Settings</p>
                            <div class="form-group">
                                <label for="mobile" class="col-form-label">Mobile:</label>
                                <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo e($getabout->mobile); ?>">
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email:</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo e($getabout->email); ?>">
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-form-label">Address:</label>
                                <input type="text" class="form-control" name="address" id="address" value="<?php echo e($getabout->address); ?>">
                            </div>
                            <button type="submit" name="update" class="btn mb-1 btn-primary mt-3">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- #/ container -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
$(document).ready(function() {

    $('#about').on('submit', function(event){
        event.preventDefault();
        var form_data = new FormData(this);
        $.ajax({
            url:"<?php echo e(URL::to('admin/about/update')); ?>",
            method:"POST",
            data:form_data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(result) {
                var msg = '';
                if(result.error.length > 0)
                {
                    for(var count = 0; count < result.error.length; count++)
                    {
                        msg += '<div class="alert alert-danger">'+result.error[count]+'</div>';
                    }
                    $('#msg').html(msg);
                    setTimeout(function(){
                      $('#msg').html('');
                    }, 5000);
                }
                else
                {
                    location.reload();
                }
            },
        })
    });
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('theme.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ab0ve3twa7yy/public_html/healthyandyummy.digitaltechs.co/resources/views/about.blade.php ENDPATH**/ ?>