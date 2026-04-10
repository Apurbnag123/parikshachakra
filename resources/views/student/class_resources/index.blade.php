@extends('layouts.dashboard')

@section('title', 'Videos & Notes')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">Videos & Notes</h1>
            <div class="text-muted">Only your batch resources are visible.</div>
        </div>
        <a class="btn btn-outline-primary" href="{{ route('student.dashboard') }}">Back</a>
    </div>

    <div class="d-flex flex-wrap gap-2 mb-3">
        <a class="btn btn-sm {{ $type ? 'btn-outline-primary' : 'btn-primary' }}" href="{{ route('student.class-resources.index') }}">All</a>
        <a class="btn btn-sm {{ $type === 'video' ? 'btn-primary' : 'btn-outline-primary' }}" href="{{ route('student.class-resources.index', ['type' => 'video']) }}">Videos</a>
        <a class="btn btn-sm {{ $type === 'note' ? 'btn-primary' : 'btn-outline-primary' }}" href="{{ route('student.class-resources.index', ['type' => 'note']) }}">Notes</a>
    </div>

    <div class="card pc-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($resources as $r)
                            <tr>
                                <td class="fw-semibold">{{ $r->title }}</td>
                                <td>
                                    <span class="badge {{ $r->type === 'video' ? 'text-bg-primary' : 'text-bg-dark' }}">
                                        {{ $r->type === 'video' ? 'Video' : 'Note' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-primary" href="{{ route('student.class-resources.show', $r) }}">
                                        {{ $r->type === 'video' ? 'Play' : 'Open' }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center text-muted py-4">No resources published.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">{{ $resources->links() }}</div>
@endsection

