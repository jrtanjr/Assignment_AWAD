@extends('layouts.standard')

@section('content')
<div class="container">
    <div class="card mt-5">
        <div class="card-header bg-success text-white">
            <h3>Payment Successful</h3>
        </div>
        
        <div class="card-body">
            <p><strong>Milestone:</strong> {{ $milestone->title }}</p>
            <p><strong>Amount Paid:</strong> ${{ number_format($payment->amount, 2) }}</p>
            <p><strong>Transaction ID:</strong> {{ $payment->transaction_id }}</p>
            <p><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>
            <p><strong>Paid On:</strong> {{ $payment->created_at->format('d M Y, h:i A') }}</p>
        </div>
        
        <div class="card-footer">
            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary">Back to Project</a>
        </div>
    </div>

</div>
@endsection
