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
            <td>{{$package->package_validity}}</td>
            <td>{{$package->package_amount}}</td>
            <td>{{$package->created_at}}</td>
            <td>
                <span>
                    <a href="#" data-toggle="tooltip" data-placement="top" onclick="GetData('{{$package->package_id}}')" title="" data-original-title="Edit">
                        <span class="badge badge-success">Edit</span>
                    </a>
                   
                </span>
                        <a href="#" class="badge badge-info px-2" onclick="StatusUpdate('{{$package->package_id}}','1')" style="color: #fff;">Delete</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>