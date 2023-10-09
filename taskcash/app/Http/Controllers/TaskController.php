<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Category;
use App\Http\Requests\TaskRequest;
use App\Task;
use App\TaskActivity;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
 
    public function __construct()
    {
    }
    public function index()
    {
        $tasks = Auth::guard('business')->user()->tasks;
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $cats = Category::all();
        $acts = Activity::all();
        return view('tasks.create', compact('cats', 'acts'));
    }

    public function validations(TaskRequest $request)
    {
        return true;
    }
    public function store(Request $request)
    {
        $data['business_id'] = Auth::guard('business')->user()->id;
        $task = Task::create([
            'title'=> $request->title,
            'description'=> $request->description,
            'category_id'=> $request->category_id,
            'till'=> $request->till,
            'link'=> $request->link,
            'business_id'=> Auth::guard('business')->user()->id,
        ]);
        $acts = explode(",", $request->acts);
        $nos = explode(",", $request->nos);
        foreach($acts as $key=>$act){
            TaskActivity::create([
                'activity_id'=> $act,
                'task_id'=> $task->id,
                'number_of_act'=> $nos[$key] 
            ]);
        }
        Transaction::create([
            'business_id'=> Auth::guard('business')->user()->id,
            'task_id'=> $task->id,
            'amount'=> $request->amount,
            'transaction_id'=> $request->transaction_id,
            'status'=> 1
        ]);
        return true;

    }

    public function show(Task $task)
    {
        return view('tasks.business_task_detail', compact('task'));
    }

    public function edit(Task $task)
    {
        //
    }

    public function update(Request $request, Task $task)
    {
        //
    }

    public function destroy(Task $task)
    {
        //
    }
}
