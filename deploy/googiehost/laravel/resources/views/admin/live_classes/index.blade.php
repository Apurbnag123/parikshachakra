@extends('layouts.dashboard')

@section('title', 'Live Classes')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">Live Classes</h1>
            <div class="text-muted">Publish live class links for all or a batch.</div>
        </div>
        <a class="btn btn-primary" href="{{ route('admin.live-classes.create') }}">New Live Class</a>
    </div>

    <div class="card pc-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Batch</th>
                            <th>Starts</th>
                            <th>Published</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($classes as $c)
                            <tr>
                                <td class="fw-semibold">{{ $c->title }}</td>
                                <td>{{ $c->batch?->name ?? 'All' }}</td>
                                <td>{{ $c->starts_at?->format('d-m-Y H:i') ?? '-' }}</td>
                                <td>
                                    <span class="badge {{ $c->is_published ? 'text-bg-success' : 'text-bg-secondary' }}">
                                        {{ $c->is_published ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.live-classes.edit', $c) }}">Edit</a>
                                    <form class="d-inline" method="post" action="{{ route('admin.live-classes.destroy', $c) }}" onsubmit="return confirm('Delete live class?')">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted py-4">No live classes.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">{{ $classes->links() }}</div>
@endsection

