@extends('layouts.dashboard')

@section('title', 'Batches')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">Batches</h1>
            <div class="text-muted">Create batches and assign them to students.</div>
        </div>
        <a class="btn btn-primary" href="{{ route('admin.batches.create') }}">New Batch</a>
    </div>

    <div class="card pc-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Starts</th>
                            <th>Ends</th>
                            <th>Active</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($batches as $b)
                            <tr>
                                <td class="fw-semibold">{{ $b->name }}</td>
                                <td>{{ $b->starts_on?->format('d-m-Y') ?? '-' }}</td>
                                <td>{{ $b->ends_on?->format('d-m-Y') ?? '-' }}</td>
                                <td>
                                    <span class="badge {{ $b->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">
                                        {{ $b->is_active ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.batches.edit', $b) }}">Edit</a>
                                    <form class="d-inline" method="post" action="{{ route('admin.batches.destroy', $b) }}" onsubmit="return confirm('Delete batch?')">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted py-4">No batches.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">{{ $batches->links() }}</div>
@endsection

