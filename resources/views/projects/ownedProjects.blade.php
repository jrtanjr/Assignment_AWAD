@extends('layouts.app')

@section('title', 'My Projects')

@section('content')
<div class="container mt-4">
    <div class="mb-4">
        <h2 class="fw-bold">Your Projects Dashboard</h2>
        <p class="text-muted">Logged in as User ID: <span class="fw-semibold">{{ $userId }}</span></p>
    </div>

    {{-- Open Projects (No Bids) --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-warning text-dark fw-bold">
            Open Projects (No Bids)
        </div>
        <ul class="list-group list-group-flush">
            @forelse($projects->where('status', 'open')->filter(fn($own) => $own->bids->isEmpty()) as $own)
                <li class="list-group-item">
                    <a href="{{ route('projects.show', $own->id) }}" class="text-decoration-none">
                        {{ $own->title }} <span class="badge bg-secondary ms-2">No Bids</span>
                    </a>
                </li>
            @empty
                <li class="list-group-item text-muted">No open projects without bids.</li>
            @endforelse
        </ul>
    </div>

    {{-- Open Projects (With Bids) --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-info text-white fw-bold">
            Open Projects (With Bids)
        </div>
        <ul class="list-group list-group-flush">
            @forelse($projects->where('status', 'open')->filter(fn($own) => !$own->bids->isEmpty()) as $own)
                <li class="list-group-item">
                    <a href="{{ route('projects.show', $own->id) }}" class="text-decoration-none">
                        {{ $own->title }} <span class="badge bg-success ms-2">Has Bids</span>
                    </a>
                </li>
            @empty
                <li class="list-group-item text-muted">No open projects with bids.</li>
            @endforelse
        </ul>
    </div>

    {{-- Bidded Projects --}}
    <div class="card mb-5 shadow-sm">
        <div class="card-header text-bg-success fw-bold">
            Assigned (Bidded) Projects
        </div>
        <ul class="list-group list-group-flush">
            @forelse($projects->where('status','assigned') as $project)
                <li class="list-group-item">
                    <a href="{{ route('projects.show', $project->id) }}" class="text-decoration-none">
                        {{ $project->title }} <span class="badge bg-primary ms-2">Assigned</span>
                    </a>
                </li>
            @empty
                <li class="list-group-item text-muted">No assigned/bidded projects found.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
