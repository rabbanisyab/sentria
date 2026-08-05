<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Greeting --}}
            <div>
                <h1 class="text-2xl font-bold">
                    Halo, {{ auth()->user()->name }} 👋
                </h1>
                <p class="text-gray-500">
                    {{ $now->translatedFormat('F Y') }}
                </p>
            </div>

            {{-- Summary Card --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-gray-500 text-sm">
                        Total Assets
                    </p>
                    <h2 class="text-2xl font-bold mt-2">
                        Rp {{ number_format($totalAssets,0,',','.') }}
                    </h2>
                </div>

                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-gray-500 text-sm">
                        Income This Month
                    </p>
                    <h2 class="text-2xl font-bold text-green-600 mt-2">
                        Rp {{ number_format($income,0,',','.') }}
                    </h2>
                </div>
                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-gray-500 text-sm">
                        Expense This Month
                    </p>
                    <h2 class="text-2xl font-bold text-red-600 mt-2">
                        Rp {{ number_format($expense,0,',','.') }}
                    </h2>
                </div>
            </div>

            {{-- Assets & Recent --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Assets by Account --}}
                <div class="lg:col-span-2 bg-white rounded-xl shadow p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">
                            Assets by Account
                        </h2>
                        <p class="text-sm text-gray-500">
                            {{ $accounts->count() }} Accounts
                        </p>
                    </div>

                    <div class="space-y-3">
                        @forelse($accounts as $account)
                            <div class="flex justify-between items-center border rounded-lg p-4">
                                <div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                            @if($account->type == 'bank')
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    stroke="currentColor"
                                                    class="w-6 h-6 text-blue-600">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M3.75 9L12 4.5 20.25 9M4.5 10.5h15M6 10.5v7.5M10.5 10.5v7.5M15 10.5v7.5M19.5 10.5v7.5M3.75 18h16.5"/>
                                                </svg>

                                            @elseif($account->type == 'ewallet')
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    stroke="currentColor"
                                                    class="w-6 h-6 text-green-600">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M2.25 6.75A2.25 2.25 0 014.5 4.5h15A2.25 2.25 0 0121.75 6.75v10.5A2.25 2.25 0 0119.5 19.5h-15A2.25 2.25 0 012.25 17.25V6.75zm13.5 5.25h3"/>
                                                </svg>

                                            @elseif($account->type == 'cash')
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    stroke="currentColor"
                                                    class="w-6 h-6 text-yellow-600">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M2.25 7.5h19.5v9H2.25v-9zm3 3h.008v.008H5.25V10.5z"/>
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    stroke="currentColor"
                                                    class="w-6 h-6 text-purple-600">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M3.75 6.75h16.5v10.5H3.75V6.75zm1.5 3h13.5"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <div>
                                            <h3 class="font-semibold">
                                                {{ $account->name }}
                                            </h3>
                                            <p class="text-sm text-gray-500">
                                                {{ ucfirst(str_replace('_',' ', $account->type)) }}
                                            </p>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-500">
                                        {{ ucfirst(str_replace('_',' ', $account->type)) }}
                                    </p>
                                </div>

                                <div class="font-semibold">
                                    Rp {{ number_format($account->balance,0,',','.') }}
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">
                                Belum ada akun.
                            </p>
                        @endforelse
                    </div>
                </div>

                {{-- Recent Transactions --}}
                <div class="lg:col-span-1 bg-white rounded-xl shadow p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">
                            Recent Transactions
                        </h2>
                        <a href="{{ route('history.index') }}"
                            class="text-blue-600 text-sm hover:underline">
                            View All
                        </a>
                    </div>

                    <div class="space-y-3">
                        @forelse($recentTransactions as $transaction)
                            <div class="border rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        @if($transaction->type == 'income')
                                            <span class="px-2 py-1 rounded-full bg-green-100 text-green-700 text-xs">
                                                Income
                                            </span>
                                        @elseif($transaction->type == 'expense')
                                            <span class="px-2 py-1 rounded-full bg-red-100 text-red-700 text-xs">
                                                Expense
                                            </span>
                                        @else
                                            <span class="px-2 py-1 rounded-full bg-blue-100 text-blue-700 text-xs">
                                                Transfer
                                            </span>
                                        @endif
                                    </div>

                                    <div>
                                        @if($transaction->type == 'income')
                                            <p class="font-semibold text-green-600">
                                                +Rp {{ number_format($transaction->amount,0,',','.') }}
                                            </p>
                                        @elseif($transaction->type == 'expense')
                                            <p class="font-semibold text-red-600">
                                                -Rp {{ number_format($transaction->amount,0,',','.') }}
                                            </p>
                                        @else
                                            <p class="font-semibold text-blue-600">
                                                Rp {{ number_format($transaction->amount,0,',','.') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-3">
                                    @if($transaction->type == 'transfer')
                                        <h3 class="font-semibold">
                                            {{ $transaction->fromAccount?->name }}
                                            →
                                            {{ $transaction->toAccount?->name }}
                                        </h3>

                                    @else
                                        <h3 class="font-semibold">
                                            {{ $transaction->category?->name }}
                                        </h3>

                                        @if($transaction->description)
                                            <p class="text-sm text-gray-600">
                                                {{ $transaction->description }}
                                            </p>
                                        @endif

                                        <p class="text-sm text-gray-500">
                                            {{ $transaction->account?->name }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                        @empty
                            <p class="text-gray-500">
                                Belum ada transaksi.
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>