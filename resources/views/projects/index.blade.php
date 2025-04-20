@extends('layouts.app')
@section('title','Projects')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Open Projects</h2>
    </div>

    @if($projects->isEmpty())
        <div class="alert alert-info text-center">
            No open projects available at the moment.
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($projects as $project)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">{{ $project->title }}</h5>
                            <p class="card-text text-muted">Project ID: {{ $project->id }}</p>
                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-outline-primary mt-auto">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
