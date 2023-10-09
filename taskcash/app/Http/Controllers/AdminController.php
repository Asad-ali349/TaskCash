<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Business;
use App\Http\Requests\BusinessRequest;
use App\Http\Requests\PasswordRequest;
use App\Task;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalBusinesses = Business::count();
        $tasks = Task::all();
        $totalTasks = $tasks->count();
        $completed_tasks = $tasks->where('status', 1)->count();
        $running_tasks = $tasks->where('status', 0)->count();
        $totalUsers = User::count();
        $amountCollected = Transaction::sum('amount');
         return view('dashboard', compact('totalBusinesses', 'totalTasks', 'completed_tasks', 'running_tasks', 'totalUsers', 'amountCollected'));
    }

    public function businesses()
    {
        $buss = Business::all();
        return view('businesses.index', compact('buss'));
    }
    
    public function getAttributes()
    {
        
        return response()->json([]);
    }
    public function createBusiness()
    {
        return view('businesses.create');
    }
    public function storeBusiness(BusinessRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        if($request->image){
            $name = time().'.'.$request->image->extension();
            $request->image->move(public_path('assets/images'), $name);
            $data['image'] = $name;
        }
        $business = Business::create($data);
        return back()->with(['success'=> 'Business Created Successfully!']);
    }

    public function editBusiness($id)
    {
        $business = Business::find($id);
        // return $business->tasks[0]->activities[0]->act->name;
        return view('businesses.detail', compact('business'));
    }

    public function updateBusiness($id)
    {
        $business = Business::find($id);
        // return $business->tasks[0]->activities[0]->act->name;
        return view('businesses.detail', compact('business'));
    }
    public function detailBusiness($id)
    {
        $business = Business::find($id);
        // return $business->tasks[0]->activities[0]->act->name;
        return view('businesses.detail', compact('business'));
    }
    
    public function activeBusiness($id)
    {
        $business = Business::find($id);
        if($business->status == 0){
            $business->status = 1;
        }else{
            $business->status = 0;
        }
        $business->save();
        return true;
    }

    public function users()
    {
        $users = User::latest()->get();
        return view('users.index', compact('users'));
    }

    public function detailUser($id)
    {
        $user = User::find($id);
        return view('users.detail', compact('user'));
    }

    public function approvedTasks()
    {
        $tasks = Task::where('status', 1)->latest()->get();
        return view('tasks.approved', compact('tasks'));
    }

    public function unApprovedTasks()
    {
        $tasks = Task::where('status', 0)->latest()->get();
        return view('tasks.unapproved', compact('tasks'));
    }

    public function completedTasks()
    {
        $tasks = Task::where('completed', 1)->latest()->get();
        return view('tasks.completed', compact('tasks'));
    }

    public function detailTask($id)
    {
        $task = Task::find($id);
        return view('tasks.detail', compact('task'));
    }

    public function approveTask($id)
    {
        $task = Task::find($id);
        $task->status = 1;
        $task->save();
        return true;
    }
    // Bussiness and Users Registeration chart
    function getMonths()
    {
        $year = date('Y');
        $months_array = [];
        $dates = Business::select('created_at')
                            ->whereYear('created_at', $year)
                            ->latest()->get();
        foreach($dates as $key=>$date)
        {
            $month_no = $date->created_at->format('m');
            $month_name = $date->created_at->format('M');
            $month_year = $date->created_at->format('Y');
            $monthOfYear = $month_name.' ('.$month_year.')';
            $months_array[$month_no] = $monthOfYear; 
        }
        return $months_array;
    }
    function getMonthlyRegisters($month, $year)
    {   
        $monthly_businesses = Business::whereMonth('created_at', $month)
                                    ->whereYear('created_at', $year)
                                    ->count();
        $monthly_users = User::whereMonth('created_at', $month)
                                    ->whereYear('created_at', $year)
                                    ->count();
        $data['businesses'] = $monthly_businesses;
        $data['users'] = $monthly_users;
        return $data;
    }
    public function Chart()
    {
        $year = date('Y');
        $months_array = $this->getMonths();
        $month_name_array = [];
        $monthly_business_array = [];
        $monthly_users_array = [];
        if(!empty($months_array))
        {
            foreach($months_array as $month_no=>$month_name)
            {
                $data = $this->getMonthlyRegisters($month_no, $year);
                array_push($month_name_array, $month_name);
                array_push($monthly_business_array, $data['businesses']);
                array_push($monthly_users_array, $data['users']);
            }
        }
        $data['businesses'] = $monthly_business_array;
        $data['users'] = $monthly_users_array;
        $result = array(
            'months'=> $month_name_array,
            'data'=> $data
        );
        return $result;
    }
}
