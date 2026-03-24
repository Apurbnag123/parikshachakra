@extends('layouts.dashboard')

@section('title', 'Contact Query')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">Contact Query</h1>
            <div class="text-muted">
                <span class="badge {{ $q->status === 'new' ? 'text-bg-danger' : 'text-bg-success' }}">{{ strtoupper($q->status) }}</span>
                <span class="ms-2">Submitted: {{ $q->created_at->format('d-m-Y H:i') }}</span>
            </div>
        </div>
        <div class="d-flex gap-2">
            <a class="btn btn-outline-primary" href="{{ route('admin.contacts.index') }}">Back</a>
            @if ($q->status !== 'resolved')
                <form method="post" action="{{ route('admin.contacts.resolve', $q) }}">
                    @csrf
                    <button class="btn btn-success" type="submit">Mark Resolved</button>
                </form>
            @endif
        </div>
    </div>

    <div class="card pc-card">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="text-muted small">Name</div>
                    <div class="fw-semibold">{{ $q->name }}</div>
                </div>
                <div class="col-md-6">
                    <div class="text-muted small">Linked User</div>
                    <div>{{ $q->user?->name ? $q->user->name.' ('.$q->user->login_id.')' : '-' }}</div>
                </div>
                <div class="col-md-6">
                    <div class="text-muted small">Email</div>
                    <div>{{ $q->email }}</div>
                </div>
                <div class="col-md-6">
                    <div class="text-muted small">Phone</div>
                    <div>{{ $q->phone ?? '-' }}</div>
                </div>
                <div class="col-12">
                    <div class="text-muted small">Message</div>
                    <div class="border rounded p-3">{!! nl2br(e($q->message)) !!}</div>
                </div>
                <div class="col-12">
                    <div class="text-muted small">From (URL)</div>
                    <div class="small">{{ $q->source_url ?? '-' }}</div>
                </div>
                <div class="col-md-6">
                    <div class="text-muted small">IP</div>
                    <div class="small">{{ $q->ip_address ?? '-' }}</div>
                </div>
                <div class="col-md-6">
                    <div class="text-muted small">User Agent</div>
                    <div class="small">{{ $q->user_agent ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection

