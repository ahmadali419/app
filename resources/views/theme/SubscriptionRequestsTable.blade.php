<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>User Details</th>
            <th>Order Details</th>
            <th>Validity Time Period</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($requests as $request)
        <td>{{$request->id}}</td>
         <td>{{$request->name}}<br>{{$request->email}}<br>{{$request->mobile}}</td>
         <td>{{$request->item_name}}<br>{{$request->item_description}}<br> KD {{$request->item_price}}</td>
         <td>{{$request->delivery_time}}</td>
         <td><p>
             <a type="btn" class="btn btn-success btn-sm btn-rounded" href="/admin/subscription_requests/approve/{{$request->id}}">Approved</a>
             <a type="btn" class="btn btn-danger btn-sm btn-rounded" href="">Decline</a>
         </p></td>
         @endforeach
    </tbody>
</table>