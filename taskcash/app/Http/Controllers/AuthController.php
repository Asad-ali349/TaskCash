<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Admin;
use App\Business;
use App\Category;
use App\Http\Requests\AdminProfileEdit;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function gotoLogin()
    {
        return redirect()->route('login');
    }
    public function loginPage()
    {
        return view('credentials.login');
    }
    public function registerPage()
    {
        return view('credentials.register');
    }
    public function register(RegisterRequest $request)
    {
        // return $request;
        $data = $request->all();
        $image = $request->file('image');
        if($image){
            $image_name = time().'.'.$image->extension();
            $image->move(public_path('assets/images') ,$image_name);
            $data['image'] = $image_name;
        }else{
            $data['image'] = 'noUserImage.jpg';
        }
        $data['password'] = bcrypt($request->password);
        $user = Business::create($data);
        return redirect('login');
    }
    public function login(LoginRequest $request)
    {
        $email = $request->email;
        $isAdmin = Admin::where('email', $email)->first();
        $isBusiness = Business::where('email', $email)->first();

        $credentials = ['email' => $request->email, 'password'=> $request->password];
        if($isAdmin == null && $isBusiness == null){
            return response()->json(['error'=> 'Email Doesn"t Exist']);
        }
        // $isActive = $this->checkGuard($email);
        // if($isActive->status == 0){
        //     return response()->json(['error'=> 'Not Authorized for this Access | Please Contact with the Admin']);
        // }
        if($isAdmin){
            if(Auth::guard('admin')->attempt($credentials)) 
            {
                return response()->json(['user'=> 'admin']);
            }
            else{
                return response()->json(['error'=> "Credentials Didn't Match!"]);
            }
        }
        if($isBusiness){
            if(Auth::guard('business')->attempt($credentials)){
                return response()->json(['user'=> 'business']);
            }else{
                return response()->json(['error'=> "Credentials Didn't Match!"]);
            }
        }

        return 'not found';
    }
    public function profile()
    {
        return view('profiles.index');
    }

    public function updateProfile(AdminProfileEdit $request)
    {
        // return $request;
        Auth::guard('admin')->user()->update($request->all());
        return back()->with('success', 'Profile Updated Successfully!');
    }


    public function changePass(PasswordRequest $request, $id)
    {
        $user = Admin::find($id);
        if(password_verify($request->current_pass, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->update();
            return back()->with('message' , 'Password Updated!');
        }
        return back()->with('message' , 'Your Current Password is inCorrect');
    }
    public function forgotPass()
    {
        return view('credentials.forgot_pass');
    }

    public function forgotPassword(Request $request)
    {
        $email = $request->email;
        $admin = Admin::whereEmail($email)->first();
        $business = Business::whereEmail($email)->first();
        $error = '';
        if($admin != '') {
            $password = \Str::random(10);
            $admin->password = bcrypt($password);
            $admin->save();
            
            $to = $email;
            $from = 'taskcash@gmail.com';
            $subject = 'Your New Password for TaskCash, Please change it ASAP';
            $message = $password;
            $headers = 'From: taskcash@gmail.com'."\r\n".
            'Reply-To: taskcash@gmail.com'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $message, $headers);
            return response()->json(['success'=> "New System Generated Password sended to this email!"]);
        }else{
            $error = 'Email Does Not Exist!';
        }
        if($business != '') {
            $password = \Str::random(10);
            $business->password = bcrypt($password);
            $business->save();
            
            $to = $email;
            $from = 'taskcash@gmail.com';
            $subject = 'Your New Password for TaskCash, Please change it ASAP';
            $message = $password;
            $headers = 'From: taskcash@gmail.com'."\r\n".
            'Reply-To: taskcash@gmail.com'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $message, $headers);
            return response()->json(['success'=> "New System Generated Password sended to this email!" ]);
        }else{
            $error = 'Email Does Not Exist!';
        }
        if($error){
            return response()->json(['error'=> $error]);
        }
    }

    public function notAuthorized()
    {
        return view('credentials.notAuthorized');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/login');
    }

    public function busLogout()
    {
        Auth::guard('business')->logout();
        return redirect('/login');
    }

    public function checkGuard($email)
    {
        $isAdmin = User::where('email', $email)->first();
        $isBusiness = Business::where('email', $email)->first();
       
        if($isAdmin){
            return $isAdmin;
        }elseif($isBusiness){
            return $isBusiness;
        }else{
            return null;
        }
    }
}
