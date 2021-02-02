<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Package;
use App\PackageCategory;
// use App\Package;
use Validator;
class PackagesController extends Controller
{
    //
    public function index()
    {
        return view('theme.packages');    
    }
    public function store(Request $request)
    {

        
        // print_r($request->package_name);exit;
        $validation = Validator::make($request->all(),[
            'package_name' => ['required'],
            'package_validity' => ['required'],
            'meals'=> ['required'],
            'package_amount'=> ['required'],

            // 'food_category'=> ['required'],
            'food_name'=> ['required'],
            'food_price'=> ['required'],
            'description'=> ['required'],          
            // 'food_image'=>'required|image|mimes:jpeg,png,jpg',
            'image'=>'required|image|mimes:jpeg,png,jpg',
        ]);
        $error_array = array();
        $success_output = '';
        if ($validation->fails())
        {
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }
        else
        {
            $image = 'package-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('public/images/packages', $image);
            $package = new Package;
            $package->image =$image;
            $package->package_name =htmlspecialchars($request->package_name, ENT_QUOTES, 'UTF-8');
            $package->package_validity =htmlspecialchars($request->package_validity, ENT_QUOTES, 'UTF-8');
            $package->meals =htmlspecialchars($request->meals, ENT_QUOTES, 'UTF-8');
            $package->package_amount =htmlspecialchars($request->package_amount, ENT_QUOTES, 'UTF-8');
            $package->package_description =htmlspecialchars($request->description, ENT_QUOTES, 'UTF-8');


            //   = $package->food_name;
            // print_r($package->package_name );exit;
                //  $package->save();
                //   print_r($package->save()->);exit;
            if ($package->save()) {
                // print_r($package->id);exit;
            //    dd($package_id);exit;
               if($package->id)
               {

                $category  = new PackageCategory;
                // print_r($category);exit; 
            $category->food_category = $request->food_category;
            // print_r($category->food_category);exit;
            
            
                   
                $itemdata=array();
                foreach ($request->food_category as $key => $value)
                {
                    $image = 'package-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
                   $request->food_image[$key]->move('public/images/packages', $image);
                   $category->image =$image;
                    $itemdata[]=array(
                        'package_id'=>$package->id, 
                        'food_category'=>$value,
                        'food_name'=>$request->food_name[$key],
                        'food_amount'=>$request->food_price[$key],
                        'image'=>$category->image,
                        // 'Amount'=>$amount[$key],
    
                    );	
                }
                // print_r($itemdata);exit;
                   
                    $category::insert($itemdata);

               }
            }
            $success_output = 'Package Added Successfully!';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }
    public function list()
    {
        $getpackages =   new Package;
        $category    =   PackageCategory::all();
        // print_r($category);exit;
        $getpackages = $getpackages->join('packages as p', 'p.package_id','=','p.package_id')
        ->join('package_category as ps','ps.package_id','=','p.package_id')
        ->select('p.*', 'ps.*')
        ->groupBy('p.package_id')
        ->where('p.is_available','1')
->get();

    //    echo "<pre>"; print_r( $getpackage);exit;
        return view('theme.packagetable',compact('getpackages'));
    }
    public function status(Request $request)
    {
        $package = Package::where('package_id', $request->id)->update( array('is_available'=>$request->status) );
        if ($package) {
            $item = PackageCategory::where('package_id', $request->id)->update( array('item_status'=>$request->status) );
            // $getitem = Item::where('cat_id', $request->id)->first();
            // $UpdateCart = Cart::where('item_id', @$getitem->id)
            //             ->update(['is_available' => $request->status]);
            return 1;
        } else {
            return 0;
        }
    }
    public function show(Request $request)
    {
        // $package = Package::findorFail($request->id);
        $getPackage = Package::where('package_id',$request->id)->first();
        $getPackageCategory = PackageCategory::where('package_id',$request->id)->first();
        $getpackages = $getPackage->join('packages as p', 'p.package_id','=','p.package_id')
        ->join('package_category as ps','ps.package_id','=','p.package_id')
        ->select('p.*', 'ps.*')
        ->groupBy('p.package_id')
        ->where('p.is_available','1')
->get();
     return view('packages',compact($getpackages));
        // print_r($getpackages->package_image);exit;  
        // if($getpackages->package_image){
        //     $getpackages->package_image=url('public/images/packages/'.$getpackages->package_image);
        // }
        // return response()->json(['ResponseCode' => 1, 'ResponseText' => 'Category fetch successfully', 'ResponseData' => $getpackages], 200);
    }
}
