<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Session;
use Auth;
use App\User;
use App\Ratting;
use App\Cart;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('front.login');
    }

    public function signup() {
        return view('front.signup');
    }


    public function login(Request $request)
    {

        $login=User::where('email',$request['email'])->where('type','=','2')->first();

        
        if(!empty($login)) {
            
            if(Hash::check($request->get('password'),$login->password)) {   
                if($login->is_verified == '1') {
                    if($login->is_available == '1') {
                        // Check item in Cart
                        $cart=Cart::where('user_id',$login->id)->count();
                        // echo "<pre>"; print_r($cart);exit;

                    	session ( [ 
                    	    'id' => $login->id, 
                            'name' => $login->name,
                            'email' => $login->email,
                            'profile_image' => $login->profile_image,
                            'cart' => $cart,
                    	] );

                        return Redirect::to('/');
                    } else {
                        return Redirect::back()->with('danger', 'Your account has been blocked by Admin');
                    }
                } else {

                    $otp = rand ( 100000 , 999999 );
                    try{

                        $title='Email Verification Code';
                        $email=$request->email;
                        $data=['title'=>$title,'email'=>$email,'otp'=>$otp];

                        Mail::send('Email.emailverification',$data,function($message)use($data){
                            $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                            $message->to($data['email']);
                        } );

                        session ( [
                            'email' => $request->email
                        ] );

                    }catch(\Swift_TransportException $e){
                        $response = $e->getMessage() ;
                        // return Redirect::back()->with('danger', $response);
                        return Redirect::back()->with('danger', 'Something went wrong while sending email Please try again...');
                    }
                    return Redirect::to('/email-verify')->with('success', "Email has been sent to your registered email address");
                }
            } else {
            	return Redirect::back()->with('danger', 'Password is incorrect');
            }
        } else {
            return Redirect::back()->with('danger', 'Email is incorrect');
        }        
    }

    public function register(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|unique:users',
            'mobile' => 'required|unique:users',
            'password' => 'required|confirmed',
            'accept' =>'accepted'
        ]);
        if ($validation->fails())
        {
            return Redirect::back()->withErrors($validation, 'login')->withInput();
        }
        else
        {

            $otp = rand ( 100000 , 999999 );

            try{
                $title='Email Verification Code';
                $email=$request->email;
                $data=['title'=>$title,'email'=>$email,'otp'=>$otp];

               if( Mail::send('Email.emailverification',$data,function($message)use($data){
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            } ))
            {
                echo "yes";exit;
            }

                $user = new User;
                $user->name =$request->name;
                $user->email =$request->email;
                $user->mobile =$request->mobile;
                $user->profile_image ='unknown.png';
                $user->otp=$otp;
                $user->type ='2';
                $user->password =Hash::make($request->password);
               
                $user->save();
              

                session ( [
                    'email' => $request->email,
                ] );
                return Redirect::to('/email-verify')->with('success', 'Email has been sent to your registered email address');  
            }catch(\Swift_TransportException $e){
                $response = $e->getMessage() ;
                // return Redirect::back()->with('danger', $response);
                return Redirect::back()->with('danger', 'Something went wrong while sending email Please try again...');
            }
            // return Redirect::to('/');
        }
        return Redirect::back()->withErrors(['msg', 'Something went wrong']);
    }

    public function changePassword(request $request)
    {
        $validation = \Validator::make($request->all(), [
            'oldpassword'=>'required|min:6',
            'newpassword'=>'required|min:6',
            'confirmpassword'=>'required_with:newpassword|same:newpassword|min:6',
        ],[
            'oldpassword.required'=>'Old Password is required',
            'newpassword.required'=>'New Password is required',
            'confirmpassword.required'=>'Confirm Password is required'
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
        else if($request->oldpassword==$request->newpassword)
        {
            $error_array[]='Old and new password must be different';
        }
        else
        {
            $login=User::where('id','=',Session::get('id'))->first();

            if(\Hash::check($request->oldpassword,$login->password)){
                $data['password'] = Hash::make($request->newpassword);
                User::where('id', Session::get('id'))->update($data);
                Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> Password has been changed.!! </div>');
            }else{
                $error_array[]="Old Password is not match.";
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        return json_encode($output);  

    }

    public function addreview(request $request)
    {
        $validation = \Validator::make($request->all(), [
            'user_id' => 'required|unique:ratting',
            'ratting'=>'required',
            'comment'=>'required',
        ],[
            'user_id.unique'=>'You already given review',
            'ratting.required'=>'Rating is required',
            'comment.required'=>'Comment is required'
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
            $user = new Ratting;
            $user->user_id =$request->user_id;
            $user->ratting =$request->ratting;
            $user->comment =$request->comment;
            $user->save();
            Session::flash('message', '<div class="alert alert-success"><strong>Success!</strong> Review has been added.!! </div>');
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        
        return json_encode($output);  

    }

    public function forgot_password() {

        return view('front.forgot-password');
    }

    public function forgotpassword(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email' => 'required'
        ]);
        if ($validation->fails())
        {
            return Redirect::back()->withErrors($validation, 'login')->withInput();
        }
        else
        {
            $checklogin=User::where('email',$request->email)->first();
            
            if(empty($checklogin))
            {
                return Redirect::back()->with('danger', 'Email does not exist');
            } else {
                if ($checklogin->google_id != "" OR $checklogin->facebook_id != "") {
                    return Redirect::back()->with('danger', 'Your account has been registered with social media');
                } else {
                    try{
                        $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 8 );

                        $newpassword['password'] = Hash::make($password);
                        $update = User::where('email', $request['email'])->update($newpassword);
                        
                        $title='Password Reset';
                        $email=$checklogin->email;
                        $data=['title'=>$title,'email'=>$email,'password'=>$password];

                        Mail::send('Email.email',$data,function($message)use($data){
                            $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                            $message->to($data['email']);
                        } );
                        return Redirect::back()->with('success', 'New Password Sent to your email address');
                    }catch(\Swift_TransportException $e){
                        $response = $e->getMessage() ;
                        // return Redirect::back()->with('danger', $response);
                        return Redirect::back()->with('danger', 'Something went wrong while sending email Please try again...');
                    }
                }
            }
        }
        return Redirect::back()->with('danger', 'Something went wrong'); 
    }

    public function email_verify() {

        return view('front.email-verify');
    }

    public function email_verification(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email' => 'required',
            'otp' => 'required',
        ]);
        if ($validation->fails())
        {
            return Redirect::back()->withErrors($validation, 'email-verify')->withInput();
        }
        else
        {
            $checkuser=User::where('email',$request->email)->first();

            if (!empty($checkuser)) {
                if ($checkuser->otp == $request->otp) {
                    $update=User::where('email',$request['email'])->update(['otp'=>NULL,'is_verified'=>'1']);

                    $cart=Cart::where('user_id',$checkuser->id)->count();
                    session ( [ 
                        'id' => $checkuser->id, 
                        'name' => $checkuser->name,
                        'email' => $checkuser->email,
                        'profile_image' => 'unknown.png',
                        'cart' => $cart,
                    ] );

                    return Redirect::to('/');

                } else {
                    return Redirect::back()->with('danger', 'Invalid OTP');
                }  
            } else {
                return Redirect::back()->with('danger', 'Invalid Email Address');
            }            
        }
        return Redirect::back()->with('danger', 'Something went wrong'); 
    }

    public function resend_email()
    {
        $checkuser=User::where('email',Session::get('email'))->first();

        if (!empty($checkuser)) {
            try{
                $otp = rand ( 100000 , 999999 );

                $update=User::where('email',Session::get('email'))->update(['otp'=>$otp,'is_verified'=>'2']);

                $title='Email Verification Code';
                $email=Session::get('email');
                $data=['title'=>$title,'email'=>$email,'otp'=>$otp];
                Mail::send('Email.emailverification',$data,function($message)use($data){
                    $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                    $message->to($data['email']);
                } );
            }catch(\Swift_TransportException $e){
                $response = $e->getMessage() ;
                // return Redirect::back()->with('danger', $response);
                return Redirect::back()->with('danger', 'Something went wrong while sending email Please try again...');
            }

            return Redirect::to('/email-verify')->with('success', "Email has been sent to your registered email address");

        } else {
            return Redirect::back()->with('danger', 'Invalid Email Address');
        }  
    }

    public function logout() {
        Session::flush ();
        Auth::logout ();
        return Redirect::to('/');
    }
}
