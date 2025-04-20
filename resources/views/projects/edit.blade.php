@extends('layouts.app')
@section('title', 'Edit Project')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Project</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('projects.update', $project) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Project Title</label>
                            <input type="text" id="title" name="title" 
                                   value="{{ old('title', $project->title ?? '') }}" 
                                   class="form-control" required>
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Project Description</label>
                            <textarea id="description" name="description" 
                                      class="form-control" rows="4" required>{{ old('description', $project->description ?? '') }}</textarea>
                        </div>

                        {{-- Submit --}}
                        <button type="submit" class="btn btn-success">Update Project</button>
                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
