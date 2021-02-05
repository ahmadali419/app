

<div class="modal fade" id="editPackage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Package</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                        </button>
                    </div>

                        <div class="modal-body">
                        @foreach($packages as $package)
                    <form id="updated_package" enctype="multipart/form-data">
                            <span id="msg"></span>
                            
                            @csrf
                            <input type="hidden" name="package_id" id="packg_id" value="<?php echo $package->package_id; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="package_name" class="col-form-label">Package Name:</label>
                                        <input type="text" class="form-control" name="package_name"
                                            id="getpackage_name" value="{{$package->package_name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="package_validity" class="col-form-label">Package Validity:</label>
                                        <select name="package_validity" id="getpackage_validity" class="form-control" value="{{$package->package_validity}}">
                                            <option value="">Select Validity</option>
                                            <option value="6" <?=$package->package_validity=='6' ? 'selected': ''?>>6 days</option>
                                            <option value="20" <?=$package->package_validity=='20' ? 'selected': ''?>>20 days</option>
                                            <option value="26" <?=$package->package_validity=='26' ? 'selected': ''?>>26 days</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_name" class="col-form-label">No of Meals:</label>
                                        <select name="meals" id="getmeals" class="form-control" value="{{$package->meals}}">
                                            <option value="">No of Meals</option>
                                            <?php for($i=1 ; $i <50 ; $i++){?>
                                            <option value="<?php echo $i;?>" <?=$package->meals==$i ? 'selected': ''?>><?php echo $i;?></option>
                                            <?php  }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="amount" class="col-form-label">Amount:</label>
                                        <input type="text" class="form-control" name="package_amount"
                                            id="package_amount"  value="{{$package->package_amount}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image" class="col-form-label">Image:</label>
                                <input type="file" class="form-control" name="image" id="image"
                                    accept=".png, .jpg, .jpeg" value="{{$package->image}}">
                                    <input type="hidden" class="form-control" id="old_img" name="old_img" value="{{$package->image}}">
                                    <!-- <img src='{!! asset("public/images/packages/".$package->image) !!}' alt="" style='max-height: 200px;'>  -->
                                    <!-- <img src="{{$package->image}}" class='img-fluid' style='max-height: 200px;'> -->
                            </div>
                            <div>
                                <h3>Food Information
                                    
                                </h3>
                            </div>
                             <?php $i=0;?>
                            <div id="items">
                               @foreach($package->categories as $category)

                               <div class="row child_item-list" id="item-list">
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="image" class="col-form-label">Food Name:</label>
                                            <input type="text" class="form-control" name="food_name[<?php echo $i; ?>]"
                                                id="getfood_name" value="{{$category->food_name}}">
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="image" class="col-form-label">Food Description:</label>
                                            <input type="text" class="form-control" name="food_description[<?php echo $i; ?>]"
                                                id="food_description" placeholder="2 meals,3 carbohydrate,price" value="{{$category->food_description}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="image" class="col-form-label">Image:</label>
                                            <input type="file" class="form-control" name="food_image[<?php echo $i; ?>]"
                                                id="food_image[0]" value="{{$category->food_image}}">
                                               
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                    <div class="addButton mt-2">
                                        <button type="button" class="btn btn-danger btn-lg mt-4"
                                            onclick="removerow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                    </div>
                                </div>
                               <?php $i++; ?>   
                               @endforeach
                            </div>

                            <div class="form-group">
                                <label for="">Description:</label>
                                <textarea name="description" id="description" cols="10" rows="5"
                                    class="form-control" value="{{$package->description}}"></textarea>
                            </div>
                            <!-- <div class="gallery"></div>                 -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="update-package">Update</button>
                            </div>
                    </form>
        @endforeach
                </div>
            </div>
        </div>
</div>
<script>
function removerow(thisis){
				// alert(thisis.closest('div.child_item-list'));return;
				thisis.closest('div.child_item-list').remove();
				


            }
            $('#update-package').on('click', function(event){
                // alert('yes');
        event.preventDefault();
        var form = document.getElementById('updated_package');
        // console.log(form);return;
        var form_data = new FormData(form);
        // console.log(form_data);return;
        $('#preloader').show();
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            url:"{{ URL::to('admin/packages/updatePackage') }}",
            method:"POST",
            data:form_data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(result) {
                $("#preloader").hide();
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
                    msg += '<div class="alert alert-success mt-1">'+result.success+'</div>';
                    packageTable();
                    $('#message').html(msg);
                    $("#editPackage").modal('hide');
                    $("#add_package").reset();
                    $('.gallery').html('');
                    setTimeout(function(){
                      $('#message').html('');
                    }, 5000);
                }
            },
        })
    });
</script>