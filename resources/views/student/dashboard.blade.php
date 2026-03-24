@extends('layouts.dashboard')

@section('title', 'Student Dashboard')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">Student Dashboard</h1>
            <div class="text-muted">
                Batch: <span class="fw-semibold">{{ $user->batch?->name ?? 'Not assigned' }}</span>
            </div>
        </div>
        <a class="btn btn-outline-primary" href="{{ route('student.profile.edit') }}">Edit Profile</a>
    </div>

    <div class="row g-3">
        <div class="col-lg-4">
            <div class="card pc-card">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Fees</h5>
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex justify-content-between"><span class="text-muted">Payable</span><span class="fw-semibold">₹ {{ number_format($account->payableAmount(), 2) }}</span></div>
                        <div class="d-flex justify-content-between"><span class="text-muted">Paid</span><span class="fw-semibold">₹ {{ number_format($account->paidAmount(), 2) }}</span></div>
                        <div class="d-flex justify-content-between"><span class="text-muted">Pending</span><span class="fw-bold {{ $account->pendingAmount() > 0 ? 'text-danger' : 'text-success' }}">₹ {{ number_format($account->pendingAmount(), 2) }}</span></div>
                    </div>

                    <hr class="my-3">
                    <div class="fw-bold mb-2">Recent Receipts</div>
                    <div class="small">
                        @forelse ($recentReceipts as $r)
                            <div class="d-flex justify-content-between">
                                <span>{{ $r->paid_on->format('d-m-Y') }}</span>
                                <span class="fw-semibold">{{ $r->receipt_no }}</span>
                                <span>₹ {{ number_format($r->amount, 2) }}</span>
                            </div>
                        @empty
                            <div class="text-muted">No receipts yet.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card pc-card">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Live Classes</h5>
                    @forelse ($classes as $c)
                        <div class="border rounded p-2 mb-2">
                            <div class="fw-semibold">{{ $c->title }}</div>
                            <div class="text-muted small">
                                {{ $c->starts_at?->format('d-m-Y H:i') ?? 'Time not set' }}
                                @if ($c->batch_id) | Batch only @endif
                            </div>
                            <a href="{{ $c->meeting_url }}" target="_blank">Join Link</a>
                        </div>
                    @empty
                        <div class="text-muted">No live classes published.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-0">
        <div class="col-lg-6">
            <div class="card pc-card">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Notices</h5>
                    @forelse ($notices as $n)
                        <div class="border rounded p-2 mb-2">
                            <div class="fw-semibold">{{ $n->title }}</div>
                            <div class="text-muted small">{{ $n->published_at?->format('d-m-Y H:i') }}</div>
                            <div class="mt-1">{!! nl2br(e($n->body)) !!}</div>
                        </div>
                    @empty
                        <div class="text-muted">No notices.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card pc-card">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Results</h5>
                    @forelse ($results as $r)
                        <div class="border rounded p-2 mb-2">
                            <div class="fw-semibold">{{ $r->title }}</div>
                            <div class="text-muted small">{{ $r->published_at?->format('d-m-Y H:i') }}</div>
                            @if ($r->remarks)
                                <div class="mt-1">{!! nl2br(e($r->remarks)) !!}</div>
                            @endif
                            @if ($r->file_path)
                                <div class="mt-1"><a href="{{ asset('storage/'.$r->file_path) }}" target="_blank">Open File</a></div>
                            @endif
                        </div>
                    @empty
                        <div class="text-muted">No results published yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

