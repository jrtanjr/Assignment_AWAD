@extends('layouts.app')
@section('title','Projects')

@section('content')
    <h1>Your own project(s):</h1>
    <p>Show current user ID: {{$userId}} </p>
    <ul>
        @foreach($projects as $own)
            <li>
                <a href="{{ route('projects.show', $own->id) }}">
                    {{ $own->title }} - ${{ number_format($own->budget, 2) }}
                </a>
            </li>
        @endforeach
    </ul>
    <br>

@endsection
