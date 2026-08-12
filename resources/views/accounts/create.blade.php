<x-app-layout>

    <div class="min-h-screen bg-[#F5F8FC] py-5 sm:py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- PAGE HEADER --}}
            <div class="mb-6 sm:mb-8">
                <div class="flex items-center gap-3">

                    {{-- Icon --}}
                    <div class="w-11 h-11 sm:w-12 sm:h-12 shrink-0 rounded-2xl
                                bg-gradient-to-br from-[#457B9D] to-[#6C63FF]
                                flex items-center justify-center shadow-sm">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.7" stroke="currentColor" class="w-5 h-5 sm:w-6 sm:h-6 text-white">

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 7.5A2.5 2.5 0 015.5 5h13A2.5 2.5 0 0121 7.5v9a2.5 2.5 0 01-2.5 2.5h-13A2.5 2.5 0 013 16.5v-9Z" />

                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 9h18" />

                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 13v4m-2-2h4" />
                        </svg>
                    </div>

                    {{-- Title --}}
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-[#1D3557] leading-tight">
                            Add Account
                        </h1>

                        <p class="text-sm text-gray-500 mt-0.5">
                            Add an account to start tracking your money.
                        </p>
                    </div>

                </div>
            </div>

            {{-- FORM CARD --}}
            <div class="relative bg-white rounded-2xl shadow-sm border border-gray-100overflow-hidden">

                {{-- Accent Line --}}
                <div class="h-1.5 bg-[#457B9D]"></div>

                <div class="p-5 sm:p-7">
                    <form action="{{ route('accounts.store') }}" method="POST">
                        @csrf

                        {{-- ACCOUNT NAME --}}
                        <div class="mb-5">

                            <label for="name" class="block text-sm font-semibold text-[#1D3557] mb-2">
                                Account Name
                            </label>

                            <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="e.g. BCA, GoPay, Cash"
                                class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3
                                       text-sm text-gray-800 placeholder:text-gray-400 focus:border-[#457B9D]
                                       focus:ring-2 focus:ring-[#457B9D]/20 focus:outline-none transition">

                            @error('name')
                                <p class="text-red-500 text-xs mt-1.5">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- ACCOUNT TYPE --}}
                        <div class="mb-5">

                            <label for="type" class="block text-sm font-semibold text-[#1D3557] mb-2">
                                Account Type
                            </label>

                            <div class="relative">
                                <select id="type" name="type"
                                    class="w-full appearance-none rounded-xl border border-gray-200 bg-gray-50
                                           px-4 py-3 pr-10 text-sm text-gray-800 focus:border-[#457B9D]
                                           focus:ring-2 focus:ring-[#457B9D]/20 focus:outline-none transition">

                                    <option value="bank"
                                        {{ old('type') == 'bank' ? 'selected' : '' }}>
                                        Bank
                                    </option>

                                    <option value="ewallet"
                                        {{ old('type') == 'ewallet' ? 'selected' : '' }}>
                                        E-Wallet
                                    </option>

                                    <option value="cash"
                                        {{ old('type') == 'cash' ? 'selected' : '' }}>
                                        Cash
                                    </option>

                                    <option value="electronic_card"
                                        {{ old('type') == 'electronic_card' ? 'selected' : '' }}>
                                        Electronic Card
                                    </option>

                                </select>


                                {{-- Dropdown Icon --}}
                                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-4 h-4 text-gray-400">

                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7" />
                                    </svg>
                                </div>

                            </div>

                            @error('type')
                                <p class="text-red-500 text-xs mt-1.5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- BALANCE --}}
                        <div class="mb-7">
                            <label for="balance" class="block text-sm font-semibold text-[#1D3557] mb-2">
                                Initial Balance
                            </label>

                            <div class="relative">

                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-semibold text-gray-400">
                                    Rp
                                </span>

                                <input id="balance" type="number" name="balance" value="{{ old('balance', 0) }}"
                                    min="0" placeholder="0"
                                    class="w-full rounded-xl border border-gray-200 bg-gray-50 pl-11 pr-4 py-3
                                           text-sm text-gray-800 placeholder:text-gray-400 focus:border-[#457B9D]
                                           focus:ring-2 focus:ring-[#457B9D]/20 focus:outline-none transition">
                            </div>

                            @error('balance')
                                <p class="text-red-500 text-xs mt-1.5">
                                    {{ $message }}
                                </p>
                            @enderror

                            <p class="text-xs text-gray-400 mt-1.5">
                                Enter the current balance of this account.
                            </p>

                        </div>

                        {{-- BUTTONS --}}

                        <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3">

                            {{-- Cancel --}}
                            <a href="{{ route('accounts.index') }}"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-3
                                       rounded-xl border border-gray-200 bg-white text-sm font-semibold
                                       text-gray-600 hover:bg-gray-50 transition">
                                Cancel
                            </a>

                            {{-- Save --}}
                            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center
                                                        gap-2 px-5 py-3 rounded-xl bg-gradient-to-r from-[#457B9D]
                                                        to-[#6C63FF] text-white text-sm font-semibold
                                                        shadow-sm hover:opacity-9 transition">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-4 h-4">

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12.75 9.25 17 19 7.25" />
                                </svg>
                                Save Account
                            </button>

                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>