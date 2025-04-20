@extends('layouts.standard')
@section('title','Create Projects')

@section('content')
    <h1>Create New Project</h1>
    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <label>
            New Project Title: <br>
            <input type="text" name='title' required><br>
        </label><br>
        <label>
            New Project Description:<br>
            <input type="text" name='description' required><br>
        </label><br>
        <hr>
        <div id="milestones">
            <hr>
            <label>
            Milestone 1 Title:<br>
            <input type="text" name="milestones[0][title]" required><br>
            </label><br>
            <label>
            Milestone 1 Description:<br>
            <input type="text" name="milestones[0][description]" required><br>
            </label><br>
            <label>
            Milestone 1 Amount:<br>
            <input type="numeric" name="milestones[0][amount]" class="milestone-amount" required><br>
            </label><br>
            <label>
            Milestone 1 Due Date:<br>
            <input type="date" name="milestones[0][due_date]" required min="{{ date('Y-m-d') }}"><br>
            </label><br>
        </div>
        <button type="button" id="add-milestone">+ Add Milestone</button>
        <button type="submit" id="submit-project">Create Project</button>
    </form>
@endsection


@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    let milestoneCount = 1;

    $('#add-milestone').on('click', function () {
        const newMilestone = `
        <div class="milestone">
        <label>
            Milestone ${milestoneCount + 1} Title:<br>
            <input type="text" name="milestones[${milestoneCount}][title]" required><br>
        </label><br>
        <label>
            Milestone ${milestoneCount + 1} Description:<br>
            <input type="text" name="milestones[${milestoneCount}][description]" required><br>
        </label><br>
        <label>
            Milestone ${milestoneCount + 1} Amount:<br>
            <input type="numeric" name="milestones[${milestoneCount}][amount]" class="milestone-amount" required><br>
        </label><br>
        <label>
            Milestone ${milestoneCount + 1} Due Date:<br>
            <input type="date" name="milestones[${milestoneCount}][due_date]" required><br>
        </label><br>
        <button type="button" class="delete-milestone">Delete Milestone</button>
        </div>
        `;
        $('#milestones').append(newMilestone);
        milestoneCount++;
    });

    $(document).on('click', '.delete-milestone', function () {
        $(this).closest('.milestone').remove();
        milestoneCount--;
    });
    </script>
@endsection