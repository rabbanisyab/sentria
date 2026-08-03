<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class HistoryController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with([
            'account',
            'category'
        ])
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

        return view('history.index', compact('transactions'));
    }
}