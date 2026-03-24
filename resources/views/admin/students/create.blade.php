@extends('layouts.dashboard')

@section('title', 'Add Student')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">Add Student</h1>
            <div class="text-muted">System will generate a unique Login ID. If password not provided, it will be auto-generated.</div>
        </div>
        <a class="btn btn-outline-primary" href="{{ route('admin.students.index') }}">Back</a>
    </div>

    <div class="card pc-card">
        <div class="card-body">
            <form method="post" action="{{ route('admin.students.store') }}" enctype="multipart/form-data">
                @csrf

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
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="2" required>{{ old('address') }}</textarea>
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
                        <label class="form-label fw-semibold">Batch</label>
                        <select class="form-select @error('batch_id') is-invalid @enderror" name="batch_id">
                            <option value="">Not set</option>
                            @foreach ($batches as $b)
                                <option value="{{ $b->id }}" {{ (string) old('batch_id') === (string) $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                            @endforeach
                        </select>
                        @error('batch_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Password (optional)</label>
                        <input class="form-control @error('password') is-invalid @enderror" type="text" name="password" value="{{ old('password') }}">
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Confirm Password</label>
                        <input class="form-control" type="text" name="password_confirmation" value="{{ old('password_confirmation') }}">
                    </div>
                </div>

                <button class="btn btn-primary mt-3" type="submit">Create Student</button>
            </form>
        </div>
    </div>
@endsection
