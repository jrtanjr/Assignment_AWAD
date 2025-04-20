<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use App\Models\Project;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    public function create(Project $project)
    {
        return view('milestones.create', ['project' => $project]);
    }
    public function store(Project $project, Request $req)
    {
        $incomingFields = $req->validate([
            'title' => ['required, string'],
            'description' => ['required, string'],
            'amount' => ['required', 'number'],
            'due_date' => ['required', 'date'],
        ]);

        $incomingFields['project_id'] = $project->id;

        Milestone::create($incomingFields);

        return redirect()->route('projects.show', $project->id)
                        ->with('success','Bid submitted successfully!');
    }
    public function edit(Project $project, Milestone $milestone)
    {
        $this->authorize('update', $milestone);
        return view('milestones.edit', ['project' => $project, 'milestone' => $milestone]);
    }

    public function ownerUpdate(Request $req, Milestone $milestone)
    {
        $incomingFields = $req->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'amount' => ['required', 'numeric', 'min:0'],
            'due_date' => ['required', 'date'],
            'status' => ['required', 'string'],
        ]);
        $milestone->status= $incomingFields['status'];
        $milestone->update($incomingFields);

        return redirect()->route('projects.show', $milestone->project_id)
                        ->with('success','Milestone updated successfully!');
    }
    public function ownerApprove(Request $req, Milestone $milestone)
    {
        $incomingFields = $req->validate([
            'status' => ['required', 'string'],
        ]);
        $milestone->status= $incomingFields['status'];
        $milestone->save();

        return redirect()->route('projects.show', $milestone->project_id)
                        ->with('success','Milestone updated successfully!');
    }
    public function freelanceUpdate(Request $req, Milestone $milestone)
    {
        $incomingFields = $req->validate([
            'status' => ['required', 'string'],
        ]);
        $milestone->status= $incomingFields['status'];
        $milestone->save();

        return redirect()->route('projects.show', $milestone->project_id)
                        ->with('success','Milestone updated successfully!');
    }



    //
    public function handle(Request $request, Project $project, Milestone $milestone)
    {
        if ($request->has('submitButton')) {
            // Freelancer submitting milestone
            $milestone->status = $request->input('status');
            $milestone->save();
            return redirect()->route('projects.show', $milestone->project_id)
                ->with('success','Milestone updated successfully!');
}

        elseif ($request->has('approveButton')) {
            $milestone->status = 'paid';
            $milestone->save();
            // Optionally: create Payment record
            return redirect()->route('projects.show', $milestone->project_id)
                ->with('success','Milestone updated successfully!');
}

        elseif ($request->has('updateMilestone')) {
            // Owner updating milestone
            $incomingFields = $request->validate([
                'title' => ['required', 'string', 'max:255'],
                'description' => ['nullable', 'string'],
                'amount' => ['required', 'numeric', 'min:0'],
                'due_date' => ['required', 'date'],
                'status' => ['required', 'string'],
            ]);
            $milestone->status= $incomingFields['status'];
            $milestone->update($incomingFields);
            return redirect()->route('projects.show', $milestone->project_id)
                ->with('success','Milestone updated successfully!');

        }    

        return back()->with('error', 'No valid action provided.');
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}