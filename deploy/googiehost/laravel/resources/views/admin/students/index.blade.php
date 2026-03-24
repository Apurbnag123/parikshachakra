@extends('layouts.dashboard')

@section('title', 'Students')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">Students</h1>
            <div class="text-muted">Add, edit, delete students. Each student has a unique Login ID.</div>
        </div>
        <div class="d-flex gap-2">
            <form method="get" action="{{ route('admin.students.index') }}" class="d-flex gap-2">
                <input class="form-control" style="min-width:260px;" name="q" value="{{ $q }}" placeholder="Search name/email/login id">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
            <a class="btn btn-primary" href="{{ route('admin.students.create') }}">Add Student</a>
        </div>
    </div>

    <div class="card pc-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Login ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Batch</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $s)
                            <tr>
                                <td>{{ $s->id }}</td>
                                <td class="fw-semibold">{{ $s->login_id }}</td>
                                <td>{{ $s->name }}</td>
                                <td>{{ $s->email }}</td>
                                <td>{{ $s->batch?->name ?? 'Not set' }}</td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.students.edit', $s) }}">Edit</a>
                                    <a class="btn btn-sm btn-outline-success" href="{{ route('admin.fees.edit', $s) }}">Fees</a>
                                    <form class="d-inline" method="post" action="{{ route('admin.students.destroy', $s) }}" onsubmit="return confirm('Delete student?')">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No students found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $students->links() }}
    </div>
@endsection

