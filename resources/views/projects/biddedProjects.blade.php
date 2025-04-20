@extends('layouts.app')
@section('title','Projects')

@section('content')
    <h1>Project(s) assigned to you:</h1>
    <p>Show current user ID: {{$userId}} </p>

    <ul>
        @foreach($projects as $bid)
            <li>
                <a href="{{ route('projects.show', $bid->id) }}">
                    {{ $bid->title }} - ${{ number_format($bid->budget, 2) }}
                </a>
            </li>
        @endforeach
    </ul>
    <br>
    
@endsection
