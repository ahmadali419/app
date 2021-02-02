<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PrivacyPolicy;
use App\About;
use Validator;

class PrivacyPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getprivacypolicy = PrivacyPolicy::where('id','1')->first();
        return view('privacy-policy',compact('getprivacypolicy'));
    }

    public function privacy()
    {
        $getabout = About::where('id','=','1')->first();
        $getprivacypolicy = PrivacyPolicy::where('id','1')->first();
        return view('front.privacy',compact('getprivacypolicy','getabout'));
    }
}
