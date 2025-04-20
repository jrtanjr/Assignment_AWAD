@extends('layouts.app')

@section('title', 'Bidding Page')

@section('styles')
<link href="{{ asset('css/bidview.css') }}" rel="stylesheet">
@endsection

@section('content')


<h1><strong>Edit Your Bid for Project {{$bid->project_id}}</strong></h1>
<div class="form-container">
<form method="POST" action="/bids/{{ $bid->id }}">
    @csrf
    @method('PUT')
    <strong>Bid_amount:</strong><br> 
    <input type="number" name="bid_amount" value="{{ $bid->bid_amount }}">
    <br>
    <br>
    <strong>Your message:</strong><br> <textarea name="msg">{{ $bid->msg }}</textarea>
    <br>
    <br>
    <div class="form-footer">
        <button type="submit" class="form-btn">Update</button>
        <a href="{{ route('projects.index') }}" class="back-link">Back to Project list</a>
    </div>
</form>
</div>



@endsection