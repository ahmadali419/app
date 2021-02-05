<!-- Modal Change Password-->
<div class="modal fade text-left" id="ChangePasswordModal" tabindex="-1" role="dialog" aria-labelledby="RditProduct"
aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <label class="modal-title text-text-bold-600" id="RditProduct">Change Password</label>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="errors" style="color: red;"></div>
      
      <form method="post" id="change_password_form">
      <?php echo e(csrf_field()); ?>

        <div class="modal-body">
          <label>Old Passwod: </label>
          <div class="form-group">
              <input type="password" placeholder="Enter Old Password" class="form-control" name="oldpassword" id="oldpassword">
          </div>

          <label>New Password: </label>
          <div class="form-group">
              <input type="password" placeholder="Enter New Password" class="form-control" name="newpassword" id="newpassword">
          </div>

          <label>Confirm Password: </label>
          <div class="form-group">
              <input type="password" placeholder="Enter Confirm Password" class="form-control" name="confirmpassword" id="confirmpassword">
          </div>

        </div>
        <div class="modal-footer">
          <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal"
          value="Close">
          <input type="button" class="btn btn-outline-primary btn-lg" onclick="changePassword()"  value="Submit">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Add Review-->
<div class="modal fade text-left" id="AddReview" tabindex="-1" role="dialog" aria-labelledby="RditProduct"
aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <label class="modal-title text-text-bold-600" id="RditProduct">Add Review</label>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="errorr" style="color: red;"></div>
      
      <form method="post" id="change_password_form">
      <?php echo e(csrf_field()); ?>

        <div class="modal-body">
          	<div class="rating"> 
	        	<input type="radio" name="rating" value="5" id="star5"><label for="star5">☆</label> 
	        	<input type="radio" name="rating" value="4" id="star4"><label for="star4">☆</label> 
	        	<input type="radio" name="rating" value="3" id="star3"><label for="star3">☆</label> 
	        	<input type="radio" name="rating" value="2" id="star2"><label for="star2">☆</label> 
	        	<input type="radio" name="rating" value="1" id="star1"><label for="star1">☆</label>
	        </div>

          <label>Comment: </label>
          <div class="form-group">
          	<textarea class="form-control" name="comment" id="comment" rows="5" required=""></textarea>
          	<input type="hidden" name="user_id" id="user_id" class="form-control" value="<?php echo e(Session::get('id')); ?>">
          </div>

        </div>
        <div class="modal-footer">
          <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal"
          value="Close">
          <input type="button" class="btn btn-outline-primary btn-lg" onclick="addReview()"  value="Submit">
        </div>
      </form>
    </div>
  </div>
</div>

<footer>
	<div class="container d-flex justify-content-between flex-wrap">
		<div class="footer-head">
			<div class="footer-logo"><img src='<?php echo asset("public/images/about/".$getabout->footer_logo); ?>' alt=""></div>
			<p><?php echo \Illuminate\Support\Str::limit(htmlspecialchars($getabout->about_content, ENT_QUOTES, 'UTF-8'), $limit = 200, $end = '...'); ?></p>
		</div>
		<div class="footer-socialmedia">
			<?php if($getabout->fb != ""): ?>
				<a href="<?php echo e($getabout->fb); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
			<?php endif; ?>

			<?php if($getabout->twitter != ""): ?>
				<a href="<?php echo e($getabout->twitter); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
			<?php endif; ?>

			<?php if($getabout->insta != ""): ?>
				<a href="<?php echo e($getabout->insta); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
			<?php endif; ?>
		</div>
	<!--	<div class="download-app">
			<p>Download the App</p>
			<div class="download-app-wrap">
				<?php if($getabout->ios != ""): ?>
					<div class="download-app-icon">
						<a href="<?php echo e($getabout->ios); ?>" target="_blank"><img src="<?php echo asset('public/front/images/apple-store.svg'); ?>" alt=""></a>
					</div>
				<?php endif; ?>

				<?php if($getabout->android != ""): ?>
					<div class="download-app-icon">
						<a href="<?php echo e($getabout->android); ?>" target="_blank"><img src="<?php echo asset('public/front/images/play-store.png'); ?>" alt=""></a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>-->
	<div class="copy-right text-center">
		<a href="<?php echo e(URL::to('/privacy')); ?>" style="color: #fff;"> Privacy Policy </a>
		<p><?php echo e($getabout->copyright); ?></p>
	</div>
</footer>

<a onclick="topFunction()" id="myBtn" title="Go to top" style="display: block;"><i class="fad fa-long-arrow-alt-up"></i></a>

<!-- footer -->


<!-- View order btn -->
<?php if(Session::get('cart') && !request()->is('cart')): ?>
	<a href="<?php echo e(URL::to('/cart')); ?>" class="view-order-btn">View My Order</a>
<?php else: ?>
	<a href="<?php echo e(URL::to('/cart')); ?>" class="view-order-btn" style="display: none;">View My Order</a>
<?php endif; ?>
<!-- View order btn -->


<!-- jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- bootstrap js -->
<script src="<?php echo asset('public/front/js/bootstrap.bundle.js'); ?>"></script>

<!-- owl.carousel js -->
<script src="<?php echo asset('public/front/js/owl.carousel.min.js'); ?>"></script>

<!-- lazyload js -->
<script src="<?php echo asset('public/front/js/lazyload.js'); ?>"></script>

<!-- custom js -->
<script src="<?php echo asset('public/front/js/custom.js'); ?>"></script>

<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<script src="<?php echo asset('public/assets/plugins/sweetalert/js/sweetalert.min.js'); ?>"></script>
<script src="<?php echo asset('public/assets/plugins/sweetalert/js/sweetalert.init.js'); ?>"></script>

<script type="text/javascript">
	function changePassword(){
	    var oldpassword=$("#oldpassword").val();
	    var newpassword=$("#newpassword").val();
	    var confirmpassword=$("#confirmpassword").val();
	    var CSRF_TOKEN = $('input[name="_token"]').val();
	    
	    $('#preloader').show();
	    $.ajax({
	        headers: {
	            'X-CSRF-Token': CSRF_TOKEN 
	        },
	        url:"<?php echo e(url('/home/changePassword')); ?>",
	        method:'POST',
	        data:{'oldpassword':oldpassword,'newpassword':newpassword,'confirmpassword':confirmpassword},
	        dataType:"json",
	        success:function(data){
	        	$("#preloader").hide();
	            if(data.error.length > 0)
	            {
	                var error_html = '';
	                for(var count = 0; count < data.error.length; count++)
	                {
	                    error_html += '<div class="alert alert-danger mt-1">'+data.error[count]+'</div>';
	                }
	                $('#errors').html(error_html);
	                setTimeout(function(){
	                    $('#errors').html('');
	                }, 10000);
	            }
	            else
	            {
	                location.reload();
	            }
	        },error:function(data){
	           
	        }
	    });
	}
	var ratting = "";
	$('.rating input').on('click', function(){
        ratting = $(this).val();
	});
	function addReview(){

        var comment=$("#comment").val();
        var user_id=$("#user_id").val();

        var CSRF_TOKEN = $('input[name="_token"]').val();

		// $('#preloader').show();
		$.ajax({
            headers: {
                'X-CSRF-Token': CSRF_TOKEN 
            },
            url:"<?php echo e(url('/home/addreview')); ?>",
            method:'POST',
            data: 'comment='+comment+'&ratting='+ratting+'&user_id='+user_id,
            dataType: 'json',
            success:function(data){
	        	$("#preloader").hide();
	            if(data.error.length > 0)
	            {
	                var error_html = '';
	                for(var count = 0; count < data.error.length; count++)
	                {
	                    error_html += '<div class="alert alert-danger mt-1">'+data.error[count]+'</div>';
	                }
	                $('#errorr').html(error_html);
	                setTimeout(function(){
	                    $('#errorr').html('');
	                }, 10000);
	            }
	            else
	            {
	                location.reload();
	            }
	        },error:function(data){
	           
	        }
        });
	}

	function contact() {
        var firstname=$("#firstname").val();
        var lastname=$("#lastname").val();
        var email=$("#email").val();
        var message=$("#message").val();
        var CSRF_TOKEN = $('input[name="_token"]').val();
        $('#preloader').show();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"<?php echo e(URL::to('/home/contact')); ?>",
            data: {
                firstname: firstname,
                lastname: lastname,
                email: email,
                message: message
            },
            method: 'POST', //Post method,
            dataType: 'json',
            success: function(response) {
            	$("#preloader").hide();
                if (response.status == 1) {
                    $('#msg').text(response.message);
                    $('#success-msg').addClass('alert-success');
                    $('#success-msg').css("display","block");

                    setTimeout(function() {
                        $("#success-msg").hide();
                    }, 5000);
                } else {
                    $('#ermsg').text(response.message);
                    $('#error-msg').addClass('alert-danger');
                    $('#error-msg').css("display","block");

                    setTimeout(function() {
                        $("#error-msg").hide();
                    }, 5000);
                }
            }
        })
    };
	function AddtoCart(id,user_id) {

		// var price = $('#price').html();
		var item_notes = $('#item_notes').val();

        var addons_id = ($('.Checkbox:checked').map(function() {
            return this.value;
        }).get().join(', '));
		// alert(item_notes);return;
        // $('#preloader').show();
	    $.ajax({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        url:"<?php echo e(URL::to('/product/addtocart')); ?>",
	        data: {
				item_id: id,
				addons_id:addons_id,
	            qty: '1',
	            item_notes: item_notes,
	            user_id: user_id
	        },
	        method: 'POST', //Post method,
	        dataType: 'json',
	        success: function(response) {
	        	$("#preloader").hide();
	            if (response.status == 1) {
	            	$('#cartcnt').text(response.cartcnt);
	                $('#msg').text(response.message);
	                $('#success-msg').addClass('alert-success');
	                $('#success-msg').css("display","block");
	                $('.view-order-btn').show();

	                setTimeout(function() {
	                    $("#success-msg").hide();
	                }, 5000);
	            } else {
	                $('#ermsg').text(response.message);
	                $('#error-msg').addClass('alert-danger');
	                $('#error-msg').css("display","block");

	                setTimeout(function() {
	                    $("#success-msg").hide();
	                }, 5000);
	            }
	        },
	        error: function(error) {

	            // $('#errormsg').show();
	        }
	    })
	};
	function Unfavorite(id,user_id) {
	    swal({
	        title: "Are you sure?",
	        text: "Do you want to Unfavorite this item ?",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonClass: "btn-danger",
	        confirmButtonText: "Yes, Unfavorite it!",
	        cancelButtonText: "No, cancel plz!",
	        closeOnConfirm: false,
	        closeOnCancel: false,
	        showLoaderOnConfirm: true,
	    },
	    function(isConfirm) {
	        if (isConfirm) {
	            $.ajax({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                },
	                url:"<?php echo e(URL::to('/product/unfavorite')); ?>",
	                data: {
                        item_id: id,
                        user_id: user_id
                    },
	                method: 'POST',
	                success: function(response) {
	                    if (response == 1) {
	                        swal({
	                            title: "Approved!",
	                            text: "Item has been unfavorite.",
	                            type: "success",
	                            showCancelButton: true,
	                            confirmButtonClass: "btn-danger",
	                            confirmButtonText: "Ok",
	                            closeOnConfirm: false,
	                            showLoaderOnConfirm: true,
	                        },
	                        function(isConfirm) {
	                            if (isConfirm) {
	                                swal.close();
	                                location.reload();
	                            }
	                        });
	                    } else {
	                        swal("Cancelled", "Something Went Wrong :(", "error");
	                    }
	                },
	                error: function(e) {
	                    swal("Cancelled", "Something Went Wrong :(", "error");
	                }
	            });
	        } else {
	            swal("Cancelled", "Your record is safe :)", "error");
	        }
	    });
	}

	function MakeFavorite(id,user_id) {
	    swal({
	        title: "Are you sure?",
	        text: "Do you want to favorite this item ?",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonClass: "btn-danger",
	        confirmButtonText: "Yes, Make it favorite!",
	        cancelButtonText: "No, cancel plz!",
	        closeOnConfirm: false,
	        closeOnCancel: false,
	        showLoaderOnConfirm: true,
	    },
	    function(isConfirm) {
	        if (isConfirm) {
	            $.ajax({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                },
	                url:"<?php echo e(URL::to('/product/favorite')); ?>",
	                data: {
                        item_id: id,
                        user_id: user_id
                    },
	                method: 'POST',
	                success: function(response) {
	                    if (response == 1) {
	                        swal({
	                            title: "Approved!",
	                            text: "Item has been added in favorite list.",
	                            type: "success",
	                            showCancelButton: true,
	                            confirmButtonClass: "btn-danger",
	                            confirmButtonText: "Ok",
	                            closeOnConfirm: false,
	                            showLoaderOnConfirm: true,
	                        },
	                        function(isConfirm) {
	                            if (isConfirm) {
	                                swal.close();
	                                location.reload();
	                            }
	                        });
	                    } else {
	                        swal("Cancelled", "Something Went Wrong :(", "error");
	                    }
	                },
	                error: function(e) {
	                    swal("Cancelled", "Something Went Wrong :(", "error");
	                }
	            });
	        } else {
	            swal("Cancelled", "Your record is safe :)", "error");
	        }
	    });
	};

	function codeAddress() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url:"<?php echo e(URL::to('/cart/isopenclose')); ?>",
            success: function(response) {
                if (response.status == 0) {
                    $('.open').hide();
                    $('.openmsg').show();
                } else {
                    $('.openmsg').hide();
                }
            }
        });
    }
    window.onload = codeAddress;
</script>
<?php echo $__env->yieldContent('script'); ?>
</body>

</html><?php /**PATH D:\new-xampp\htdocs\app\resources\views/front/theme/footer.blade.php ENDPATH**/ ?>