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
        $accounts = Account::where('user_id', auth()->id())->get();
        $categories = Category::where('type', 'income')->get();

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

            $account->balance += $request->amount;
            $account->save();
        });

        return redirect()
            ->route('history.index')
            ->with('success', 'Income successfully added.');
    }

    public function createExpense()
    {
        $accounts = Account::where('user_id', auth()->id())->get();

        $categories = Category::where('type', 'expense')->get();

        return view('transactions.expense', compact(
            'accounts',
            'categories'
        ));
    }

    public function storeExpense(Request $request)
    {
        $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
        ]);

        // Ambil account
        $account = Account::findOrFail($request->account_id);

        if ($account->balance < $request->amount) {
            return back()
                ->withInput()
                ->withErrors([
                    'amount' => 'Saldo akun tidak mencukupi.'
                ]);
        }

        // Simpan transaksi
        Transaction::create([
            'user_id' => auth()->id(),
            'type' => 'expense',
            'account_id' => $request->account_id,
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'description' => $request->description,
            'transaction_date' => $request->transaction_date,
        ]);

        // Kurangi saldo account
        $account->balance -= $request->amount;
        $account->save();

        return redirect()->route('history.index');
    }

    public function createTransfer()
    {
        $accounts = Account::where('user_id', auth()->id())->get();

        return view('transactions.transfer', compact('accounts'));
    }

    public function storeTransfer(Request $request)
    {
        $request->validate([
            'from_account_id' => 'required|exists:accounts,id',
            'to_account_id' => 'required|exists:accounts,id',
            'amount' => 'required|numeric|min:1',
            'admin_fee' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
        ]);

        if ($request->from_account_id == $request->to_account_id) {
            return back()->withInput()->withErrors([
                'to_account_id' => 'Akun tujuan tidak boleh sama dengan akun asal.'
            ]);
        }

        $fromAccount = Account::findOrFail($request->from_account_id);
        $toAccount = Account::findOrFail($request->to_account_id);
        $totalDeduction = $request->amount + $request->admin_fee;

        if ($fromAccount->balance < $totalDeduction) {
            return back()
                ->withInput()
                ->withErrors([
                    'amount' => 'Saldo akun tidak mencukupi.'
                ]);
        }

        Transaction::create([
            'user_id' => auth()->id(),
            'type' => 'transfer',
            'from_account_id' => $request->from_account_id,
            'to_account_id' => $request->to_account_id,
            'amount' => $request->amount,
            'admin_fee' => $request->admin_fee ?? 0,
            'description' => $request->description,
            'transaction_date' => $request->transaction_date,
        ]);

        $fromAccount->balance -= $totalDeduction;
        $toAccount->balance += $request->amount;
        $fromAccount->save();
        $toAccount->save();  
        
        return redirect()->route('history.index');
    }
}