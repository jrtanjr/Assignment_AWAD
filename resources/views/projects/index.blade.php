@extends('layouts.standard')
@section('title','Projects')

@section('content')
    <h1>Open Project(s):</h1>
    <p>Show current user ID: {{$userId}} </p>
    

    <ul>
        @foreach($projects as $project)
            <li>
                <a href="{{ route('projects.show', $project->id) }}">
                    {{ $project->title }} - ${{ number_format($project->budget, 2) }}
                </a>
            </li>
        @endforeach
        
    </ul>
    <br>

    <h1>Your own project(s):</h1>
    <ul>
        @foreach($owner as $own)
            <li>
                <a href="{{ route('projects.show', $own->id) }}">
                    {{ $own->title }} - ${{ number_format($own->budget, 2) }}
                </a>
            </li>
        @endforeach
    </ul>
    <br>

    <h1>Project(s) assigned to you:</h1>
    <ul>
        @foreach($bidded as $bid)
            <li>
                <a href="{{ route('projects.show', $bid->id) }}">
                    {{ $bid->title }} - ${{ number_format($bid->budget, 2) }}
                </a>
            </li>
        @endforeach
    </ul>
    <br>
    
    <h1>Project(s) you are bidding:</h1>
    <ul>
        @forelse($bidProjects as $project)
            <li>
                <a href="{{ route('projects.show', $project['id']) }}">
                    {{ $project['title'] }} - ${{ number_format( $project['budget'], 2) }}
                </a>
            </li>
        @empty  
            <li>You haven't placed any bids yet.</li>
        @endforelse
    </ul>

@endsection