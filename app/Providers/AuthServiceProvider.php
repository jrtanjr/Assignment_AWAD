<?php

namespace App\Providers;

use App\Models\Milestone;
use App\Models\Project;
use App\Models\Author;
use App\Policies\MilestonePolicy;
use App\Policies\ProjectPolicies;
// use App\Policies\UserPolicy;
use Illuminate\Auth\Access\Gate as AccessGate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Project::class => ProjectPolicies::class,
        Milestone::class => MilestonePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isOpen', function (Author $user, Project $project) {
            return $project->status === 'open';
        });
    }
}
