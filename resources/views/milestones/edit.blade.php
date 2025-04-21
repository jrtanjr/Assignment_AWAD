@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4">Milestone Details</h1>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $milestone->title }}</h4>
        </div>

        <div class="card-body">
            <form id="milestoneForm" action="{{ route('milestones.handle', $milestone) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <div class="mb-3">
                    <label class="form-label"><strong>Title</strong></label>
                    @if(Gate::allows('isOpen', $milestone->project))
                        <input type="text" class="form-control" name="title" value="{{ $milestone->title }}" required>
                    @else
                        <p class="form-control-plaintext">{{ $milestone->title }}</p>
                    @endif
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label"><strong>Description</strong></label>
                    @if(Gate::allows('isOpen', $milestone->project))
                        <textarea class="form-control" name="description" rows="3" required>{{ $milestone->description }}</textarea>
                    @else
                        <p class="form-control-plaintext">{{ $milestone->description }}</p>
                    @endif
                </div>

                {{-- Amount --}}
                <div class="mb-3">
                    <label class="form-label"><strong>Amount</strong></label>
                    @if(Gate::allows('isOpen', $milestone->project))
                        <input type="number" class="form-control" name="amount" value="{{ $milestone->amount }}" required>
                    @else
                        <p class="form-control-plaintext">${{ number_format($milestone->amount, 2) }}</p>
                    @endif
                </div>

                {{-- Due Date --}}
                <div class="mb-3">
                    <label class="form-label"><strong>Due Date</strong></label>
                    @if(Gate::allows('isOpen', $milestone->project))
                        <input type="date" class="form-control" name="due_date" value="{{ $milestone->due_date ? \Carbon\Carbon::parse($milestone->due_date)->format('Y-m-d') : '' }}" required>
                    @else
                        <p class="form-control-plaintext">{{ $milestone->due_date ? \Carbon\Carbon::parse($milestone->due_date)->format('Y-m-d') : 'N/A' }}</p>
                    @endif
                </div>

                {{-- Freelancer Status Update --}}
                @can('isFreelancer', $milestone->project)
                    <div class="mb-3">
                        <label class="form-label"><strong>Status</strong></label>
                        <select class="form-select" name="status" required {{ $milestone->status == 'completed' ? 'disabled' : '' }}>
                            <option value="in_progress" {{ $milestone->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ $milestone->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <button type="submit" name="submitButton" value="freelancer" class="btn btn-success" id="submitButton" {{ $milestone->status == 'completed' ? 'disabled' : '' }}>
                        Submit Milestone
                    </button>
                @endcan

                {{-- Owner Controls --}}
                @can('isOwner', $milestone->project)
                    <div class="mb-3">
                        @if($milestone->status == 'completed' || $milestone->status == 'paid')
                        <label class="form-label"><strong>Status</strong></label>
                        @endif
                        @if($milestone->status == 'completed')
                            <p class="form-control-plaintext text-success">Completed</p>
                            <button type="submit" name="approveButton" value="owner" class="btn btn-primary">Pay Now</button>
                        @elseif($milestone->status == 'paid')
                            <p class="form-control-plaintext text-muted">Paid</p>
                        @elseif(Gate::denies('isOpen', $milestone->project))
                            <select class="form-select" disabled>
                                <option value="in_progress" selected>In Progress</option>
                            </select>
                            <button type="button" class="btn btn-secondary mt-2" disabled>Pay Now</button>
                            <p class="text-danger mt-2">Payment can only be made when freelancer completes the milestone.</p>
                        @elseif(Gate::allows('isOpen', $milestone->project))
                            <br><button type="submit" name="updateMilestone" value="update" class="btn btn-warning">Update Milestone</button>
                        @endif
                    </div>
                @endcan
            </form>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('projects.show', $milestone->project->id) }}" class="btn btn-outline-secondary">← Back to Project</a>
        </div>
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
                if (!confirm('You are about to mark this milestone as completed. This action cannot be undone. Proceed?')) {
                    e.preventDefault();
                }
            }
        });
    });
</script>
@endsection
