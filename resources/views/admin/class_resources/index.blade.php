@extends('layouts.dashboard')

@section('title', 'Resources')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">Videos & Notes</h1>
            <div class="text-muted">Upload videos and notes (batch-wise).</div>
        </div>
        <a class="btn btn-primary" href="{{ route('admin.class-resources.create') }}">New Resource</a>
    </div>

    <div class="d-flex flex-wrap gap-2 mb-3">
        <a class="btn btn-sm {{ $type ? 'btn-outline-primary' : 'btn-primary' }}" href="{{ route('admin.class-resources.index') }}">All</a>
        <a class="btn btn-sm {{ $type === 'video' ? 'btn-primary' : 'btn-outline-primary' }}" href="{{ route('admin.class-resources.index', ['type' => 'video']) }}">Videos</a>
        <a class="btn btn-sm {{ $type === 'note' ? 'btn-primary' : 'btn-outline-primary' }}" href="{{ route('admin.class-resources.index', ['type' => 'note']) }}">Notes</a>
    </div>

    <div class="card pc-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Batch</th>
                            <th>Published</th>
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
                                <td>{{ $r->batch?->name ?? 'All' }}</td>
                                <td>
                                    <span class="badge {{ $r->is_published ? 'text-bg-success' : 'text-bg-secondary' }}">
                                        {{ $r->is_published ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.class-resources.edit', $r) }}">Edit</a>
                                    <form class="d-inline" method="post" action="{{ route('admin.class-resources.destroy', $r) }}" onsubmit="return confirm('Delete resource?')">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted py-4">No resources.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">{{ $resources->links() }}</div>
@endsection

