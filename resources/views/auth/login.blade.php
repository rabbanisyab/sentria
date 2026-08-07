<x-guest-layout>

<div class="w-full max-w-lg mx-auto">

    <!-- Logo -->
    <div class="text-center mb-10">

        <h1 class="text-5xl font-extrabold text-[#1D3557]">
            Sentria
        </h1>

        <p class="mt-3 text-gray-500">
            Smart Personal Finance Tracker
        </p>

    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-10">

        <div class="mb-8">

            <h2 class="text-3xl font-bold text-[#1D3557]">
                Welcome Back
            </h2>

            <p class="mt-2 text-gray-500">
                Sign in to continue
            </p>

        </div>

        <x-auth-session-status class="mb-5" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">

            @csrf

            <!-- EMAIL -->

            <div class="mb-5">

                <label
                    for="email"
                    class="block mb-2 font-medium text-gray-700">

                    Email

                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus

                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-[#457B9D] focus:ring-[#457B9D]">

                @error('email')

                    <p class="mt-2 text-sm text-red-500">

                        {{ $message }}

                    </p>

                @enderror

            </div>

            <!-- PASSWORD -->

            <div>

                <label
                    for="password"
                    class="block mb-2 font-medium text-gray-700">

                    Password

                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    required

                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-[#457B9D] focus:ring-[#457B9D]">

                @error('password')

                    <p class="mt-2 text-sm text-red-500">

                        {{ $message }}

                    </p>

                @enderror

            </div>

            <!-- Remember -->

            <div class="flex items-center justify-between mt-6">

                <label class="flex items-center gap-2">

                    <input
                        type="checkbox"
                        name="remember"
                        class="rounded border-gray-300 text-[#457B9D]">

                    <span class="text-sm text-gray-600">

                        Remember me

                    </span>

                </label>

                @if(Route::has('password.request'))

                <a
                    href="{{ route('password.request') }}"
                    class="text-sm font-medium text-[#457B9D] hover:text-[#1D3557]">

                    Forgot Password?

                </a>

                @endif

            </div>

            <!-- BUTTON -->

            <button

                type="submit"

                class="mt-8 w-full rounded-xl bg-[#457B9D] py-3 font-semibold text-white transition hover:bg-[#1D3557]">

                Login

            </button>

        </form>

        <div class="mt-8 text-center">

            <span class="text-gray-500">

                Don't have an account?

            </span>

            <a

                href="{{ route('register') }}"

                class="font-semibold text-[#457B9D] hover:text-[#1D3557]">

                Register

            </a>

        </div>

    </div>

</div>

</x-guest-layout>