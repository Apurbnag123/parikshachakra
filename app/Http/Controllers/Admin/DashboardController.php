<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeeAccount;
use App\Models\FeePayment;
use App\Models\ContactQuery;
use App\Models\Batch;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $studentsCount = User::where('role', User::ROLE_STUDENT)->count();
        $paymentsToday = FeePayment::whereDate('paid_on', today())->sum('amount');
        $accounts = FeeAccount::withSum('payments', 'amount')->get();
        $pendingTotal = $accounts->sum(fn (FeeAccount $a) => $a->pendingAmount());
        $newContactsCount = ContactQuery::where('status', 'new')->count();
        $recentContacts = ContactQuery::orderByDesc('id')->limit(5)->get();

        $paymentsLast7 = FeePayment::query()
            ->selectRaw('paid_on as d, SUM(amount) as total')
            ->where('paid_on', '>=', now()->subDays(6)->toDateString())
            ->groupBy('d')
            ->orderBy('d')
            ->get()
            ->keyBy('d');

        $paymentLabels = [];
        $paymentTotals = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $paymentLabels[] = now()->subDays($i)->format('d M');
            $paymentTotals[] = (float) ($paymentsLast7[$date]->total ?? 0);
        }

        $studentsByBatch = User::query()
            ->select('batch_id', DB::raw('COUNT(*) as c'))
            ->where('role', User::ROLE_STUDENT)
            ->groupBy('batch_id')
            ->get();

        $batchNames = Batch::query()->pluck('name', 'id');
        $batchLabels = [];
        $batchCounts = [];
        foreach ($studentsByBatch as $row) {
            $id = $row->batch_id;
            $batchLabels[] = $id ? ($batchNames[$id] ?? ('Batch #' . $id)) : 'Unassigned';
            $batchCounts[] = (int) $row->c;
        }

        return view('admin.dashboard', [
            'studentsCount' => $studentsCount,
            'paymentsToday' => $paymentsToday,
            'pendingTotal' => $pendingTotal,
            'newContactsCount' => $newContactsCount,
            'recentContacts' => $recentContacts,
            'paymentLabels' => $paymentLabels,
            'paymentTotals' => $paymentTotals,
            'batchLabels' => $batchLabels,
            'batchCounts' => $batchCounts,
        ]);
    }
}
