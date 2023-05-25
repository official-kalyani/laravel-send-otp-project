<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function loginRegister(){
        return view('home.login_register');
    }

    public function registerUser(Request $request){
        if($request->isMethod('post')){
            Session::forget('error_message');
            Session::forget('success_message');
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $rules=[
                'name'=>'required|regex:/^[\pL\s\-]+$/u',
                // 'mobile'=>'required|numeric|digits:11',
                'email'=> 'required|email|max:255',
                'password'=>'required',
                'password'=>'required|digits:8',
                'password.required'=>'Password Must be Minimum 8 Digit',
                
            ];
            $customMessages=[
                'name.required'=>'Name is Required',
                'name.alpha'=>'Valid Name is Required',
                'mobile.required'=>'Mobile No. is Required',
                'mobile.numeric'=>'valid Mobile no. is Required',
                // 'mobile.digits'=>'Number Must be 11 Digit',
                'email.required'=> 'Email is Required',
                'email.email'=>'Valid Email is Required',
                'password.required'=>'Password is Required',
                
            ];
            
            $this->validate($request,$rules,$customMessages);

            $userCount=User::where('email',$data['email'])->count();
            if($userCount>0){
                $message="Email Already Exists!";
                Session::flash('error_message',$message);
                return redirect()->back(); 
            }
            else{
                $user = new User;
                $user->name=$data['name'];
                $user->email=$data['email'];
                $user->mobile=$data['mobile'];
                $user->password=bcrypt($data['password']);
                $user->address="";
                $user->status=0;
                $user->save();

                // Send Confirmation Email
                $email = $data['email'];
                $messageData = [
                    'email'=> $data['email'],
                    'name'=>$data['name'],
                    'code'=>base64_encode($data['email'])
                ];
                Mail::send('emails.confirmation',$messageData,function($message) use($email){
                $message->to($email)->subject('Confirm Your Email Account for Registration');
                });

                // Redirect Back With Success Message

                $message="Please Check Your Email For Confirmation to Activate Your Account!";
                Session::put('success_message',$message);
                return redirect()->back();

                // if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                //     // echo "<pre>"; print_r(Auth::User()); die;
                //     if(!empty(Session::get('session_id'))){
                //         $user_id = Auth::user()->id;
                //         $session_id = Session::get('session_id');
                //         Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                //     }

                //     $email=$data['email'];
                //     $messageData=['name'=>$data['name'],'mobile'=>$data['mobile'],'email'=>$data['email']];
                //     Mail::send('emails.register',$messageData,function($message) use($email){
                //         $message->to($email)->subject('Welcome to Airsoft Point');
                //     });
                //     return redirect('/products/my-cart');
                // }
            }
        }
    }

    public function confirmAccount($email){
        Session::forget('error_message');
        Session::forget('success_message');
        $email = base64_decode($email);

        // Check User Email Exists

        $userCount = User::where('email',$email)->count();
        if($userCount>0){
             // User Email is already activated or not
             $userDetails=User::where('email',$email)->first();
             if($userDetails->status==1){
                 $message = "Your Account is Already Activated. Please Login.";
                 Session::put('error_message',$message);
                 return redirect('/login-register');
             }else{
                 // Update User Status to 1 to Activate Account
                 User::where('email',$email)->update(['status'=>1]);
    
                         $messageData=['name'=>$userDetails['name'],'mobile'=>$userDetails['mobile'],'email'=>$email];
                         Mail::send('emails.register',$messageData,function($message) use($email){
                             $message->to($email)->subject('Welcome to Our E-Commerce');
                        });

                    //redirect to login/register with success page
                    $message = " Your Account is Activated. You Can Login Now!";
                    Session::put('success_message',$message);
                    return redirect('/login-register');
             }
        }else{
            abort(404);
        }

    }

    public function logoutUser(){
        Auth::logout();
        return redirect('/');
    }

    public function loginUser(Request $request){
        if($request->isMethod('post')){
            Session::forget('error_message');
            Session::forget('success_message');
            $data = $request->all();
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                // Session::flash('error_message','Invalid Email or Password!');
                //Check Email is Activator or Not
                $userStatus = User::where('email',$data['email'])->first();
                if($userStatus->status==0){
                    Auth::logout();
                    $message = "Your Account is Not Activated Yet! Please Confirm Your Email to Activate!";
                    Session::put('error_message',$message);
                    return redirect()->back();
                }
                // if(!empty(Session::get('session_id'))){
                //     $user_id = Auth::user()->id;
                //     $session_id = Session::get('session_id');
                //     Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                // }
                return redirect('/');
            }else{
                $message="Invalid Email or Password!";
                Session::flash('error_message',$message);
                return redirect()->back();
            }
        }
    }

    public function forgotPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            Session::forget('error_message');
            Session::forget('success_message');
            // echo "<pre>"; print_r($data); die;
            $emailCount = User::where('email',$data['email'])->count();
            if($emailCount==0){
                $message= "Email Does Not Exists!";
                Session::put('error_message','Email Does Not Exists!');
                Session::forget('success_message');
                return redirect()->back();
            }

            //Generate New Random Password
            $random_password = Str::random(8);
            //Encode/secure password
            $new_password = bcrypt($random_password);
            User::where('email',$data['email'])->update(['password'=>$new_password]);
            $userName = User::select('name')->where('email',$data['email'])->first();
            $email = $data['email'];
            $name = $userName->name;
            $messageData = [
                'email'=>$email,
                'name'=>$name,
                'password'=>$random_password
            ];
            Mail::send('emails.forgot_password',$messageData,function($message) use($email){
            $message->to($email)->subject("Get New Password - E-Commerce");
            });

            $message = "Please Check Email For New Password!";
            Session::put('success_message',$message);
            return redirect('/login-register');
        }
        return view('home.forgot_password');
    }

    public function account(Request $request){
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id)->toArray();
        // $userDetails = json_decode(json_encode($userDetails),true);
        // dd($userDetails); die;

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            Session::forget('error_message');
            Session::forget('success_message');

            // Validation
            $rules=[
                'name'=>'required|regex:/^[\pL\s\-]+$/u',
                'mobile'=>'required|numeric|digits:11',
                'location_status'=>'required',
                'district'=>'required',
                'pin_code'=>'required',
                'address'=>'required'
            ];
            $customMessages=[
                'name.required'=>'Name is Required',
                'name.alpha'=>'Valid Name is Required',
                'mobile.required'=>'Mobile No. is Required',
                'mobile.numeric'=>'valid Mobile no. is Required',
                'mobile.digits'=>'Number Must be 11 Digit',
                'address'=>'Valid Address is Required',
                'location_status'=>'Select Location Status is Required',
                'district'=>'Select District is Required',
                'pin_code'=>'Valid Pin Code is Required',
            ];
            $this->validate($request,$rules,$customMessages);

            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->mobile = $data['mobile'];
            $user->location_status = $data['location_status'];
            $user->district = $data['district'];
            $user->pin_code = $data['pin_code'];
            $user->address = $data['address'];
            $user->save();
            $message = "Your Account Details Has Been Updated Successfully";
            Session::put('success_message',$message);
            return redirect()->back();
        }
        return view('home.user_account')->with(compact('userDetails'));
    }

    public function chkUserPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $user_id = Auth::User()->id;
            $checkPassword = User::select('password')->where('id',$user_id)->first();
            if(Hash::check($data['current_pwd'],$checkPassword->password)){
                return "true";
            }else{
                return "false";
            }
        }
    }
    public function updateUserPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            Session::forget('error_message');
            Session::forget('success_message');
            
            // echo "<pre>"; print_r($data); die;
            $user_id = Auth::User()->id;
            $checkPassword = User::select('password')->where('id',$user_id)->first();
            if(Hash::check($data['current_pwd'],$checkPassword->password)){
                //Update Password
                $new_pwd = bcrypt($data['new_pwd']);
                User::where('id',$user_id)->update(['password'=>$new_pwd]);
                $message = "Password Updated Successfully";
                Session::put('success_message',$message);
                return redirect()->back();

            }else{
                $message = "Current Password is Incorrect!";
                Session::put('error_message',$message);
                return redirect()->back();
            }
        }
    }


    

}
