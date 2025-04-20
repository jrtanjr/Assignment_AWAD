@extends('layouts.app')

@section('title', 'Milestone Details')

@section('styles')
    <link href="{{ asset('css/milestoneview.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h1><strong>Milestone Details</strong></h1>
    <div class="form-container">
        <form id="milestoneForm" action="{{ route('milestones.handle', $milestone) }}" method="POST">
            @csrf
            @method('PUT')

            <label>
                <strong>Title:</strong>
                @if(Gate::allows('isOpen', $milestone->project))
                    <input type="text" name="title" value="{{ $milestone->title }}" required>
                @else
                    <p>{{ $milestone->title }}</p>
                @endif
            </label>

            <label>
                <strong>Description:</strong>
                @if(Gate::allows('isOpen', $milestone->project))
                    <textarea name="description" required>{{ $milestone->description }}</textarea>
                @else
                    <p>{{ $milestone->description }}</p>
                @endif
            </label>

            <label>
                <strong>Amount:</strong>
                @if(Gate::allows('isOpen', $milestone->project))
                    <input type="number" name="amount" value="{{ $milestone->amount }}" required>
                @else
                    <p>{{ $milestone->amount }}</p>
                @endif
            </label>

            <label>
                <strong>Due Date:</strong>
                @if(Gate::allows('isOpen', $milestone->project))
                    <input type="date" name="due_date" value="{{ $milestone->due_date ? \Carbon\Carbon::parse($milestone->due_date)->format('Y-m-d') : '' }}" required>
                @else
                    <p>{{ $milestone->due_date ? \Carbon\Carbon::parse($milestone->due_date)->format('Y-m-d') : '' }}</p>
                @endif
            </label>

            @can('isFreelancer', $milestone->project)
                <label>
                    <strong>Status:</strong>
                    <select name="status" required {{ $milestone->status == 'completed' ? 'disabled' : '' }}>
                        <option value="in_progress" {{ $milestone->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ $milestone->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </label>
            @endcan

            @can('isOwner', $milestone->project)
                <label>
                    <strong>Status:</strong>
                    @if($milestone->status == 'completed')
                        <p>Completed</p>
                    @elseif($milestone->status == 'paid')
                        <p>Paid</p>
                    @elseif(Gate::denies('isOpen', $milestone->project))
                        <p>In Progress</p>
                    @endif
                </label>
            @endcan

            <div class="form-footer">
                @can('isFreelancer', $milestone->project)
                    <button type="submit" name="submitButton" value="freelancer" id="submitButton" class="form-btn" {{ $milestone->status == 'completed' ? 'disabled' : '' }}>Submit Milestone</button>
                @endcan

                @can('isOwner', $milestone->project)
                    @if($milestone->status == 'completed')
                        <button type="submit" name="approveButton" value="owner" id="approveButton" class="form-btn">Pay Now</button>
                    @elseif($milestone->status == 'paid')
                        <!-- No button for paid status -->
                    @elseif(Gate::denies('isOpen', $milestone->project))
                        <button type="submit" name="disApproveButton" id="disApproveButton" class="form-btn" disabled>Pay Now</button>
                        <p class="error-message">Payment can only be made when the freelancer completes the milestone.</p>
                    @elseif(Gate::allows('isOpen', $milestone->project))
                        <button type="submit" name="updateMilestone" value="update" id="updateMilestone" class="form-btn">Update</button>
                    @endif
                @endcan

                <a href="{{ route('projects.show', $milestone->project->id) }}" class="back-link">Back to Project</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        let initialStatus = "{{ $milestone->status }}";

        $('select[name="status"]').on('change', function() {
            const selectedStatus = $(this).val();

            if (selectedStatus === 'completed' && initialStatus !== 'completed') {
                if (!confirm('Are you sure you want to mark this milestone as completed? This action cannot be undone.')) {
                    $(this).val('in_progress');
                }
            }
        });

        $('#submitButton').on('click', function(e) {
            const selectedStatus = $('select[name="status"]').val();

            if (selectedStatus === 'completed' && initialStatus !== 'completed') {
                if (!confirm('You are about to mark this milestone as completed. This action cannot be undone. Do you wish to proceed?')) {
                    e.preventDefault();
                }
            }
        });
    });
</script>
@endsection