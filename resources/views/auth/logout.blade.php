@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header bg-success text-white">Logout Successful</div>
                <div class="card-body">
                    <h4 class="mb-3">You’ve been logged out successfully!</h4>
                    <p>Thanks for visiting. We hope to see you again soon.</p>

                    <!-- Button to redirect to login page -->
                    <a href="{{ route('login') }}" class="btn btn-primary mt-3">Login Again</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection