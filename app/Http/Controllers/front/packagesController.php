<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Package;
use App\PackageCategory;
use Validator;
class PackagesController extends Controller
{
    
    public function index()
    {
        return view('packages');
    }
    public function show(Request $request)
    {
   echo "yes";
        
       print_r($request);exit;
    }

    public function status(Request $request)
    {
        $package = Package::where('package_id', $request->id)->update( array('is_available'=>$request->status) );
        if ($package) {
            // $item = Item::where('cat_id', $request->id)->update( array('item_status'=>$request->status) );
            // $getitem = Item::where('cat_id', $request->id)->first();
            // $UpdateCart = Cart::where('item_id', @$getitem->id)
            //             ->update(['is_available' => $request->status]);
            return 1;
        } else {
            return 0;
        }
    }
}
