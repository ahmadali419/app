@include('front.theme.header')>
@if(Session::has('success'))
    <div class="alert alert-success"> {{ Session::get('success') }}</div>
@endif
<section class="favourite">
    <div class="container">
        <h2 class="sec-head">My Orders</h2>
        <div class="row">
            @if (count($orderdata) == 0)
                <p>No Data found</p>
            @else 
                @foreach ($orderdata as $orders)
                <div class="col-lg-4">
                    <a href="#" class="order-box">
                        <div class="order-box-no">
                            {{$orders->date}}
                            <h4>Order Number : <span>{{$orders->order_number}}</span></h4>
                            <p class="order-qty">QTY : <span>{{$orders->qty}}</span></p>
                            @if($orders->status == 1)
                                <p class="order-status">Order Status : <span>Order Placed</span></p>
                            @elseif($orders->status == 2)
                                <p class="order-status">Order Status : <span>Order Ready</span></p>
                            @elseif($orders->status == 3)
                                <p class="order-status">Order Status : <span>Order on the way</span></p>
                            @else
                                <p class="order-status">Order Status : <span>Order Delivered</span></p>
                            @endif
                        </div>
                        <div class="order-box-price">
                            <h5><?php echo env('CURRENCY'); ?>{{number_format($orders->package_amount, 2)}}</h5>
                            @if($orders->payment_type == 1)
                                <p>Razorpay</p>
                            @elseif($orders->payment_type == 2)
                                <p>Stripe</p>
                            @else
                                <p>COD</p>
                            @endif
                        </div>
                    </a>
                </div>
                @endforeach
            @endif
        </div>
        {!! $orderdata->links() !!}
    </div>
</section>

@include('front.theme.footer')