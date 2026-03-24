@extends('layouts.dashboard')

@section('title', 'Results')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">Results</h1>
            <div class="text-muted">Publish results for a student.</div>
        </div>
        <a class="btn btn-primary" href="{{ route('admin.results.create') }}">Publish Result</a>
    </div>

    <div class="card pc-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Published</th>
                            <th>Student</th>
                            <th>Title</th>
                            <th>File</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($results as $r)
                            <tr>
                                <td>{{ $r->published_at?->format('d-m-Y H:i') ?? '-' }}</td>
                                <td>{{ $r->user?->name }} ({{ $r->user?->login_id }})</td>
                                <td class="fw-semibold">{{ $r->title }}</td>
                                <td>
                                    @if ($r->file_path)
                                        <a href="{{ asset('storage/'.$r->file_path) }}" target="_blank">Open</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <form class="d-inline" method="post" action="{{ route('admin.results.destroy', $r) }}" onsubmit="return confirm('Delete result?')">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted py-4">No results.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">{{ $results->links() }}</div>
@endsection

