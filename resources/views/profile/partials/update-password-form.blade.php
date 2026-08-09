<section class="mt-7">

    {{-- Header --}}
    <div class="mb-5">
        <div class="flex items-center gap-3">

            <div class="w-10 h-10
                        shrink-0
                        rounded-xl
                        bg-[#F0EFFF]
                        text-[#6C63FF]
                        flex items-center justify-center">

                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="w-5 h-5">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75" />

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5.25 10.5h13.5v9H5.25v-9z" />

                </svg>

            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-800">
                    {{ __('Update Password') }}
                </h2>

                <p class="text-sm text-gray-500 mt-0.5">
                    {{ __('Ensure your account is using a long, random password to stay secure.') }}
                </p>
            </div>

        </div>
    </div>


    {{-- Card --}}
    <div class="bg-white
                rounded-2xl
                shadow-sm
                border border-[#DCD9FF]
                overflow-hidden">

        <div class="h-1 w-full bg-[#6C63FF]"></div>

        <div class="p-5 sm:p-6">

            <form method="post"
                action="{{ route('password.update') }}"
                class="space-y-5">

                @csrf
                @method('put')


                {{-- Current Password --}}
                <div>
                    <label
                        for="update_password_current_password"
                        class="block text-sm font-semibold text-gray-700 mb-2">

                        {{ __('Current Password') }}

                    </label>

                    <input
                        id="update_password_current_password"
                        name="current_password"
                        type="password"
                        autocomplete="current-password"
                        class="w-full rounded-xl
                               border-gray-200
                               bg-gray-50
                               focus:border-[#6C63FF]
                               focus:ring-[#6C63FF]
                               text-gray-700
                               py-2.5">

                    @error('current_password', 'updatePassword')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- New Password --}}
                <div>
                    <label
                        for="update_password_password"
                        class="block text-sm font-semibold text-gray-700 mb-2">

                        {{ __('New Password') }}

                    </label>

                    <input
                        id="update_password_password"
                        name="password"
                        type="password"
                        autocomplete="new-password"
                        class="w-full rounded-xl
                               border-gray-200
                               bg-gray-50
                               focus:border-[#6C63FF]
                               focus:ring-[#6C63FF]
                               text-gray-700
                               py-2.5">

                    @error('password', 'updatePassword')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- Confirm Password --}}
                <div>
                    <label
                        for="update_password_password_confirmation"
                        class="block text-sm font-semibold text-gray-700 mb-2">

                        {{ __('Confirm Password') }}

                    </label>

                    <input
                        id="update_password_password_confirmation"
                        name="password_confirmation"
                        type="password"
                        autocomplete="new-password"
                        class="w-full rounded-xl
                               border-gray-200
                               bg-gray-50
                               focus:border-[#6C63FF]
                               focus:ring-[#6C63FF]
                               text-gray-700
                               py-2.5">

                    @error('password_confirmation', 'updatePassword')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- Submit --}}
                <div class="pt-1">

                    <button
                        type="submit"
                        class="w-full
                               py-3
                               rounded-xl
                               bg-[#6C63FF]
                               hover:bg-[#5A52E0]
                               text-white
                               text-sm
                               font-semibold
                               shadow-sm
                               hover:shadow-md
                               transition">

                        {{ __('Update Password') }}

                    </button>

                    @if (session('status') === 'password-updated')

                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="mt-3 text-sm text-center text-green-600 font-medium">

                            {{ __('Saved.') }}

                        </p>

                    @endif

                </div>

            </form>

        </div>
    </div>

</section>