<nav class="bg-white border-gray-200">

    {{-- ================= DESKTOP SIDEBAR ================= --}}
    <aside class="hidden md:flex fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-gray-200 flex-col">

        {{-- Logo --}}
        <div class="h-20 flex items-center px-7 border-b border-gray-100">
            <a href="{{ route('dashboard') }}"
                class="text-2xl font-extrabold bg-gradient-to-r from-[#457B9D] to-[#6C63FF] bg-clip-text text-transparent">
                Sentria
            </a>
        </div>


        {{-- Navigation --}}
        <div class="flex-1 px-4 py-6">

            <p class="px-3 mb-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                Menu
            </p>

            <div class="space-y-2">

                {{-- Dashboard --}}
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('dashboard')
                        ? 'bg-[#E8EAFD] text-[#457B9D] font-semibold'
                        : 'text-gray-600 hover:bg-gray-50 hover:text-[#457B9D]' }}">

                    <svg class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 12l9-9 9 9M5 10v10h14V10M9 20v-6h6v6"/>
                    </svg>

                    <span>Dashboard</span>
                </a>


                {{-- Transactions --}}
                <a href="{{ route('transactions.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('transactions.*')
                        ? 'bg-[#E8EAFD] text-[#457B9D] font-semibold'
                        : 'text-gray-600 hover:bg-gray-50 hover:text-[#457B9D]' }}">

                    <svg class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M7 7h10M7 12h10M7 17h6"/>
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 4h16v16H4z"/>
                    </svg>

                    <span>Transactions</span>
                </a>


                {{-- History --}}
                <a href="{{ route('history.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('history.*')
                        ? 'bg-[#E8EAFD] text-[#457B9D] font-semibold'
                        : 'text-gray-600 hover:bg-gray-50 hover:text-[#457B9D]' }}">

                    <svg class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 8v4l3 2"/>
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M20 12a8 8 0 11-16 0 8 8 0 0116 0z"/>
                    </svg>

                    <span>History</span>
                </a>


                {{-- Accounts --}}
                <a href="{{ route('accounts.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('accounts.*')
                        ? 'bg-[#E8EAFD] text-[#457B9D] font-semibold'
                        : 'text-gray-600 hover:bg-gray-50 hover:text-[#457B9D]' }}">

                    <svg class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 10h18M5 10v9M9 10v9M15 10v9M19 10v9M3 19h18M4 7l8-4 8 4"/>
                    </svg>

                    <span>Accounts</span>
                </a>

            </div>
        </div>


        {{-- User --}}
        <div class="border-t border-gray-100 p-4">

            {{-- Profile --}}
            <a href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-gray-50 transition">

                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#457B9D] to-[#6C63FF] text-white flex items-center justify-center font-semibold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-gray-800 truncate">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-xs text-gray-500 truncate">
                        {{ auth()->user()->email }}
                    </p>
                </div>
            </a>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf

                <button
                    type="submit"
                    class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm text-gray-500 hover:bg-red-50 hover:text-red-500 transition">

                    <svg class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 12H3m0 0l4-4m-4 4l4 4"/>
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10 5V4a1 1 0 011-1h7a1 1 0 011 1v16a1 1 0 01-1 1h-7a1 1 0 01-1-1v-1"/>
                    </svg>

                    <span>Logout</span>
                </button>
            </form>

        </div>

    </aside>



    {{-- ================= MOBILE BOTTOM NAVIGATION ================= --}}
    <div class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-200">

        <div class="grid grid-cols-5 h-16">

            {{-- Dashboard --}}
            <a href="{{ route('dashboard') }}"
                class="flex flex-col items-center justify-center gap-1
                {{ request()->routeIs('dashboard')
                    ? 'text-[#457B9D]'
                    : 'text-gray-400' }}">

                <svg class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 12l9-9 9 9M5 10v10h14V10M9 20v-6h6v6"/>
                </svg>

                <span class="text-[11px] font-medium">
                    Home
                </span>
            </a>


            {{-- Transactions --}}
            <a href="{{ route('transactions.index') }}"
                class="flex flex-col items-center justify-center gap-1
                {{ request()->routeIs('transactions.*')
                    ? 'text-[#457B9D]'
                    : 'text-gray-400' }}">

                <svg class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M7 7h10M7 12h10M7 17h6"/>
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 4h16v16H4z"/>
                </svg>

                <span class="text-[11px] font-medium">
                    Transaction
                </span>
            </a>


            {{-- History --}}
            <a href="{{ route('history.index') }}"
                class="flex flex-col items-center justify-center gap-1
                {{ request()->routeIs('history.*')
                    ? 'text-[#457B9D]'
                    : 'text-gray-400' }}">

                <svg class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 8v4l3 2"/>
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M20 12a8 8 0 11-16 0 8 8 0 0116 0z"/>
                </svg>

                <span class="text-[11px] font-medium">
                    History
                </span>
            </a>


            {{-- Accounts --}}
            <a href="{{ route('accounts.index') }}"
                class="flex flex-col items-center justify-center gap-1
                {{ request()->routeIs('accounts.*')
                    ? 'text-[#457B9D]'
                    : 'text-gray-400' }}">

                <svg class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 10h18M5 10v9M9 10v9M15 10v9M19 10v9M3 19h18M4 7l8-4 8 4"/>
                </svg>

                <span class="text-[11px] font-medium">
                    Accounts
                </span>
            </a>

            {{-- Profile --}}
            <a href="{{ route('profile.edit') }}"
                class="flex flex-col items-center justify-center gap-1
                {{ request()->routeIs('profile.*')
                    ? 'text-[#6C63FF]'
                    : 'text-gray-400' }}">

                <svg class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 19a6 6 0 00-6 0"/>
                    <circle cx="12" cy="8" r="4"/>
                </svg>

                <span class="text-[11px] font-medium">
                    Profile
                </span>

            </a>
        </div>
    </div>

</nav>