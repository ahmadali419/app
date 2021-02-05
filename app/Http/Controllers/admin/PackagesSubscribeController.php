<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Package;
use App\SubscribePackage;
use App\PackageCategory;
use App\User;
use App\Item;
use App\Category;



// use App\Package;
use Validator;
class PackagesSubscribeController extends Controller
{
    //
    public function index()
    {
      $getPackage   =   new Package;    
      $users              = new User;           
        $item            =       new Item;
    //   print_r($users);exit;
      $getpackages = $getPackage->join('subscription_request as sr', 'sr.user_id','=','sr.user_id')
      ->join('users as u','u.id','=','sr.user_id')
      ->join('package_category as ps','ps.package_id','=','sr.product_id')
      ->select('sr.*', 'u.*','ps.*')
      ->where('sr.action',0)
      ->get();
     return view('theme.subscribePackage');  
    }
   public function list()
   {
    $today = date("Y-m-d H:i:s"); 
    $getPackage   =   new SubscribePackage;    
    $users              = new User;           
      $item            =       new Item;
      $category            =       new Category;

  //   print_r($users);exit;
    $getSubscribepackages = $getPackage->join('subscription_request as sr', 'sr.user_id','=','sr.user_id')
    ->join('users as u','u.id','=','sr.user_id')
    ->join('packages as p','p.package_id','=','sr.product_id')
    ->select('sr.*', 'u.*','p.*')
    ->orderBy('sr.id', 'asc')
    ->groupBy('sr.id')
    ->get();

    // ->groupBy('sr.user_id')
  
    // echo "<pre>";print_r($getSubscribepackages);exit;    
    return view('theme.packageSubscribetable',compact('getSubscribepackages'));
   }
   public function update(Request $request)
   {
       if($request->status=='Request Approved')
       {
        $package = SubscribePackage::where(['product_id'=> $request->id,'user_id'=>$request->user_id])->update(array('status'=>$request->status,'action'=>'1'));
    if ($package) {
       
        
        return 1;
    } else {
        return 0;
    }
       }
      if($request->status=='Request initiate')
      {
        $package = SubscribePackage::where(['product_id'=> $request->id,'user_id'=>$request->user_id])->update(array('status'=>$request->status,'action'=>'0'));
    if ($package) {
       
        
        return 1;
    } else {
        return 0;
    }

      }
   

   }
   public function status(Request $request)
   {
    //  print_r($request->user_id);exit;
       $package = SubscribePackage::where(['product_id'=>$request->id,'user_id'=>$request->user_id])->update( array('action'=>$request->status,'status'=>'Request Declined'));
       if ($package) {
          
           return 1;
       } else {
           return 0;
       }
   }
}
