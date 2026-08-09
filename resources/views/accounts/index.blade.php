<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Accounts
        </h2>
    </x-slot>

<div class="py-5 sm:py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ========================================================= --}}
        {{-- SUCCESS MESSAGE --}}
        {{-- ========================================================= --}}

        @if(session('success'))
            <div class="mb-5 rounded-xl
                        bg-green-50
                        border border-green-100
                        px-4 py-3
                        text-sm text-green-700">

                {{ session('success') }}

            </div>
        @endif


        {{-- ========================================================= --}}
        {{-- PAGE HEADER --}}
        {{-- ========================================================= --}}

        <div class="flex items-center justify-between gap-4 mb-6">

            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
                    My Accounts
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Manage your bank, e-wallet, cash, and cards.
                </p>
            </div>


            {{-- Add Account --}}
            <a
                href="{{ route('accounts.create') }}"
                class="shrink-0
                       inline-flex items-center justify-center
                       px-4 py-2.5
                       rounded-xl
                       bg-[#457B9D]
                       text-white
                       text-sm font-semibold
                       shadow-sm
                       hover:bg-[#386B89]
                       transition">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    class="w-4 h-4 mr-1.5">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 6v12m6-6H6" />

                </svg>

                <span>
                    Add
                </span>

            </a>

        </div>


        {{-- ========================================================= --}}
        {{-- ACCOUNT LIST --}}
        {{-- ========================================================= --}}

        @if ($accounts->isEmpty())

            {{-- Empty State --}}
            <div class="bg-white
                        rounded-2xl
                        border border-gray-100
                        shadow-sm
                        text-center
                        px-5
                        py-14">

                <div class="w-16 h-16 mx-auto
                            rounded-2xl
                            bg-[#F0EFFF]
                            text-[#6C63FF]
                            flex items-center justify-center
                            mb-5">

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
                            d="M2.25 8.25h19.5M3.75 5.25h16.5a1.5 1.5 0 0 1 1.5 1.5v10.5a1.5 1.5 0 0 1-1.5 1.5H3.75a1.5 1.5 0 0 1-1.5-1.5V6.75a1.5 1.5 0 0 1 1.5-1.5Z" />

                    </svg>

                </div>

                <h3 class="text-lg font-semibold text-gray-800">
                    No accounts yet
                </h3>

                <p class="text-sm text-gray-500 mt-1 mb-5">
                    Add your first account to start managing your money.
                </p>

                <a
                    href="{{ route('accounts.create') }}"
                    class="inline-flex items-center
                           px-5 py-2.5
                           rounded-xl
                           bg-[#457B9D]
                           text-white
                           text-sm font-semibold
                           hover:bg-[#386B89]
                           transition">

                    + Add Account

                </a>

            </div>

        @else

            @php

                /*
                |--------------------------------------------------------------------------
                | GROUP ACCOUNT BERDASARKAN KATEGORI
                |--------------------------------------------------------------------------
                */

                $groupedAccounts = [
                    'Bank' => collect(),
                    'E-Wallet' => collect(),
                    'Electronic Card' => collect(),
                    'Cash' => collect(),
                ];

                foreach ($accounts as $account) {

                    $type = strtolower(trim($account->type));

                    if (str_contains($type, 'bank')) {

                        $groupedAccounts['Bank']->push($account);

                    } elseif (
                        str_contains($type, 'wallet') ||
                        str_contains($type, 'ewallet') ||
                        str_contains($type, 'e-wallet')
                    ) {

                        $groupedAccounts['E-Wallet']->push($account);

                    } elseif (
                        str_contains($type, 'card') ||
                        str_contains($type, 'e-money') ||
                        str_contains($type, 'emoney')
                    ) {

                        $groupedAccounts['Electronic Card']->push($account);

                    } elseif (str_contains($type, 'cash')) {

                        $groupedAccounts['Cash']->push($account);
                    }
                }

            @endphp


            {{-- ========================================================= --}}
            {{-- CATEGORY LIST --}}
            {{-- ========================================================= --}}

            <div class="space-y-5">

                @foreach($groupedAccounts as $category => $categoryAccounts)

                    {{-- Jangan tampilkan kategori kosong --}}
                    @if($categoryAccounts->isEmpty())
                        @continue
                    @endif


                    @php

                        /*
                        |--------------------------------------------------------------------------
                        | CATEGORY ICON & COLOR
                        |--------------------------------------------------------------------------
                        */

                        if ($category === 'Bank') {

                            $categoryIconBg = 'bg-blue-50';
                            $categoryIconColor = 'text-[#457B9D]';

                        } elseif ($category === 'E-Wallet') {

                            $categoryIconBg = 'bg-purple-50';
                            $categoryIconColor = 'text-[#6C63FF]';

                        } elseif ($category === 'Electronic Card') {

                            $categoryIconBg = 'bg-orange-50';
                            $categoryIconColor = 'text-orange-500';

                        } else {

                            $categoryIconBg = 'bg-green-50';
                            $categoryIconColor = 'text-green-600';

                        }

                    @endphp


                    {{-- ================================================= --}}
                    {{-- CATEGORY CARD --}}
                    {{-- ================================================= --}}

                    <div class="bg-white
                                rounded-2xl
                                border border-gray-100
                                shadow-sm
                                overflow-hidden">


                        {{-- ================================================= --}}
                        {{-- CATEGORY HEADER --}}
                        {{-- ================================================= --}}

                        <div class="px-4 sm:px-5 py-4
                                    flex items-center gap-3
                                    border-b border-gray-100">

                            {{-- Category Icon --}}
                            <div
                                class="w-10 h-10
                                       shrink-0
                                       rounded-xl
                                       {{ $categoryIconBg }}
                                       {{ $categoryIconColor }}
                                       flex items-center justify-center">

                                @if($category === 'Bank')

                                    {{-- Bank --}}
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.7"
                                        stroke="currentColor"
                                        class="w-5 h-5">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 10.5 12 4l9 6.5" />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 10.5v7.5m4-7.5v7.5m6-7.5v7.5m4-7.5v7.5M3 18h18M2.5 20h19" />

                                    </svg>


                                @elseif($category === 'E-Wallet')

                                    {{-- Wallet --}}
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.7"
                                        stroke="currentColor"
                                        class="w-5 h-5">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 7.5A2.25 2.25 0 0 1 5.25 5.25h13.5A2.25 2.25 0 0 1 21 7.5v10.25A1.75 1.75 0 0 1 19.25 19.5H5.75A2.75 2.75 0 0 1 3 16.75V7.5Z" />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 8h15.5A2.5 2.5 0 0 1 21 10.5v2.25h-5.25a2.75 2.75 0 1 1 0-5.5H21" />

                                        <circle
                                            cx="15.75"
                                            cy="10"
                                            r=".75"
                                            fill="currentColor"
                                            stroke="none" />

                                    </svg>


                                @elseif($category === 'Electronic Card')

                                    {{-- Card --}}
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.7"
                                        stroke="currentColor"
                                        class="w-5 h-5">

                                        <rect
                                            x="2.5"
                                            y="5"
                                            width="19"
                                            height="14"
                                            rx="2" />

                                        <path
                                            stroke-linecap="round"
                                            d="M2.5 9h19" />

                                        <path
                                            stroke-linecap="round"
                                            d="M6 14h4" />

                                    </svg>


                                @else

                                    {{-- Cash --}}
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.7"
                                        stroke="currentColor"
                                        class="w-5 h-5">

                                        <rect
                                            x="3"
                                            y="6"
                                            width="18"
                                            height="12"
                                            rx="2" />

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="3" />

                                        <path
                                            stroke-linecap="round"
                                            d="M6 9h.01M18 15h.01" />

                                    </svg>

                                @endif

                            </div>


                            {{-- Category Name --}}
                            <div>

                                <h2 class="text-base sm:text-lg font-bold text-gray-800">
                                    {{ $category }}
                                </h2>

                                <p class="text-xs text-gray-400 mt-0.5">
                                    {{ $categoryAccounts->count() }}
                                    {{ $categoryAccounts->count() == 1 ? 'account' : 'accounts' }}
                                </p>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- ACCOUNT ITEMS --}}
                        {{-- ================================================= --}}

                        <div class="divide-y divide-gray-100">

                            @foreach($categoryAccounts as $account)

                                <div
                                    class="px-4 sm:px-5 py-4
                                           flex items-center gap-3
                                           hover:bg-gray-50
                                           transition">


                                    {{-- Small Account Icon --}}
                                    <div
                                        class="w-8 h-8
                                               shrink-0
                                               rounded-lg
                                               bg-gray-50
                                               border border-gray-100
                                               flex items-center justify-center
                                               text-gray-400">

                                        @if($category === 'Bank')

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.6"
                                                stroke="currentColor"
                                                class="w-4 h-4">

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M3 10.5 12 4l9 6.5" />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M5 10.5v7.5m4-7.5v7.5m6-7.5v7.5m4-7.5v7.5M3 18h18" />

                                            </svg>

                                        @elseif($category === 'E-Wallet')

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.6"
                                                stroke="currentColor"
                                                class="w-4 h-4">

                                                <rect
                                                    x="3"
                                                    y="5"
                                                    width="18"
                                                    height="14"
                                                    rx="2" />

                                                <path
                                                    stroke-linecap="round"
                                                    d="M3 9h18" />

                                            </svg>

                                        @elseif($category === 'Electronic Card')

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.6"
                                                stroke="currentColor"
                                                class="w-4 h-4">

                                                <rect
                                                    x="2.5"
                                                    y="5"
                                                    width="19"
                                                    height="14"
                                                    rx="2" />

                                                <path
                                                    stroke-linecap="round"
                                                    d="M2.5 9h19" />

                                            </svg>

                                        @else

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.6"
                                                stroke="currentColor"
                                                class="w-4 h-4">

                                                <rect
                                                    x="3"
                                                    y="6"
                                                    width="18"
                                                    height="12"
                                                    rx="2" />

                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="3" />

                                            </svg>

                                        @endif

                                    </div>


                                    {{-- ================================================= --}}
                                    {{-- ACCOUNT NAME --}}
                                    {{-- ================================================= --}}

                                    <div class="flex-1 min-w-0">

                                        <h3 class="text-sm sm:text-base font-semibold text-gray-800 truncate">
                                            {{ $account->name }}
                                        </h3>

                                    </div>


                                    {{-- ================================================= --}}
                                    {{-- BALANCE --}}
                                    {{-- ================================================= --}}

                                    <div class="text-right shrink-0">

                                        <p class="text-xs text-gray-400 mb-0.5">
                                            Balance
                                        </p>

                                        <p class="text-sm sm:text-base font-bold text-gray-800">
                                            Rp {{ number_format($account->balance, 0, ',', '.') }}
                                        </p>

                                    </div>


                                    {{-- ================================================= --}}
                                    {{-- ACTION BUTTON --}}
                                    {{-- ================================================= --}}

                                    <div class="flex items-center gap-1 shrink-0 ml-1">

                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('accounts.edit', $account->id) }}"
                                            class="w-8 h-8
                                                   rounded-lg
                                                   flex items-center justify-center
                                                   text-gray-400
                                                   hover:text-[#457B9D]
                                                   hover:bg-blue-50
                                                   transition"
                                            title="Edit account">

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.8"
                                                stroke="currentColor"
                                                class="w-4 h-4">

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.862 4.487Z" />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M19.5 7.125 16.875 4.5" />

                                            </svg>

                                        </a>


                                        {{-- Delete --}}
                                        <form
                                            action="{{ route('accounts.destroy', $account->id) }}"
                                            method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                onclick="return confirm('Nonaktifkan akun ini?')"
                                                class="w-8 h-8
                                                       rounded-lg
                                                       flex items-center justify-center
                                                       text-gray-400
                                                       hover:text-red-500
                                                       hover:bg-red-50
                                                       transition"
                                                title="Delete account">

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.8"
                                                    stroke="currentColor"
                                                    class="w-4 h-4">

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M6 7.5h12M9.75 7.5V5.25A1.25 1.25 0 0 1 11 4h2a1.25 1.25 0 0 1 1.25 1.25V7.5M8 7.5v10.25A1.75 1.75 0 0 0 9.75 19.5h4.5A1.75 1.75 0 0 0 16 17.75V7.5M10 11v5M14 11v5" />

                                                </svg>

                                            </button>

                                        </form>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    </div>
</div>
</x-app-layout>