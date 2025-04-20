@extends('layouts.app')
@section('title','Projects')

@section('content')
    <h1>Open Project(s):</h1>
    <p>Show current user ID: {{$userId}} </p>

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
