@extends('layouts.app')

@section('title','Create Milestone')

@section('content')
    @can('update', $project)
        <form action="{{route('milestones.store', $project->id)}}" method="POST">
            @csrf
            <label>
                <strong>Title:</strong>
                <input type="text" name='title' required>
            </label>
            <label>
                <strong>Description:</strong>
                <input type="text" name='description' required>
            </label>
            <label>
                <strong>Amount:</strong>
                <input type="number" name='amount' required>
            </label>
            <label>
                <strong>Due date:</strong>
                <input type="date" name='due_date' required>
            </label>
            <button type="submit">Submit milestones</button>
        </form>
    @endcan

    @can('updateStatus', $milestone)
        <form action="{{route('milestones.updateStatus', $milestone->id)}}" method="POST">
            @csrf
            @method('PATCH')
            <label>
                <strong>Status:</strong>
                <select name="status" required>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                </select>
            </label>
            <button type="submit">Update Status</button>
        </form>
    @endcan

@endsection