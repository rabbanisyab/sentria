<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Transactions History
        </h2>
    </x-slot>

    @php
        /*
        |--------------------------------------------------------------------------
        | Prepare transaction data
        |--------------------------------------------------------------------------
        */

        $monthNames = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        // Sort transaction by date
        $sortedTransactions = $transactions->sortByDesc('transaction_date');

        // Group transaction by date
        $groupedTransactions = $sortedTransactions->groupBy(function ($transaction) {
            return \Carbon\Carbon::parse($transaction->transaction_date)->format('Y-m-d');
        });

        // Get available years from transaction data
        $availableYears = $transactions
            ->map(function ($transaction) {
                return \Carbon\Carbon::parse($transaction->transaction_date)->format('Y');
            })
            ->unique()
            ->sort()
            ->values();
    @endphp


    <div class="min-h-screen bg-gray-50 pb-8">

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-5 sm:py-8">

            {{-- ========================================================= --}}
            {{-- PAGE TITLE --}}
            {{-- ========================================================= --}}

            <div class="mb-5 sm:mb-7">

                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
                    Transaction History
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    View your income, expenses, and transfers.
                </p>

            </div>


            {{-- ========================================================= --}}
            {{-- FILTER --}}
            {{-- ========================================================= --}}

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-5 mb-6">

                <div class="grid grid-cols-2 gap-3">

                    {{-- MONTH --}}
                    <div>

                        <label
                            for="monthFilter"
                            class="block text-xs font-medium text-gray-500 mb-1.5">
                            Bulan
                        </label>

                        <div class="relative">

                            <select
                                id="monthFilter"
                                class="w-full appearance-none rounded-xl
                                       border border-gray-200
                                       bg-gray-50
                                       px-4 py-3 pr-10
                                       text-sm font-medium text-gray-700
                                       focus:border-[#457B9D]
                                       focus:ring-2 focus:ring-[#457B9D]/20
                                       focus:outline-none
                                       transition">

                                <option value="all">
                                    Semua Bulan
                                </option>

                                @foreach($monthNames as $number => $name)
                                    <option value="{{ $number }}">
                                        {{ $name }}
                                    </option>
                                @endforeach

                            </select>

                            {{-- Dropdown icon --}}
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="w-4 h-4 text-gray-400">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m19 9-7 7-7-7" />

                                </svg>
                            </div>

                        </div>

                    </div>


                    {{-- YEAR --}}
                    <div>

                        <label
                            for="yearFilter"
                            class="block text-xs font-medium text-gray-500 mb-1.5">
                            Tahun
                        </label>

                        <div class="relative">

                            <select
                                id="yearFilter"
                                class="w-full appearance-none rounded-xl
                                       border border-gray-200
                                       bg-gray-50
                                       px-4 py-3 pr-10
                                       text-sm font-medium text-gray-700
                                       focus:border-[#457B9D]
                                       focus:ring-2 focus:ring-[#457B9D]/20
                                       focus:outline-none
                                       transition">

                                <option value="all">
                                    Semua Tahun
                                </option>

                                @foreach($availableYears as $year)
                                    <option value="{{ $year }}">
                                        {{ $year }}
                                    </option>
                                @endforeach

                            </select>

                            {{-- Dropdown icon --}}
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="w-4 h-4 text-gray-400">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m19 9-7 7-7-7" />

                                </svg>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- TRANSACTION LIST --}}
            {{-- ========================================================= --}}

            @if($transactions->count() > 0)

                <div id="transactionList" class="space-y-7">

                    @foreach($groupedTransactions as $date => $dateTransactions)

                        @php
                            $dateObject = \Carbon\Carbon::parse($date);
                            $day = $dateObject->format('d');
                            $month = (int) $dateObject->format('m');
                            $year = $dateObject->format('Y');

                            $displayDate =
                                $day . ' ' .
                                $monthNames[$month] . ' ' .
                                $year;
                        @endphp


                        {{-- DATE GROUP --}}
                        <div
                            class="transaction-date-group"
                            data-month="{{ $month }}"
                            data-year="{{ $year }}">

                            {{-- DATE --}}
                            <div class="flex items-center gap-3 mb-3">

                                <h3 class="text-sm font-bold text-gray-700 whitespace-nowrap">
                                    {{ $displayDate }}
                                </h3>

                                <div class="h-px bg-gray-200 flex-1"></div>

                            </div>


                            {{-- TRANSACTIONS --}}
                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

                                @foreach($dateTransactions as $index => $transaction)

                                    @php
                                        $isLast = $index === $dateTransactions->count() - 1;
                                    @endphp

                                    <div class="transaction-item relative px-4 sm:px-5 py-4"
                                         data-month="{{ $month }}"
                                         data-year="{{ $year }}">

                                        <div class="flex items-start gap-3">

                                            {{-- TIMELINE --}}
                                            <div class="relative flex flex-col items-center pt-1">

                                                {{-- Circle --}}
                                                @if($transaction->type == 'income')

                                                    <div class="w-3.5 h-3.5 rounded-full
                                                                border-[3px] border-green-500
                                                                bg-white z-10">
                                                    </div>

                                                @elseif($transaction->type == 'expense')

                                                    <div class="w-3.5 h-3.5 rounded-full
                                                                border-[3px] border-red-500
                                                                bg-white z-10">
                                                    </div>

                                                @else

                                                    <div class="w-3.5 h-3.5 rounded-full
                                                                border-[3px] border-[#6C63FF]
                                                                bg-white z-10">
                                                    </div>

                                                @endif


                                                {{-- Vertical line --}}
                                                @if(!$isLast)

                                                    <div class="absolute top-4
                                                                w-px h-full
                                                                bg-gray-200">
                                                    </div>

                                                @endif

                                            </div>


                                            {{-- TRANSACTION CONTENT --}}
                                            <div class="flex-1 min-w-0">

                                                <div class="flex items-start justify-between gap-3">

                                                    {{-- LEFT --}}
                                                    <div class="min-w-0">

                                                        @if($transaction->type == 'transfer')

                                                            {{-- Transfer title --}}
                                                            <h4 class="font-semibold text-gray-800 text-sm sm:text-base">
                                                                Transfer
                                                            </h4>

                                                            {{-- Account --}}
                                                            <p class="text-xs sm:text-sm text-gray-500 mt-1">

                                                                {{ $transaction->fromAccount?->name ?? '-' }}

                                                                <span class="mx-1 text-gray-400">
                                                                    →
                                                                </span>

                                                                {{ $transaction->toAccount?->name ?? '-' }}

                                                            </p>

                                                        @else

                                                            {{-- Category --}}
                                                            <h4 class="font-semibold text-gray-800 text-sm sm:text-base">

                                                                {{ $transaction->category?->name ?? ucfirst($transaction->type) }}

                                                            </h4>


                                                            {{-- Description --}}
                                                            @if($transaction->description)

                                                                <p class="text-xs sm:text-sm text-gray-600 mt-1 leading-relaxed">
                                                                    {{ $transaction->description }}
                                                                </p>

                                                            @endif


                                                            {{-- Account --}}
                                                            <p class="text-xs text-gray-400 mt-1.5">

                                                                {{ $transaction->account?->name ?? '-' }}

                                                            </p>

                                                        @endif

                                                    </div>


                                                    {{-- RIGHT : AMOUNT --}}
                                                    <div class="text-right shrink-0">

                                                        @if($transaction->type == 'income')

                                                            <p class="font-bold text-sm sm:text-base text-green-600 whitespace-nowrap">

                                                                + Rp {{ number_format($transaction->amount, 0, ',', '.') }}

                                                            </p>

                                                        @elseif($transaction->type == 'expense')

                                                            <p class="font-bold text-sm sm:text-base text-red-500 whitespace-nowrap">

                                                                - Rp {{ number_format($transaction->amount, 0, ',', '.') }}

                                                            </p>

                                                        @else

                                                            <p class="font-bold text-sm sm:text-base text-[#6C63FF] whitespace-nowrap">

                                                                Rp {{ number_format($transaction->amount, 0, ',', '.') }}

                                                            </p>


                                                            {{-- Admin Fee --}}
                                                            @if($transaction->admin_fee > 0)

                                                                <p class="text-xs text-red-500 mt-1 whitespace-nowrap">

                                                                    Admin Fee
                                                                    -Rp {{ number_format($transaction->admin_fee, 0, ',', '.') }}

                                                                </p>

                                                            @endif

                                                        @endif

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    @endforeach

                </div>


                {{-- ===================================================== --}}
                {{-- NO FILTER RESULT --}}
                {{-- ===================================================== --}}

                <div
                    id="noFilterResult"
                    class="hidden bg-white rounded-2xl border border-gray-100 shadow-sm text-center py-12 px-5">

                    <div class="w-14 h-14 mx-auto rounded-2xl bg-gray-100
                                flex items-center justify-center mb-4">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.7"
                            stroke="currentColor"
                            class="w-7 h-7 text-gray-400">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 14.25 12 17.25l6.75-6.75" />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h3M3.75 17.25h3" />

                        </svg>

                    </div>

                    <h4 class="font-semibold text-gray-800">
                        No transactions found
                    </h4>

                    <p class="text-sm text-gray-500 mt-1">
                        There are no transactions for the selected period.
                    </p>

                </div>

            @else

                {{-- ===================================================== --}}
                {{-- EMPTY STATE --}}
                {{-- ===================================================== --}}

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">

                    <div class="text-center py-14 sm:py-16 px-5">

                        <div class="w-16 h-16 mx-auto rounded-2xl
                                    bg-[#F0EFFF]
                                    text-[#6C63FF]
                                    flex items-center justify-center mb-5">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.7"
                                stroke="currentColor"
                                class="w-8 h-8">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 6v12m6-6H6" />

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9" />

                            </svg>

                        </div>

                        <h4 class="text-lg font-semibold text-gray-800">
                            No transactions yet
                        </h4>

                        <p class="text-sm text-gray-500 mt-2 max-w-sm mx-auto">
                            Start recording your income, expenses, and transfers.
                        </p>

                    </div>

                </div>

            @endif


            {{-- ========================================================= --}}
            {{-- SUCCESS MESSAGE --}}
            {{-- ========================================================= --}}

            @if(session('success'))

                <div class="mt-5 rounded-xl
                            border border-green-100
                            bg-green-50
                            px-4 py-3
                            text-sm text-green-700">

                    {{ session('success') }}

                </div>

            @endif

        </div>

    </div>


    {{-- ================================================================ --}}
    {{-- FILTER SCRIPT --}}
    {{-- ================================================================ --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const monthFilter = document.getElementById('monthFilter');
            const yearFilter = document.getElementById('yearFilter');

            const dateGroups = document.querySelectorAll('.transaction-date-group');
            const noFilterResult = document.getElementById('noFilterResult');

            if (!monthFilter || !yearFilter) {
                return;
            }


            function filterTransactions() {

                const selectedMonth = monthFilter.value;
                const selectedYear = yearFilter.value;

                let visibleGroups = 0;


                dateGroups.forEach(function (group) {

                    const groupMonth = group.dataset.month;
                    const groupYear = group.dataset.year;


                    const monthMatches =
                        selectedMonth === 'all' ||
                        selectedMonth === groupMonth;


                    const yearMatches =
                        selectedYear === 'all' ||
                        selectedYear === groupYear;


                    if (monthMatches && yearMatches) {

                        group.classList.remove('hidden');

                        visibleGroups++;

                    } else {

                        group.classList.add('hidden');

                    }

                });


                // Show empty state if there are no results
                if (visibleGroups === 0) {

                    noFilterResult.classList.remove('hidden');

                } else {

                    noFilterResult.classList.add('hidden');

                }

            }


            monthFilter.addEventListener('change', filterTransactions);
            yearFilter.addEventListener('change', filterTransactions);

        });

    </script>

</x-app-layout>