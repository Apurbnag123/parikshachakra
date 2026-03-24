<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeeAccount;
use App\Models\FeePayment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FeeController extends Controller
{
    public function index(Request $request)
    {
        $students = User::query()
            ->where('role', User::ROLE_STUDENT)
            ->with(['batch', 'feeAccount' => fn ($q) => $q->withSum('payments', 'amount')])
            ->orderBy('name')
            ->paginate(20);

        return view('admin.fees.index', [
            'students' => $students,
        ]);
    }

    public function edit(User $student)
    {
        abort_unless($student->role === User::ROLE_STUDENT, 404);

        $account = FeeAccount::firstOrCreate(
            ['user_id' => $student->id],
            ['created_by' => request()->user()?->id]
        );

        $account->loadSum('payments', 'amount');

        return view('admin.fees.edit', [
            'student' => $student->load('batch'),
            'account' => $account,
            'payments' => $account->payments()->orderByDesc('paid_on')->limit(20)->get(),
        ]);
    }

    public function updateAccount(Request $request, User $student)
    {
        abort_unless($student->role === User::ROLE_STUDENT, 404);

        $data = $request->validate([
            'total_fee' => ['required', 'numeric', 'min:0'],
            'concession' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
        ]);

        $account = FeeAccount::firstOrCreate(
            ['user_id' => $student->id],
            ['created_by' => $request->user()?->id]
        );

        $account->fill([
            'total_fee' => $data['total_fee'],
            'concession' => $data['concession'] ?? 0,
            'notes' => $data['notes'] ?? null,
        ])->save();

        return redirect()->route('admin.fees.edit', $student)->with('status', 'Fees updated.');
    }

    public function storePayment(Request $request, User $student)
    {
        abort_unless($student->role === User::ROLE_STUDENT, 404);

        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:1'],
            'paid_on' => ['required', 'date'],
            'payment_mode' => ['required', 'string', 'max:50'],
            'transaction_id' => ['nullable', 'string', 'max:100', 'required_unless:payment_mode,cash'],
            'reference_no' => ['nullable', 'string', 'max:100'],
            'remarks' => ['nullable', 'string'],
        ]);

        $account = FeeAccount::firstOrCreate(
            ['user_id' => $student->id],
            ['created_by' => $request->user()?->id]
        );

        $receiptNo = $this->generateReceiptNo();

        $payment = FeePayment::create([
            'fee_account_id' => $account->id,
            'receipt_no' => $receiptNo,
            'amount' => $data['amount'],
            'paid_on' => $data['paid_on'],
            'payment_mode' => $data['payment_mode'],
            'transaction_id' => $data['payment_mode'] === 'cash' ? null : ($data['transaction_id'] ?? null),
            'reference_no' => $data['reference_no'] ?? null,
            'remarks' => $data['remarks'] ?? null,
            'created_by' => $request->user()?->id,
        ]);

        return redirect()
            ->route('admin.fees.receipt', $payment)
            ->with('status', 'Payment saved. Receipt: '.$receiptNo);
    }

    public function receipt(FeePayment $payment)
    {
        $payment->load(['feeAccount.user.batch']);

        return view('admin.fees.receipt', [
            'payment' => $payment,
        ]);
    }

    public function report(Request $request)
    {
        $data = $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date'],
        ]);

        $from = $data['from'] ?? now()->subDays(30)->toDateString();
        $to = $data['to'] ?? now()->toDateString();

        $payments = FeePayment::query()
            ->whereBetween('paid_on', [$from, $to])
            ->with('feeAccount.user')
            ->orderByDesc('paid_on')
            ->paginate(50)
            ->withQueryString();

        $total = (float) FeePayment::whereBetween('paid_on', [$from, $to])->sum('amount');

        return view('admin.fees.report', [
            'payments' => $payments,
            'from' => $from,
            'to' => $to,
            'total' => $total,
        ]);
    }

    private function generateReceiptNo(): string
    {
        do {
            $candidate = 'RC'.now()->format('Ymd').Str::upper(Str::random(4));
        } while (FeePayment::where('receipt_no', $candidate)->exists());

        return $candidate;
    }
}
