@extends('layouts.dashboard')

@section('title', 'Manage Fees')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">Manage Fees</h1>
            <div class="text-muted">
                {{ $student->name }} ({{ $student->login_id }}) | Batch: {{ $student->batch?->name ?? 'Not set' }}
            </div>
        </div>
        <a class="btn btn-outline-primary" href="{{ route('admin.fees.index') }}">Back</a>
    </div>

    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card pc-card">
                <div class="card-body">
                    <h5 class="mb-3 fw-bold">Decide Fees</h5>
                    <form method="post" action="{{ route('admin.fees.account.update', $student) }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Total Fee</label>
                                <input class="form-control @error('total_fee') is-invalid @enderror" type="number" step="0.01" name="total_fee" value="{{ old('total_fee', $account->total_fee) }}" required>
                                @error('total_fee')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Concession</label>
                                <input class="form-control @error('concession') is-invalid @enderror" type="number" step="0.01" name="concession" value="{{ old('concession', $account->concession) }}">
                                @error('concession')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Notes</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" rows="2">{{ old('notes', $account->notes) }}</textarea>
                                @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <button class="btn btn-primary mt-3" type="submit">Save Fees</button>
                    </form>

                    <hr class="my-4">
                    <div class="d-flex flex-wrap gap-2">
                        <div class="badge text-bg-light border">Payable: ₹ {{ number_format($account->payableAmount(), 2) }}</div>
                        <div class="badge text-bg-light border">Paid: ₹ {{ number_format($account->paidAmount(), 2) }}</div>
                        <div class="badge {{ $account->pendingAmount() > 0 ? 'text-bg-danger' : 'text-bg-success' }}">Pending: ₹ {{ number_format($account->pendingAmount(), 2) }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card pc-card">
                <div class="card-body">
                    <h5 class="mb-3 fw-bold">Deposit Fees</h5>
                    <form method="post" action="{{ route('admin.fees.payment.store', $student) }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Amount</label>
                                <input class="form-control @error('amount') is-invalid @enderror" type="number" step="0.01" name="amount" value="{{ old('amount') }}" required>
                                @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Paid On</label>
                                <input class="form-control @error('paid_on') is-invalid @enderror" type="date" name="paid_on" value="{{ old('paid_on', now()->toDateString()) }}" required>
                                @error('paid_on')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Payment Mode</label>
                                <select class="form-select @error('payment_mode') is-invalid @enderror" name="payment_mode" required>
                                    @foreach (['cash','upi','bank','card','other'] as $m)
                                        <option value="{{ $m }}" {{ old('payment_mode', 'cash') === $m ? 'selected' : '' }}>{{ strtoupper($m) }}</option>
                                    @endforeach
                                </select>
                                @error('payment_mode')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Transaction ID (required for online)</label>
                                <input class="form-control @error('transaction_id') is-invalid @enderror" name="transaction_id" value="{{ old('transaction_id') }}">
                                @error('transaction_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Reference No (optional)</label>
                                <input class="form-control @error('reference_no') is-invalid @enderror" name="reference_no" value="{{ old('reference_no') }}">
                                @error('reference_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Remarks</label>
                                <textarea class="form-control @error('remarks') is-invalid @enderror" name="remarks" rows="2">{{ old('remarks') }}</textarea>
                                @error('remarks')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <button class="btn btn-success mt-3" type="submit">Save Payment + Generate Receipt</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const mode = document.querySelector('select[name="payment_mode"]');
            const txn = document.querySelector('input[name="transaction_id"]');
            if (!mode || !txn) return;

            function syncTxnRequired() {
                const isCash = (mode.value || '').toLowerCase() === 'cash';
                txn.required = !isCash;
                txn.placeholder = isCash ? 'Not required for CASH' : 'Enter transaction id';
            }

            mode.addEventListener('change', syncTxnRequired);
            syncTxnRequired();
        })();
    </script>

    <div class="card pc-card mt-3">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Recent Payments</h5>
            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Receipt</th>
                            <th>Paid On</th>
                            <th>Mode</th>
                            <th class="text-end">Amount</th>
                            <th class="text-end">Receipt</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $p)
                            <tr>
                                <td class="fw-semibold">{{ $p->receipt_no }}</td>
                                <td>{{ $p->paid_on->format('d-m-Y') }}</td>
                                <td>{{ strtoupper($p->payment_mode) }}</td>
                                <td class="text-end">₹ {{ number_format($p->amount, 2) }}</td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.fees.receipt', $p) }}" target="_blank">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-muted text-center py-3">No payments yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
