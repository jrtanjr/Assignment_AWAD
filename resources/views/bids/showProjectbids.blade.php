@extends('layouts.app')

@section('title', 'Bidding Page')

@section('styles')
<link href="{{ asset('css/bidview.css') }}" rel="stylesheet">
@endsection

@section('content')


<div class="container-bids">
<h1 class="title">Bids for {{ $project->title }}</h1>

@foreach($bids as $bid)
@php
        $cardClass = 'bid-card status-pending';
        if ($project->status != 'open') {
            if ($bid->status === 'accepted') {
                $cardClass = 'bid-card status-accepted';
            } elseif ($bid->status === 'rejected') {
                $cardClass = 'bid-card status-rejected';
            } else {
                $cardClass = 'bid-card status-pending';
            }
        }
@endphp

    <div class="{{ $cardClass }}">
    <p class="freelancer-name">
    <strong>{{ $bid->freelancer->name ?? 'Unknown Freelancer' }}</strong>:
    <span class="bid-amount">RM {{ $bid->bid_amount }}</span>
    </p>
        <p class="bid-message">{{ $bid->msg }}</p>

        
        @if($project->status == 'open')
        <form method="POST" action="{{ route('bids.assign', $bid->id) }}">
            @csrf
            <button type="submit" class="btn-assign">Assign to this Freelancer</button>
            
            
        </form>
        
        
        @else
        <p class="status-text">
            <strong>Status:</strong>
            @if($bid->status === 'rejected')
                <span class="status-rejected">Rejected</span>
            @elseif($bid->status === 'accepted')
                <span class="status-accepted">Accepted</span>
            @else
                <span class="status-pending">Pending</span>
            @endif
        </p>
        @endif
    </div>
@endforeach

<br>
<a href="{{ route('projects.index') }}" class="back-link">Back to Project list</a>

@endsection