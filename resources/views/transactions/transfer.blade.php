<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Add Transfer
        </h2>
    </x-slot>

    <div class="py-5 sm:py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back --}}
            <a href="{{ route('transactions.index') }}"
                class="inline-flex items-center gap-2
                       text-sm font-medium text-gray-500
                       hover:text-[#6C63FF]
                       transition mb-5">

                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="w-4 h-4">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15.75 19.5L8.25 12l7.5-7.5" />

                </svg>

                Back to Transactions
            </a>


            {{-- Header --}}
            <div class="mb-6 sm:mb-8">

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 sm:w-14 sm:h-14
                                shrink-0
                                rounded-2xl
                                bg-[#F0EFFF]
                                text-[#6C63FF]
                                flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="w-6 h-6 sm:w-7 sm:h-7">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M7 7h11l-3-3m3 3l-3 3" />

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M17 17H6l3 3m-3-3l3-3" />

                        </svg>

                    </div>

                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
                            Add Transfer
                        </h1>

                        <p class="text-sm text-gray-500 mt-1">
                            Move money between your accounts.
                        </p>
                    </div>

                </div>

            </div>


            {{-- Form Card --}}
            <div class="bg-white
                        rounded-2xl
                        shadow-sm
                        border border-[#DCD9FF]
                        overflow-hidden">

                {{-- Top Accent --}}
                <div class="h-1.5 w-full bg-[#6C63FF]"></div>

                {{-- Form Content --}}
                <div class="p-5 sm:p-7">

                    <form method="POST"
                          action="{{ route('transactions.store.transfer') }}"
                          class="space-y-5">

                        @csrf


                        {{-- From Account --}}
                        <div>
                            <label for="from_account_id"
                                class="block text-sm font-semibold text-gray-700 mb-2">
                                From Account
                            </label>

                            <select
                                id="from_account_id"
                                name="from_account_id"
                                required
                                class="w-full rounded-xl
                                       border-gray-200
                                       bg-gray-50
                                       focus:border-[#6C63FF]
                                       focus:ring-[#6C63FF]
                                       text-gray-700
                                       py-3">

                                <option value="">
                                    Select account
                                </option>

                                @foreach($accounts as $account)
                                    <option value="{{ $account->id }}"
                                        {{ old('from_account_id') == $account->id ? 'selected' : '' }}>

                                        {{ $account->name }}
                                        — Rp {{ number_format($account->balance, 0, ',', '.') }}

                                    </option>
                                @endforeach

                            </select>

                            @error('from_account_id')
                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- To Account --}}
                        <div>
                            <label for="to_account_id"
                                class="block text-sm font-semibold text-gray-700 mb-2">
                                To Account
                            </label>

                            <select
                                id="to_account_id"
                                name="to_account_id"
                                required
                                class="w-full rounded-xl
                                       border-gray-200
                                       bg-gray-50
                                       focus:border-[#6C63FF]
                                       focus:ring-[#6C63FF]
                                       text-gray-700
                                       py-3">

                                <option value="">
                                    Select account
                                </option>

                                @foreach($accounts as $account)
                                    <option value="{{ $account->id }}"
                                        {{ old('to_account_id') == $account->id ? 'selected' : '' }}>

                                        {{ $account->name }}
                                        — Rp {{ number_format($account->balance, 0, ',', '.') }}

                                    </option>
                                @endforeach

                            </select>

                            @error('to_account_id')
                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Amount --}}
                        <div>
                            <label for="amount"
                                class="block text-sm font-semibold text-gray-700 mb-2">
                                Amount
                            </label>

                            <div class="relative">

                                <span class="absolute left-4 top-1/2
                                             -translate-y-1/2
                                             text-gray-500
                                             font-medium">
                                    Rp
                                </span>

                                <input
                                    id="amount"
                                    type="number"
                                    name="amount"
                                    value="{{ old('amount') }}"
                                    min="1"
                                    required
                                    placeholder="0"
                                    class="w-full rounded-xl
                                           border-gray-200
                                           bg-gray-50
                                           focus:border-[#6C63FF]
                                           focus:ring-[#6C63FF]
                                           text-gray-700
                                           py-3 pl-12">

                            </div>

                            @error('amount')
                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Admin Fee --}}
                        <div>
                            <label for="admin_fee"
                                class="block text-sm font-semibold text-gray-700 mb-2">
                                Admin Fee
                            </label>

                            <div class="relative">

                                <span class="absolute left-4 top-1/2
                                             -translate-y-1/2
                                             text-gray-500
                                             font-medium">
                                    Rp
                                </span>

                                <input
                                    id="admin_fee"
                                    type="number"
                                    name="admin_fee"
                                    value="{{ old('admin_fee', 0) }}"
                                    min="0"
                                    placeholder="0"
                                    class="w-full rounded-xl
                                           border-gray-200
                                           bg-gray-50
                                           focus:border-[#6C63FF]
                                           focus:ring-[#6C63FF]
                                           text-gray-700
                                           py-3 pl-12">

                            </div>

                            @error('admin_fee')
                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Date --}}
                        <div>
                            <label for="transaction_date"
                                class="block text-sm font-semibold text-gray-700 mb-2">
                                Date
                            </label>

                            <input
                                id="transaction_date"
                                type="date"
                                name="transaction_date"
                                value="{{ old('transaction_date', now()->format('Y-m-d')) }}"
                                required
                                class="w-full rounded-xl
                                       border-gray-200
                                       bg-gray-50
                                       focus:border-[#6C63FF]
                                       focus:ring-[#6C63FF]
                                       text-gray-700
                                       py-3">

                            @error('transaction_date')
                                <p class="mt-2 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Submit --}}
                        <button
                            type="submit"
                            class="w-full
                                   mt-2
                                   py-3.5
                                   rounded-xl
                                   bg-[#6C63FF]
                                   hover:bg-[#5A52E0]
                                   text-white
                                   font-semibold
                                   shadow-sm
                                   hover:shadow-md
                                   transition">

                            Add Transfer

                        </button>

                    </form>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>