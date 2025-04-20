@extends('layouts.app')

@section('title', 'Bidding Page')

@section('styles')
<link href="{{ asset('css/bidview.css') }}" rel="stylesheet">
@endsection

@section('content')



<h1>Bids for {{ $project->title }}</h1>

@foreach($bids as $bid)
    <div>
    <p>
    <strong>{{ $bid->freelancer->name ?? 'Unknown Freelancer' }}</strong>:
    RM {{ $bid->bid_amount }}
    </p>
        <p>{{ $bid->msg }}</p>

        @if($project->status == 'open')
        <form method="POST" action="{{ route('bids.assign', $bid->id) }}">
            @csrf
            <button type="submit" class="btn btn-success">Assign to this Freelancer</button>
        </form>
        

        @else
        <p>
            <strong>Status:</strong>
            @if($bid->status === 'rejected')
                <span style="color:red; font-weight: bold;">Rejected</span>
            @elseif($bid->status === 'accepted')
                <span style="color:green; font-weight: bold">Accepted</span>
            @else
                <span style="color:blue; font-weight: bold">Pending</span>
            @endif
        </p>
        @endif
    </div>
@endforeach

<br>
<a href="{{ route('projects.index') }}">Back to Project list</a>

@endsection