@extends('layouts.app')
@section('title', 'Payment Details')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="display-6 text-primary">💳 Payment Details</h1>
        <p class="lead text-muted">Please fill in your payment information below to process the milestone payment.</p>
    </div>

    <div class="card shadow-lg border-0">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Create Payment for Milestone #{{ $milestone->id }}</h4>
        </div>

        <div class="card-body bg-light">
            <form action="{{ route('payments.store', [$milestone->id]) }}" method="POST" id="paymentForm">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name on Card</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="John Doe" required>
                    <p class="text-danger error" id="nameError"></p>
                </div>

                <div class="mb-3">
                    <label for="card_number" class="form-label">Card Number</label>
                    <input type="text" name="card_number" id="card_number" class="form-control" placeholder="1234 5678 9012 3456" required>
                    <p class="text-danger error" id="cardNumberError"></p>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="expiry_month" class="form-label">Expiry Month (MM)</label>
                        <input type="text" name="expiry_month" id="expiry_month" class="form-control" placeholder="MM" maxlength="2" required>
                        <p class="text-danger error" id="expiryMonthError"></p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="expiry_year" class="form-label">Expiry Year (YYYY)</label>
                        <input type="text" name="expiry_year" id="expiry_year" class="form-control" placeholder="YYYY" maxlength="4" required>
                        <p class="text-danger error" id="expiryYearError"></p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cvv" class="form-label">CVV/CVC</label>
                        <input type="password" name="cvv" id="cvv" class="form-control" placeholder="•••" required>
                        <p class="text-danger error" id="cvvError"></p>
                    </div>
                </div>

                <input type="hidden" name="amount" value="{{ $milestone->amount }}">
                <input type="hidden" name="transaction_id" value="{{ uniqid('TXN') }}">
                <input type="hidden" name="expiry_date" id="expiry_date">

                <button type="submit" class="btn btn-primary w-100 mt-3 py-2">
                    💰 Pay ${{ number_format($milestone->amount, 2) }}
                </button>
            </form>
        </div>

        <div class="card-footer bg-white text-end">
            <a href="{{ route('projects.show', $milestone->project_id) }}" class="btn btn-outline-secondary">← Back to Project</a>
        </div>
    </div>
</div>
@endsection
