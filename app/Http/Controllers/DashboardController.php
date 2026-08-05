<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');

        $now = Carbon::now();

        $accounts = Account::where('user_id', auth()->id())->get();

        $totalAssets = $accounts->sum('balance');

        $income = Transaction::where('user_id', auth()->id())
            ->where('type', 'income')
            ->whereMonth('transaction_date', $now->month)
            ->whereYear('transaction_date', $now->year)
            ->sum('amount');

        $expense = Transaction::where('user_id', auth()->id())
            ->where('type', 'expense')
            ->whereMonth('transaction_date', $now->month)
            ->whereYear('transaction_date', $now->year)
            ->sum('amount');

        $recentTransactions = Transaction::with([
                'account',
                'category',
                'fromAccount',
                'toAccount'
            ])
            ->where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'accounts',
            'totalAssets',
            'income',
            'expense',
            'recentTransactions',
            'now'
        ));
    }
}