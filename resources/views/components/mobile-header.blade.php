{{-- Mobile Header --}}
<div class="sm:hidden sticky top-0 z-40
            bg-white/95 backdrop-blur-md
            border-b border-gray-100 shadow-sm">

    <div class="h-16 px-4 flex items-center justify-between">

        {{-- Logo Sentria --}}
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-2.5">

            <img
                src="{{ asset('img/logo_sentria_light.png') }}"
                alt="Sentria"
                class="w-23 h-12 object-contain">
        </a>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                type="submit"
                class="w-10 h-10 rounded-xl
                       flex items-center justify-center
                       text-gray-500
                       hover:text-red-500
                       hover:bg-red-50
                       transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.8"
                     stroke="currentColor"
                     class="w-5 h-5">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M18 15l3-3m0 0l-3-3m3 3H9"/>

                </svg>

            </button>

        </form>

    </div>

</div>