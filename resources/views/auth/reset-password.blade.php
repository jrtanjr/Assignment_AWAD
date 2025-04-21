@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Enter OTP & New Password</h2>

    @if (session('otp'))
        <div class="alert alert-info">
            Your OTP: <strong>{{ session('otp') }}</strong>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <div class="form-group">
            <label>OTP</label>
            <input type="text" name="otp" class="form-control" required>
        </div>

        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Confirm New Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button class="btn btn-primary mt-2">Reset Password</button>
    </form>
</div>
@endsection