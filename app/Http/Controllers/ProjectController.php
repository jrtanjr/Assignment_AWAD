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
    public function index()
    {
        $userId = Auth::id();
        //Only display the project that is related to the user (if the user is bidder or owner of the project)
        // $OwnerORBidder = Project::where(function ($query) use ($userId){
        //     $query->where('owner_id', $userId)
        //     ->orWhere('freelancer_id', $userId);
        // })->orWhere('status', 'open')->get();

        //Only display the open project 
        $projects = Project::where('status', 'open')
                            ->where('owner_id', '!=', $userId)
                            ->get();

        //Only display the owned project
        $owner = Project::where('owner_id', $userId)->get();

        //Only display the bidded project
        $bidded = Project::where('freelancer_id', $userId)->get();

        //Only display the project that you are bidding
        $bidding = Bid::where('freelancer_id', $userId)->get();
        //Create new array for the responding projects that the freelancer have submit bid
        $bidProjects= [];
        
        foreach($bidding as $bid){
            //fetch project based on project_id in each bid
            $project = Project:: find($bid->project_id);

            //Only fetch the project that you are bidding, exclude the project assigned to you
            if($project && $project->freelancer_id !== $userId){
                $bidProjects[]=[
                    'id' => $project->id,
                    'title' => $project->title,
                    'budget' => $project->budget
                ];
            }
        }

        return view('projects.index', compact('projects', 'userId', 'owner', 'bidded', 'bidProjects'));
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
            'title' => ['string','required','max:50'],
            'description' => ['string','required'],
            'budget' => ['numeric','required'] 
        ]);
        $incomingFields['owner_id']=Auth::id();
        Project::create($incomingFields);

        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $userId = Auth::id();
        $milestones = collect();
        $bids = Bid::where('project_id', $project->id)->get();
        
        if ($project->status === 'assigned' && ($project->freelancer_id === Auth::id() || $project->owner_id === Auth::id())) {
            $milestones = Milestone::where('project_id', $project->id)->get();
        }
        // $bids = collect();
        // if ($project->status === 'open' && $project->owner_id === Auth::id()) {
        //     $bids = Bid::where('project_id', $project->id)->get();
        // }
        // if ($project->status === 'open' && $bids->freelancer_id === Auth::id())
        //     $bidding = Bid::where('project_id', $project->id)->get();
        
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
            'budget' => ['numeric','required'] 
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
