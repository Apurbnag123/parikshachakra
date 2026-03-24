<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\FeeAccount;
use App\Models\LiveClass;
use App\Models\Notice;
use App\Models\ResultEntry;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $batchId = $user?->batch_id;

        $account = $user?->feeAccount;
        if ($account) {
            $account->loadSum('payments', 'amount');
        } else {
            $account = FeeAccount::firstOrCreate(
                ['user_id' => $user->id],
                ['created_by' => null]
            );
            $account->loadSum('payments', 'amount');
        }

        $notices = Notice::query()
            ->where('is_published', true)
            ->where(function ($q) use ($batchId) {
                $q->whereNull('batch_id');
                if ($batchId) {
                    $q->orWhere('batch_id', $batchId);
                }
            })
            ->orderByDesc('published_at')
            ->limit(10)
            ->get();

        $classes = LiveClass::query()
            ->where('is_published', true)
            ->where(function ($q) use ($batchId) {
                $q->whereNull('batch_id');
                if ($batchId) {
                    $q->orWhere('batch_id', $batchId);
                }
            })
            ->orderBy('starts_at')
            ->limit(10)
            ->get();

        $results = ResultEntry::query()
            ->where('user_id', $user->id)
            ->orderByDesc('published_at')
            ->limit(10)
            ->get();

        $recentReceipts = $account->payments()->orderByDesc('paid_on')->limit(10)->get();

        return view('student.dashboard', [
            'user' => $user->load('batch'),
            'account' => $account,
            'notices' => $notices,
            'classes' => $classes,
            'results' => $results,
            'recentReceipts' => $recentReceipts,
        ]);
    }
}

