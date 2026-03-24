@extends('layouts.auth')

@section('title', 'Student Register')

@section('content')
    <h2>Student Registration</h2>
    <p class="text-muted mb-4">Fill details carefully. You will get a unique Login ID after submit.</p>

    <form class="pc-form" method="post" action="{{ route('student.register.submit') }}" enctype="multipart/form-data">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger mb-3" role="alert">
                Please check the form and try again.
            </div>
        @endif

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">First Name</label>
                <input class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required>
                @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Last Name</label>
                <input class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required>
                @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Father's Name</label>
                <input class="form-control @error('father_name') is-invalid @enderror" name="father_name" value="{{ old('father_name') }}" required>
                @error('father_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Gender</label>
                <select class="form-select @error('gender') is-invalid @enderror" name="gender" required>
                    <option value="">Select</option>
                    <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender') === 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Phone</label>
                <input class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Email</label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold">Address</label>
                <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="3" required>{{ old('address') }}</textarea>
                @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Pincode</label>
                <input class="form-control @error('pincode') is-invalid @enderror" name="pincode" value="{{ old('pincode') }}" required>
                @error('pincode')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-8">
                <label class="form-label fw-semibold">Photo (optional)</label>
                <input class="form-control @error('photo') is-invalid @enderror" type="file" name="photo" accept="image/*">
                @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Password</label>
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Confirm Password</label>
                <input class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <button class="btn pc-primary w-100 mt-3" type="submit">Register</button>

        <div class="text-center mt-3">
            <span class="text-muted">Already have an account?</span>
            <a class="pc-link" href="{{ route('login') }}">Sign in</a>
        </div>
    </form>
@endsection

