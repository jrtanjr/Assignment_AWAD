@extends('layouts.app')
@section('title','Create Project')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Create New Project</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Project Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Project Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>

                <hr>
                <h5>Milestones</h5>
                <div id="milestones">
                    <div class="card mb-3 p-3 milestone">
                        <h6>Milestone 1</h6>
                        <div class="mb-2">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="milestones[0][title]" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="milestones[0][description]" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Amount</label>
                            <input type="number" step="0.01" class="form-control" name="milestones[0][amount]" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Due Date</label>
                            <input type="date" class="form-control" name="milestones[0][due_date]" required min="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-outline-primary mb-3" id="add-milestone">+ Add Milestone</button>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Create Project</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let milestoneCount = 1;

$('#add-milestone').on('click', function () {
    const milestoneHTML = `
    <div class="card mb-3 p-3 milestone">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h6 class="mb-0">Milestone ${milestoneCount + 1}</h6>
            <button type="button" class="btn btn-sm btn-danger delete-milestone">Remove</button>
        </div>
        <div class="mb-2">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="milestones[${milestoneCount}][title]" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Description</label>
            <input type="text" class="form-control" name="milestones[${milestoneCount}][description]" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Amount</label>
            <input type="number" step="0.01" class="form-control" name="milestones[${milestoneCount}][amount]" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Due Date</label>
            <input type="date" class="form-control" name="milestones[${milestoneCount}][due_date]" required min="{{ date('Y-m-d') }}">
        </div>
    </div>`;
    $('#milestones').append(milestoneHTML);
    milestoneCount++;
});

$(document).on('click', '.delete-milestone', function () {
    $(this).closest('.milestone').remove();
});
</script>
@endsection
