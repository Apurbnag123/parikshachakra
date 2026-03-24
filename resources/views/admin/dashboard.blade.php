@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">Admin Dashboard</h1>
            <div class="text-muted">Full authority panel: students, fees, notices, classes, results.</div>
        </div>
        <div class="d-flex gap-2">
            <a class="btn btn-primary" href="{{ route('admin.students.create') }}">Add Student</a>
            <a class="btn btn-outline-primary" href="{{ route('admin.fees.report') }}">Fees Report</a>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card pc-card">
                <div class="card-body">
                    <div class="text-muted">Students</div>
                    <div class="display-6 fw-bold">{{ $studentsCount }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card pc-card">
                <div class="card-body">
                    <div class="text-muted">Payments Today</div>
                    <div class="display-6 fw-bold">₹ {{ number_format($paymentsToday, 2) }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card pc-card">
                <div class="card-body">
                    <div class="text-muted">Total Pending</div>
                    <div class="display-6 fw-bold">₹ {{ number_format($pendingTotal, 2) }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-0">
        <div class="col-lg-6">
            <div class="card pc-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-end gap-2">
                        <div>
                            <div class="text-muted">Contact Queries (New)</div>
                            <div class="display-6 fw-bold">{{ $newContactsCount }}</div>
                        </div>
                        <a class="btn btn-outline-primary" href="{{ route('admin.contacts.index') }}">Open</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card pc-card">
                <div class="card-body">
                    <div class="fw-bold mb-2">Recent Queries</div>
                    @forelse ($recentContacts as $c)
                        <div class="border rounded p-2 mb-2">
                            <div class="d-flex justify-content-between gap-2 flex-wrap">
                                <div class="fw-semibold">{{ $c->name }}</div>
                                <span class="badge {{ $c->status === 'new' ? 'text-bg-danger' : 'text-bg-success' }}">{{ strtoupper($c->status) }}</span>
                            </div>
                            <div class="small text-muted">{{ $c->email }} @if($c->phone) | {{ $c->phone }} @endif</div>
                            <div class="small text-muted">From: {{ $c->source_url ?? '-' }}</div>
                            <div class="mt-1">
                                <a href="{{ route('admin.contacts.show', $c) }}">View</a>
                            </div>
                        </div>
                    @empty
                        <div class="text-muted">No queries yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
