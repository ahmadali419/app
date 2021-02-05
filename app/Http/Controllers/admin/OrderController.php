<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Order;
use App\Item;
use App\Addons;
use App\User;
use App\OrderDetails;
use App\Package;


use Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getorders = Order::with('users')->select('order.*','users.name')->leftJoin('users', 'order.driver_id', '=', 'users.id')->where('order.created_at','LIKE','%' .date("Y-m-d") . '%')->get();
       
        $getdriver = User::where('type','3')->get();
        // dd($getorders);
        return view('orders',compact('getorders','getdriver'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function invoice(Request $request)
    {
        $getusers = Order::with('users')->where('order.id', $request->id)->get()->first();
        $getorders = $getusers->join('order','order.id','=','order.id')
         ->join('order_detail as od','od.order_id','=','order.id')
         ->select('od.*')
         ->get();

        // $getorders=Order::with('orderDetail')->withCount("orderDetail")->get();
        // $getpackages = OrderDetails::with('packages')
        // ->join('packages','order_details.item_id','=','packages.package_id')
        // ->join('order','order_details.order_id','=','order.id')
        // ->where('order_details.order_id',$request->id)->get();
        // $getabout = About::where('id','=','1')->first();
    //    echo "<pre>"; print_r($getorders);exit;
    //     $getorders=OrderDetails::with('packages')->select('order_details.id',DB::raw('DATE_FORMAT(order_details.created_at, "%d %M %Y") as date'),'packages.package_name','order_details.addons_id','packages.package_name','packages.package_amount')
    //     ->join('packages','order_details.item_id','=','packages.package_id')
    //     // ->join('order','order_details.order_id','=','order.id')
    //     ->where('order_details.order_id',$request->id)->get();
    //   dd($getorders->toArray());
        if(count($getorders) == 0){ 
            abort(404); 
        } else {
            foreach ($getorders as $value) {
               $arr = explode(',', $value['addons_id']);
               $value['addons']=Addons::whereIn('id',$arr)->get();
            };
        }

        return view('invoice',compact('getorders','getusers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $UpdateDetails = Order::where('id', $request->id)
                    ->update(['status' => $request->status]);

        //Notification
        $userdetails = Order::where('id', $request->id)->first();

        
        $getalluses=User::select('token','email','name')->where('id',$userdetails->user_id)
        ->get()->first();

        $title = "Order";

        if ($request->status == "2") {
            $body = 'Your Order '.$userdetails->order_number.' is Ready';
            $ordermessage='Your Order "'.$userdetails->order_number.'" is Ready';
        } else {
            $body = 'Your Order '.$userdetails->order_number.' is Delivered';
            $ordermessage='Your Order "'.$userdetails->order_number.'" is Delivered'; 
        }

        try{
            $email=$getalluses->email;
            $name=$getalluses->name;
            $data=['ordermessage'=>$ordermessage,'email'=>$email,'name'=>$name];

            Mail::send('Email.orderemail',$data,function($message)use($data){
                $message->from(env('MAIL_USERNAME'))->subject($data['ordermessage']);
                $message->to($data['email']);
            } );
        }catch(\Swift_TransportException $e){
            $response = $e->getMessage() ;
            // return Redirect::back()->with('danger', $response);
            return 0;
        }
        
        $google_api_key = env('FIREBASE');
        
        $registrationIds = $getalluses->token;
        #prep the bundle
        $msg = array
            (
            'body'  => $body,
            'title' => $title,
            'sound' => 1/*Default sound*/
            );
            
        $fields = array
            (
            'to'            => $registrationIds,
            'notification'  => $msg
            );

        $headers = array
            (
            'Authorization: key=' . $google_api_key,
            'Content-Type: application/json'
            );
        #Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        
        $result = curl_exec ( $ch );
        // dd($result);
        curl_close ( $ch );

        if ($UpdateDetails) {
            return 2;
        } else {
            return 0;
        }
    }

    public function assign(Request $request)
    {
        $UpdateDetails = Order::where('id', $request->bookId)
                    ->update(['driver_id' => $request->driver_id,'status' => '3']);

        $userdetails = Order::where('id', $request->bookId)->first();

        $google_api_key = env('FIREBASE');

        $title = "Order";

        if ($userdetails->driver_id) {

            $gettoken=User::select('token','name','email')->where('id',$userdetails->driver_id)
            ->get()->first();

            $body = 'New Order '.$userdetails->order_number.' assigned to you';


            try{
                $ordermessage='New Order "'.$userdetails->order_number.'" assigned to you';
                $email=$gettoken->email;
                $name=$gettoken->name;
                $data=['ordermessage'=>$ordermessage,'email'=>$email,'name'=>$name];

                Mail::send('Email.orderemail',$data,function($message)use($data){
                    $message->from(env('MAIL_USERNAME'))->subject($data['ordermessage']);
                    $message->to($data['email']);
                } );
            }catch(\Swift_TransportException $e){
                $response = $e->getMessage() ;
                // return Redirect::back()->with('danger', $response);
                return 0;
            }

            $registrationIds = $gettoken->token;
            #prep the bundle
            $msg = array
                (
                'body'  => $body,
                'title' => $title,
                'sound' => 1/*Default sound*/
                );
                
            $fields = array
                (
                'to'            => $registrationIds,
                'notification'  => $msg
                );

            $headers = array
                (
                'Authorization: key=' . $google_api_key,
                'Content-Type: application/json'
                );
            #Send Reponse To FireBase Server
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
            $result = curl_exec ( $ch );
            curl_close ( $ch );
        }

        if ($userdetails->user_id) {
            $gettoken=User::select('token','name','email')->where('id',$userdetails->user_id)
            ->get()->first();

            $body = 'Your Order '.$userdetails->order_number.' is on the way';

            try{
                $ordermessage='Your Order "'.$userdetails->order_number.'" is on the way';
                $email=$gettoken->email;
                $name=$gettoken->name;
                $data=['ordermessage'=>$ordermessage,'email'=>$email,'name'=>$name];

                Mail::send('Email.orderemail',$data,function($message)use($data){
                    $message->from(env('MAIL_USERNAME'))->subject($data['ordermessage']);
                    $message->to($data['email']);
                } );
            }catch(\Swift_TransportException $e){
                $response = $e->getMessage() ;
                // return Redirect::back()->with('danger', $response);
                return 0;
            }

            $registrationIds = $gettoken->token;
            #prep the bundle
            $msg = array
                (
                'body'  => $body,
                'title' => $title,
                'sound' => 1/*Default sound*/
                );
                
            $fields = array
                (
                'to'            => $registrationIds,
                'notification'  => $msg
                );

            $headers = array
                (
                'Authorization: key=' . $google_api_key,
                'Content-Type: application/json'
                );
            #Send Reponse To FireBase Server
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );

            $result = curl_exec ( $ch );
            curl_close ( $ch );
        }

        if ($UpdateDetails) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $order=Order::where('id', $request->id)->delete();
        $delete=OrderDetails::where('order_id', $request->id)->delete();
        if ($order) {
            return 1;
        } else {
            return 0;
        }
    }
}
