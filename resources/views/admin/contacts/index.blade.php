@extends('layouts.dashboard')

@section('title', 'Contact Queries')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">Contact Queries</h1>
            <div class="text-muted">Who contacted, from where, and what message they sent.</div>
        </div>
        <form method="get" action="{{ route('admin.contacts.index') }}" class="d-flex gap-2">
            <select class="form-select" name="status" style="min-width:160px;">
                <option value="new" {{ $status === 'new' ? 'selected' : '' }}>New</option>
                <option value="resolved" {{ $status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                <option value="all" {{ $status === 'all' ? 'selected' : '' }}>All</option>
            </select>
            <button class="btn btn-outline-primary" type="submit">Filter</button>
        </form>
    </div>

    <div class="card pc-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>From</th>
                            <th>When</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($queries as $q)
                            <tr>
                                <td>
                                    <span class="badge {{ $q->status === 'new' ? 'text-bg-danger' : 'text-bg-success' }}">{{ strtoupper($q->status) }}</span>
                                </td>
                                <td class="fw-semibold">{{ $q->name }}</td>
                                <td>
                                    <div>{{ $q->email }}</div>
                                    <div class="small text-muted">{{ $q->phone ?? '-' }}</div>
                                </td>
                                <td class="small text-muted" style="max-width: 340px;">
                                    {{ $q->source_url ?? '-' }}
                                </td>
                                <td class="small text-muted">{{ $q->created_at->format('d-m-Y H:i') }}</td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.contacts.show', $q) }}">View</a>
                                    <form class="d-inline" method="post" action="{{ route('admin.contacts.destroy', $q) }}" onsubmit="return confirm('Delete query?')">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted py-4">No queries.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">{{ $queries->links() }}</div>
@endsection

