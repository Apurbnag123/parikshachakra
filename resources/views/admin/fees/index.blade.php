@extends('layouts.dashboard')

@section('title', 'Fees')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">Fees</h1>
            <div class="text-muted">Decide fee, deposit fee, pending fee, receipts.</div>
        </div>
        <a class="btn btn-outline-primary" href="{{ route('admin.fees.report') }}">Fees Report</a>
    </div>

    <div class="card pc-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Login ID</th>
                            <th>Batch</th>
                            <th class="text-end">Payable</th>
                            <th class="text-end">Paid</th>
                            <th class="text-end">Pending</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $s)
                            @php
                                $acc = $s->feeAccount;
                                $payable = $acc ? $acc->payableAmount() : 0;
                                $paid = $acc ? $acc->paidAmount() : 0;
                                $pending = $acc ? $acc->pendingAmount() : 0;
                            @endphp
                            <tr>
                                <td class="fw-semibold">{{ $s->name }}</td>
                                <td>{{ $s->login_id }}</td>
                                <td>{{ $s->batch?->name ?? 'Not set' }}</td>
                                <td class="text-end">₹ {{ number_format($payable, 2) }}</td>
                                <td class="text-end">₹ {{ number_format($paid, 2) }}</td>
                                <td class="text-end">
                                    <span class="badge {{ $pending > 0 ? 'text-bg-danger' : 'text-bg-success' }}">
                                        ₹ {{ number_format($pending, 2) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-primary" href="{{ route('admin.fees.edit', $s) }}">Manage</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">{{ $students->links() }}</div>
@endsection

