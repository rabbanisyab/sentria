<x-guest-layout>

    <div class="w-full max-w-md mx-auto">

        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold bg-gradient-to-r from-blue-600 via-green-500 to-blue-500 bg-clip-text text-transparent">
                Sentria
            </h1>

            <p class="mt-3 text-gray-500">
                Smart Personal Finance Tracker
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl p-8">

            <div class="mb-8 text-center">
                <h2 class="text-2xl font-bold text-gray-800">
                    Create Account
                </h2>

                <p class="text-gray-500 mt-2">
                    Start managing your finances today.
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Full Name')" />

                    <x-text-input
                        id="name"
                        class="block mt-2 w-full rounded-xl"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                        autofocus />

                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mt-5">
                    <x-input-label for="email" :value="__('Email')" />

                    <x-text-input
                        id="email"
                        class="block mt-2 w-full rounded-xl"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-5">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input
                        id="password"
                        class="block mt-2 w-full rounded-xl"
                        type="password"
                        name="password"
                        required />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-5">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input
                        id="password_confirmation"
                        class="block mt-2 w-full rounded-xl"
                        type="password"
                        name="password_confirmation"
                        required />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <button
                    type="submit"
                    class="w-full mt-8 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-green-500 text-white font-semibold hover:opacity-90 transition">

                    Register

                </button>

            </form>

            <div class="mt-8 text-center text-sm">

                <span class="text-gray-500">
                    Already have an account?
                </span>

                <a
                    href="{{ route('login') }}"
                    class="font-semibold text-blue-600 hover:underline">

                    Login

                </a>

            </div>

        </div>

    </div>

</x-guest-layout>