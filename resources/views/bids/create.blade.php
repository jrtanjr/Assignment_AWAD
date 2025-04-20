@extends('layouts.app')

@section('title', 'Bidding Page')

@section('content')
    <h1>{{ $project->title }}</h1>   
    <form action="{{ route('bids.store', $project->id) }}" method="POST">
        @csrf
        <label>
            <strong>Name:</strong>
            <input type="text" name='name' value={{auth()->user()->name}} disabled>
        </label>
        <br>
        <label>
            <strong>Message for project owner:</strong><br>
            <textarea name="msg" cols="30" rows="10" required></textarea>
        </label>
        <label>
            <strong>Bid Amount:</strong><br>
            <input type="number" name="bid_amount" min="0" required>
        </label>
        <input type="hidden" name="project_id" value="{{ $project->id }}">
        <button type='submit'> Submit bid</button>
    </form>
    
@endsection