@extends('layouts.app')
@section('title','Bidded Projects')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Projects You Are Bidding</h2>
        <span class="text-muted">User ID: <strong>{{ $userId }}</strong></span>
    </div>

    @forelse($bidProjects as $project)
        <div class="card mb-3 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">{{ $project['title'] }}</h5>
                    <small class="text-muted">Project ID: {{ $project['id'] }}</small>
                </div>
                <a href="{{ route('projects.show', $project['id']) }}" class="btn btn-outline-primary">View Project</a>
            </div>
        </div>
    @empty
        <div class="alert alert-warning text-center">
            You haven't placed any bids yet.
        </div>
    @endforelse
</div>
@endsection
