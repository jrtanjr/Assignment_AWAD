@extends('layouts.app')

@section('title', 'Project Details')

@section('content')
@php $isOpen = $project->status === 'open'; @endphp

<div class="container mt-4">
    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h4 class="mb-0">{{ $project->title }}</h4>
            @can('view', $project)
                <div>
                    <a href="{{ route('projects.edit', $project) }}" class="btn btn-light btn-sm me-2" {{ $isOpen ? '' : 'disabled' }}>Edit</a>
                    <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" {{ $isOpen ? '' : 'disabled' }}>Delete</button>
                    </form>
                </div>
            @endcan
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $project->description }}</p>
            <p><strong>Total Amount:</strong> ${{ $milestones->sum('amount') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($project->status) }}</p>
            <p><strong>Owner ID:</strong> {{ $project->owner_id }}</p>
            <p><strong>Freelancer ID:</strong> {{ $project->freelancer_id ?? 'Not Assigned' }}</p>
        </div>
    </div>

    @php $userBid = $bids->firstWhere('freelancer_id', $userId); @endphp

    <div class="mb-4">
        @if ($isOpen && $project->owner_id === $userId)
            <a href="{{ route('bids.showProjectbids', $project->id) }}" class="btn btn-outline-secondary">View Bids</a>

        @elseif ($isOpen && $userBid)
            <a href="/bids/{{ $userBid->id }}/edit" class="btn btn-outline-info">Edit Your Bid</a>

        @elseif ($userBid)
            <div>
                <strong>Status:</strong>
                @if($userBid->status === 'rejected')
                    <span class="text-danger fw-bold">Rejected</span>
                @elseif($userBid->status === 'accepted')
                    <span class="text-success fw-bold">Accepted</span>
                @else
                    <span class="text-primary fw-bold">Pending</span>
                @endif
            </div>

        @elseif ($isOpen)
            <form action="{{ route('bids.create', $project->id) }}" method="GET" class="mt-2">
                <button type="submit" class="btn btn-success">Bid Now</button>
            </form>
        @endif
    </div>

    <a href="{{ route('projects.index') }}" class="btn btn-link">← Back to Project List</a>

    @if ($milestones->isNotEmpty())
        <div class="mt-4">
            <h5 class="mb-3">Total Milestones: {{ $milestones->count() }}</h5>

            @foreach ($milestones as $milestone)
                <div class="card mb-2">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1"><strong>{{ $milestone->title }}</strong></p>
                            <p class="mb-0 text-muted">${{ number_format($milestone->amount, 2) }}</p>
                            <p class="mb-0"><strong>Status:</strong> {{ ucfirst($milestone->status) }}</p>
                        </div>
                        @if ($milestone->status === 'in_progress' || ($milestone->status === 'completed' && $project->owner_id === $userId))
                            @can('update', $milestone)
                                <a href="{{ route('milestones.edit', ['project' => $project->id, 'milestone' => $milestone->id]) }}"
                                   class="btn btn-sm btn-outline-primary">Update</a>
                            @endcan
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
