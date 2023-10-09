<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Http\Requests\ActivityRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
   
    public function index()
    {
        $acts = Activity::where('status', 1)->get();
        return view('activities.index', compact('acts'));
    }

  
    public function create()
    {
        return view('activities.create');
    }

    public function store(ActivityRequest $request)
    {
        $activity = Activity::create($request->all());
        return back()->with('success', 'Added Successfully');
    }

 
    public function show(Activity $activity)
    {
        return response()->json($activity);
    }

  
    public function edit(Activity $activity)
    {
        return view('activities.edit', compact('activity'));
    }
  
    public function update(ActivityRequest $request, Activity $activity)
    {
        $activity->update($request->all());
        return redirect()->route('activities.index')->with('success', 'Successfully Updated!');
    }

    public function destroy(Activity $activity)
    {
        $activity->status = 0;
        $activity->save();
        return redirect()->route('activities.index')->with('success', 'Successfully Deleted!');
    }
}
