@extends('layouts.dashboard')

@section('title', 'Live Classes')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">Live Classes</h1>
            <div class="text-muted">Join your published classes here.</div>
        </div>
        <a class="btn btn-outline-primary" href="{{ route('student.dashboard') }}">Back</a>
    </div>

    <div class="card pc-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Starts</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($classes as $c)
                            <tr>
                                <td class="fw-semibold">{{ $c->title }}</td>
                                <td>{{ $c->starts_at?->format('d-m-Y H:i') ?? '-' }}</td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-primary" href="{{ route('student.live-classes.join', $c) }}">Join</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center text-muted py-4">No live classes published.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">{{ $classes->links() }}</div>
@endsection

