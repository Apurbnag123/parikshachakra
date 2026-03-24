@extends('layouts.dashboard')

@section('title', 'Publish Result')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">Publish Result</h1>
            <div class="text-muted">Student will see it on their dashboard.</div>
        </div>
        <a class="btn btn-outline-primary" href="{{ route('admin.results.index') }}">Back</a>
    </div>

    <div class="card pc-card">
        <div class="card-body">
            <form method="post" action="{{ route('admin.results.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Student</label>
                        <select class="form-select @error('user_id') is-invalid @enderror" name="user_id" required>
                            <option value="">Select</option>
                            @foreach ($students as $s)
                                <option value="{{ $s->id }}" {{ (string) old('user_id') === (string) $s->id ? 'selected' : '' }}>
                                    {{ $s->name }} ({{ $s->login_id }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Title</label>
                        <input class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Remarks</label>
                        <textarea class="form-control @error('remarks') is-invalid @enderror" name="remarks" rows="3">{{ old('remarks') }}</textarea>
                        @error('remarks')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">File (optional)</label>
                        <input class="form-control @error('file') is-invalid @enderror" type="file" name="file">
                        @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="form-text">PDF/Image supported (max 10MB).</div>
                    </div>
                </div>

                <button class="btn btn-primary mt-3" type="submit">Publish</button>
            </form>
        </div>
    </div>
@endsection

