<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Author;
use Illuminate\Auth\Access\Response;

class ProjectPolicies
{
    public function isFreelancer(Author $user, Project $project)
    {
        return $user->id === $project->freelancer_id;
    }
    
    public function isOwner(Author $user, Project $project)
    {
        return $user->id === $project->owner_id;
    }

    public function viewBids(Author $user, Project $project)
    {
        // Only the owner of the project or freelancers who bid should see bids
        return $user->id === $project->owner_id || $project->bids()->where('freelancer_id', $user->id)->exists();
    }
    
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Author $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Author $user, Project $project)
    {
        return $project->owner_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Author $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function updateProject(Author $user, Project $project): bool
    {
        return $project->owner_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Author $user, Project $project): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Author $user, Project $project): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Author $user, Project $project): bool
    {
        return false;
    }
}
