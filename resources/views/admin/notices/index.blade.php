@extends('layouts.dashboard')

@section('title', 'Notices')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">Notices</h1>
            <div class="text-muted">Publish notices for all students or a specific batch.</div>
        </div>
        <a class="btn btn-primary" href="{{ route('admin.notices.create') }}">New Notice</a>
    </div>

    <div class="card pc-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Batch</th>
                            <th>Published</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($notices as $n)
                            <tr>
                                <td class="fw-semibold">{{ $n->title }}</td>
                                <td>{{ $n->batch?->name ?? 'All' }}</td>
                                <td>
                                    @if ($n->is_published)
                                        <span class="badge text-bg-success">Yes</span>
                                        <span class="text-muted small">{{ $n->published_at?->format('d-m-Y H:i') }}</span>
                                    @else
                                        <span class="badge text-bg-secondary">No</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.notices.edit', $n) }}">Edit</a>
                                    <form class="d-inline" method="post" action="{{ route('admin.notices.destroy', $n) }}" onsubmit="return confirm('Delete notice?')">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">No notices.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">{{ $notices->links() }}</div>
@endsection

