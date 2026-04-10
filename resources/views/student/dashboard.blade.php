@extends('layouts.dashboard')

@section('title', 'Student Dashboard')

@section('content')
    <style>
        .st-hero{
            background:
                radial-gradient(900px 260px at 12% 10%, rgba(159,210,255,0.22), rgba(159,210,255,0) 60%),
                radial-gradient(900px 260px at 90% 0%, rgba(246,161,26,0.16), rgba(246,161,26,0) 62%),
                linear-gradient(135deg, #ffffff, #f7f8fb);
            border: 1px solid rgba(11,44,95,0.10);
            border-radius: 18px;
            padding: 18px 18px;
        }
        .st-metric{
            border: 1px solid rgba(11,44,95,0.10);
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 16px 45px rgba(0,0,0,0.06);
        }
        .st-metric .k{ color: rgba(7,26,57,0.70); font-weight: 900; font-size: 12px; letter-spacing: .45px; }
        .st-metric .v{ color: var(--pc-ink); font-weight: 900; font-size: 22px; line-height: 1.2; }
        .st-pill{
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            border-radius: 999px;
            border: 1px solid rgba(11,44,95,0.12);
            background: rgba(255,255,255,0.75);
            font-weight: 900;
            color: rgba(7,26,57,0.78);
            font-size: 13px;
        }
        .st-section-title{
            font-weight: 900;
            color: var(--pc-ink);
            margin: 0;
        }
        .st-list .list-group-item{
            border: 1px solid rgba(11,44,95,0.10);
            border-left-width: 3px;
            border-left-color: rgba(11,44,95,0.22);
            border-radius: 14px;
            margin-bottom: 10px;
        }
        .st-list .list-group-item:last-child{ margin-bottom: 0; }
        .st-table th{
            font-size: 12px;
            letter-spacing: .3px;
            font-weight: 900;
            color: rgba(7,26,57,0.60) !important;
        }
    </style>

    <div class="st-hero mb-3">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div>
                <div class="st-pill">Student • {{ now()->format('d M Y') }}</div>
                <h1 class="h3 mb-1 mt-2" style="color:var(--pc-ink); font-weight:900;">Welcome, {{ $user->name }}</h1>
                <div class="text-muted">
                    Batch: <span class="fw-semibold">{{ $user->batch?->name ?? 'Not assigned' }}</span>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a class="btn btn-outline-primary" href="{{ route('student.class-resources.index') }}">Videos & Notes</a>
                <a class="btn btn-outline-primary" href="{{ route('student.live-classes.index') }}">Live Classes</a>
                <a class="btn btn-primary" href="{{ route('student.profile.edit') }}">Edit Profile</a>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="st-metric p-3 h-100">
                <div class="k">FEES PENDING</div>
                <div class="v mt-1" style="{{ $account->pendingAmount() > 0 ? 'color:#b42318;' : '' }}">
                    &#8377; {{ number_format($account->pendingAmount(), 2) }}
                </div>
                <div class="small text-muted mt-2">Payable: &#8377; {{ number_format($account->payableAmount(), 2) }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="st-metric p-3 h-100">
                <div class="k">LIVE CLASSES</div>
                <div class="v mt-1">{{ count($classes) }}</div>
                <div class="small text-muted mt-2">Upcoming / published</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="st-metric p-3 h-100">
                <div class="k">NOTICES</div>
                <div class="v mt-1">{{ count($notices) }}</div>
                <div class="small text-muted mt-2">Latest updates</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="st-metric p-3 h-100">
                <div class="k">RESULTS</div>
                <div class="v mt-1">{{ count($results) }}</div>
                <div class="small text-muted mt-2">Recently published</div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-0">
        <div class="col-lg-4">
            <div class="card pc-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap mb-2">
                        <h5 class="st-section-title">Fees</h5>
                        <a class="small text-decoration-none" href="{{ route('student.profile.edit') }}">Account</a>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex justify-content-between"><span class="text-muted">Payable</span><span class="fw-semibold">&#8377; {{ number_format($account->payableAmount(), 2) }}</span></div>
                        <div class="d-flex justify-content-between"><span class="text-muted">Paid</span><span class="fw-semibold">&#8377; {{ number_format($account->paidAmount(), 2) }}</span></div>
                        <div class="d-flex justify-content-between"><span class="text-muted">Pending</span><span class="fw-bold {{ $account->pendingAmount() > 0 ? 'text-danger' : 'text-success' }}">&#8377; {{ number_format($account->pendingAmount(), 2) }}</span></div>
                    </div>

                    <hr class="my-3">
                    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap mb-2">
                        <div class="fw-bold">Recent Receipts</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0 st-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Receipt</th>
                                    <th class="text-end">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentReceipts as $r)
                                    <tr>
                                        <td class="text-muted">{{ $r->paid_on->format('d-m-Y') }}</td>
                                        <td class="fw-semibold">{{ $r->receipt_no }}</td>
                                        <td class="text-end">&#8377; {{ number_format($r->amount, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted py-3">No receipts yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card pc-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap mb-2">
                        <h5 class="st-section-title">Live Classes</h5>
                        <a class="small text-decoration-none" href="{{ route('student.live-classes.index') }}">View all</a>
                    </div>

                    <div class="list-group st-list">
                        @forelse ($classes as $c)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between gap-2 flex-wrap">
                                    <div>
                                        <div class="fw-semibold">{{ $c->title }}</div>
                                        <div class="text-muted small">
                                            {{ $c->starts_at?->format('d-m-Y H:i') ?? 'Time not set' }}
                                            @if ($c->batch_id) | Batch only @endif
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <a class="btn btn-sm btn-primary" href="{{ route('student.live-classes.join', $c) }}">Join</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-muted">No live classes published.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-0">
        <div class="col-lg-8">
            <div class="card pc-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap mb-2">
                        <h5 class="st-section-title">Fees Paid (Last 6 months)</h5>
                        <div class="small text-muted">Monthly total</div>
                    </div>
                    <canvas id="stFeesChart" height="110"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card pc-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap mb-2">
                        <h5 class="st-section-title">Fee Status</h5>
                        <div class="small text-muted">Paid vs Pending</div>
                    </div>
                    <canvas id="stFeeSplit" height="220"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-0">
        <div class="col-lg-6">
            <div class="card pc-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap mb-2">
                        <h5 class="st-section-title">Notices</h5>
                    </div>

                    <div class="list-group st-list">
                        @forelse ($notices as $n)
                            <div class="list-group-item">
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
        </div>

        <div class="col-lg-6">
            <div class="card pc-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap mb-2">
                        <h5 class="st-section-title">Results</h5>
                    </div>

                    <div class="list-group st-list">
                        @forelse ($results as $r)
                            <div class="list-group-item">
                                <div class="fw-semibold">{{ $r->title }}</div>
                                <div class="text-muted small">{{ $r->published_at?->format('d-m-Y H:i') }}</div>
                                @if ($r->remarks)
                                    <div class="mt-1">{!! nl2br(e($r->remarks)) !!}</div>
                                @endif
                                @if ($r->file_path)
                                    <div class="mt-2">
                                        <a class="btn btn-sm btn-outline-primary" href="{{ asset('storage/'.$r->file_path) }}" target="_blank" rel="noopener">Open File</a>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="text-muted">No results published yet.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_js')
    <script>
        (function () {
            if (!window.Chart) return;

            const monthLabels = @json($monthLabels ?? []);
            const monthTotals = @json($monthTotals ?? []);

            const paid = Number(@json($account->paidAmount()));
            const pending = Number(@json($account->pendingAmount()));

            const ink = getComputedStyle(document.documentElement).getPropertyValue('--pc-ink').trim() || '#0b2c5f';
            const amber = getComputedStyle(document.documentElement).getPropertyValue('--pc-amber').trim() || '#f6a11a';

            const mEl = document.getElementById('stFeesChart');
            if (mEl) {
                new Chart(mEl, {
                    type: 'bar',
                    data: {
                        labels: monthLabels,
                        datasets: [{
                            label: 'Paid',
                            data: monthTotals,
                            backgroundColor: 'rgba(159,210,255,0.55)',
                            borderColor: 'rgba(159,210,255,1)',
                            borderWidth: 1,
                            borderRadius: 10
                        }]
                    },
                    options: {
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { ticks: { callback: (v) => '₹ ' + v } }
                        }
                    }
                });
            }

            const sEl = document.getElementById('stFeeSplit');
            if (sEl) {
                new Chart(sEl, {
                    type: 'doughnut',
                    data: {
                        labels: ['Paid', 'Pending'],
                        datasets: [{
                            data: [paid, pending],
                            backgroundColor: [ink, amber],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        plugins: { legend: { position: 'bottom' } },
                        cutout: '62%'
                    }
                });
            }
        })();
    </script>
@endpush
