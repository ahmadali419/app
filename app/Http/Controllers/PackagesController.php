<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Package;
use App\PackageCategory;
use App\About;
use Session;
use Validator;
class PackagesController extends Controller
{
    
    public function index()
    {
        return view('packages');
    }
    public function show(Request $request)
    {
        $getpackages = Package::where('is_available','=','0')->get();
        $getpackage = Package::where(['package_id'=>$request->id,'is_available'=>0])->get();
        

       
        $getabout = About::where('id','=','1')->first();
        $user_id  = Session::get('id');
        $subsRequest = DB::table('subscription_request')->where('user_id',Session::get('id'))->get();
 
        return view('front.packages', compact('getpackages','getpackage','getabout','subsRequest'));
       
                // print_r($getabout);exit;

   echo "yes";
        
       print_r($request->id);exit;
    }

    public function packageDetails(Request $request)
    {

        $user_id  = Session::get('id');
        $getabout = About::where('id', '=', '1')->first();
        $packages = Package::with("categories")->where(['package_id'=>$request->id])->get();
        // dd($packages->toArray());
        // $getPackage = Package::where('package_id',$request->id)->first();
        // $getPackageDetail = DB::table('packages as p')
        //     ->join('package_category as pc', 'p.package_id', '=', 'pc.package_id')
        //     ->select('pc.*', 'p.*')
        //     ->where(['p.package_id'=>$request->id,'pc.package_id'=>$request->id])
        //     ->get();
        $subsRequest = DB::table('subscription_request')->where('user_id',Session::get('id'))->get();

            return view('front.package-details', compact('packages', 'getabout','subsRequest'));

    //    echo "<pre>"; dd($getPackageDetail);exit;
       
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
