@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <h2>Login</h2>
    <p class="text-muted mb-4">Welcome back. Continue to your account.</p>

    <form class="pc-form" method="post" action="{{ route('login.submit') }}">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger mb-3" role="alert">
                Please check the form and try again.
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label fw-semibold" for="login">Login ID / Email</label>
            <input class="form-control @error('login') is-invalid @enderror" id="login" name="login" type="text" placeholder="PC000000 or name@example.com" required autocomplete="username" value="{{ old('login') }}">
            @error('login')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold" for="password">Password</label>
            <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="Your password" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
            <label class="form-check mb-0">
                <input class="form-check-input" type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                <span class="form-check-label">Remember me</span>
            </label>
            <a class="pc-link small" href="javascript:void(0)">Forgot password?</a>
        </div>

        <button class="btn pc-primary w-100" type="submit">Sign In</button>

        <div class="text-center mt-3">
            <span class="text-muted">New here?</span>
            <a class="pc-link" href="{{ route('student.register') }}">Student Registration</a>
        </div>
    </form>
@endsection
