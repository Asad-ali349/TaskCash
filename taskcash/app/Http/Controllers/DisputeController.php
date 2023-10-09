<?php

namespace App\Http\Controllers;

use App\Dispute;
use App\DisputeChat;
use App\Http\Requests\DisputeRequest;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DisputeController extends Controller 
{
    //  Business Dispute Functions
    public function disputes()
    {
        $disputes = [];
        foreach(Auth::guard('business')->user()->tasks as $task){
            if($task->disputes->count() > 0)
                foreach($task->disputes as $dispute){
                    $disputes[] = $dispute;
                }
        }
        // return $disputes;
        return view('disputes_business.index', compact('disputes'));
    }

    public function create($id)
    {
        $task = Task::find($id);
        return view('disputes_business.create', compact('task'));
    }

    public function store(DisputeRequest $request)
    {
        // return $request;
        $dispute = Dispute::create($request->all());
        return response()->json(['success'=> 'good']);
    }

    public function business_dispute_detail($id)
    {
        $dispute = Dispute::find($id);
        $chats = $dispute->chats;
        return view('disputes_business.dispute_detail', compact('dispute', 'chats'));
    }
    public function businessReply(Request $request, $id)
    {
        $request->validate(['message'=> 'required|max:5000|min:30'], $request->all());
        $dispute = Dispute::find($id);
        DisputeChat::create([
            'dispute_id'=> $dispute->id,
            'message'=> $request->message,
            // 'sender'=> Auth::guard('admin')->user()->id,
            // 'receiver'=> $dispute->task->business->id,
            // 'sent_by'=> Auth::guard('admin')->user()->id
            'sent_by'=> 'business'
        ]);
        // return $dispute;
        return back()->with(['message'=> 'Message Sended successfully!']);
    }
    public function businessResolve($id)
    {
        $dispute = Dispute::find($id);
        $dispute->update(['status'=> 1]);
        return back()->with(['message'=> 'Dispute Resolved successfully!']);
    }


    // Admin Dispute Functions
    public function unResolvedDisputes()
    {
        $disputes = Dispute::where('status', 0)->get();
        return view('disputes_admin.unsolved', compact('disputes'));
    }
    public function detail($id)
    {
        $dispute = Dispute::find($id);
        $chats = $dispute->chats;
        return view('disputes_admin.detail', compact('dispute', 'chats'));
    }

    public function replying($id)
    {
        $dispute = Dispute::find($id);
        return view('disputes_admin.dispute_replying', compact('dispute'));
    }
    public function reply(Request $request, $id)
    {
        $request->validate(['message'=> 'required|max:5000|min:30'], $request->all());
        $dispute = Dispute::find($id);
        DisputeChat::create([
            'dispute_id'=> $dispute->id,
            'message'=> $request->message,
            // 'sender'=> Auth::guard('admin')->user()->id,
            // 'receiver'=> $dispute->task->business->id,
            // 'sent_by'=> Auth::guard('admin')->user()->id
            'sent_by'=> 'admin'
        ]);
        // return $dispute;
        return back()->with(['message'=> 'Message Sended successfully!']);
    }
    public function resolve($id)
    {
        $dispute = Dispute::find($id);
        $dispute->update(['status'=> 1]);
        return back()->with(['message'=> 'Dispute Resolved successfully!']);
    }
    public function resolvedDisputes()
    {
        $disputes = Dispute::where('status', 1)->get();
        return view('disputes_admin.resolved', compact('disputes'));  
    }
   
}
