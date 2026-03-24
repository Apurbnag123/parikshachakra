@extends('layouts.dashboard')

@section('title', 'Edit Live Class')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">Edit Live Class</h1>
            <div class="text-muted">Update details and publish status.</div>
        </div>
        <a class="btn btn-outline-primary" href="{{ route('admin.live-classes.index') }}">Back</a>
    </div>

    <div class="card pc-card">
        <div class="card-body">
            <form method="post" action="{{ route('admin.live-classes.update', $liveClass) }}">
                @csrf
                @method('put')
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Title</label>
                        <input class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $liveClass->title) }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Batch</label>
                        <select class="form-select @error('batch_id') is-invalid @enderror" name="batch_id">
                            <option value="">All</option>
                            @foreach ($batches as $b)
                                <option value="{{ $b->id }}" {{ (string) old('batch_id', $liveClass->batch_id) === (string) $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                            @endforeach
                        </select>
                        @error('batch_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Meeting URL</label>
                        <input class="form-control @error('meeting_url') is-invalid @enderror" name="meeting_url" value="{{ old('meeting_url', $liveClass->meeting_url) }}" required>
                        @error('meeting_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Starts At (optional)</label>
                        <input class="form-control @error('starts_at') is-invalid @enderror" type="datetime-local" name="starts_at" value="{{ old('starts_at', $liveClass->starts_at ? $liveClass->starts_at->format('Y-m-d\\TH:i') : '') }}">
                        @error('starts_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Ends At (optional)</label>
                        <input class="form-control @error('ends_at') is-invalid @enderror" type="datetime-local" name="ends_at" value="{{ old('ends_at', $liveClass->ends_at ? $liveClass->ends_at->format('Y-m-d\\TH:i') : '') }}">
                        @error('ends_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_published" value="1" {{ old('is_published', $liveClass->is_published ? '1' : '') ? 'checked' : '' }}>
                            <span class="form-check-label fw-semibold">Published</span>
                        </label>
                    </div>
                </div>

                <button class="btn btn-primary mt-3" type="submit">Save</button>
            </form>
        </div>
    </div>
@endsection

