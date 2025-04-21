@extends('layouts.app')
@section('title', 'Assigned Projects')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="card-title mb-3 text-primary">🛠️ Projects Assigned to You</h2>            
            @if($projects->isEmpty())
                <div class="alert alert-info">
                    No projects have been assigned to you yet.
                </div>
            @else
                <ul class="list-group">
                    @foreach($projects as $bid)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <a href="{{ route('projects.show', $bid->id) }}" class="text-decoration-none">
                                    <strong>{{ $bid->title }}</strong>
                                </a>
                            </div>
                            <span class="badge bg-success">Assigned</span>
                        </li>
                    @endforeach
                </ul>
            @endif

            <div class="mt-4">
                <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary">
                    ← Back to All Projects
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
