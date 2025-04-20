@extends('layouts.app')
@section('title','Projects')

@section('content')
    <h1>Projects</h1>
    <ul>
        @foreach($projects as $project)
            <li>
                <a href="{{ route('projects.show', $project->id) }}">
                    {{ $project->title }} - ${{ number_format($project->budget, 2) }}
                </a>
            </li>
        @endforeach
    </ul>

@endsection