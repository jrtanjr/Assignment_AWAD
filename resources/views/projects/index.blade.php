@extends('layouts.app')
@section('title','Projects')

@section('content')
    <h1>Open Project(s):</h1>
    <p>Show current user ID: {{$userId}} </p>

    <ul>
        @foreach($projects as $project)
            <li>
                <a href="{{ route('projects.show', $project->id) }}">
                    {{ $project->title }}
                </a>
            </li>
        @endforeach
    </ul>
    <br>

@endsection
