<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Transactions
        </h2>
    </x-slot>

    <div class="py-5 sm:py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Heading --}}
            <div class="text-center mb-6 sm:mb-10">

                <div class="inline-flex items-center justify-center
                            w-12 h-12 sm:w-14 sm:h-14
                            rounded-2xl
                            bg-gradient-to-br from-[#457B9D] to-[#6C63FF]
                            text-white mb-3 sm:mb-4">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="w-6 h-6 sm:w-7 sm:h-7">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M7 7h10M7 12h10M7 17h6" />

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 4h16v16H4z" />

                    </svg>

                </div>

                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
                    Add Transaction
                </h1>

                <p class="text-gray-500 mt-1.5 sm:mt-2 text-sm sm:text-base">
                    Choose the type of transaction you want to record.
                </p>

            </div>


            {{-- Transaction Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 sm:gap-5 lg:gap-6">

                {{-- ================= INCOME ================= --}}
                <a href="{{ route('transactions.create.income') }}"
                   class="group">

                    <div class="h-full bg-white
                                border border-green-100
                                rounded-2xl
                                p-4 sm:p-6 lg:p-7
                                shadow-sm
                                transition-all duration-300
                                hover:-translate-y-1
                                hover:shadow-lg
                                hover:border-green-200">

                        <div class="flex items-center gap-4 md:block">

                            {{-- Icon --}}
                            <div class="w-12 h-12 md:w-14 md:h-14
                                        shrink-0
                                        rounded-2xl
                                        bg-green-50
                                        text-green-600
                                        flex items-center justify-center
                                        md:mb-5
                                        transition
                                        group-hover:bg-green-100">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="w-6 h-6 md:w-7 md:h-7">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 6v12m6-6H6" />

                                    <circle cx="12"
                                        cy="12"
                                        r="9" />

                                </svg>

                            </div>


                            {{-- Content --}}
                            <div class="flex-1 min-w-0">

                                <div class="flex items-center justify-between md:block">

                                    <h2 class="text-lg md:text-xl font-bold text-gray-800">
                                        Income
                                    </h2>

                                    {{-- Arrow mobile --}}
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        class="w-5 h-5 text-green-600 md:hidden
                                               transition-transform
                                               group-hover:translate-x-1">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />

                                    </svg>

                                </div>

                                <p class="text-sm text-gray-500
                                          mt-1 md:mt-2
                                          leading-relaxed">
                                    Record money coming in such as allowance,
                                    salary, or other income.
                                </p>

                                {{-- Desktop action --}}
                                <div class="hidden md:flex items-center gap-2
                                            mt-6
                                            text-sm font-semibold
                                            text-green-600">

                                    <span>Add Income</span>

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        class="w-4 h-4 transition-transform
                                               group-hover:translate-x-1">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />

                                    </svg>

                                </div>

                            </div>

                        </div>

                    </div>

                </a>


                {{-- ================= EXPENSE ================= --}}
                <a href="{{ route('transactions.create.expense') }}"
                   class="group">

                    <div class="h-full bg-white
                                border border-red-100
                                rounded-2xl
                                p-4 sm:p-6 lg:p-7
                                shadow-sm
                                transition-all duration-300
                                hover:-translate-y-1
                                hover:shadow-lg
                                hover:border-red-200">

                        <div class="flex items-center gap-4 md:block">

                            {{-- Icon --}}
                            <div class="w-12 h-12 md:w-14 md:h-14
                                        shrink-0
                                        rounded-2xl
                                        bg-red-50
                                        text-red-500
                                        flex items-center justify-center
                                        md:mb-5
                                        transition
                                        group-hover:bg-red-100">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="w-6 h-6 md:w-7 md:h-7">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 18V6m-6 6h12" />

                                    <circle cx="12"
                                        cy="12"
                                        r="9" />

                                </svg>

                            </div>


                            {{-- Content --}}
                            <div class="flex-1 min-w-0">

                                <div class="flex items-center justify-between md:block">

                                    <h2 class="text-lg md:text-xl font-bold text-gray-800">
                                        Expense
                                    </h2>

                                    {{-- Arrow mobile --}}
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        class="w-5 h-5 text-red-500 md:hidden
                                               transition-transform
                                               group-hover:translate-x-1">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />

                                    </svg>

                                </div>

                                <p class="text-sm text-gray-500
                                          mt-1 md:mt-2
                                          leading-relaxed">
                                    Record your daily spending such as food,
                                    transport, or shopping.
                                </p>

                                {{-- Desktop action --}}
                                <div class="hidden md:flex items-center gap-2
                                            mt-6
                                            text-sm font-semibold
                                            text-red-500">

                                    <span>Add Expense</span>

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        class="w-4 h-4 transition-transform
                                               group-hover:translate-x-1">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />

                                    </svg>

                                </div>

                            </div>

                        </div>

                    </div>

                </a>


                {{-- ================= TRANSFER ================= --}}
                <a href="{{ route('transactions.create.transfer') }}"
                   class="group">

                    <div class="h-full bg-white
                                border border-[#DCD9FF]
                                rounded-2xl
                                p-4 sm:p-6 lg:p-7
                                shadow-sm
                                transition-all duration-300
                                hover:-translate-y-1
                                hover:shadow-lg
                                hover:border-[#BDB8FF]">

                        <div class="flex items-center gap-4 md:block">

                            {{-- Icon --}}
                            <div class="w-12 h-12 md:w-14 md:h-14
                                        shrink-0
                                        rounded-2xl
                                        bg-[#F0EFFF]
                                        text-[#6C63FF]
                                        flex items-center justify-center
                                        md:mb-5
                                        transition
                                        group-hover:bg-[#E5E3FF]">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="w-6 h-6 md:w-7 md:h-7">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M7 7h11l-3-3m3 3l-3 3" />

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M17 17H6l3 3m-3-3l3-3" />

                                </svg>

                            </div>


                            {{-- Content --}}
                            <div class="flex-1 min-w-0">

                                <div class="flex items-center justify-between md:block">

                                    <h2 class="text-lg md:text-xl font-bold text-gray-800">
                                        Transfer
                                    </h2>

                                    {{-- Arrow mobile --}}
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        class="w-5 h-5 text-[#6C63FF] md:hidden
                                               transition-transform
                                               group-hover:translate-x-1">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />

                                    </svg>

                                </div>

                                <p class="text-sm text-gray-500
                                          mt-1 md:mt-2
                                          leading-relaxed">
                                    Move money between your accounts
                                    easily and securely.
                                </p>

                                {{-- Desktop action --}}
                                <div class="hidden md:flex items-center gap-2
                                            mt-6
                                            text-sm font-semibold
                                            text-[#6C63FF]">

                                    <span>Make Transfer</span>

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        class="w-4 h-4 transition-transform
                                               group-hover:translate-x-1">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />

                                    </svg>

                                </div>

                            </div>

                        </div>

                    </div>

                </a>

            </div>

        </div>
    </div>

</x-app-layout>