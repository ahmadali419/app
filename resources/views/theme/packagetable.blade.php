<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Package Name</th>
            <th>Package Validity</th>
            <th>Package Amount</th>
            <th>created_at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($getpackages as $package) {
        ?>
        <tr id="dataid{{$package->package_id}}">
            <td>{{$package->package_id}}</td>
            <td><img src='{!! asset("public/images/packages/".$package->image) !!}' class='img-fluid' style='max-height: 50px;'></td>
            <td>{{$package->package_name}}</td>
            <td>{{$package->package_validity}} days</td>
            <td>{{$package->package_amount}}</td>
            <td>{{$package->created_at}}</td>
            <td>
            <span>
                <a data-toggle="modal" data-target="#edit       Package" class="badge badge-info px-2" onclick="GetData('{{$package->package_id}}')" style="color: #fff;">Edit</a>
                
                </span>
<span>
<a href="#" class="badge badge-info px-2" onclick="StatusUpdate('{{$package->package_id}}','1')" style="color: #fff;">Delete</a>

</span>            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<div id="edit_modal">
    </div>  
<script>
function GetData(id) {
    // alert(id);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ URL::to('admin/packages/show') }}",
        data: {
            id: id
        },
        method: 'POST', //Post method,
        dataType: 'html',
        success: function(response) {
        //   console.log(response);return;
            $('#edit_modal').html(response);
            $("#editPackage").modal('show');
            // console.log(response.ResponseData[0].package_id);
            // $('#packg_id').val(response.ResponseData[0].package_id);

            // $('#getpackage_name').val(response.ResponseData[0].package_name);
            // $('#getpackage_validity').val(response.ResponseData[0].package_validity);

            // $('#getmeals').val(response.ResponseData[0].meals);
            // $('#getfood_category').val(response.ResponseData[0].food_category);
            // $('#getfood_name').val(response.ResponseData[0].food_name);





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