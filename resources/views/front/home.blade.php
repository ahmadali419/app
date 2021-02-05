@include('front.theme.header')

    <div class="list-of-packages">
    <h3>Packages</h3>
    @foreach ($getpackage as $package)
                    <li>
                    <a href="{{URL::to('packages/'.$package->package_id)}}" class=" @if (request()->id == $package->package_id) active @endif">
                       
                        {{$package->package_name}}
                    </a>
                    </li>
                    @endforeach
    </div>

<section class="banner-sec">
    <div class="container-fluid px-0">
        <div class="banner-carousel owl-carousel owl-theme">
            @foreach ($getslider as $slider)
            <div class="item">
                <img src='{!! asset("public/images/slider/".$slider->image) !!}' alt="">
                <div class="banner-contant">
                    <h1>{{$slider->title}}</h1>
                    <p>{{$slider->description}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="feature-sec">
    <div class="container">
        <div class="feature-carousel owl-carousel owl-theme">
            @foreach ($getbanner as $banner)
            <div class="item">
                <div class="feature-box">
                    <img src='{!! asset("public/images/banner/".$banner->image) !!}' alt="">
                    <div class="feature-contant">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="product-prev-sec">
    <div class="container">
        <h2 class="sec-head">Subcribe Packages</h2>
        <div id="sync2" class="owl-carousel owl-theme">
            <?php $i=1; ?>
            @foreach ($getpackage as $package)
            <div class="item product-tab">
            <img src='{!! asset("public/images/slider/".$slider->image) !!}' alt=""> {{$package->package_name}}
            </div>
            <?php $i++; ?>
            @endforeach
        </div>
        <div id="sync1" class="owl-carousel owl-theme">
            <?php $i=1; ?>
            @foreach($getpackage as $package)
            <div class="item">
                <div class="tab-pane">
                    <div class="row">
                   
                       
                  
                        <div class="col-lg-4 col-md-6">
                            <div class="pro-box">
                                <div class="pro-img">
                                    <a href="{{URL::to('package-details/'.$package->package_id)}}">
                                    <img src='{!! asset("public/images/slider/".$slider->image) !!}' alt="">
                                    </a>
                                  
                                </div>
                                <div class="product-details-wrap">
                                    <div class="product-details">
                                        <a href="{{URL::to('package-details/'.$package->package_id)}}">
                                            <h4>{{$package->package_name}}</h4>
                                        </a>
                                        <p class="pro-pricing"><?php echo env('CURRENCY'); ?>{{number_format($package->package_amount, 2)}}</p>
                                    </div>
                                    <div class="product-details">
                                        <p>{{ Str::limit($package->package_description, 60) }}</p>
                                    </div>
                                    <div class="float-right">
                                    <a class="btn btn-success btn-sm mt-3" href="{{URL::to('package-details/'.$package->package_id)}}">View More</a>
                                      <!-- <button class="btn btn-success btn-sm mt-3" >Subscribe</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <a href="{{URL::to('packages/'.$package->package_id)}}" class="btn">View More</a>
                </div>
            </div>
            <?php $i++; ?>
            @endforeach
        </div>
    </div>
</section>

<section class="product-prev-sec">
    <div class="container">
        <h2 class="sec-head">Food Items</h2>
        <div id="sync2" class="owl-carousel owl-theme">
            <?php $i=1; ?>
            @foreach ($getcategory as $category)
            <div class="item product-tab">
                <img src='{!! asset("public/images/category/".$category->image) !!}' alt=""> {{$category->category_name}}
            </div>
            <?php $i++; ?>
            @endforeach
        </div>
        <div id="sync1" class="owl-carousel owl-theme">
            <?php $i=1; ?>
            @foreach($getcategory as $category)
            <div class="item">
                <div class="tab-pane">
                    <div class="row">
                        @foreach($getitem as $item)
                        @if($item->cat_id==$category->id)
                        <div class="col-lg-4 col-md-6">
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
                                    @else
                                        <a class="i" href="{{URL::to('/signin')}}"><i class="fal fa-heart"></i></a>
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
                                        <p>{{ Str::limit($item->item_description, 60) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <a href="{{URL::to('product/')}}" class="btn">View More</a>
                </div>
            </div>
            <?php $i++; ?>
            @endforeach
        </div>
    </div>
</section>

<section class="about-sec">
    <div class="container">
        <div class="about-box">
            <div class="about-img">
                <img src='{!! asset("public/images/about/".$getabout->image) !!}' alt="">
            </div>
            <div class="about-contant">
                <h2 class="sec-head text-left">About Us</h2>
                <p>{!! \Illuminate\Support\Str::limit(htmlspecialchars($getabout->about_content, ENT_QUOTES, 'UTF-8'), $limit = 500, $end = '...') !!}</p>
            </div>
        </div>
    </div>
</section>



<section class="review-sec">
    <div class="container">
        <h2 class="sec-head">Our Food Review</h2>
        <div class="review-carousel owl-carousel owl-theme">
            @foreach($getreview as $review)
            <div class="item">
                <div class="review-profile">
                    <img src='{!! asset("public/images/profile/".$review["users"]->profile_image) !!}' alt="">
                </div>
                <h3>{{$review['users']->name}}</h3>
                <p>{{$review->comment}}</p>
            </div>
            @endforeach
        </div>

    </div>
</section>

<section class="our-app">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                
                <h2 class="sec-head">Choose the Package that better suits you</h2>
                <br>
                <h3>Confirm your order & pick it up </h3>
                <h5>Enjoy your food on the go!</h5>
            </div>
            <div class="col-lg-6">
              <!--  @if($getabout->ios != "")
                    <a href="{{$getabout->ios}}" class="our-app-icon" target="_blank"> 
                       <img src="{!! asset('public/front/images/apple-store.svg') !!}" alt="">
                    </a>
               @endif

                @if($getabout->android != "")
                    <a href="{{$getabout->android}}" class="our-app-icon" target="_blank"> </a> -->
                    <a>    <img src="{!! asset('public/front/images/Group 1.png') !!}" alt="">
                    </a>
                <!-- @endif -->
            </div>
        </div>
    </div>
</section>

<section class="contact-from">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="sec-head">Contact Us</h2>
                @if($getabout->mobile != "")
                    <a href="tel:{{$getabout->mobile}}" class="contact-box">
                        <i class="fas fa-phone-alt"></i>
                        <p>{{$getabout->mobile}}</p>
                    </a>
                @endif

                @if($getabout->email != "")
                    <a href="mailto:{{$getabout->email}}" class="contact-box">
                        <i class="fas fa-envelope"></i>
                        <p>{{$getabout->email}}</p>
                    </a>
                @endif

                @if($getabout->address != "")
                    <div class="contact-box">
                        <i class="fas fa-home"></i>
                        <p>{{$getabout->address}}</p>
                    </div>
                @endif
            </div>
            <div class="col-lg-6">
                <form class="contact-form" id="contactform" method="post">
                    {{csrf_field()}}
                    <input type="text" name="firstname" placeholder="First Name*" id="firstname" required="">
                    <input type="text" name="lastname" placeholder="Last Name*" id="lastname" required="">
                    <input type="email" name="email" placeholder="Email*" id="email" required="">
                    <textarea name="message" placeholder="Message" id="message" required=""></textarea>
                    <button type="button" name="submit" class="btn" onclick="contact()">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>

@include('front.theme.footer')