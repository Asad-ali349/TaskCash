<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Task;
use App\User;
use App\TaskCompleted;
use App\UserRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function tasks(Request $request)
    {
        $user = User::find($request->id);
        $user_completed_tasks = [];
        foreach($user->jobs as $job){
            $user_completed_tasks[] = $job->task_id;    
        }
        
        $completedTasks = Task::all();
        foreach($completedTasks as $task){
            $acts_count = $task->activities->sum('number_of_act');
            $jobs = $task->jobs->count();
            if($acts_count <= $jobs){
                $user_completed_tasks[] =  $task->id;
            }
        }
        
        $tasks = Task::whereNotIn('id', $user_completed_tasks)->where('status', 1)->where('completed', 0)->with(['activities', 'category'])->latest()->get();
        return response()->json(['error'=> false, 'success_msg'=> 'Tasks Retreived', 'tasks'=> $tasks]);
    }
    
    public function completedTasks(Request $request)
    {
        $jobs = TaskCompleted::whereUserId($request->user_id)->where('status', 1)->latest()->get();
        $ids = [];
        foreach($jobs as $task){
            $ids[] = $task->task_id;
        }
        $tasks = Task::whereIn('id', $ids)->with(['activities', 'category'])->latest()->get();
        return response()->json(['error'=> false, 'success_msg'=> 'Tasks Retrieved!', 'completed_tasks'=> $tasks ]);
    }
    
    public function PendingPaymentTasks(Request $request)
    {
        $jobs = TaskCompleted::whereUserId($request->user_id)->where('status', 1)->latest()->get();
        $ids = [];
        foreach($jobs as $task){
            $ids[] = $task->task_id;
        }
        $tasks = Task::whereIn('id', $ids)->where('completed', 0)->with(['activities', 'category'])->latest()->get();
        return response()->json(['error'=> false, 'success_msg'=> 'Tasks Retrieved!', 'pending_payment_tasks'=> $tasks ]);
    }
    
    public function pendingTasks(Request $request)
    {
        // return $request->user_id;
        $jobs = TaskCompleted::whereUserId($request->user_id)->where('status', 0)->latest()->get();
        $ids = [];
        foreach($jobs as $task){
            $ids[] = $task->task_id;
        }
        $tasks = Task::whereIn('id', $ids)->with(['activities', 'category'])->latest()->get();
        return response()->json(['error'=> false, 'success_msg'=> 'Tasks Retrieved!', 'pending_tasks'=> $tasks ]);
    }
    
    public function completeJob(Request $request)
    {
        $rules = [
            'user_id'=> 'required',
            'task_id'=> 'required',
            'screen_shot'=> 'nullable|image|size:3000'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            response()->json(['error'=> true, 'error_msg'=> $validator->errors()->first()]);
        }
        
        if($request->screen_shot){
            $image_parts = explode(";base64,",$request->screen_shot);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $imageName = uniqid() .'.'.$image_type;
            file_put_contents(public_path().'/assets/images/'.$imageName, $image_base64);
            $status = 1;
        }else{
            $imageName = '';
            $status = 0;
        }
        TaskCompleted::create([
            'user_id'=> $request->user_id,
            'task_id'=> $request->task_id,
            'screen_shot'=> $imageName,
            'status'=> $status
        ]);
        return response()->json(['error'=> false, 'success_msg'=> 'Job Successfully Completed!']);
    }
    
    public function transactions(Request $request)
    {
        $user = User::find($request->user_id);
        $transactions = $user->requests;
        // $credits = 
        return response()->json(['error'=> false, 'success_msg'=> 'All Transactions!', 'transactions'=> $transactions]);
    }
    
    public function withDraw(Request $request)
    {
        $user = User::find($request->user_id);
        if($user->wallet->amount >= $request->amount ){
            $user->wallet->amount -= $request->amount;
            $user->wallet->save();
            UserRequest::create([
                'user_id'=> $user->id,
                'amount'=> $request->amount
            ]);
            return response()->json(['error'=> false, 'success_msg'=> 'Amount Successfully WithDrawn!']);
        }else{
            return response()->json(['error'=> true, 'error_msg'=> 'Requested Amount more than your Wallet Amount!']);
        }
    }
    
    
}
