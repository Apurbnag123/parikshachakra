<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Receipt {{ $payment->receipt_no }} | ParikshaChakra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{ background:#f4f6f9; }
        .pc-receipt{
            max-width: 880px;
            margin: 18px auto;
            background: #fff;
            border: 1px solid rgba(0,0,0,0.12);
            border-radius: 14px;
            overflow:hidden;
        }
        .pc-head{
            padding: 18px 18px 12px;
            background: linear-gradient(135deg, #071a39, #0b2c5f 55%, #071a39);
            color: #fff;
        }
        .pc-body{ padding: 18px; }
        .pc-copy{
            border: 1px solid rgba(0,0,0,0.12);
            border-radius: 12px;
            padding: 14px;
            margin-bottom: 14px;
        }
        .pc-cut{
            border-top: 2px dashed rgba(0,0,0,0.35);
            margin: 14px 0;
        }
        @media print{
            body{ background:#fff; }
            .no-print{ display:none !important; }
            .pc-receipt{ border:0; margin:0; border-radius:0; }
        }
    </style>
</head>
<body>
@php
    $student = $payment->feeAccount->user;
    $acc = $payment->feeAccount->loadSum('payments', 'amount');
    $payable = $acc->payableAmount();
    $paid = $acc->paidAmount();
    $pending = $acc->pendingAmount();
@endphp

<div class="pc-receipt">
    <div class="pc-head d-flex justify-content-between align-items-center">
        <div>
            <div class="fw-bold" style="letter-spacing:.4px;">PARIKSHA CHAKRA</div>
            <div style="opacity:.9;">Fees Receipt</div>
        </div>
        <div class="text-end">
            <div class="fw-bold">Receipt No: {{ $payment->receipt_no }}</div>
            <div style="opacity:.9;">Date: {{ $payment->paid_on->format('d-m-Y') }}</div>
        </div>
    </div>

    <div class="pc-body">
        <div class="no-print mb-3 d-flex gap-2">
            <button class="btn btn-primary" onclick="window.print()">Print</button>
            <a class="btn btn-outline-secondary" href="{{ route('admin.fees.edit', $student) }}">Back</a>
        </div>

        @php
            $mode = strtoupper($payment->payment_mode);
            $txn = $payment->transaction_id;
        @endphp

        <div class="pc-copy">
            <div class="d-flex justify-content-between align-items-center">
                <div class="fw-bold">Coaching Copy</div>
                <div class="text-muted small">Signature: ____________________</div>
            </div>
            <hr class="my-2">

            <div class="row g-3">
                <div class="col-md-7">
                    <div class="fw-semibold">Student</div>
                    <div>{{ $student->name }}</div>
                    <div class="text-muted">Login ID: {{ $student->login_id }} | Batch: {{ $student->batch?->name ?? 'Not set' }}</div>
                </div>
                <div class="col-md-5">
                    <div class="fw-semibold">Payment</div>
                    <div>Amount: <span class="fw-bold">₹ {{ number_format($payment->amount, 2) }}</span></div>
                    <div>Mode: {{ $mode }}</div>
                    @if ($txn)
                        <div>Transaction ID: <span class="fw-semibold">{{ $txn }}</span></div>
                    @endif
                    @if ($payment->reference_no)
                        <div>Reference: {{ $payment->reference_no }}</div>
                    @endif
                </div>
            </div>

            @if ($payment->remarks)
                <div class="mt-2"><span class="fw-semibold">Remarks:</span> {{ $payment->remarks }}</div>
            @endif

            <div class="mt-3">
                <div class="row g-2">
                    <div class="col-md-4"><div class="border rounded p-2">Payable: ₹ {{ number_format($payable, 2) }}</div></div>
                    <div class="col-md-4"><div class="border rounded p-2">Paid: ₹ {{ number_format($paid, 2) }}</div></div>
                    <div class="col-md-4"><div class="border rounded p-2">Pending: ₹ {{ number_format($pending, 2) }}</div></div>
                </div>
            </div>
        </div>

        <div class="pc-cut"></div>

        <div class="pc-copy">
            <div class="d-flex justify-content-between align-items-center">
                <div class="fw-bold">Student Copy</div>
                <div class="text-muted small">Signature: ____________________</div>
            </div>
            <hr class="my-2">

            <div class="row g-3">
                <div class="col-md-7">
                    <div class="fw-semibold">Student</div>
                    <div>{{ $student->name }}</div>
                    <div class="text-muted">Login ID: {{ $student->login_id }} | Batch: {{ $student->batch?->name ?? 'Not set' }}</div>
                </div>
                <div class="col-md-5">
                    <div class="fw-semibold">Payment</div>
                    <div>Amount: <span class="fw-bold">₹ {{ number_format($payment->amount, 2) }}</span></div>
                    <div>Mode: {{ $mode }}</div>
                    @if ($txn)
                        <div>Transaction ID: <span class="fw-semibold">{{ $txn }}</span></div>
                    @endif
                    @if ($payment->reference_no)
                        <div>Reference: {{ $payment->reference_no }}</div>
                    @endif
                </div>
            </div>

            @if ($payment->remarks)
                <div class="mt-2"><span class="fw-semibold">Remarks:</span> {{ $payment->remarks }}</div>
            @endif

            <div class="mt-3">
                <div class="row g-2">
                    <div class="col-md-4"><div class="border rounded p-2">Payable: ₹ {{ number_format($payable, 2) }}</div></div>
                    <div class="col-md-4"><div class="border rounded p-2">Paid: ₹ {{ number_format($paid, 2) }}</div></div>
                    <div class="col-md-4"><div class="border rounded p-2">Pending: ₹ {{ number_format($pending, 2) }}</div></div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
