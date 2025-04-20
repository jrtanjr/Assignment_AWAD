<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Milestone;
use App\Models\Project;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Contracts\Service\Attribute\Required;
use App\Models\Author;

class ProjectController extends Controller
{

    public function getOpenProjects()
    {
        $userId = Auth::id();
        $projects = Project::where('status', 'open')
                      ->where('owner_id', '!=', $userId)
                      ->get();
        return view('projects.index', compact('projects','userId'));
    }

    public function getOwnedProjects()
    {        
        $userId = Auth::id();
        $projects = Project::where('owner_id', $userId)->get();
        return view('projects.ownedProjects', compact('projects', 'userId'));
    }

    public function getBiddedProjects()
    {
        $userId = Auth::id();
        $projects = Project::where('freelancer_id', $userId)->get();
        return view('projects.biddedProjects', compact('projects', 'userId'));
    }

    public function getBidProjects()
    {
        $userId = Auth::id();
        $bidding = Bid::where('freelancer_id', $userId)->get();
        $bidProjects = [];

        foreach ($bidding as $bid) {
            $project = Project::find($bid->project_id);

            if ($project && $project->freelancer_id !== $userId) {
                $bidProjects[] = [
                    'id' => $project->id,
                    'title' => $project->title,
                    'budget' => $project->budget
                ];
            }
        }

        return view('projects.bidProjects', compact('bidProjects', 'userId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'milestones' => 'required|array',
            'milestones.*.title' => 'required|string',
            'milestones.*.description' => 'required|string',
            'milestones.*.due_date' => 'required|date',
            'milestones.*.amount' => 'required|numeric',
        ]);

        try {
            $incomingFields['owner_id'] = Auth::id();
            $project = Project::create($incomingFields);

            foreach ($incomingFields['milestones'] as $milestone) {
                $project->milestones()->create($milestone);
            }

            return redirect()->route('projects.index')->with('success', 'Project created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create project. Please try again.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $userId = Auth::id();
        $milestones = collect();
        $bids = Bid::where('project_id', $project->id)->get();
        $milestones = Milestone::where('project_id', $project->id)->get();
        
        return view('projects.show', compact('project', 'milestones', 'bids', 'userId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        try {
            $this->authorize('updateProject', $project);
        } catch (AuthorizationException $e) {
            return redirect()->route('projects.index')->with('error', 'Unauthorized.');
        }
        return view('projects.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $incomingFields = $request->validate([
            'title' => ['string','required','max:50'],
            'description' => ['string','required'],
        ]);
        $project->update($incomingFields);
        
        return redirect()->route('projects.show', ['project' => $project]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        $project->milestones()->delete();
        $project->bids()->delete();
        return redirect()->route('projects.index');
    }

    public function showBids(Project $project)
    {
        $this->authorize('viewBids', $project);
        return response()->json($project->bids);
    }
    // public function show(Project $project)
    // {
    //     $userId = Auth::id(); //get current logged-in user's id
    //     $milestones = collect();
    //     $bids = collect();
    //     $freeOrBoss = null;

    
    // //Verify the current user's role in the project (Freelancer or Project Owner)
    // if($userId === $project->owner_id){
    //     //Project owner
    //     $milestones = Milestone::where('project_id', $project->id())->get();
    //     $bids = Bid::where('project_id', $project->id())->get();

    //     //Get project bidder(freelancer)'s name
    //     $freeOrBoss = \App\Models\Author::find($project->freelancer_id);

    // }

    // elseif($userId === $project->freelancer_id){
    //     //Project Bidder / freelancer
    //     $milestones = Milestone::where('project_id', $project->id())->get();
    //     $bids = Bid::where('project_id', $project->id())->get();

    //     //Get project owner's name
    //     $freeOrBoss = \App\Models\Author::find($project->owner_id);
    // }

    // return view('projects.show', compact('project', 'milestones', 'bids', 'freeOrBoss'));
    // }














}
