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

        $expenseByCategory = Transaction::selectRaw('
                category_id,
                SUM(amount) as total
            ')
            ->with('category')
            ->where('user_id', auth()->id())
            ->where('type', 'expense')
            ->whereMonth('transaction_date', $now->month)
            ->whereYear('transaction_date', $now->year)
            ->groupBy('category_id')
            ->orderByDesc('total')
            ->get();

        $topCategory = $expenseByCategory->first();

        $recentTransactions = Transaction::with([
                'account',
                'category',
                'fromAccount',
                'toAccount'
            ])
            ->where('user_id', auth()->id())
            ->latest()
            ->take(3)
            ->get();

        return view('dashboard', compact(
            'accounts',
            'totalAssets',
            'income',
            'expense',
            'recentTransactions',
            'expenseByCategory',
            'topCategory',
            'now'
        ));
    }
}