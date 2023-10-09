<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'email'=> 'required|email',
            'password'=> 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(['error'=> true, 'error_msg'=> $validator->errors()->first()]);
        }
        $credentials = ['email'=> $request->email, 'password'=> $request->password];
        if(Auth::attempt($credentials)){
            $user = User::whereEmail($request->email)->first();
            $user['wallet_amount'] = $user->wallet->amount;
            $total_earnings = 0;
            $pending_amount = 0;
            foreach($user->jobs as $job){
                $task = Task::find($job->task_id);
                $total_earnings += ($task->completed == 1) ? 0.01 : 0;
                $pending_amount += ($task->completed == 0) ? 0.01 : 0;
            }
            $user['completed_tasks'] = $user->jobs->where('status', 1)->count();
            $user['pending_tasks'] = $user->jobs->where('status', 0)->count();
            $user['pending_amount'] = number_format($pending_amount, 2);
            $user['total_earnings'] = number_format($total_earnings, 2);
            $users = [];
            $users[] = $user->makeHidden(['wallet', 'requests', 'jobs']);
            return response()->json(['error'=> false, 'success_msg'=> 'Login Successfully!', 'user'=> $users]);
        }else{
            return response()->json(['error'=> true, 'error_msg'=> 'Credentials did not matched!']);
        }
    }

    public function register(Request $request)
    {
        $rules = [
            'name'=> 'required|max:30|min:3',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|max:16|min:6',
            'phone'=> 'required|numeric|unique:users',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(['error'=> true, 'error_msg'=> $validator->errors()->first()]);
        }
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        User::create($data);
        $credentials = ['email'=> $request->email, 'password'=> $request->password];
        if(Auth::attempt($credentials)){
            $user = User::whereEmail($request->email)->first();
            $user['wallet_amount'] = $user->wallet->amount;
            $total_earnings = 0;
            $pending_amount = 0;
            foreach($user->jobs as $job){
                $task = Task::find($job->task_id);
                $total_earnings += ($task->completed == 1) ? 0.01 : 0;
                $pending_amount += ($task->completed == 0) ? 0.01 : 0;
            }
            $user['completed_tasks'] = $user->jobs->where('status', 1)->count();
            $user['pending_tasks'] = $user->jobs->where('status', 0)->count();
            $user['pending_amount'] = number_format($pending_amount, 2);
            $user['total_earnings'] = number_format($total_earnings, 2);
            $users = [];
            $users[] = $user->makeHidden(['wallet', 'requests', 'jobs']);
            return response()->json(['error'=> false, 'success_msg'=> 'Registered Successfully!', 'user'=> $users]);
        }else{
            return response()->json(['error'=> true, 'error_msg'=> 'Credentials did not matched!']);
        }
    }

    public function profileUpdate(Request $request)
    {
        $user = User::find($request->user_id);
        $user->update($request->all());
        return response()->json(['error'=> false, 'success_msg'=> 'Profile Updated Successfully!', 'user'=> $user]);
    }

    public function forgotPassword(Request $request)
    {
        $email = $request->email;
        $user = User::whereEmail($email)->first();
        if($user != '') {
            $password = \Str::random(10);
            $user->password = bcrypt($password);
            $user->save();
            
            $to = $email;
            $from = 'taskcash@gmail.com';
            $subject = 'Your New Password for TaskCash, Please change it ASAP';
            $message = $password;
            $headers = 'From: taskcash@gmail.com'."\r\n".
            'Reply-To: taskcash@gmail.com'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $message, $headers);
            return response()->json(['error'=> false, 'success_msg'=> "New System Generated Password sended to this email!"]);
        }else{
            return response()->json(['error'=> true, 'error_msg'=> 'Email Doesn"t Exist']);
        }
    }

    public function changePassword(Request $request)
    {
        $data = $request->all();
        $rules = [
            'current_password'=> 'required',
            'password' => 'required|min:6|max:16',
        ];

        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json(['error'=> true, 'error_msg'=> $validator->errors()->first()]);
        }
        $user = User::find($request->user_id);
        if(password_verify($request->current_password, $user->password)){
            $user->password = bcrypt($request->password);
            $user->save();
            return response()->json(['error'=> false, 'success_msg'=> 'Password Updated Successfully!']);
        }else{
            return response()->json(['error'=> true, 'error_msg'=> 'Current Password is Wrong']);
        }
    }
}
