<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function showBids(Project $project)
    {
        //Retrieve all bids on the project
        $bids = $project->bids()->with('freelancer')->get();

        return view('bids.showProjectbids', compact('project', 'bids'));
        
    }

    public function create(Project $project)
    {
        return view('bids.create', ['project' => $project]);
    }  

    public function store(Project $project, Request $req)
    {
        $incomingFields = $req->validate([
            'bid_amount'=>['required','numeric'], 
            'msg'=>['required','string'],
        ]);
        $incomingFields['project_id'] = $project->id;
        $incomingFields['freelancer_id'] = Auth::id();

        Bid::create($incomingFields);

        return redirect()->route('projects.show', $project->id)
                        ->with('success','Bid submitted successfully!');
    }

    public function assign(Bid $bid) {
        $project = $bid->project;
        $project['status'] = 'assigned';
        $project->update([
            'freelancer_id' => $bid->freelancer_id,
        ]);

        //Accept the current bid for this project
        $bid['status'] = 'accepted';
        $bid->save();
            

        // Reject all other bids for the project
        Bid::where('project_id', $project->id)
            ->where('id', '!=', $bid->id)
            ->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Bid assigned successfully!');
    }

    public function update(Request $request, Bid $bid){
        $bid->update([
            'bid_amount' => $request->bid_amount,
            'msg' => $request->msg,
        ]);
        return redirect()->route('projects.show', $bid->project_id)->with('success', 'Bid updated successfully!');
    }

    public function edit(Bid $bid) {

        //Prevent editing bid_amount and message if the bid is accepted or rejected by boss
        if(in_array($bid->status, ['accepted', 'rejected'])){
            return redirect()->back()->with('error', 'You cannot edit a bid that has been accepted or rejected!');
        }

        return view('bids.edit', compact('bid'));
    }

}