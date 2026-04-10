@extends('layouts.dashboard')

@section('title', 'New Resource')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">New Video/Note</h1>
            <div class="text-muted">Students will see it in their portal (batch-wise).</div>
        </div>
        <a class="btn btn-outline-primary" href="{{ route('admin.class-resources.index') }}">Back</a>
    </div>

    <div class="card pc-card">
        <div class="card-body">
            <form method="post" action="{{ route('admin.class-resources.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Type</label>
                        <select id="type" class="form-select @error('type') is-invalid @enderror" name="type" required>
                            <option value="video" {{ old('type', 'video') === 'video' ? 'selected' : '' }}>Video</option>
                            <option value="note" {{ old('type') === 'note' ? 'selected' : '' }}>Note</option>
                        </select>
                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Title</label>
                        <input class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Batch</label>
                        <select class="form-select @error('batch_id') is-invalid @enderror" name="batch_id">
                            <option value="">All</option>
                            @foreach ($batches as $b)
                                <option value="{{ $b->id }}" {{ (string) old('batch_id') === (string) $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                            @endforeach
                        </select>
                        @error('batch_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Upload File (optional)</label>
                        <input class="form-control @error('file') is-invalid @enderror" type="file" name="file">
                        <div class="form-text">Video file (mp4) or notes file (pdf/doc). Large files depend on PHP limits.</div>
                        @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12" id="video_url_wrap">
                        <label class="form-label fw-semibold">Video URL (optional)</label>
                        <input class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') }}" placeholder="YouTube / Drive / any direct URL">
                        <div class="form-text">If you don’t upload a video file, add an external link.</div>
                        @error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12" id="notes_body_wrap" style="display:none;">
                        <label class="form-label fw-semibold">Notes Text (optional)</label>
                        <textarea class="form-control @error('body') is-invalid @enderror" name="body" rows="6" placeholder="Write notes here...">{{ old('body') }}</textarea>
                        <div class="form-text">If you don’t upload a notes file, write notes text.</div>
                        @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_published" value="1" {{ old('is_published', '1') ? 'checked' : '' }}>
                            <span class="form-check-label fw-semibold">Publish</span>
                        </label>
                    </div>
                </div>

                <button class="btn btn-primary mt-3" type="submit">Save</button>
            </form>
        </div>
    </div>

    <script>
        (function () {
            const type = document.getElementById('type');
            const videoUrlWrap = document.getElementById('video_url_wrap');
            const notesBodyWrap = document.getElementById('notes_body_wrap');

            function sync() {
                const isNote = type.value === 'note';
                videoUrlWrap.style.display = isNote ? 'none' : '';
                notesBodyWrap.style.display = isNote ? '' : 'none';
            }

            type.addEventListener('change', sync);
            sync();
        })();
    </script>
@endsection

