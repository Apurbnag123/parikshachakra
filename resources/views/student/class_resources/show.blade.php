@extends('layouts.dashboard')

@section('title', $resource->title)

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">{{ $resource->title }}</h1>
            <div class="text-muted">{{ $resource->type === 'video' ? 'Video' : 'Note' }}</div>
        </div>
        <a class="btn btn-outline-primary" href="{{ route('student.class-resources.index') }}">Back</a>
    </div>

    <div class="card pc-card">
        <div class="card-body">
            @if ($resource->type === 'video')
                @php
                    $fileUrl = $resource->fileUrl();
                    $embedUrl = $resource->embedUrl();
                @endphp

                @if ($fileUrl)
                    <video controls style="width:100%; max-height:75vh; background:#000; border-radius:12px;">
                        <source src="{{ $fileUrl }}" type="{{ $resource->mime_type ?? 'video/mp4' }}">
                        Your browser does not support the video tag.
                    </video>
                    <div class="mt-2">
                        <a class="btn btn-sm btn-outline-primary" href="{{ $fileUrl }}" target="_blank" rel="noopener">Open in new tab</a>
                    </div>
                @elseif ($embedUrl)
                    <div style="position:relative; padding-top:56.25%; border-radius:12px; overflow:hidden;">
                        <iframe
                            src="{{ $embedUrl }}"
                            style="position:absolute; inset:0; width:100%; height:100%; border:0;"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                        ></iframe>
                    </div>
                    <div class="mt-2">
                        <a class="btn btn-sm btn-outline-primary" href="{{ $resource->url }}" target="_blank" rel="noopener">Open link</a>
                    </div>
                @else
                    <div class="text-muted">No video source available.</div>
                @endif
            @else
                @if ($resource->body)
                    <div class="mb-3">{!! nl2br(e($resource->body)) !!}</div>
                @endif

                @if ($resource->fileUrl())
                    <a class="btn btn-primary" href="{{ $resource->fileUrl() }}" target="_blank" rel="noopener">Open Notes File</a>
                @else
                    <div class="text-muted">No file attached.</div>
                @endif
            @endif
        </div>
    </div>
@endsection

