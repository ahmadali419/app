@include('front.theme.header')

<section class="product-details-sec">
    <div class="container">
        @foreach($packages as $detail)
        @php $flag = 0; @endphp
       <div class="row">
           <div class="col-md-12">
           <h3 class=" mb-4">{{ucfirst($detail->package_name)}}</h3>
           </div>
       </div>
        <div class="row">
            <div class="col-md-4">
            <a href="{{URL::to('package-details/'.$detail->package_id)}}" class="mb-5 pb-5">
                                <img src='{!! asset("public/images/packages/".$detail->image) !!}' alt="">

                                </a>
                               <div class="mt-4">
                               <span class="mt-5">
                                 {{$detail->package_description}}
                                </span>
                                 <span class="float-right">Package Validity: <b>{{$detail->package_validity}} days</b></span>
                               </div>
                                 <div class="row mt-4">
                                     <div class="col-md-12">
                                      <p class="pro-pricing"><?php echo env('CURRENCY'); ?>Package Amount: <span id="price">{{number_format($detail->package_amount, 2)}}</span></p>
                                     </div>
                                 </div>
            </div>
            <div class="col-md-8">
              <h3 class="text-center mb-3">Food Information</h3>
            @foreach($detail->categories as $category)
            <div class="row">
                  <div class="col-md-3 mb-3">
                  <div class="row">
                      <div class="col-2">
                      <span class="">   <input type="checkbox" name="foodItem[]" class="Checkbox" value="{{$category->category_id}}"></span>
                      </div>
                 
               
               
                             <div class="col-8">
                             
                             <span class="float-right">
                              <img src='{!! asset("public/images/packages/".$category->item_image) !!}' alt="">
                              </span>
                             </div>

                     </div>        
                  </div>
                  <div class="col-md-6">
                   <span><b>{{ucfirst($category->food_name)}}</b></span>
                   <span class="float-right">{{$category->food_description}}</span>
            </div>
              </div>
            @endforeach
            </div>
           
        </div>
        <textarea id="item_notes" name="item_notes" placeholder="Write Notes..."></textarea>
        <div class="product-details">
                                        <?php $Date =date('Y-m-d'); ?>
                                 
                                    @foreach($subsRequest as $request)
                                     @if (Session::get('id'))
                                    
                                        @if($request->action == 0 && $request->product_id == $detail->package_id)    
                                        @php $flag = 1; @endphp
                                        <button class="btn" disabled>Subscribe Request Pending</button>
                                        
                                        @elseif($request->action == 1 && $request->product_id == $detail->package_id  && $request->end_date >= $Date)
                                        @php $flag = 1; @endphp
                                        <?php //echo $Date.'End date'.$request->end_date;?>
                                        <button class="btn"  onclick="AddtoCart('{{$detail->package_id}}','{{Session::get('id')}}')">Add to Cart</button>
                                        
                                        @elseif($request->action == 2 && $request->product_id == $detail->package_id)
                                        @php $flag = 1; @endphp
                                        <p class="label label-danger"><small>*Your Subscription request has been decline.</small></p>
                                        <a class="btn" disable href="{{URL::to('/package/subscribe')}}/{{$detail->id}}/{{$detail->package_validity}}">Subscribe Again</a>
                                        
                                        @elseif($request->product_id == $detail->id && $request->action == 3)
                                        @php $flag = 1; @endphp
                                       <a href="{{URL::to('/package/subscribe')}}/{{$detail->package_id}}/{{$detail->package_validity}}">Subscribe</a>
                                        
                                        @elseif($request->action == 1 && $request->product_id == $detail->package_id && $request->end_date < $Date)
                                        @php $flag = 1; @endphp
                                       <a class="btn btn-success" href="{{URL::to('/package/subscribe')}}/{{$detail->package_id}}/{{$detail->package_validity}}">Subscribe Again</a>
                                        @endif
                                        
                                    @else
                                        <a class="btn" href="{{URL::to('/signin')}}">Subscribe</a>
                                    @endif 
                                    @endforeach
                                    
                                    @if($flag == 0)
                                    <a class="btn" href="{{URL::to('/package/subscribe')}}/{{$detail->package_id}}/{{$detail->package_validity}}">Subscribe</a>
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