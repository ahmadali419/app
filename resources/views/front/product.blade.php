
@include('front.theme.header')


<section class="product-prev-sec product-list-sec">
    <div class="container">
        <div class="product-rev-wrap">
            <div class="cat-aside">
                
                <h3 class="text-center">Food Category</h3>
                <div class="cat-aside-wrap">
                    @foreach ($getcategory as $category)
                    <a href="{{URL::to('/product/'.$category->id)}}" class="cat-check border-top-no @if (request()->id == $category->id) active @endif">
                        <img src='{!! asset("public/images/category/".$category->image) !!}' alt="">
                        <p>{{$category->category_name}}</p>
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="cat-product">
                <div class="cart-pro-head">
                    <h2 class="sec-head">Our Quality Food</h2>
                    <div class="btn-wrap" data-toggle="buttons">
                        <label id="list" class="btn">
                            <input type="radio" name="layout" id="layout1"> <i class="fas fa-list"></i>
                        </label>
                        <label id="grid" class="btn active">
                            <input type="radio" name="layout" id="layout2" checked> <i class="fas fa-th"></i>
                        </label>
                    </div>
                </div>
                <div class="row">
                    
                    @foreach ($getitem as $item)
                    @php $flag = 0; @endphp
                    <div class="col-xl-4 col-md-6">
                        <div class="pro-box">
                            <div class="pro-img">
                                <a href="{{URL::to('product-details/'.$item->id)}}">
                                    <img src='{{$item["itemimage"]->image }}' alt="">
                                </a>
                                @if (Session::get('id'))
                                    @if ($item->is_favorite == 1)
                                        <i class="fas fa-heart i"></i>
                                    @else
                                        <i class="fal fa-heart i" onclick="MakeFavorite('{{$item->id}}','{{Session::get('id')}}')"></i>
                                    @endif
                                @endif
                            </div> 
                            <div class="product-details-wrap">
                                <div class="product-details">
                                    <a href="{{URL::to('product-details/'.$item->id)}}">
                                        <h4>{{$item->item_name}}</h4>
                                    </a>
                                    <p class="pro-pricing"><?php echo env('CURRENCY'); ?>{{number_format($item->item_price, 2)}}</p>
                                </div>
                                <div class="product-details">
                                        <?php $Date =date('Y-m-d'); ?>
                                    <p>{{ Str::limit($item->item_description, 60) }}</p>
                                    @foreach($subsRequest as $request)
                                     @if (Session::get('id'))
                                        
                                    
                                        @if($request->action == 0 && $request->product_id == $item->id)    
                                        @php $flag = 1; @endphp
                                        <button class="btn" disabled>Subscribe Request Pending</button>
                                        
                                        @elseif($request->action == 1 && $request->product_id == $item->id)
                                        @php $flag = 1; @endphp
                                        <!-- <a class="btn" href="{{URL::to('/cart')}}">Check Out</a> -->
                                        
                                        @elseif($request->action == 2 && $request->product_id == $item->id)
                                        @php $flag = 1; @endphp
                                        <p class="label label-danger"><small>*Your Subscription request has been decline.</small></p>
                                        <a class="btn" disable href="{{URL::to('/product/subscribe')}}/{{$item->id}}/{{$item->days}}">Subscribe Again</a>
                                        
                                        @elseif($request->product_id == $item->id && $request->action == 3)
                                        @php $flag = 1; @endphp
                                       <a href="{{URL::to('/product/subscribe')}}/{{$item->id}}/{{$item->days}}">Subscribe</a>
                                        
                                        @elseif($request->product_id == $item->id && $request->end_date < $Date)
                                        @php $flag = 1; @endphp
                                       <a href="{{URL::to('/product/subscribe')}}/{{$item->id}}/{{$item->days}}">Subscribe Again</a>
                                        @endif
                                        
                                    @else
                                        <a class="btn" href="{{URL::to('/signin')}}">Subscribe</a>
                                    @endif 
                                    @endforeach
                                    
                                    @if($flag == 0)
                                    <a class="btn" href="{{URL::to('/product/subscribe')}}/{{$item->id}}/{{$item->days}}">Subscribe</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                {!! $getitem->links() !!}
            </div>
        </div>
    </div>
</section>

@include('front.theme.footer')