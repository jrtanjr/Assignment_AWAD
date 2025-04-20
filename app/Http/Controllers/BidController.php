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

        //Update the project status to 'assigned'
        // and set the freelancer_id to the freelancer who won the bid
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

        //Get milestones related to the project
        $milestones = $project->milestones;

        $originalTotal = $milestones->sum('amount');

        if($originalTotal > 0){
            // Update each milestone by scaling its amount based on the ratio of the original total, using the bid amount as the new sum of milestones (project budget)
            foreach ($milestones as $milestone) {
                $originalAmount = $milestone->amount;
                $scaledAmount = ($originalAmount / $originalTotal) * $bid->bid_amount;
                
                $milestone->amount = $scaledAmount;
                $milestone->save();

            
            }}
        return redirect()->back()->with('success', 'Bid assigned and milestones updated proportionally!');
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