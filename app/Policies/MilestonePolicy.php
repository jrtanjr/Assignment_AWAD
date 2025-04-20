<?php

namespace App\Policies;

use App\Models\Milestone;
use App\Models\Author;
use Illuminate\Auth\Access\HandlesAuthorization;

class MilestonePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the Author can view any models.
     *
     * @param  \App\Models\Author  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Author $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Author  $user
     * @param  \App\Models\Milestone  $milestone
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Author $user, Milestone $milestone)
    {
        //
    }

    /**
     * Determine whether the Author can create models.
     *
     * @param  \App\Models\Author  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Author $user)
    {
        //
    }

    /**
     * Determine whether the Author can update the model.
     *
     * @param  \App\Models\Author  $user
     * @param  \App\Models\Milestone  $milestone
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Author $user, Milestone $milestone)
    {
        return $user->id === $milestone->project->freelancer_id || $user->id === $milestone->project->owner_id;
    }
    

    /**
     * Determine whether the Author can delete the model.
     *
     * @param  \App\Models\Author  $Author
     * @param  \App\Models\Milestone  $milestone
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Author $Author, Milestone $milestone)
    {
        //
    }

    /**
     * Determine whether the Author can restore the model.
     *
     * @param  \App\Models\Author  $user
     * @param  \App\Models\Milestone  $milestone
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Author $user, Milestone $milestone)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Author  $user
     * @param  \App\Models\Milestone  $milestone
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Author $user, Milestone $milestone)
    {
        //
    }
}
