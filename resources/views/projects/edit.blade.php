@extends('layouts.app')
@section('title','Edit Projects')

@section('content')
    <h1>Update Project</h1>
    <form action="{{ route('projects.update', $project) }}" method="POST">
        @csrf
        @method('PUT')
        <label>
            Project Title: <br>
            <input type="text" name='title' value='{{ old('title', $project->title ?? '') }}' required><br>
        </label><br>
        <label>
            Project Description:<br>
            <input type="text" name='description' value='{{ old('description', $project->description ?? '') }}' required><br>
        </label><br>
        <label>
            Project Budget:<br>
            <input type="text" name='budget' value='{{ old('budget', $project->budget ?? '') }}' required><br>
        </label><br>
        <button type="submit">Update Project</button>
    </form>

@endsection