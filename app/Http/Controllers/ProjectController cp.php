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

class ProjectController extends Controller
{
    public function index()
    {
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'budget' => 'required|numeric',
            'milestones' => 'required|array',
            'milestones.*.title' => 'required|string',
            'milestones.*.description' => 'required|string',
            'milestones.*.due_date' => 'required|date',
            'milestones.*.amount' => 'required|numeric',
        ]);
        $incomingFields['owner_id']=Auth::id();
        $project = Project::create($incomingFields);

        foreach ($incomingFields['milestones'] as $milestone) {
            $project->milestones()->create($milestone);
        }
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
        $project->milestones()->delete();
        $project->bids()->delete();
        return redirect()->route('projects.index');
    }

    public function showBids(Project $project)
    {
        $this->authorize('viewBids', $project);
        return response()->json($project->bids);
    }
}
