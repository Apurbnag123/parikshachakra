<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeeAccount;
use App\Models\FeePayment;
use App\Models\ContactQuery;
use App\Models\User;

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

        return view('admin.dashboard', [
            'studentsCount' => $studentsCount,
            'paymentsToday' => $paymentsToday,
            'pendingTotal' => $pendingTotal,
            'newContactsCount' => $newContactsCount,
            'recentContacts' => $recentContacts,
        ]);
    }
}
