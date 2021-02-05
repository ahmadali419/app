<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Package;
use App\PackageCategory;
use App\About;
use Session;

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
            'food_name'=> ['required'],
            'food_description'=> ['required'],  
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
            $package->image = $image;
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
                
            //    dd($package_id);exit;
               if($package->id)
               {

                $category  = new PackageCategory;
                // print_r($category);exit; 
            $category->food_category = $request->food_category;
            // print_r($category->food_category);exit;
            
            
                   
                $itemdata=array();
                foreach ($request->food_name as $key => $value)
                {
                   
                   $category->image =$image;
                    $itemdata[]=array(
                        'package_id'=>$package->id, 
                        'food_name'=>$value,
                        'food_description'=>$request->food_description[$key],
                        'item_image'=>$image,
                    
    
                    );	
                }
                
                
                   
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
        ->where('p.is_available','0')
->get();
// print_r($getpackages);exit;

    //    echo "<pre>"; print_r( $getpackages);exit;
        return view('theme.packagetable',compact('getpackages'));
    }
    public function status(Request $request)
    {
        $package = Package::where('package_id', $request->id)->update( array('is_available'=>$request->status) );
        if ($package) {
            $item = PackageCategory::where('package_id', $request->id)->update( array('item_status'=>$request->status) );
           
            return 1;
        } else {
            return 0;
        }
    }
    public function show(Request $request)
    {
        // print_r($request->id);exit;
        // $package = Package::findorFail($request->id);
        $user_id  = Session::get('id');
        $getabout = About::where('id', '=', '1')->first();
        $packages = Package::with("categories")->where(['package_id'=>$request->id])->get();
        // dd($packages);exit;
     return view('front.editPackage',compact('packages'));
    }
    public function updatePackage(Request $request)
    {
        // print_r($request->package_id);exit;
        $validation = Validator::make($request->all(),[
            'package_name' => ['required'],
            'package_validity' => ['required'],
            'meals'=> ['required'],
            'package_amount'=> ['required'],

            // 'food_category'=> ['required'],
            'food_name'=> ['required'],
            'food_description'=> ['required'],   
                   
            // 'food_image'=>'required|image|mimes:jpeg,png,jpg',
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
            // $image = 'package-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            // $request->image->move('public/images/packages', $image);
            $package = new Package;
            // $package->exists = true;
            // $package->package_id = $request->package_id;
            if(isset($request->image)){
                if($request->hasFile('image')){
                    $image = $request->file('image');
                    $image = 'packages-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
                    $request->image->move('public/images/packages', $image);
                    $updatePackage  =   Package::where(['package_id'=>$request->package_id])->update(array('image'=>$image));

                    // unlink(public_path('images/packages/'.$request->old_img));
                }            
            }
            $package->package_name =htmlspecialchars($request->package_name, ENT_QUOTES, 'UTF-8');
            $package->package_validity =htmlspecialchars($request->package_validity, ENT_QUOTES, 'UTF-8');
            $package->meals =htmlspecialchars($request->meals, ENT_QUOTES, 'UTF-8');
            $package->package_amount =htmlspecialchars($request->package_amount, ENT_QUOTES, 'UTF-8');
            $package->package_description =htmlspecialchars($request->description, ENT_QUOTES, 'UTF-8');
            $updatePackage  =   Package::where(['package_id'=>$request->package_id])->update(array('package_name'=>$request->package_name,'package_validity'=>$request->package_validity,'meals'=>$request->meals,'package_description'=>$request->description));

            //   = $package->food_name;
            // print_r($package->package_name );exit;
                //  $package->save();
                //   print_r($package->save()->);exit;
            if ($updatePackage) {
                // exit;
            //    dd($package_id);exit;
               if($package->id)
               {
                echo $package->id;exit;
                $category  = new PackageCategory;
                // print_r($category);exit; 
            $category->food_category = $request->food_category;
            // print_r($category->food_category);exit;
            
            
                   
                $itemdata=array();
                foreach ($request->food_name as $key => $value)
                {
                    if(isset($request->food_image)){
                        if($request->hasFile('image')){
                            $image = $request->file('image');
                            $image = 'packages-' . uniqid() . '.' . $request->food_image->getClientOriginalExtension();
                            $request->food_image->move('public/images/packages', $image);
                           
                            // $package->food_image=$image;
                      
                        }            
                    }
                   $category->image =$image;
                    $itemdata[]=array(
                        'package_id'=>$package->id, 
                        'food_name'=>$value,
                        'food_description'=>$request->food_description[$key],
                        'item_image'=>$image[$key],
                    
    
                    );	
                }
                
                
                   
                    $category::updated($itemdata);

               }
            }
            $success_output = 'Package Updated Successfully!';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }
}
