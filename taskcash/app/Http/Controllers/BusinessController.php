<?php

namespace App\Http\Controllers;

use App\Business;
use App\Http\Requests\BusinessProfileEdit;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
   public function dashboard()
   {
       $business = Auth::guard('business')->user();
       $total_tasks = $business->tasks ? $business->tasks->count() : 0;
       $completed_tasks = $business->tasks ? $business->tasks->where('completed', 1)->count() : 0;
       $running_tasks = $business->tasks ? $business->tasks->where('completed', 0)->count() : 0;
       $amount_paid = $business->transactions ? $business->transactions->sum('amount') : 0;
       $amount_consumed = 0;
       foreach($business->tasks as $task){
           $amount_consumed += $task->jobs->count() * 0.05;
       }
       $member_since = $business->created_at;
       $transactions = Auth::guard('business')->user()->transactions;
        return view('business_dashboard', compact('total_tasks', 'completed_tasks', 'running_tasks', 'amount_paid', 'member_since', 'amount_consumed', 'transactions'));
   }

   public function transactions()
   {
        $transactions = Auth::guard('business')->user()->transactions;
        return view('transactions', compact('transactions'));
   }

   public function profile()
    {
        return view('profiles.busProfile');
    }

    public function updateProfile(BusinessProfileEdit $request)
    {
        // return $request;
        $data = $request->all();
        if($request->image){
            $name = time().'.'.$request->image->extension();
            $request->image->move(public_path('assets/images'), $name);
            if(Auth::guard('business')->user()->image){
               unlink(public_path('assets/images/'.Auth::guard('business')->user()->image));
            }
            $data['image'] = $name;
         }
        Auth::guard('business')->user()->update($data);
        return back()->with('success', 'Profile Updated Successfully!');
    }


    public function changePass(PasswordRequest $request, $id)
    {
        $user = Business::find($id);
        if(password_verify($request->current_pass, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->update();
            return back()->with('message' , 'Password Updated!');
        }
        return back()->with('message' , 'Your Current Password is inCorrect');
    }
}
