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
                    Halo, {{ auth()->user()->name }} 
                </h1>

                <p class="text-gray-500">
                    {{ $now->translatedFormat('F Y') }}
                </p>
            </div>

            {{-- Summary --}}
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

            {{-- Accounts --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-lg font-semibold mb-4">
                    My Accounts
                </h2>
                <div class="space-y-3">
                    @forelse($accounts as $account)
                        <div class="flex justify-between border rounded-lg p-4">
                            <div>
                                <h3 class="font-semibold">
                                    {{ $account->name }}
                                </h3>
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
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-lg font-semibold mb-4">
                    Recent Transactions
                </h2>
                <div class="space-y-3">
                    @forelse($recentTransactions as $transaction)
                        <div class="flex justify-between border rounded-lg p-4">
                            <div>
                                @if($transaction->type == 'transfer')
                                    <h3 class="font-semibold">
                                        Transfer
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        {{ $transaction->fromAccount?->name }}
                                        →
                                        {{ $transaction->toAccount?->name }}
                                    </p>
                                @else
                                    <h3 class="font-semibold">
                                        {{ $transaction->category?->name }}
                                    </h3>
                                    @if($transaction->description)
                                        <p class="text-sm text-gray-700">
                                            {{ $transaction->description }}
                                        </p>
                                    @endif
                                    <p class="text-sm text-gray-500">
                                        {{ $transaction->account?->name }}
                                    </p>
                                @endif
                            </div>

                            <div class="text-right">
                                @if($transaction->type == 'income')
                                    <p class="font-semibold text-green-600">
                                        + Rp {{ number_format($transaction->amount,0,',','.') }}
                                    </p>
                                @elseif($transaction->type == 'expense')
                                    <p class="font-semibold text-red-600">
                                        - Rp {{ number_format($transaction->amount,0,',','.') }}
                                    </p>
                                @else
                                    <p class="font-semibold text-blue-600">
                                        Rp {{ number_format($transaction->amount,0,',','.') }}
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

</x-app-layout>