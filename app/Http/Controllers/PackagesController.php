<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Package;
use App\PackageCategory;
use Validator;
class PackagesController extends Controller
{
    //
    public function index()
    {
        return view('packages');
    }
    public function store(Request $request)
    {

        
        print_r($request->package_name);exit;
        $validation = Validator::make($request->all(),[
            'package_name' => ['required'],
            'package_validity' => ['required'],
            'meals'=> ['required'],
            'package_image'=>'required|image|mimes:jpeg,png,jpg',
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
            // $image = 'category-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            // $request->image->move('public/images/category', $image);

            $package = new Package;
            // $category->image =$image;
            $package->package_name =htmlspecialchars($request->package_name, ENT_QUOTES, 'UTF-8');
            $package->package_validity =htmlspecialchars($request->package_validity, ENT_QUOTES, 'UTF-8');
            $package->meals =htmlspecialchars($request->meals, ENT_QUOTES, 'UTF-8');
            print_r($package->package_name );exit;
            $package->save();
            $success_output = 'Package Added Successfully!';
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
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
