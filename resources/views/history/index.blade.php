<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Transaction History
        </h2>
    </x-slot>

    @php
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

        $sortedTransactions = $transactions->sortByDesc('transaction_date');

        $groupedTransactions = $sortedTransactions->groupBy(function ($transaction) {
            return \Carbon\Carbon::parse($transaction->transaction_date)->format('Y-m-d');
        });

        $availableYears = $transactions
            ->map(function ($transaction) {
                return \Carbon\Carbon::parse($transaction->transaction_date)->format('Y');
            })
            ->unique()
            ->sortDesc()
            ->values();
    @endphp

    <div class="min-h-screen bg-[#F8FAFC] pb-24">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">

            {{-- PAGE HEADER --}}
            <div class="mb-6 sm:mb-8">
                <div class="flex items-center gap-3">

                    {{-- Page Icon --}}
                    <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl
                                bg-gradient-to-br from-[#457B9D] to-[#6C63FF]
                                flex items-center justify-center shadow-sm">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.7"
                             stroke="currentColor"
                             class="w-5 h-5 sm:w-6 sm:h-6 text-white">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 6v6l4 2" />

                            <circle cx="12"
                                    cy="12"
                                    r="8.25" />
                        </svg>
                    </div>

                    {{-- Title --}}
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-[#1D3557]">
                            Transaction History
                        </h1>

                        <p class="text-sm text-gray-500 mt-0.5">
                            View your income, expenses, and transfers.
                        </p>
                    </div>

                </div>
            </div>

            {{-- FILTER CARD --}}
            <div class="relative overflow-visible bg-white rounded-2xl
                        border border-gray-100 shadow-sm mb-7 z-30">

                {{-- Top Accent --}}
                <div class="h-1.5 bg-gradient-to-r from-[#457B9D]
                            to-[#6C63FF] rounded-t-2xl">
                </div>

                <div class="p-4 sm:p-5">

                    {{-- Filter Header --}}
                    <div class="flex items-center gap-2 mb-4">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.7"
                             stroke="currentColor"
                             class="w-5 h-5 text-[#457B9D]">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M3 4.5h18M6 9h12M10 13.5h4M11 18h2" />
                        </svg>

                        <h2 class="font-semibold text-gray-800">
                            Filter Transactions
                        </h2>
                    </div>

                    {{-- Filters --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        {{-- MONTH --}}
                        <div class="relative">
                            <label class="block text-sm font-semibold
                                          text-gray-700 mb-2">
                                Month
                            </label>

                            <button type="button"
                                    id="monthDropdownButton"
                                    class="w-full flex items-center justify-between
                                           rounded-xl border border-gray-200
                                           bg-white px-4 py-3
                                           text-sm font-medium text-gray-700
                                           shadow-sm transition-all
                                           hover:border-gray-300
                                           focus:outline-none
                                           focus:border-[#457B9D]
                                           focus:ring-2 focus:ring-[#457B9D]/20">

                                <span id="monthDropdownText">
                                    All Months
                                </span>

                                <svg id="monthDropdownArrow"
                                     xmlns="http://www.w3.org/2000/svg"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke-width="2"
                                     stroke="currentColor"
                                     class="w-4 h-4 text-gray-400
                                            transition-transform duration-200">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            {{-- Month Options --}}
                            <div id="monthDropdown"
                                 class="hidden absolute left-0 right-0 top-full mt-2
                                        bg-white border border-gray-100 rounded-xl
                                        shadow-lg overflow-hidden z-50">

                                <div data-value="all"
                                     data-label="All Months"
                                     class="month-option px-4 py-3
                                            text-sm font-medium text-gray-700
                                            cursor-pointer transition
                                            hover:bg-[#F0F7FA]
                                            hover:text-[#457B9D]">
                                    All Months
                                </div>

                                @foreach($monthNames as $number => $name)
                                    <div data-value="{{ $number }}"
                                         data-label="{{ $name }}"
                                         class="month-option px-4 py-3
                                                text-sm font-medium text-gray-700
                                                cursor-pointer transition
                                                hover:bg-[#F0F7FA]
                                                hover:text-[#457B9D]">
                                        {{ $name }}
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        {{-- YEAR --}}
                        <div class="relative">
                            <label class="block text-sm font-semibold
                                          text-gray-700 mb-2">
                                Year
                            </label>

                            <button type="button"
                                    id="yearDropdownButton"
                                    class="w-full flex items-center justify-between
                                           rounded-xl border border-gray-200
                                           bg-white px-4 py-3
                                           text-sm font-medium text-gray-700
                                           shadow-sm transition-all
                                           hover:border-gray-300
                                           focus:outline-none
                                           focus:border-[#457B9D]
                                           focus:ring-2 focus:ring-[#457B9D]/20">

                                <span id="yearDropdownText">
                                    All Years
                                </span>

                                <svg id="yearDropdownArrow"
                                     xmlns="http://www.w3.org/2000/svg"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke-width="2"
                                     stroke="currentColor"
                                     class="w-4 h-4 text-gray-400
                                            transition-transform duration-200">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            {{-- Year Options --}}
                            <div id="yearDropdown"
                                 class="hidden absolute left-0 right-0 top-full mt-2
                                        bg-white border border-gray-100 rounded-xl
                                        shadow-lg overflow-hidden z-50">

                                <div data-value="all"
                                     data-label="All Years"
                                     class="year-option px-4 py-3
                                            text-sm font-medium text-gray-700
                                            cursor-pointer transition
                                            hover:bg-[#F0F7FA]
                                            hover:text-[#457B9D]">
                                    All Years
                                </div>

                                @foreach($availableYears as $year)
                                    <div data-value="{{ $year }}"
                                         data-label="{{ $year }}"
                                         class="year-option px-4 py-3
                                                text-sm font-medium text-gray-700
                                                cursor-pointer transition
                                                hover:bg-[#F0F7FA]
                                                hover:text-[#457B9D]">
                                        {{ $year }}
                                    </div>
                                @endforeach

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- TRANSACTION LIST --}}
            @if($transactions->count() > 0)

                <div id="transactionList" class="space-y-7">

                    @foreach($groupedTransactions as $date => $dateTransactions)

                        @php
                            $dateObject = \Carbon\Carbon::parse($date);
                            $day = $dateObject->format('d');
                            $month = (int) $dateObject->format('m');
                            $year = $dateObject->format('Y');

                            $displayDate = $day . ' ' .
                                $monthNames[$month] . ' ' .
                                $year;
                        @endphp

                        {{-- DATE GROUP --}}
                        <div class="transaction-date-group"
                             data-month="{{ $month }}"
                             data-year="{{ $year }}">

                            {{-- DATE HEADER --}}
                            <div class="flex items-center gap-3 mb-3">
                                <div class="flex items-center gap-2 shrink-0">

                                    <div class="w-2 h-2 rounded-full bg-[#6C63FF]"></div>

                                    <h3 class="text-sm font-bold text-[#1D3557]">
                                        {{ $displayDate }}
                                    </h3>
                                </div>

                                <div class="h-px bg-gray-200 flex-1"></div>
                            </div>

                            {{-- TRANSACTIONS CARD --}}
                            <div class="bg-white rounded-2xl border border-gray-100
                                        shadow-sm overflow-hidden">

                                @foreach($dateTransactions as $index => $transaction)

                                    @php
                                        $isLast = $index === $dateTransactions->count() - 1;
                                    @endphp

                                    <div class="transaction-item relative px-4 sm:px-5 py-4
                                                transition hover:bg-gray-50/70"
                                         data-month="{{ $month }}"
                                         data-year="{{ $year }}">

                                        <div class="flex items-start gap-3">

                                            {{-- TIMELINE --}}
                                            <div class="relative flex flex-col items-center
                                                        pt-1 shrink-0">

                                                {{-- Timeline Dot --}}
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

                                                {{-- Timeline Line --}}
                                                @if(!$isLast)
                                                    <div class="absolute top-4 bottom-[-16px]
                                                                w-px bg-gray-200">
                                                    </div>
                                                @endif

                                            </div>

                                            {{-- CONTENT --}}
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-start
                                                            justify-between gap-3">

                                                    {{-- LEFT --}}
                                                    <div class="min-w-0">

                                                        @if($transaction->type == 'transfer')

                                                            {{-- Transfer --}}
                                                            <div class="flex items-center gap-2">
                                                                <span class="inline-flex items-center
                                                                             rounded-full bg-[#F0EFFF]
                                                                             px-2.5 py-1 text-[11px]
                                                                             font-semibold text-[#6C63FF]">
                                                                    Transfer
                                                                </span>
                                                            </div>

                                                            <h4 class="font-semibold text-gray-800
                                                                       text-sm sm:text-base mt-2">

                                                                {{ $transaction->fromAccount?->name ?? '-' }}

                                                                <span class="mx-1 text-gray-400">
                                                                    →
                                                                </span>

                                                                {{ $transaction->toAccount?->name ?? '-' }}
                                                            </h4>

                                                        @else

                                                            {{-- Type Badge --}}
                                                            @if($transaction->type == 'income')

                                                                <span class="inline-flex items-center
                                                                             rounded-full bg-green-50
                                                                             px-2.5 py-1 text-[11px]
                                                                             font-semibold text-green-600">
                                                                    Income
                                                                </span>

                                                            @else

                                                                <span class="inline-flex items-center
                                                                             rounded-full bg-red-50
                                                                             px-2.5 py-1 text-[11px]
                                                                             font-semibold text-red-500">
                                                                    Expense
                                                                </span>

                                                            @endif

                                                            {{-- Category --}}
                                                            <h4 class="font-semibold text-gray-800
                                                                       text-sm sm:text-base mt-2">
                                                                {{ $transaction->category?->name ?? ucfirst($transaction->type) }}
                                                            </h4>

                                                            {{-- Description --}}
                                                            @if($transaction->description)
                                                                <p class="text-xs sm:text-sm text-gray-500
                                                                          mt-1 leading-relaxed">
                                                                    {{ $transaction->description }}
                                                                </p>
                                                            @endif

                                                            {{-- Account --}}
                                                            <p class="text-xs text-gray-400 mt-1.5">
                                                                {{ $transaction->account?->name ?? '-' }}
                                                            </p>

                                                        @endif

                                                    </div>

                                                    {{-- AMOUNT --}}
                                                    <div class="text-right shrink-0">

                                                        @if($transaction->type == 'income')

                                                            <p class="font-bold text-sm sm:text-base
                                                                      text-green-600 whitespace-nowrap">
                                                                + Rp
                                                                {{ number_format($transaction->amount, 0, ',', '.') }}
                                                            </p>

                                                        @elseif($transaction->type == 'expense')

                                                            <p class="font-bold text-sm sm:text-base
                                                                      text-red-500 whitespace-nowrap">
                                                                - Rp
                                                                {{ number_format($transaction->amount, 0, ',', '.') }}
                                                            </p>

                                                        @else

                                                            <p class="font-bold text-sm sm:text-base
                                                                      text-[#6C63FF] whitespace-nowrap">
                                                                Rp
                                                                {{ number_format($transaction->amount, 0, ',', '.') }}
                                                            </p>

                                                            @if($transaction->admin_fee > 0)
                                                                <p class="text-[11px] text-red-500 mt-1
                                                                          whitespace-nowrap">
                                                                    Admin Fee -Rp
                                                                    {{ number_format($transaction->admin_fee, 0, ',', '.') }}
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

                {{-- NO FILTER RESULT --}}
                <div id="noFilterResult"
                     class="hidden bg-white rounded-2xl border border-gray-100
                            shadow-sm text-center py-14 px-5">

                    <div class="w-14 h-14 mx-auto rounded-2xl bg-[#F0EFFF]
                                flex items-center justify-center mb-4">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.7"
                             stroke="currentColor"
                             class="w-7 h-7 text-[#6C63FF]">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 14.25 12 17.25l6.75-6.75" />

                            <path stroke-linecap="round"
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

                {{-- EMPTY STATE --}}
                <div class="bg-white rounded-2xl border border-gray-100
                            shadow-sm overflow-hidden">

                    <div class="h-1.5 bg-gradient-to-r
                                from-[#457B9D] to-[#6C63FF]">
                    </div>

                    <div class="text-center py-16 px-5">

                        <div class="w-16 h-16 mx-auto rounded-2xl
                                    bg-[#F0EFFF] text-[#6C63FF]
                                    flex items-center justify-center mb-5">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.7"
                                 stroke="currentColor"
                                 class="w-8 h-8">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M12 6v12m6-6H6" />

                                <circle cx="12"
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

            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
                <div class="mt-5 rounded-xl border border-green-100
                            bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

        </div>
    </div>

    {{-- FILTER SCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /* ELEMENTS */
            const monthButton = document.getElementById('monthDropdownButton');
            const monthDropdown = document.getElementById('monthDropdown');
            const monthText = document.getElementById('monthDropdownText');
            const monthArrow = document.getElementById('monthDropdownArrow');

            const yearButton = document.getElementById('yearDropdownButton');
            const yearDropdown = document.getElementById('yearDropdown');
            const yearText = document.getElementById('yearDropdownText');
            const yearArrow = document.getElementById('yearDropdownArrow');

            const dateGroups = document.querySelectorAll(
                '.transaction-date-group'
            );

            const noFilterResult =
                document.getElementById('noFilterResult');

            /* CURRENT FILTER VALUES */
            let selectedMonth = 'all';
            let selectedYear = 'all';

            /* DROPDOWN FUNCTIONS */
            function openDropdown(dropdown, arrow) {
                dropdown.classList.remove('hidden');
                arrow.classList.add('rotate-180');
            }

            function closeDropdown(dropdown, arrow) {
                dropdown.classList.add('hidden');
                arrow.classList.remove('rotate-180');
            }

            function toggleDropdown(dropdown, arrow) {
                if (dropdown.classList.contains('hidden')) {
                    openDropdown(dropdown, arrow);
                } else {
                    closeDropdown(dropdown, arrow);
                }
            }

            /* MONTH BUTTON */
            monthButton.addEventListener('click', function (event) {
                event.stopPropagation();

                closeDropdown(yearDropdown, yearArrow);
                toggleDropdown(monthDropdown, monthArrow);
            });

            /* YEAR BUTTON */
            yearButton.addEventListener('click', function (event) {
                event.stopPropagation();

                closeDropdown(monthDropdown, monthArrow);
                toggleDropdown(yearDropdown, yearArrow);
            });

            /* MONTH OPTIONS */
            document.querySelectorAll('.month-option').forEach(function (option) {

                option.addEventListener('click', function () {
                    selectedMonth = this.dataset.value;
                    monthText.textContent = this.dataset.label;

                    document.querySelectorAll('.month-option')
                        .forEach(function (item) {
                            item.classList.remove(
                                'bg-[#F0F7FA]',
                                'text-[#457B9D]',
                                'font-semibold'
                            );
                        });

                    this.classList.add(
                        'bg-[#F0F7FA]',
                        'text-[#457B9D]',
                        'font-semibold'
                    );

                    closeDropdown(monthDropdown, monthArrow);
                    filterTransactions();
                });

            });

            /* YEAR OPTIONS */
            document.querySelectorAll('.year-option').forEach(function (option) {

                option.addEventListener('click', function () {
                    selectedYear = this.dataset.value;
                    yearText.textContent = this.dataset.label;

                    document.querySelectorAll('.year-option')
                        .forEach(function (item) {
                            item.classList.remove(
                                'bg-[#F0F7FA]',
                                'text-[#457B9D]',
                                'font-semibold'
                            );
                        });

                    this.classList.add(
                        'bg-[#F0F7FA]',
                        'text-[#457B9D]',
                        'font-semibold'
                    );

                    closeDropdown(yearDropdown, yearArrow);
                    filterTransactions();
                });

            });

            /* FILTER TRANSACTIONS */
            function filterTransactions() {
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

                if (visibleGroups === 0) {
                    noFilterResult?.classList.remove('hidden');
                } else {
                    noFilterResult?.classList.add('hidden');
                }
            }

            /* CLOSE WHEN CLICKING OUTSIDE */
            document.addEventListener('click', function () {
                closeDropdown(monthDropdown, monthArrow);
                closeDropdown(yearDropdown, yearArrow);
            });

            /* PREVENT DROPDOWN FROM CLOSING */
            monthDropdown.addEventListener('click', function (event) {
                event.stopPropagation();
            });

            yearDropdown.addEventListener('click', function (event) {
                event.stopPropagation();
            });

        });
    </script>

</x-app-layout>