@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4">Milestone Details</h1>
    <div class="card mt-4">
        <div class="card-header">
            <h2>{{ $milestone->title }}</h2>
        </div>
        <div class="card-body">
            <form id="milestoneForm" action="{{ route('milestones.handle', [$project->id, $milestone->id]) }}" method="POST">
                @csrf
                @method('PUT')
                
                <label>
                    @if(Gate::allows('isOpen', $project))
                        <strong>Title:</strong>
                        <input type="text" name="title" value="{{ $milestone->title }}" required>
                    @else
                        <strong>Title:</strong>
                        <p>{{ $milestone->title }}</p>
                    @endif
                </label> 
                <label>
                    @if(Gate::allows('isOpen', $project))
                        <strong>Description:</strong>
                        <textarea name="description" required>{{ $milestone->description }}</textarea>
                    @else
                        <strong>Description:</strong>
                        <p>{{ $milestone->description }}</p>
                    @endif
                </label>
                
                <label>
                    @if(Gate::allows('isOpen', $project))
                        <strong>Amount:</strong>
                        <input type="number" name="amount" value="{{ $milestone->amount }}" required>
                    @else
                        <strong>Amount:</strong>
                        <p>{{ $milestone->amount }}</p>
                    @endif
                </label>
                
                <label>
                    @if(Gate::allows('isOpen', $project))
                        <strong>Due date:</strong>
                        <input type="date" name="due_date" value="{{ $milestone->due_date ? \Carbon\Carbon::parse($milestone->due_date)->format('Y-m-d') : '' }}" required>
                    @else
                        <strong>Due date:</strong>
                        <p>{{ $milestone->due_date ? \Carbon\Carbon::parse($milestone->due_date)->format('Y-m-d') : '' }}</p>
                    @endif
                </label>
                {{-- This is when freelancer want to set milestone to completed --}}
                @can('isFreelancer', $project)
                    <label>
                        <strong>Status:</strong>
                        <select name="status" required {{ $milestone->status == 'completed' ? 'disabled' : '' }}>
                            <option value="in_progress" {{ $milestone->status == 'in_progress' ? 'selected' : '' }}>In progress</option>
                            <option value="completed" {{ $milestone->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </label>
                    <button type="submit" name="submitButton" value='freelancer' id="submitButton">Submit milestones</button>
                @endcan
                @can('isOwner', $project)
                    <label>

                    {{-- This is when owner want to make payment --}}
                    @if($milestone->status == 'completed')
                        <strong>Status:</strong>
                        <select name="status" required>
                            <option value="completed" {{ $milestone->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="paid" {{ $milestone->status == 'paid' ? 'selected' : '' }}>In progress</option>
                        </select>
                    </label>
                    <button type="submit" name="approveButton" value='owner' id="approveButton">Pay Now</button>
                    
                    {{-- This is when owner want to make payment but freelancer haven't finish the job --}}
                    @elseif(Gate::denies('isOpen', $project))
                        <strong>Status:</strong>
                        <select name="status" disabled required>
                            <option value="in_progress" selected>In progress</option>
                        </select>
                    </label><br>
                    <button type="submit" name="disApproveButton" id="disApproveButton" disabled>Pay Now</button>
                    <p>Payment can only be made when freelancer completed the milestone</p>

                    {{-- This is when owner want to update milestone before any freelancer is assigned --}}
                    @elseif(Gate::allows('isOpen', $project))
                        <button type='submit' name='updateMilestone' value='update' id="updateMilestone">Update</button>
                    @endif
                @endcan
            </form>
        </div>
        <div class="card-footer">
            <a href="{{ route('projects.show', $milestone->project->id) }}" class="btn btn-primary">Back to Project</a>
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
                if (!confirm('You are about to mark this milestone as completed. This action cannot be undone. Do you wish to proceed?')) {
                    e.preventDefault();
                }
            }
        });
    });
</script>
@endsection