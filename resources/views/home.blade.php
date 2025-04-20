@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-5">
        <h1 class="display-4">Welcome to CodeFlex</h1>
        <p class="lead">Manage your freelance milestones and payments easily.</p>
        @auth
            <a href="{{ route('projects.index') }}" class="btn btn-primary btn-lg mt-3">Go to Projects</a>
        @else
            <a href="{{ route('register') }}" class="btn btn-success btn-lg mt-3">Get Started</a>
        @endauth
    </div>

    <div class="row text-center">
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Create Projects</h5>
                    <p class="card-text">Start new projects and break them into clear, manageable milestones.</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Track Progress</h5>
                    <p class="card-text">Freelancers can update progress while owners monitor each step.</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Secure Payments</h5>
                    <p class="card-text">Owners approve and pay once milestones are completed. Transparent and fair!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
