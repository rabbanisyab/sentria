<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sentria') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-[#EEF4FF] via-[#F5F3FF] to-[#E8F0FF] font-sans antialiased">
    <main class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">

        <div class="w-full max-w-6xl">

            <div class="overflow-hidden rounded-3xl bg-white shadow-xl">

                <div class="grid lg:grid-cols-2">

                    <!-- LEFT : BRAND -->
                    <div class="hidden lg:flex relative overflow-hidden bg-gradient-to-br from-[#1D3557] via-[#457B9D] to-[#6D4AFF] p-12 xl:p-16">

                        <!-- Decorative circles -->
                        <div class="absolute -top-20 -right-20 h-64 w-64 rounded-full bg-white/10"></div>
                        <div class="absolute -bottom-24 -left-20 h-72 w-72 rounded-full bg-purple-400/10"></div>

                        <div class="relative z-10 flex flex-col justify-between w-full">

                            <div>
                                <div class="flex items-center gap-3">
                                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/15 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <rect width="20" height="14" x="2" y="5" rx="2"/>
                                            <line x1="2" x2="22" y1="10" y2="10"/>
                                        </svg>
                                    </div>

                                    <span class="text-2xl font-bold tracking-tight text-white">
                                        Sentria
                                    </span>
                                </div>

                                <div class="mt-20 max-w-md">
                                    <h1 class="text-4xl xl:text-5xl font-bold leading-tight text-white">
                                        Your money,
                                        <span class="text-purple-200">
                                            organized.
                                        </span>
                                    </h1>

                                    <p class="mt-5 text-base leading-7 text-blue-100">
                                        Manage your accounts, track your transactions,
                                        and understand your finances in one place.
                                    </p>
                                </div>
                            </div>

                            <p class="text-sm text-blue-100/70">
                                Smart Personal Finance Tracker
                            </p>

                        </div>
                    </div>


                    <!-- RIGHT : LOGIN -->
                    <div class="flex items-center p-6 sm:p-10 lg:p-12 xl:p-16">

                        <div class="w-full max-w-md mx-auto">

                            <!-- Mobile Logo -->
                            <div class="mb-8 flex items-center gap-3 lg:hidden">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#457B9D] text-white">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        width="21"
                                        height="21"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect width="20" height="14" x="2" y="5" rx="2"/>
                                        <line x1="2" x2="22" y1="10" y2="10"/>
                                    </svg>

                                </div>

                                <span class="text-2xl font-bold text-[#1D3557]">
                                    Sentria
                                </span>

                            </div>


                            <!-- Heading -->
                            <div class="mb-8">

                                <h2 class="text-3xl font-bold tracking-tight text-[#1D3557] sm:text-4xl">
                                    Welcome back
                                </h2>

                                <p class="mt-2 text-sm text-slate-500 sm:text-base">
                                    Sign in to continue to your account.
                                </p>

                            </div>


                            <!-- Session Status -->
                            <x-auth-session-status
                                class="mb-5"
                                :status="session('status')" />


                            <!-- FORM -->
                            <form method="POST" action="{{ route('login') }}" class="space-y-5">

                                @csrf


                                <!-- EMAIL -->
                                <div>

                                    <label
                                        for="email"
                                        class="mb-2 block text-sm font-medium text-[#1D3557]">

                                        Email

                                    </label>

                                    <input
                                        id="email"
                                        type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        required
                                        autofocus
                                        autocomplete="username"

                                        class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-[#457B9D] focus:bg-white focus:ring-2 focus:ring-[#457B9D]/20"

                                        placeholder="Enter your email">

                                    @error('email')
                                        <p class="mt-2 text-sm text-[#E63946]">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                <!-- PASSWORD -->
                                <div>

                                    <div class="mb-2 flex items-center justify-between">

                                        <label
                                            for="password"
                                            class="block text-sm font-medium text-[#1D3557]">

                                            Password

                                        </label>

                                        @if (Route::has('password.request'))
                                            <a
                                                href="{{ route('password.request') }}"
                                                class="text-sm font-medium text-[#6D4AFF] hover:text-[#1D3557]">

                                                Forgot password?

                                            </a>
                                        @endif

                                    </div>


                                    <input
                                        id="password"
                                        type="password"
                                        name="password"
                                        required
                                        autocomplete="current-password"

                                        class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-[#457B9D] focus:bg-white focus:ring-2 focus:ring-[#457B9D]/20"

                                        placeholder="Enter your password">

                                    @error('password')
                                        <p class="mt-2 text-sm text-[#E63946]">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                <!-- REMEMBER -->
                                <div class="flex items-center">

                                    <label class="inline-flex items-center">

                                        <input
                                            type="checkbox"
                                            name="remember"

                                            class="h-4 w-4 rounded border-slate-300 text-[#457B9D] focus:ring-[#457B9D]">

                                        <span class="ml-2 text-sm text-slate-500">
                                            Remember me
                                        </span>

                                    </label>

                                </div>


                                <!-- LOGIN BUTTON -->
                                <button
                                    type="submit"

                                    class="w-full rounded-xl bg-gradient-to-r from-[#457B9D] to-[#6D4AFF] px-4 py-3.5 text-sm font-semibold text-white shadow-md shadow-[#457B9D]/20 transition duration-200 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-[#457B9D]/25 focus:outline-none focus:ring-2 focus:ring-[#457B9D] focus:ring-offset-2">

                                    Login

                                </button>

                            </form>


                            <!-- REGISTER -->
                            <div class="mt-8 text-center">

                                <p class="text-sm text-slate-500">

                                    Don't have an account?

                                    <a
                                        href="{{ route('register') }}"
                                        class="ml-1 font-semibold text-[#457B9D] hover:text-[#1D3557]">

                                        Create account

                                    </a>

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>

</body>

</html>