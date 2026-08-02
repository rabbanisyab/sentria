<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Transactions
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold">
                        Transaction History
                    </h3>
                    <a href="{{ route('transactions.choose') }}"
                       class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg transition">
                        + Add Transaction
                    </a>
                </div>

                @if($transactions->count() > 0)
                <div class="space-y-4">
                @foreach($transactions as $transaction)

                <div class="flex items-center justify-between border rounded-xl p-4">
                    <div>
                        <h3 class="font-semibold text-gray-800">
                            {{ $transaction->category->name ?? 'Transfer' }}
                        </h3>

                        <p class="text-sm text-gray-500">
                            {{ $transaction->account->name ?? '-' }}
                            •
                            {{ $transaction->transaction_date }}
                        </p>
                    </div>

                    <div class="text-right">
                        <p class="font-semibold
                            {{ $transaction->type === 'income'
                                ? 'text-green-600'
                                : 'text-red-600' }}">
                            {{ $transaction->type === 'income' ? '+' : '-' }}
                            Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                @endforeach
                </div>
                @else

                <div class="text-center py-16">
                    <div class="text-6xl mb-4">
                        💸
                    </div>
                    <h4 class="text-xl font-semibold mb-2">
                        No transactions yet
                    </h4>
                    <p class="text-gray-500">
                        Start recording your income, expenses, and transfers.
                    </p>
                </div>
                @endif
            </div>

            @if(session('success'))
                <div class="mb-5 rounded-lg bg-green-100 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>

</x-app-layout>