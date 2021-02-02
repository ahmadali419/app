<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Auth;
use App\Cart;
use App\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Redirect;
use validate;
use Hash;
use Session;


class SubsRequestController extends Controller
{
    public function index()
    {
        $requests = DB::table('subscription_request')
        ->select('users.name', 'users.email', 'users.mobile', 'subscription_request.id', 'subscription_request.created_at',
                 'item.item_name', 'item.item_description','item.item_price', 'item.delivery_time')
        ->leftjoin('users', 'subscription_request.user_id', '=', 'users.id')
        ->leftjoin('item', 'subscription_request.product_id', '=', 'item.id')
        ->where('action', 0)
        ->orderByDesc('subscription_request.id')
        ->get();
        // dd($requests);
        return view('subs_requests', compact('requests'));
    }
    
    public function requestApprove($requestId)
    {
        DB::table('subscription_request')->where('id', $requestId)->update(['action'=> 1, 'status'=>"Request Approved"]);
        $request = DB::table('subscription_request')->where('id', $requestId)->get()->first();
        $product = item::find($request->product_id);
        
        $cart = new Cart;
        $cart->item_id =$product->id;
        $cart->addons_id =null;
        $cart->qty = 1;
        $cart->price =$product->item_price;
        $cart->user_id =$request->user_id;
        $cart->item_notes ='';
        $cart->save();
        
        return Redirect::back()->with('message','Subscription request has been approved ');
    }

}
