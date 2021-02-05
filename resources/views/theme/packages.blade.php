@extends('theme.default')

@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/admin/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Packages</a></li>
        </ol>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPackage"
            data-whatever="@addPackage">Add Package</button>
        <!-- Add Category -->
        <div class="modal fade" id="addPackage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <form id="add_package" enctype="multipart/form-data">
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
                                            <option value="6">6 days</option>
                                            <option value="20">20 days</option>
                                            <option value="26">26 days</option>

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

                                </h3>
                            </div>

                            <div id="items">

                                <div class="row" id="item-list">

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="image" class="col-form-label">Food Name:</label>
                                            <input type="text" class="form-control" name="food_name[0]"
                                                id="getfood_name">
                                        </div>

                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="image" class="col-form-label">Food Description:</label>
                                            <input type="text" class="form-control" name="food_description[0]"
                                                id="food_description" placeholder="2 meals,3 carbohydrate,price">
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
                                    <div class="col-3">
                                        <div class="addButton mt-2">
                                            <button type="button" class="btn btn-success btn-lg mt-4"
                                                onclick="addItem()">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Description:</label>
                                <textarea name="description" id="description" cols="10" rows="5" class="form-control"
                                    placeholder="2 meals,3 carbohydrate"></textarea>
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


        </div>
        <!-- row -->

    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <span id="message"></span>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">All Packages</h4>
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
        packageTable();



    });
    var row = 1;

    function addItem() {
        let target = $('#items');
        let html = ` <div class="row child_item-list">
                                   
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="image" class="col-form-label">Food Name:</label>
                                            <input type="text" class="form-control" name="food_name[${row}]"
                                                id="food_name">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="image" class="col-form-label">Food Description:</label>
                                            <input type="text" class="form-control" name="food_description[${row}]"
                                                id="food_price0" placeholder="2 meals,3 carbohydrate,price" >
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="image" class="col-form-label">Image:</label>
                                            <input type="file" class="form-control" name="food_image[${row}]"
                                                id="food_image[0]">
                                            <input type="hidden" name="removeimg" id="removeimg">
                                        </div>
                                    </div>
                                    <div class="col-1 mt-2">
                                    <button type="button" class="btn btn-danger  mt-4 btn-lg"
                                            onclick="removeItem(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>`;
        target.append(html);
        row++;
    }

    function removeItem(thisis) {

        thisis.closest('div.child_item-list').remove();



    }

    $('#add-package').on('click', function(event) {
        event.preventDefault();
        var form = document.getElementById('add_package');
        var form_data = new FormData(form);
        $('#preloader').show();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ URL::to('admin/packages/store') }}",
            method: "POST",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(result) {
                $("#preloader").hide();
                var msg = '';
                if (result.error.length > 0) {
                    for (var count = 0; count < result.error.length; count++) {
                        msg += '<div class="alert alert-danger">' + result.error[count] + '</div>';
                    }
                    $('#msg').html(msg);
                    setTimeout(function() {
                        $('#msg').html('');
                    }, 5000);
                } else {
                    msg += '<div class="alert alert-success mt-1">' + result.success + '</div>';
                    packageTable();
                    $('#message').html(msg);
                    $("#addPackage").modal('hide');
                    $("#add_package").reset();
                    $('.gallery').html('');
                    setTimeout(function() {
                        $('#message').html('');
                    }, 30000);
                }
            },
        })
    });

    function packageTable() {
        // alert('yes');return;
        $.ajax({
            url: "{{ URL::to('admin/packages/list') }}",
            method: 'get',
            success: function(data) {
                console.log(data);
                $('#table-display').html(data);
                $(".zero-configuration").DataTable()
            }
        });
    }

    function updatePackageStatus(status, id) {
        // alert(status);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ URL::to('admin/packages/update') }}",
            data: {
                id: id,
                status: status
            },
            method: 'POST',
            success: function(response) {
                if (response == 1) {
                    msg += `<div class="alert alert-success mt-1"> Updated Successfully!
                        </div>`;
                    packageTable();
                    $('#message').html(msg);

                } else {
                    // swal("Cancelled", "Something Went Wrong :(", "error");
                }
            }
        });
    }

    function StatusUpdate(id, status) {
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
                                            packageTable();
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
    </script>
    @endsection