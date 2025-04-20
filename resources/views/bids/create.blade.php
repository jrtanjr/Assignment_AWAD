@extends('layouts.app')

@section('title', 'Bidding Page')

@section('styles')
<link href="{{ asset('css/bidview.css') }}" rel="stylesheet">
@endsection

@section('content')


    <h1><strong>{{ $project->title }}</strong></h1> 
    <div class="form-container">
    <form action="{{ route('bids.store', $project->id) }}" method="POST">
        @csrf
        <label>
            <strong>Name:</strong>
            <input type="text" name='name' value={{auth()->user()->name}} disabled>
        </label>
        <br>
        <label>
            <strong>Message for project owner:</strong><br>
            <textarea name="msg"  required></textarea>
            
        </label>
        <div>
        <label>
            <br>
            <strong>Bid Amount:</strong><br>
            <input type="number" name="bid_amount" min="0" required>
        </label></div>
        <input type="hidden" name="project_id" value="{{ $project->id }}">

        <div class="form-footer">
            <button type='submit' class="form-btn"> Submit bid</button>
            <a href="{{ route('projects.index') }}" class="back-link">Back to Project list</a>
        </div>
    </form>
</div>

    
@endsection