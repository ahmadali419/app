@extends('theme.default')

@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/admin/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Packages</a></li>
        </ol>
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPackage"
            data-whatever="@addPackage">Add Package</button> -->
        <!-- Add Category -->
        <div class="modal fade" id="addPackage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <h5 class="modal-title" id="exampleModalLabel">Add New Package</h5> -->
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                        </button> -->
                    </div>

                    <form id="add_package" enctype="multipart/form-data">
                        <div class="modal-body">
                            <span id="msg"></span>
                            @csrf
                            <input type="hidden" name="package_id" id="packg_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="package_name" class="col-form-label">Package Name:</label>
                                        <input type="text" class="form-control" name="package_name"
                                            id="getpackage_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="package_validity" class="col-form-label">Package Validity:</label>
                                        <select name="package_validity" id="getpackage_validity" class="form-control">
                                            <option value="">Select Validity</option>
                                            <option value="1">1 day</option>
                                            <option value="10">10 day</option>
                                            <option value="30">1 month</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_name" class="col-form-label">No of Meals:</label>
                                        <select name="meals" id="getmeals" class="form-control">
                                            <option value="">No of Meals</option>
                                            <?php for($i=1 ; $i <50 ; $i++){?>
                                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                            <?php  }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="amount" class="col-form-label">Amount:</label>
                                        <input type="text" class="form-control" name="package_amount"
                                            id="package_amount">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image" class="col-form-label">Image:</label>
                                <input type="file" class="form-control" name="image" id="image"
                                    accept=".png, .jpg, .jpeg">
                                <input type="hidden" name="removeimg" id="removeimg">
                            </div>
                            <div>
                                <h3>Food Information
                                    <div class="addButton float-right">
                                        <button type="button" class="btn btn-success btn-lg"
                                            onclick="adItem()">+</button>
                                    </div>
                                </h3>
                            </div>

                            <div id="items">

                                <div class="row" id="item-list">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="">Food Category:</label>
                                            <select name="food_category[0]" id="getfood_category"
                                                class="form-control food-cat" onchange="changePrice(this.value,0)">
                                                <option value="">Select Category</option>
                                                <option value="Paid">Paid</option>
                                                <option value="Free">Free</option>

                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="image" class="col-form-label">Food Name:</label>
                                            <input type="text" class="form-control" name="food_name[0]"
                                                id="getfood_name">
                                        </div>

                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="image" class="col-form-label">Food Price:</label>
                                            <input type="number" class="form-control" name="food_price[0]"
                                                id="food_price0" value="0">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="image" class="col-form-label">Image:</label>
                                            <input type="file" class="form-control" name="food_image[0]"
                                                id="food_image[0]">
                                            <input type="hidden" name="removeimg" id="removeimg">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Description:</label>
                                <textarea name="description" id="description" cols="10" rows="5"
                                    class="form-control"></textarea>
                            </div>
                            <!-- <div class="gallery"></div>                 -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="add-package">Save</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Category -->
        <div class="modal fade" id="editPackage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabeledit"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" name="editcategory" class="editcategory" id="editcategory"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabeledit">Edit Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <span id="emsg"></span>
                        <div class="modal-body">
                            <input type="hidden" class="form-control" id="id" name="id">
                            <input type="hidden" class="form-control" id="old_img" name="old_img">
                            <div class="form-group">
                                <label for="category_id" class="col-form-label">Category Name:</label>
                                <input type="text" class="form-control" id="getcategory_name" name="category_name"
                                    placeholder="Category Name">
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-form-label">Select image:</label>
                                <input type="file" class="form-control" name="image" id="image"
                                    accept=".png, .jpg, .jpeg">
                            </div>
                            <div class="gallerys"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <span id="message"></span>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Subscription Requests</h4>
                    <div class="table-responsive" id="table-display">


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- #/ container -->
@endsection
@section('script')

<script>

$(document).ready(function() {
    SubscribeTable();
   


});
// $(document).on('click','.addButton',function(){


// //   alert('yes');
//     // $("#item-list").clone().appendTo("#items");
//     // $('#dlticon').show();   

//     // $('#dlticon').append(`<button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>`)

// });
function SubscribeTable() {
    // alert('yes');return;
    $.ajax({
        url: "{{ URL::to('admin/subscirbepackages/list') }}",
        method: 'get',
        success: function(data) {
            // console.log(data);
            $('#table-display').html(data);
            $(".zero-configuration").DataTable()
        }
    });
}
function updatePackageStatus(status,user_id,id)
{
   
    $.ajax({
        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
        url: "{{ URL::to('admin/subscirbepackages/update') }}",
        data: {
                       id : id,
                       user_id:user_id,
                        status: status
                    },
                    method: 'POST',
        success: function(response) {
            if (response == 1) {
                msg += `<div class="alert alert-success mt-1"> Updated Successfully!
                        </div>`;
                        SubscribeTable();
                    $('#message').html(msg);
                              
                        } else {
                            // swal("Cancelled", "Something Went Wrong :(", "error");
                        }
                    }
        }
);
}
function StatusUpdate(id,user_id, status) {
    swal({
            title: "Are you sure?",
            text: "Do you want to delete this Package Subscription?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
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
                    url: "{{ URL::to('admin/packages/status') }}",
                    data: {
                        id: id,
                        user_id:user_id,
                        status: status
                    },
                    method: 'POST',
                    success: function(response) {
                        if (response == 1) {
                            swal({
                                    title: "Approved!",
                                    text: "Package has been deleted.",
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
                                        SubscribeTable();
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

function GetData(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ URL::to('admin/packages/show') }}",
        data: {
            id: id
        },
        method: 'POST', //Post method,
        dataType: 'json',
        success: function(response) {
            $("#addPackage").modal('show');
            // console.log(response.ResponseData[0].package_id);
            $('#packg_id').val(response.ResponseData[0].package_id);

            $('#getpackage_name').val(response.ResponseData[0].package_name);
            $('#getpackage_validity').val(response.ResponseData[0].package_validity);

            $('#getmeals').val(response.ResponseData[0].meals);
            $('#getfood_category').val(response.ResponseData[0].food_category);
            $('#getfood_name').val(response.ResponseData[0].food_name);





            // $('#getcategory_name').val(response.ResponseData.category_name);
            // $('#getis_admin').val(response.ResponseData.is_admin);

            // $('.gallerys').html("<img src="+response.ResponseData.img+" class='img-fluid' style='max-height: 200px;'>");
            // $('#old_img').val(response.ResponseData.image);
        },
        error: function(error) {

            // $('#errormsg').show();
        }
    })
}
</script>
@endsection