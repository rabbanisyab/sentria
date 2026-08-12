<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-[#1D3557]">Dashboard</h2>
                <p class="text-sm text-slate-500">Manage your finances</p>
            </div>

            <a href="{{ route('transactions.index') }}"
                class="hidden sm:inline-flex items-center gap-2 rounded-xl bg-[#1D3557] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#457B9D]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Add Transaction
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-[#F5F8FF] via-white to-[#F7F3FF]">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

            <!-- Welcome -->
            <section class="mb-6">
                <p class="text-sm font-medium text-[#457B9D]">Welcome back</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-[#1D3557] sm:text-3xl">
                    Halo, {{ auth()->user()->name }}
                </h1>
                <p class="mt-1 text-sm text-slate-500">Here's your financial overview.</p>
            </section>

            <!-- Current Period -->
            <section class="mb-6 flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Current Period</p>
                    <p class="mt-1 text-lg font-bold text-[#1D3557]">
                        {{ $now->translatedFormat('F Y') }}
                    </p>
                </div>

                <button type="button"
                    class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-600 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="currentColor" class="h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />
                    </svg>
                    This Month
                </button>
            </section>

            <!-- Summary Cards -->
            <section class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-3">

                <!-- Total Assets -->
                <div class="rounded-2xl bg-gradient-to-br from-[#1D3557] to-[#457B9D] p-5 text-white shadow-lg shadow-[#457B9D]/15">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-blue-100">Total Assets</p>

                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/15">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.8" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 7.5h16.5m-16.5 0A2.25 2.25 0 015.999 5.25h12.002A2.25 2.25 0 0120.25 7.5v9A2.25 2.25 0 0118.001 18.75H5.999A2.25 2.25 0 013.75 16.5v-9z" />
                            </svg>
                        </div>
                    </div>

                    <p class="mt-4 text-2xl font-bold sm:text-3xl">
                        Rp {{ number_format($totalAssets, 0, ',', '.') }}
                    </p>
                </div>

                <!-- Income -->
                <div class="rounded-2xl border border-green-100 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-slate-500">Income</p>

                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-green-50 text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.8" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 19.5V4.5m0 0l-6 6m6-6l6 6" />
                            </svg>
                        </div>
                    </div>

                    <p class="mt-4 text-2xl font-bold text-green-600 sm:text-3xl">
                        Rp {{ number_format($income, 0, ',', '.') }}
                    </p>
                    <p class="mt-1 text-xs text-slate-400">This month</p>
                </div>

                <!-- Expense -->
                <div class="rounded-2xl border border-red-100 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-slate-500">Expense</p>

                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-red-50 text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.8" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 4.5v15m0 0l6-6m-6 6l-6-6" />
                            </svg>
                        </div>
                    </div>

                    <p class="mt-4 text-2xl font-bold text-red-600 sm:text-3xl">
                        Rp {{ number_format($expense, 0, ',', '.') }}
                    </p>
                    <p class="mt-1 text-xs text-slate-400">This month</p>
                </div>

            </section>

            <!-- Accounts & Recent Transactions -->
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                <!-- Assets by Account -->
                <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm lg:col-span-2 sm:p-6">
                    <div class="mb-5 flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-bold text-[#1D3557]">Assets by Account</h2>
                            <p class="mt-1 text-sm text-slate-400">Your current account balances</p>
                        </div>

                        <a href="{{ route('accounts.index') }}"
                            class="text-sm font-semibold text-[#457B9D] hover:text-[#6D4AFF]">
                            View All
                        </a>
                    </div>

                    @if($accounts->count() > 0)

                        <!-- Desktop / Tablet -->
                        <div class="hidden gap-4 sm:grid sm:grid-cols-3 xl:grid-cols-4">
                            @foreach($accounts as $account)
                                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4 transition hover:-translate-y-0.5 hover:shadow-md">
                                    <div class="flex items-center gap-3">

                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl
                                            @if($account->type == 'bank') bg-blue-50 text-[#457B9D]
                                            @elseif($account->type == 'ewallet') bg-purple-50 text-[#6D4AFF]
                                            @elseif($account->type == 'cash') bg-amber-50 text-amber-600
                                            @else bg-indigo-50 text-indigo-600
                                            @endif">

                                            @if($account->type == 'bank')
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.8" stroke="currentColor" class="h-5 w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3.75 9L12 4.5 20.25 9M4.5 10.5h15M6 10.5v7.5M10.5 10.5v7.5M15 10.5v7.5M19.5 10.5v7.5M3.75 18h16.5" />
                                                </svg>

                                            @elseif($account->type == 'ewallet')
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.8" stroke="currentColor" class="h-5 w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.25 6.75A2.25 2.25 0 014.5 4.5h15a2.25 2.25 0 012.25 2.25v10.5A2.25 2.25 0 0119.5 19.5h-15a2.25 2.25 0 01-2.25-2.25V6.75z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12h3" />
                                                </svg>

                                            @elseif($account->type == 'cash')
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.8" stroke="currentColor" class="h-5 w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5h18v9H3v-9z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 10.5h.01M18 13.5h.01" />
                                                </svg>

                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.8" stroke="currentColor" class="h-5 w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3.75 6.75h16.5v10.5H3.75V6.75z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 10.5h13.5" />
                                                </svg>
                                            @endif
                                        </div>

                                        <div class="min-w-0">
                                            <p class="truncate text-sm font-semibold text-[#1D3557]">{{ $account->name }}</p>
                                            <p class="mt-0.5 text-xs capitalize text-slate-400">
                                                {{ str_replace('_', ' ', $account->type) }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-6">
                                        <p class="text-lg font-bold text-slate-800">
                                            Rp {{ number_format($account->balance, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Mobile -->
                        <div class="flex gap-3 overflow-x-auto pb-2 sm:hidden">
                            @foreach($accounts as $account)
                                <div class="min-w-[180px] rounded-2xl border border-slate-100 bg-slate-50 p-4">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl
                                        @if($account->type == 'bank') bg-blue-50 text-[#457B9D]
                                        @elseif($account->type == 'ewallet') bg-purple-50 text-[#6D4AFF]
                                        @elseif($account->type == 'cash') bg-amber-50 text-amber-600
                                        @else bg-indigo-50 text-indigo-600
                                        @endif">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.8" stroke="currentColor" class="h-5 w-5">
                                            <rect x="3" y="5" width="18" height="14" rx="2" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18" />
                                        </svg>
                                    </div>

                                    <p class="mt-4 text-sm font-semibold text-[#1D3557]">{{ $account->name }}</p>
                                    <p class="mt-1 text-xs capitalize text-slate-400">
                                        {{ str_replace('_', ' ', $account->type) }}
                                    </p>
                                    <p class="mt-3 text-base font-bold text-slate-800">
                                        Rp {{ number_format($account->balance, 0, ',', '.') }}
                                    </p>
                                </div>
                            @endforeach
                        </div>

                    @else

                        <div class="rounded-2xl border border-dashed border-slate-200 py-12 text-center">
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-[#457B9D]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.8" stroke="currentColor" class="h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 7.5h16.5m-16.5 0A2.25 2.25 0 015.999 5.25h12.002A2.25 2.25 0 0120.25 7.5v9A2.25 2.25 0 0118.001 18.75H5.999A2.25 2.25 0 013.75 16.5v-9z" />
                                </svg>
                            </div>

                            <p class="mt-4 font-semibold text-[#1D3557]">No accounts yet</p>
                            <p class="mt-1 text-sm text-slate-400">Add an account to start tracking your assets.</p>

                            <a href="{{ route('accounts.create') }}"
                                class="mt-5 inline-flex rounded-xl bg-[#457B9D] px-4 py-2.5 text-sm font-semibold text-white hover:bg-[#1D3557]">
                                Add Account
                            </a>
                        </div>

                    @endif
                </div>

                <!-- Recent Transactions -->
                <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm sm:p-6">
                    <div class="mb-5 flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-bold text-[#1D3557]">Recent Transactions</h2>
                            <p class="mt-1 text-sm text-slate-400">Latest activity</p>
                        </div>

                        <a href="{{ route('history.index') }}"
                            class="text-sm font-semibold text-[#457B9D] hover:text-[#6D4AFF]">
                            View All
                        </a>
                    </div>

                    <div class="space-y-3">
                        @forelse($recentTransactions as $transaction)
                            <div class="rounded-xl border border-slate-100 p-3.5">
                                <div class="flex items-start gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl
                                        @if($transaction->type == 'income') bg-green-50 text-green-600
                                        @elseif($transaction->type == 'expense') bg-red-50 text-red-600
                                        @else bg-blue-50 text-[#457B9D]
                                        @endif">

                                        @if($transaction->type == 'income')
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 19.5V4.5m0 0l-6 6m6-6l6 6" />
                                            </svg>

                                        @elseif($transaction->type == 'expense')
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4.5v15m0 0l6-6m-6 6l-6-6" />
                                            </svg>

                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7.5 7.5h9m0 0v9m0-9L7.5 16.5" />
                                            </svg>
                                        @endif
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        @if($transaction->type == 'transfer')
                                            <p class="truncate text-sm font-semibold text-[#1D3557]">
                                                {{ $transaction->fromAccount?->name }} → {{ $transaction->toAccount?->name }}
                                            </p>
                                            <p class="mt-1 text-xs text-slate-400">Transfer</p>
                                        @else
                                            <p class="truncate text-sm font-semibold text-[#1D3557]">
                                                {{ $transaction->category?->name ?? ucfirst($transaction->type) }}
                                            </p>
                                            <p class="mt-1 truncate text-xs text-slate-400">
                                                {{ $transaction->account?->name }}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="shrink-0 text-right">
                                        @if($transaction->type == 'income')
                                            <p class="text-sm font-bold text-green-600">
                                                +Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                            </p>
                                        @elseif($transaction->type == 'expense')
                                            <p class="text-sm font-bold text-red-600">
                                                -Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                            </p>
                                        @else
                                            <p class="text-sm font-bold text-[#457B9D]">
                                                Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                            </p>
                                        @endif
                                    </div>

                                </div>
                            </div>

                        @empty

                            <div class="py-10 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-slate-50 text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.8" stroke="currentColor" class="h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12h6m-6 4h6m2.25 4.5H6.75A2.25 2.25 0 014.5 18.25V5.75A2.25 2.25 0 016.75 3.5h7.5l5.25 5.25v9.5a2.25 2.25 0 01-2.25 2.25z" />
                                    </svg>
                                </div>

                                <p class="mt-3 text-sm font-medium text-slate-500">No transactions yet</p>
                                <p class="mt-1 text-xs text-slate-400">Your latest activity will appear here.</p>
                            </div>

                        @endforelse
                    </div>
                </div>

            </section>

            <!-- Analytics -->
            <section class="mt-6 rounded-2xl border border-slate-100 bg-white p-5 shadow-sm sm:p-6">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-[#1D3557]">Analytics by Category</h2>
                        <p class="mt-1 text-sm text-slate-400">Understand where your money goes</p>
                    </div>

                    <a href="#" class="text-sm font-semibold text-[#457B9D] hover:text-[#6D4AFF]">
                        View Analytics
                    </a>
                </div>

                <div class="flex min-h-[220px] items-center justify-center rounded-2xl bg-gradient-to-br from-[#F5F8FF] to-[#F7F3FF]">
                    <div class="text-center">
                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full border-[18px]
                            border-[#457B9D] border-r-[#6D4AFF] border-b-purple-200">
                            <div class="h-5 w-5 rounded-full bg-white"></div>
                        </div>

                        <p class="mt-4 font-semibold text-[#1D3557]">Income & Expense Analytics</p>
                        <p class="mt-1 text-sm text-slate-400">Category breakdown will appear here.</p>
                    </div>
                </div>
            </section>

        </div>
    </div>

</x-app-layout>