@extends('layouts.dashboard')

@section('title', 'My Profile')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">My Profile</h1>
            <div class="text-muted">You can change only Email, Photo, and Signature.</div>
        </div>
        <a class="btn btn-outline-primary" href="{{ route('student.dashboard') }}">Back</a>
    </div>

    <div class="card pc-card">
        <div class="card-body">
            <form method="post" action="{{ route('student.profile.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Name (locked)</label>
                        <input class="form-control" value="{{ $user->name }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Login ID (locked)</label>
                        <input class="form-control" value="{{ $user->login_id }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Phone (locked)</label>
                        <input class="form-control" value="{{ $user->phone }}" disabled>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Photo</label>
                        <input class="form-control @error('photo') is-invalid @enderror" type="file" name="photo" accept="image/*">
                        @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        @if ($user->photo_path)
                            <div class="mt-2">
                                <div class="text-muted small">Current:</div>
                                <img src="{{ asset('storage/'.$user->photo_path) }}" alt="Photo" style="max-height:120px;" class="rounded border">
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Signature</label>
                        <input class="form-control @error('signature') is-invalid @enderror" type="file" name="signature" accept="image/*">
                        @error('signature')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        @if ($user->signature_path)
                            <div class="mt-2">
                                <div class="text-muted small">Current:</div>
                                <img src="{{ asset('storage/'.$user->signature_path) }}" alt="Signature" style="max-height:120px;" class="rounded border">
                            </div>
                        @endif
                    </div>
                </div>

                <button class="btn btn-primary mt-3" type="submit">Update Profile</button>
            </form>
        </div>
    </div>
@endsection

