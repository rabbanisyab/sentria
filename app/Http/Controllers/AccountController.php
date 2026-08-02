<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAccountRequest;
use App\Models\Account;
use App\Http\Requests\UpdateAccountRequest;

class AccountController extends Controller
{
    public function index() {
        $accounts = auth()->user()
            ->accounts()
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('accounts.create');
    }

    public function store(StoreAccountRequest $request)
    {
        Account::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'type' => $request->type,
            'balance' => $request->balance,
            'is_active' => true,
        ]);

        return redirect()
            ->route('accounts.index')
            ->with('success', 'Account created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Account $account)
    {
        return view('accounts.edit', compact('account'));
    }

    public function update(UpdateAccountRequest $request, Account $account)
    {
        $account->update([
            'name' => $request->name,
            'type' => $request->type,
            'balance' => $request->balance,
        ]);

        return redirect()
            ->route('accounts.index')
            ->with('success', 'Account updated successfully.');
    }

    public function destroy(Account $account)
    {
        $account->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('accounts.index')
            ->with('success', 'Account deactivated successfully.');
    }
}
