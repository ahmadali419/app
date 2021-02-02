<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\OrderDetails;
use App\Order;
use App\About;
use App\User;
use App\Cart;
use App\item;
use App\Addons;
use App\Promocode;
use App\Pincode;
use Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $getabout = About::where('id','=','1')->first();
        $orderdata=OrderDetails::select('order.order_total as total_price',DB::raw('SUM(order_details.qty) AS qty'),'order.id',DB::raw('DATE_FORMAT(order.created_at, "%d %M %Y") as date'),'order.order_number','order.status','order.payment_type')
        ->join('item','order_details.item_id','=','item.id')
        ->join('order','order_details.order_id','=','order.id')
        ->where('order.user_id',Session::get('id'))->groupBy('order_details.order_id')->orderby('order.id','desc')->paginate(9);

        return view('front.orders',compact('orderdata','getabout'));
    }

    public function orderdetails(Request $request) {
        $getabout = About::where('id','=','1')->first();
        $orderdata=OrderDetails::with('itemimage')->select('order_details.id','order_details.qty','order_details.price as total_price','item.id','item.item_name','item.item_price','order_details.item_id','order_details.addons_id','order_details.item_notes')
        ->join('item','order_details.item_id','=','item.id')
        ->join('order','order_details.order_id','=','order.id')
        ->where('order_details.order_id',$request->id)->get();

        if(count($orderdata) == 0){ 
            abort(404); 
        } else {
            foreach ($orderdata as $value) {
               $arr = explode(',', $value['addons_id']);
               $value['addons']=Addons::whereIn('id',$arr)->get();
            };
            
            $status=Order::select('order.driver_id','order.order_number',DB::raw('DATE_FORMAT(order.created_at, "%d %M %Y") as date'),'order.address','order.building','order.landmark','order.pincode','order.order_type','order.promocode','order.discount_amount','order.order_number','order.status','order.order_notes','order.tax','order.tax_amount','order.delivery_charge')->where('order.id',$request->id)
            ->get()->first();

            $getdriver=User::select('users.name',\DB::raw("CONCAT('".url('/public/images/profile/')."/', users.profile_image) AS profile_image"),'users.mobile')->where('users.id',$status->driver_id)
            ->get()->first();

            if (@$getdriver["name"] == "") {
                $drivername = "";
                $driverprofile_image = "";
                $drivermobile = "";
            } else {
                $drivername = $getdriver["name"];
                $driverprofile_image = $getdriver["profile_image"];
                $drivermobile = $getdriver["mobile"];
            }

            $summery = array(
                'tax' => "$status->tax",
                'tax_amount' => "$status->tax_amount",
                'discount_amount' => $status->discount_amount,
                'order_number' => $status->order_number,
                'created_at' => $status->date,
                'promocode' => $status->promocode,
                'delivery_charge' => "$status->delivery_charge",
                'address' => $status->address,
                'building' => $status->building,
                'landmark' => $status->landmark,
                'pincode' => $status->pincode,
                'order_notes' => $status->order_notes,
                'status' => $status->status,
                'order_type' => $status->order_type,
                'driver_name' => $drivername,
                'driver_profile_image' => $driverprofile_image,
                'driver_mobile' => $drivermobile,
            );
        }

        return view('front.order-details',compact('orderdata','summery','getabout'));
    }

    public function cashondelivery(Request $request)
    {
        if ($request->order_type == "1") {
            if($request->address == ""){
                return response()->json(["status"=>0,"message"=>"Address is required"],200);
            }

            if($request->lat == ""){
                return response()->json(["status"=>0,"message"=>"Please select the address from suggestion"],200);
            }

            if($request->lang == ""){
                return response()->json(["status"=>0,"message"=>"Please select the address from suggestion"],200);
            }

            if($request->postal_code == ""){
                return response()->json(["status"=>0,"message"=>"Pincode is required"],200);
            }

            if($request->building == ""){
                return response()->json(["status"=>0,"message"=>"Door / Flat No. is required"],200);
            }

            if($request->landmark == ""){
                return response()->json(["status"=>0,"message"=>"Landmark is required"],200);
            }
        } 

        $getuserdata=User::where('id',Session::get('id'))
        ->get()->first(); 

        $getdata=User::select('min_order_amount','max_order_amount')->where('type','1')
        ->get()->first();

        if ($request->discount_amount == "NaN") {
            $discount_amount = "0.00";
        } else {
            $discount_amount = $request->discount_amount;
        }     

        try {

            if ($request->order_type == "2") {

                $order_number = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 10)), 0, 10);

                if ($request->order_type == "2") {
                    $delivery_charge = "0.00";
                    $address = "";
                    $lat = "";
                    $lang = "";
                    $building = "";
                    $landmark = "";
                    $postal_code = "";
                    $order_total = $request->order_total-$request->$delivery_charge;
                } else {
                    $delivery_charge = $request->delivery_charge;
                    $address = $request->address;
                    $lat = $request->lat;
                    $lang = $request->lang;
                    $order_total = $request->order_total;
                    $building = $request->building;
                    $landmark = $request->landmark;
                    $postal_code = $request->postal_code;
                }

                if ($getdata->min_order_amount > $request->total_order) {
                    return response()->json(['status'=>0,'message'=>"Order amount must be between ".env('CURRENCY')."".$getdata->min_order_amount." and ".env('CURRENCY')."".$getdata->max_order_amount.""],200);
                }

                if ($getdata->max_order_amount < $request->total_order) {
                    return response()->json(['status'=>0,'message'=>"Order amount must be between ".env('CURRENCY')."".$getdata->min_order_amount." and ".env('CURRENCY')."".$getdata->max_order_amount.""],200);
                }

                $order = new Order;
                $order->order_number =$order_number;
                $order->user_id =Session::get('id');
                $order->order_total =$order_total;
                $order->payment_type ='0';
                $order->status ='1';
                $order->address =$address;
                $order->promocode =$request->promocode;
                $order->discount_amount =$discount_amount;
                $order->discount_pr =$request->discount_pr;
                $order->tax =$request->tax;
                $order->tax_amount =$request->tax_amount;
                $order->delivery_charge =$delivery_charge;
                $order->order_type =$request->order_type;
                $order->lat =$lat;
                $order->lang =$lang;
                $order->building =$building;
                $order->landmark =$landmark;
                $order->pincode =$postal_code;
                $order->order_notes =$request->notes;
                $order->order_from ='web';

                $order->save();

                $order_id = DB::getPdo()->lastInsertId();
                $data=Cart::where('cart.user_id',Session::get('id'))
                ->get();
                foreach ($data as $value) 
                {
                    $OrderPro = new OrderDetails;
                    $OrderPro->order_id = $order_id;
                    $OrderPro->user_id = $value['user_id'];
                    $OrderPro->item_id = $value['item_id'];
                    $OrderPro->price = $value['price'];
                    $OrderPro->qty = $value['qty'];
                    $OrderPro->item_notes = $value['item_notes'];
                    $OrderPro->addons_id = $value['addons_id'];
                    $OrderPro->save();
                    
                    $product = DB::table('item')->select('meals', 'days')->where('id',  $value['item_id'])->get()->first();
                    $days        = $product->days;
                    $mealsPerDay = $product->meals;
                    $dt          = Carbon::now();
                    
                    for($i=0; $i<$days; $i++)
                    {
                        for($j=1; $j<=$mealsPerDay; $j++)
                        {
                            $validityDate = $dt->addDays($j);
                            DB::table(meals)->insert(['user_id'=>$value['user_id'], 'product_id'=>$value['item_id'], 'validity_period'=>$validityDate, 'action'=>0, 'status'=>'Not Availed',]);    
                        }
                        
                    }
                    
                    DB::table('subscription_request')->where([['user_id', $value['user_id']],['product_id', $value['item_id']],['action', 1] ])->update(['action'=>3, 'status'=>"Oder Placed"]);
                }//end foreach
                
                $cart=Cart::where('user_id', Session::get('id'))->delete();

                $count=Cart::where('user_id',Session::get('id'))->count();

                try{
                    $ordermessage='Order "'.$order_number.'" has been placed';
                    $email=$getuserdata->email;
                    $name=$getuserdata->name;
                    $data=['ordermessage'=>$ordermessage,'email'=>$email,'name'=>$name];

                    Mail::send('Email.orderemail',$data,function($message)use($data){
                        $message->from(env('MAIL_USERNAME'))->subject($data['ordermessage']);
                        $message->to($data['email']);
                    } );
                }catch(\Swift_TransportException $e){
                    $response = $e->getMessage() ;
                    return response()->json(['status'=>0,'message'=>'Something went wrong while sending email Please try again...'],200);
                }
                
                Session::put('cart', $count);

                session()->forget(['offer_amount','offer_code']);
                
                return response()->json(['status'=>1,'message'=>'Order has been placed'],200);
            } else {
                $pincode=Pincode::select('pincode')->where('pincode',$request->postal_code)
                ->get()->first();

                if(@$pincode['pincode'] == $request->postal_code) {
                    if(!empty($pincode))
                    {
                        $order_number = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 10)), 0, 10);

                        if ($request->order_type == "2") {
                            $delivery_charge = "0.00";
                            $address = "";
                            $lat = "";
                            $lang = "";
                            $building = "";
                            $landmark = "";
                            $postal_code = "";
                            $order_total = $request->order_total-$request->$delivery_charge;
                        } else {
                            $delivery_charge = $request->delivery_charge;
                            $address = $request->address;
                            $lat = $request->lat;
                            $lang = $request->lang;
                            $order_total = $request->order_total;
                            $building = $request->building;
                            $landmark = $request->landmark;
                            $postal_code = $request->postal_code;
                        }

                        if ($getdata->min_order_amount > $request->total_order) {
                            return response()->json(['status'=>0,'message'=>"Order amount must be between ".env('CURRENCY')."".$getdata->min_order_amount." and ".env('CURRENCY')."".$getdata->max_order_amount.""],200);
                        }

                        if ($getdata->max_order_amount < $request->total_order) {
                            return response()->json(['status'=>0,'message'=>"Order amount must be between ".env('CURRENCY')."".$getdata->min_order_amount." and ".env('CURRENCY')."".$getdata->max_order_amount.""],200);
                        }
                            $order = Order::where(['user_id'=>Session::get('id')])->whereRaw('DATE(created_at)',$Date);
                            print_r($order);exit;
                            if($count>=2)
                            {
                                return response()->json(['status'=>0,'message'=>'You cannot order today...'],200);

                            }
                            
                            // $order->join('order as o','order.user_id','=','0.user_id')
                            //      ->join('order_details as od','')
                        $count = OrderDetails::where(['user_id'=>Session::get('id'),'item_id'=>$getitem->id])->whereRaw('DATE(created_at)',$Date)->count();
                        $order = new Order;
                        $order->order_number =$order_number;
                        $order->user_id =Session::get('id');
                        $order->order_total =$order_total;
                        $order->payment_type ='0';
                        $order->status ='1';
                        $order->address =$address;
                        $order->promocode =$request->promocode;
                        $order->discount_amount =$discount_amount;
                        $order->discount_pr =$request->discount_pr;
                        $order->tax =$request->tax;
                        $order->tax_amount =$request->tax_amount;
                        $order->delivery_charge =$delivery_charge;
                        $order->order_type =$request->order_type;
                        $order->lat =$lat;
                        $order->lang =$lang;
                        $order->building =$building;
                        $order->landmark =$landmark;
                        $order->pincode =$postal_code;
                        $order->order_notes =$request->notes;
                        $order->order_from ='web';

                        $order->save();

                        $order_id = DB::getPdo()->lastInsertId();
                        $data=Cart::where('cart.user_id',Session::get('id'))
                        ->get();
                        foreach ($data as $value) 
                        {
                            $userId = $value['user_id'];
                            $itemId = $value['item_id'];
                            
                            $OrderPro = new OrderDetails;
                            $OrderPro->order_id = $order_id;
                            $OrderPro->user_id = $userId;
                            $OrderPro->item_id = $itemId;
                            $OrderPro->price = $value['price'];
                            $OrderPro->qty = $value['qty'];
                            $OrderPro->item_notes = $value['item_notes'];
                            $OrderPro->addons_id = $value['addons_id'];
                            $OrderPro->save();
                            
                            
                            
                            // $product = item::find(8);
                            
                            // $days        = $product->days;
                            // $mealsPerDay = $product->meals;
                            // $dt          = Carbon::now();
                    
                            // for($i=1; $i<=$days; $i++)
                            // {
                            //     for($j=1; $j<=$mealsPerDay; $j++)
                            //     {
                            //         $validityDate = $dt->addDays($i);
                                    
                            //         DB::table(meals)->insert([
                            //             'user_id'=>$userId,
                            //             'product_id'=>$itemId,
                            //             'validity_period'=>$validityDate,
                            //             'action'=>0,
                            //             'status'=>"Not Availed"]);    
                            //     }
                            // }
                            
                            // DB::table('subscription_request')->where([['user_id', $userId],['product_id', $itemId],['action', 1] ])->update(['action'=>3, 'status'=>"Oder Placed"]);
                            
                        }
                        $cart=Cart::where('user_id', Session::get('id'))->delete();

                        $count=Cart::where('user_id',Session::get('id'))->count();

                        try{
                            $ordermessage='Order "'.$order_number.'" has been placed';
                            $email=$getuserdata->email;
                            $name=$getuserdata->name;
                            $data=['ordermessage'=>$ordermessage,'email'=>$email,'name'=>$name];

                            Mail::send('Email.orderemail',$data,function($message)use($data){
                                $message->from(env('MAIL_USERNAME'))->subject($data['ordermessage']);
                                $message->to($data['email']);
                            } );
                        }catch(\Swift_TransportException $e){
                            $response = $e->getMessage() ;
                            return response()->json(['status'=>0,'message'=>'Something went wrong while sending email Please try again...'],200);
                        }
                        
                        Session::put('cart', $count);

                        session()->forget(['offer_amount','offer_code']);
                        
                        return response()->json(['status'=>1,'message'=>'Order has been placed'],200);
                    }
                } else {
                    return response()->json(['status'=>0,'message'=>'Delivery is not available in your area'],200);
                }
            }
            

        } catch (\Exception $e) {
            return  $e->getMessage();
            \Session::put('error',$e->getMessage());
            return redirect()->back();
        }
    }
}
