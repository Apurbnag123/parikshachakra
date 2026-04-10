@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')
    <style>
        .pc-hero{
            background:
                radial-gradient(900px 260px at 20% 10%, rgba(246,161,26,0.18), rgba(246,161,26,0) 60%),
                radial-gradient(900px 260px at 90% 0%, rgba(11,44,95,0.16), rgba(11,44,95,0) 62%),
                linear-gradient(135deg, #ffffff, #f7f8fb);
            border: 1px solid rgba(11,44,95,0.10);
            border-radius: 18px;
            padding: 18px 18px;
        }
        .pc-kpi{
            border: 1px solid rgba(11,44,95,0.10);
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 16px 45px rgba(0,0,0,0.06);
        }
        .pc-kpi .label{
            color: rgba(7,26,57,0.70);
            font-weight: 900;
            font-size: 12px;
            letter-spacing: .45px;
        }
        .pc-kpi .value{
            color: var(--pc-ink);
            font-weight: 900;
            font-size: 30px;
            line-height: 1.1;
        }
        .pc-kpi .hint{
            color: rgba(7,26,57,0.60);
            font-size: 13px;
        }
        .pc-chip{
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
        .pc-table th{
            font-size: 12px;
            letter-spacing: .3px;
            font-weight: 900;
            color: rgba(7,26,57,0.60) !important;
        }
    </style>

    <div class="pc-hero mb-3">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div>
                <div class="pc-chip">Admin Panel • {{ now()->format('d M Y') }}</div>
                <h1 class="h3 mb-1 mt-2" style="color:var(--pc-ink); font-weight:900;">Dashboard</h1>
                <div class="text-muted">Quick view of students, fees, and contact queries.</div>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a class="btn btn-primary" href="{{ route('admin.students.create') }}">Add Student</a>
                <a class="btn btn-outline-primary" href="{{ route('admin.fees.report') }}">Fees Report</a>
                <a class="btn btn-outline-primary" href="{{ route('admin.class-resources.index') }}">Videos & Notes</a>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="pc-kpi p-3 h-100">
                <div class="label">STUDENTS</div>
                <div class="value mt-1">{{ number_format($studentsCount) }}</div>
                <div class="hint mt-2">Total registered students</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="pc-kpi p-3 h-100">
                <div class="label">PAYMENTS (TODAY)</div>
                <div class="value mt-1">&#8377; {{ number_format($paymentsToday, 2) }}</div>
                <div class="hint mt-2">Collected on {{ now()->format('d M') }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="pc-kpi p-3 h-100">
                <div class="label">TOTAL PENDING</div>
                <div class="value mt-1">&#8377; {{ number_format($pendingTotal, 2) }}</div>
                <div class="hint mt-2">Across all fee accounts</div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-0">
        <div class="col-lg-6">
            <div class="pc-kpi p-3 h-100">
                <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                    <div>
                        <div class="label">CONTACT QUERIES</div>
                        <div class="value mt-1">{{ number_format($newContactsCount) }}</div>
                        <div class="hint mt-2">New / unresolved</div>
                    </div>
                    <a class="btn btn-outline-primary" href="{{ route('admin.contacts.index') }}">Open Inbox</a>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card pc-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap mb-2">
                        <div class="fw-bold">Recent Queries</div>
                        <a class="small" href="{{ route('admin.contacts.index') }}">View all</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0 pc-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentContacts as $c)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">{{ $c->name }}</div>
                                            <div class="small text-muted">{{ $c->email }} @if($c->phone) | {{ $c->phone }} @endif</div>
                                        </td>
                                        <td>
                                            <span class="badge {{ $c->status === 'new' ? 'text-bg-danger' : 'text-bg-success' }}">{{ strtoupper($c->status) }}</span>
                                        </td>
                                        <td class="text-end">
                                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.contacts.show', $c) }}">Open</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted py-3">No queries yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
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
                        <div class="fw-bold">Payments (Last 7 days)</div>
                        <div class="small text-muted">Daily collection</div>
                    </div>
                    <canvas id="pcPaymentsChart" height="110"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card pc-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap mb-2">
                        <div class="fw-bold">Students by Batch</div>
                        <div class="small text-muted">Distribution</div>
                    </div>
                    <canvas id="pcBatchChart" height="220"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_js')
    <script>
        (function () {
            if (!window.Chart) return;

            const paymentLabels = @json($paymentLabels ?? []);
            const paymentTotals = @json($paymentTotals ?? []);
            const batchLabels = @json($batchLabels ?? []);
            const batchCounts = @json($batchCounts ?? []);

            const ink = getComputedStyle(document.documentElement).getPropertyValue('--pc-ink').trim() || '#0b2c5f';
            const amber = getComputedStyle(document.documentElement).getPropertyValue('--pc-amber').trim() || '#f6a11a';

            const pEl = document.getElementById('pcPaymentsChart');
            if (pEl) {
                new Chart(pEl, {
                    type: 'line',
                    data: {
                        labels: paymentLabels,
                        datasets: [{
                            label: 'Payments',
                            data: paymentTotals,
                            borderColor: ink,
                            backgroundColor: 'rgba(11,44,95,0.12)',
                            fill: true,
                            tension: 0.35,
                            pointRadius: 3,
                            pointBackgroundColor: ink,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { ticks: { callback: (v) => '₹ ' + v } }
                        }
                    }
                });
            }

            const bEl = document.getElementById('pcBatchChart');
            if (bEl) {
                new Chart(bEl, {
                    type: 'doughnut',
                    data: {
                        labels: batchLabels,
                        datasets: [{
                            data: batchCounts,
                            backgroundColor: [
                                ink,
                                amber,
                                'rgba(159,210,255,0.90)',
                                'rgba(11,44,95,0.45)',
                                'rgba(246,161,26,0.55)',
                                'rgba(7,26,57,0.65)'
                            ],
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
