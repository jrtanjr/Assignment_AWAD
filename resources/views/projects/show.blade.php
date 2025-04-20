@extends('layouts.app')

@section('title','Project page')

@section('content')
    @php
    $isOpen = $project->status === 'open';
    @endphp
    @can('view', $project)
        <p><strong>Note:</strong> Created by me</p>
        <button onclick="window.location='{{ route('projects.edit', $project) }}'" {{ $isOpen ? '' : 'disabled'}}>
            Edit project
        </button>
        <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are you sure?')" {{ $isOpen ? '' : 'disabled'}}>Delete</button>
        </form>

    @endcan
    <h1>{{ $project->title }}</h1>
    <p><strong>Description:</strong> {{ $project->description }}</p>
    <p><strong>Total Amount:</strong> ${{ $milestones->sum('amount') }}</p>
    <p><strong>Status:</strong> {{ ucfirst($project->status) }}</p>
    <p><strong>Owner ID:</strong> {{ $project->owner_id }}</p>
    <p><strong>Freelancer ID:</strong> {{ $project->freelancer_id ?? 'Not Assigned' }}</p>

    @php
    $userBid = $bids->firstWhere('freelancer_id', $userId);
    @endphp
    
    @if ($isOpen && $project->owner_id === $userId)
    <a href="/projects/{{ $project->id }}/bids">View Bids</a>
    <br><br>

    @elseif ($isOpen && $userBid) 
        <a href="/bids/{{ $userBid->id }}/edit">Edit Your Bid</a>
        <br><br>
    
     @elseif ($userBid) 
     <p>
        <strong>Status:</strong>
        @if($userBid->status === 'rejected')
            <span style="color:red; font-weight: bold;">Rejected</span>
        @elseif($userBid->status === 'accepted')
            <span style="color:green; font-weight: bold">Accepted</span>
        @else
            <span style="color:blue; font-weight: bold">Pending</span>
        @endif
        <br><br>
        
    @elseif ($isOpen)
    <form action="{{ route('bids.create', $project->id) }}" method="GET">
        <button type="submit">Bid Now</button>
    </form>
    @endif

    <a href="{{ route('projects.index') }}">← Back to Project List</a>
    @if ($milestones->isNotEmpty())
        <div class="mb-4">
            <h3>Total Milestones: {{ $milestones->count() }}</h3>

            @foreach ($milestones as $milestone)
                <div class="border p-3 rounded mb-2"><hr>
                    <p>{{ $milestone->title }}</p>
                    <p>{{ $milestone->amount }}</p>
                    @can('update', $milestone)
                    <a href="{{ route('milestones.edit', ['project' => $project->id, 'milestone' => $milestone->id]) }}" class="btn btn-sm btn-primary ml-2">
                        Update
                    </a>
                    @endcan
                </div>
            @endforeach
        </div>
    @endif

@endsection