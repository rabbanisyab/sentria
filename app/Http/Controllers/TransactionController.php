<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transactions.choose');
    }

    public function createIncome()
    {
        $accounts = Account::where('user_id', auth()->id())
            ->get();

        $categories = Category::where('type', 'income')
            ->get();

        return view('transactions.income', compact(
            'accounts',
            'categories'
        ));
    }

    public function storeIncome(Request $request)
    {
        $request->validate([
            'account_id' => 'required',
            'category_id' => 'required',
            'amount' => 'required|numeric|min:1',
            'transaction_date' => 'required|date',
        ]);


        DB::transaction(function () use ($request) {
            Transaction::create([
                'user_id' => auth()->id(),
                'type' => 'income',
                'account_id' => $request->account_id,
                'category_id' => $request->category_id,
                'amount' => $request->amount,
                'transaction_date' => $request->transaction_date,
            ]);

            $account = Account::findOrFail(
                $request->account_id
            );

            $account->increment(
                'balance',
                $request->amount
            );
        });

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Income successfully added.');
    }

    public function createExpense()
    {
        //
    }

    public function createTransfer()
    {
        //
    }
}