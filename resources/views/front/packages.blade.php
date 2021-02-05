
@include('front.theme.header')


<section class="product-prev-sec product-list-sec">
    <div class="container">
        <div class="product-rev-wrap">
            <div class="cat-aside">
                
                <h3 class="text-center">Food Packages</h3>
                <div class="cat-aside-wrap">
                    @foreach ($getpackages as $package)
                    <a href="{{URL::to('packages/'.$package->package_id)}}" class="cat-check border-top-no @if (request()->id == $package->package_id) active @endif">
                        <img src='{!! asset("public/images/packages/".$package->image) !!}' alt="">
                        <p>{{$package->package_name}}</p>
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
                    
                    @foreach ($getpackage as $spackage)
                    @php $flag = 0; @endphp
                    <div class="col-xl-4 col-md-6">
                        <div class="pro-box">
                            <div class="pro-img">
                                <a href="{{URL::to('package-details/'.$spackage->package_id)}}">
                                <img src='{!! asset("public/images/packages/".$spackage->image) !!}' alt="">

                                </a>
                                @if (Session::get('id'))
                                    @if ($spackage->is_favorite == 1)
                                        <i class="fas fa-heart i"></i>
                                    @else
                                        <i class="fal fa-heart i" onclick="MakeFavorite('{{$spackage->package_id}}','{{Session::get('id')}}')"></i>
                                    @endif
                                @endif
                            </div> 
                            <div class="product-details-wrap">
                                <div class="product-details">
                                    <a href="{{URL::to('package-details/'.$spackage->package_id)}}">
                                        <h4>{{$spackage->package_name}}</h4>
                                    </a>
                                    <p class="pro-pricing"><?php echo env('CURRENCY'); ?>{{number_format($spackage->package_amount, 2)}}</p>
                                </div>
                                <div class="product-details">
                                        <?php $Date =date('Y-m-d'); ?>
                                    <p>{{ Str::limit($spackage->package_description, 60) }}</p>
                                   
                                    <a class="btn" href="{{URL::to('package-details/'.$spackage->package_id)}}">View More</a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
               
            </div>
        </div>
    </div>
</section>

@include('front.theme.footer')