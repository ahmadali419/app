@include('front.theme.header')

<section class="product-details-sec">
    <div class="container">
        @foreach($packages as $detail)
        @php $flag = 0; @endphp
       <div class="row">
           <div class="col-md-12">
           <h3 class="text-center mb-4">{{ucfirst($detail->package_name)}}</h3>
           </div>
       </div>
        <div class="row">
            <div class="col-md-4">
            <a href="{{URL::to('package-details/'.$detail->package_id)}}">
                                <img src='{!! asset("public/images/packages/".$detail->image) !!}' alt="">

                                </a>
                                <span class="mt-2">
                                 {{$detail->package_description}}
                                </span>
                                 <span class="float-right">Package Validity: <b>{{$detail->package_validity}} days</b></span>
                                 <div class="row mt-4">
                                     <div class="col-md-12">
                                      <p class="pro-pricing"><?php echo env('CURRENCY'); ?>Package Amount: {{number_format($detail->package_amount, 2)}}</p>
                                     </div>
                                 </div>
            </div>
            <div class="col-md-8">
              <h3 class="text-center mb-3">Food Information</h3>
            @foreach($detail->categories as $category)
            <div class="row">
                  <div class="col-md-3">
                  <a href="#">
                                <img src='{!! asset("public/images/packages/".$category->item_image) !!}' alt="">

                                </a>
                  </div>
                  <div class="col-md-6">
                   <span >{{ucfirst($category->food_name)}}</span>
                   <span class="float-right">{{$category->food_description}}</span>
            </div>
              </div>
            @endforeach
            </div>
           
        </div>
      
        <div class="product-details">
                                        <?php $Date =date('Y-m-d'); ?>
                                 
                                    @foreach($subsRequest as $request)
                                     @if (Session::get('id'))
                                    
                                        @if($request->action == 0 && $request->product_id == $detail->package_id)    
                                        @php $flag = 1; @endphp
                                        <button class="btn" disabled>Subscribe Request Pending</button>
                                        
                                        @elseif($request->action == 1 && $request->product_id == $detail->package_id)
                                        @php $flag = 1; @endphp
                                        <!-- <a class="btn" href="{{URL::to('/cart')}}">Check Out</a> -->
                                        
                                        @elseif($request->action == 2 && $request->product_id == $detail->package_id)
                                        @php $flag = 1; @endphp
                                        <p class="label label-danger"><small>*Your Subscription request has been decline.</small></p>
                                        <a class="btn" disable href="{{URL::to('/product/subscribe')}}/{{$item->id}}/{{$item->days}}">Subscribe Again</a>
                                        
                                        @elseif($request->product_id == $detail->id && $request->action == 3)
                                        @php $flag = 1; @endphp
                                       <a href="{{URL::to('/product/subscribe')}}/{{$item->id}}/{{$item->days}}">Subscribe</a>
                                        
                                        @elseif($request->product_id == $detail->package_id && $request->end_date < $Date)
                                        @php $flag = 1; @endphp
                                       <a href="{{URL::to('/product/subscribe')}}/{{$item->id}}/{{$item->days}}">Subscribe Again</a>
                                        @endif
                                        
                                    @else
                                        <a class="btn" href="{{URL::to('/signin')}}">Subscribe</a>
                                    @endif 
                                    @endforeach
                                    
                                    @if($flag == 0)
                                    <a class="btn" href="{{URL::to('/product/subscribe')}}/{{$detail->package_id}}/{{$detail->package_validity}}">Subscribe</a>
                                    @endif
                                </div>  
          
        @endforeach
        <div class="row">
        <div class="col-md-2">
     <span>
   
        </div>
        </div>
    </div>
    </div>
</section>

@include('front.theme.footer')
<script type="text/javascript">
var total = parseInt($("#price").val());

$('input[type="checkbox"]').change(function() {
    if ($(this).is(':checked')) {
        total += parseFloat($(this).attr('price')) || 0;
    } else {
        total -= parseFloat($(this).attr('price')) || 0;
    }
    $('p.pricing').text('$' + total.toFixed(2));
    $('#price').val(total.toFixed(2));
})
</script>