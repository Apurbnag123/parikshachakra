@extends('layouts.dashboard')

@section('title', 'Edit Batch')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">Edit Batch</h1>
            <div class="text-muted">Update batch details.</div>
        </div>
        <a class="btn btn-outline-primary" href="{{ route('admin.batches.index') }}">Back</a>
    </div>

    <div class="card pc-card">
        <div class="card-body">
            <form method="post" action="{{ route('admin.batches.update', $batch) }}">
                @csrf
                @method('put')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $batch->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Starts On</label>
                        <input class="form-control @error('starts_on') is-invalid @enderror" type="date" name="starts_on" value="{{ old('starts_on', $batch->starts_on?->toDateString()) }}">
                        @error('starts_on')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Ends On</label>
                        <input class="form-control @error('ends_on') is-invalid @enderror" type="date" name="ends_on" value="{{ old('ends_on', $batch->ends_on?->toDateString()) }}">
                        @error('ends_on')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $batch->is_active ? '1' : '') ? 'checked' : '' }}>
                            <span class="form-check-label fw-semibold">Active</span>
                        </label>
                    </div>
                </div>

                <button class="btn btn-primary mt-3" type="submit">Save</button>
            </form>
        </div>
    </div>
@endsection

