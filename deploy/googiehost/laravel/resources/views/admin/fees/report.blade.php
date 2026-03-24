@extends('layouts.dashboard')

@section('title', 'Fees Report')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">Fees Report</h1>
            <div class="text-muted">From {{ $from }} to {{ $to }} | Total: ₹ {{ number_format($total, 2) }}</div>
        </div>
        <form method="get" action="{{ route('admin.fees.report') }}" class="d-flex gap-2">
            <input class="form-control" type="date" name="from" value="{{ $from }}">
            <input class="form-control" type="date" name="to" value="{{ $to }}">
            <button class="btn btn-outline-primary" type="submit">Filter</button>
        </form>
    </div>

    <div class="card pc-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Receipt</th>
                            <th>Student</th>
                            <th>Mode</th>
                            <th>Txn ID</th>
                            <th class="text-end">Amount</th>
                            <th class="text-end">Receipt</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $p)
                            <tr>
                                <td>{{ $p->paid_on->format('d-m-Y') }}</td>
                                <td class="fw-semibold">{{ $p->receipt_no }}</td>
                                <td>{{ $p->feeAccount?->user?->name }} ({{ $p->feeAccount?->user?->login_id }})</td>
                                <td>{{ strtoupper($p->payment_mode) }}</td>
                                <td>{{ $p->transaction_id ?? '-' }}</td>
                                <td class="text-end">₹ {{ number_format($p->amount, 2) }}</td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.fees.receipt', $p) }}" target="_blank">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center text-muted py-4">No payments.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">{{ $payments->links() }}</div>
@endsection
