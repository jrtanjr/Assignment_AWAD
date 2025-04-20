@extends('layouts.standard')

@section('content')
<div class="container">
    <h1 class="mt-4">Payment Details</h1>
    <p class="lead">Please fill in the payment details below.</p>
    
    <div class="card mt-4">
        <div class="card-header">
            <h2>Create Payment for Milestone: {{ $milestone->id }}</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('payments.store', [$milestone->id]) }}" method="POST" id="paymentForm">
                @csrf

                <div class="form-group mb-3">
                    <label for="name"><strong>Person Name</strong></label>
                    <input type="text" name="name" id="name" class="form-control bg-dark text-white" placeholder="John" required>
                    <p class="text-danger error" id="nameError"></p>
                </div>

                <div class="form-group mb-3">
                    <label for="card_number"><strong>Card Number</strong></label>
                    <input type="text" name="card_number" id="card_number" class="form-control bg-dark text-white" placeholder="1234 5678 4356" required>
                    <p class="text-danger error" id="cardNumberError"></p>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="expiry_month"><strong>Expiry Month</strong></label>
                        <input type="text" name="expiry_month" id="expiry_month" class="form-control bg-dark text-white" placeholder="MM" maxlength="2" required>
                        <p class="text-danger error" id="expiryMonthError"></p>
                    </div>

                    <div class="col">
                        <label for="expiry_year"><strong>Expiry Year</strong></label>
                        <input type="text" name="expiry_year" id="expiry_year" class="form-control bg-dark text-white" placeholder="YYYY" maxlength="4" required>
                        <p class="text-danger error" id="expiryYearError"></p>
                    </div>

                    <div class="col">
                        <label for="cvv"><strong>CVV/CVC</strong></label>
                        <input type="password" name="cvv" id="cvv" class="form-control bg-dark text-white" placeholder="••••" required>
                        <p class="text-danger error" id="cvvError"></p>
                    </div>
                </div>

                <input type="hidden" name="amount" value="{{ $milestone->amount }}">
                <input type="hidden" name="transaction_id" value="{{ uniqid('TXN') }}">
                <input type="hidden" name="expiry_date" id="expiry_date">


                <button type="submit" class="btn btn-gradient mt-3 w-100">
                    Pay ${{ number_format($milestone->amount, 2) }}
                </button>
            </form>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('projects.show', $milestone->project_id) }}" class="btn btn-outline-secondary">Back to Project</a>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('paymentForm');
        const expiryMonthInput = document.getElementById('expiry_month');
        const expiryYearInput = document.getElementById('expiry_year');

        // Validate expiry month
        function validateExpiryMonth() {
            const month = expiryMonthInput.value;
            const errorElement = document.getElementById('expiryMonthError');
            
            if (!/^\d{2}$/.test(month)) {
                errorElement.textContent = 'Please enter 2-digit month';
                return false;
            }
            
            const monthNum = parseInt(month);
            if (monthNum < 1 || monthNum > 12) {
                errorElement.textContent = 'Month must be 01-12';
                return false;
            }
            
            errorElement.textContent = '';
            return true;
        }

        // Validate expiry year
        function validateExpiryYear() {
            const year = expiryYearInput.value;
            const errorElement = document.getElementById('expiryYearError');
            
            if (!/^\d{4}$/.test(year)) {
                errorElement.textContent = 'Please enter 4-digit year';
                return false;
            }
            
            const currentYear = new Date().getFullYear();
            const yearNum = parseInt(year);
            
            if (yearNum < currentYear) {
                errorElement.textContent = 'Year cannot be in past';
                return false;
            }
            
            errorElement.textContent = '';
            return true;
        }

        // Validate if card is expired (combines month and year)
        function validateCardNotExpired() {
            if (!validateExpiryMonth() || !validateExpiryYear()) {
                return false;
            }

            const month = parseInt(expiryMonthInput.value);
            const year = parseInt(expiryYearInput.value);
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear();
            const currentMonth = currentDate.getMonth() + 1;

            if (year < currentYear || (year === currentYear && month < currentMonth)) {
                document.getElementById('expiryMonthError').textContent = 'Card has expired';
                document.getElementById('expiryYearError').textContent = 'Card has expired';
                return false;
            }

            return true;
        }

        // Format month as user types (limit to 2 digits)
        expiryMonthInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 2) value = value.substring(0, 2);
            e.target.value = value;
            
            // Auto-focus to year when month is complete
            if (value.length === 2) {
                expiryYearInput.focus();
            }
        });

        // Format year as user types (limit to 4 digits)
        expiryYearInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 4) value = value.substring(0, 4);
            e.target.value = value;
        });

        // Validate on blur
        expiryMonthInput.addEventListener('blur', validateExpiryMonth);
        expiryYearInput.addEventListener('blur', validateExpiryYear);

        // Form submission handler
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate all fields
            const isNameValid = validateName();
            const isCardValid = validateCardNumber();
            const isExpiryValid = validateCardNotExpired();
            const isCvvValid = validateCVV();
            
            if (isNameValid && isCardValid && isExpiryValid && isCvvValid) {
                if (confirm('Are you sure you want to proceed with this payment?')) {
                    document.getElementById('expiry_date').value = expiryYearInput.value + '-' + expiryMonthInput.value + '-01';
                    this.submit();
                }
            } else {
                // Scroll to the first error
                const firstError = form.querySelector('.error:not(:empty)');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.previousElementSibling.focus();
                }
            }
        });

        // Add your other validation functions here (name, card number, CVV)
        function validateName() {
            const name = document.getElementById('name').value.trim();
            const errorElement = document.getElementById('nameError');
            
            if (name.length < 2) {
                errorElement.textContent = 'Please enter a valid name';
                return false;
            }
            
            errorElement.textContent = '';
            return true;
        }

        function validateCardNumber() {
            const cardNumber = document.getElementById('card_number').value.replace(/\s/g, '');
            const errorElement = document.getElementById('cardNumberError');
            
            if (!/^\d{16}$/.test(cardNumber)) {
                errorElement.textContent = 'Please enter a valid 16-digit card number';
                return false;
            }
            
            errorElement.textContent = '';
            return true;
        }

        function validateCVV() {
            const cvv = document.getElementById('cvv').value;
            const errorElement = document.getElementById('cvvError');
            
            if (!/^\d{3,4}$/.test(cvv)) {
                errorElement.textContent = 'Please enter a valid 3 or 4-digit CVV';
                return false;
            }
            
            errorElement.textContent = '';
            return true;
        }
    });
</script>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<style>
    .error {
        margin-top: 5px;
        font-size: 0.875em;
        color: #dc3545;
    }
</style>
@endsection