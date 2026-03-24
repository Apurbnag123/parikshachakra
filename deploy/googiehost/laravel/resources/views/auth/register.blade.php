@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <h2>Admin Registration</h2>
    <p class="text-muted mb-4">Create an admin account. (Recommended: keep this page private.)</p>

    <form class="pc-form" method="post" action="{{ route('register.submit') }}">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger mb-3" role="alert">
                Please check the form and try again.
            </div>
        @endif

        <div class="row g-3">
            <div class="col-12">
                <label class="form-label fw-semibold" for="name">Admin Name</label>
                <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" placeholder="Admin name" required autocomplete="name" value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold" for="email">Email</label>
                <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="name@example.com" required autocomplete="email" value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold" for="password">Password</label>
                <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="Create a password" required autocomplete="new-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold" for="password_confirmation">Confirm Password</label>
                <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm password" required autocomplete="new-password">
            </div>
        </div>

        <div class="mt-3">
            <label class="form-check">
                <input class="form-check-input" type="checkbox" required>
                <span class="form-check-label">
                    I agree to the <a class="pc-link" href="javascript:void(0)">Terms</a> and <a class="pc-link" href="javascript:void(0)">Privacy Policy</a>
                </span>
            </label>
        </div>

        <button class="btn pc-primary w-100 mt-3" type="submit">Create Account</button>

        <div class="text-center mt-3">
            <span class="text-muted">Student?</span>
            <a class="pc-link" href="{{ route('student.register') }}">Register here</a>
        </div>
    </form>
@endsection
