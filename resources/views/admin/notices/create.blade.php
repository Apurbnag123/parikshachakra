@extends('layouts.dashboard')

@section('title', 'New Notice')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">New Notice</h1>
            <div class="text-muted">Publish to All or select a batch.</div>
        </div>
        <a class="btn btn-outline-primary" href="{{ route('admin.notices.index') }}">Back</a>
    </div>

    <div class="card pc-card">
        <div class="card-body">
            <form method="post" action="{{ route('admin.notices.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Title</label>
                        <input class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Batch</label>
                        <select class="form-select @error('batch_id') is-invalid @enderror" name="batch_id">
                            <option value="">All</option>
                            @foreach ($batches as $b)
                                <option value="{{ $b->id }}" {{ (string) old('batch_id') === (string) $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                            @endforeach
                        </select>
                        @error('batch_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Body</label>
                        <textarea class="form-control @error('body') is-invalid @enderror" name="body" rows="6" required>{{ old('body') }}</textarea>
                        @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_published" value="1" {{ old('is_published', '1') ? 'checked' : '' }}>
                            <span class="form-check-label fw-semibold">Publish now</span>
                        </label>
                    </div>
                </div>

                <button class="btn btn-primary mt-3" type="submit">Save</button>
            </form>
        </div>
    </div>
@endsection

