<section>
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
                        d="M15.75 6a3.75 3.75 0 11-7.5 0
                           3.75 3.75 0 017.5 0z" />

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4.5 20.25a8.25 8.25 0 0115 0" />

                </svg>

            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-800">
                    {{ __('Profile Information') }}
                </h2>

                <p class="text-sm text-gray-500 mt-0.5">
                    {{ __("Update your account's profile information and email address.") }}
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
                action="{{ route('profile.update') }}"
                class="space-y-5">

                @csrf
                @method('patch')


                {{-- Name --}}
                <div>
                    <label for="name"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('Name') }}
                    </label>

                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name', $user->name) }}"
                        required
                        autofocus
                        autocomplete="name"
                        class="w-full rounded-xl
                               border-gray-200
                               bg-gray-50
                               focus:border-[#6C63FF]
                               focus:ring-[#6C63FF]
                               text-gray-700
                               py-2.5">

                    @error('name')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- Email --}}
                <div>
                    <label for="email"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ __('Email') }}
                    </label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email', $user->email) }}"
                        required
                        autocomplete="username"
                        class="w-full rounded-xl
                               border-gray-200
                               bg-gray-50
                               focus:border-[#6C63FF]
                               focus:ring-[#6C63FF]
                               text-gray-700
                               py-2.5">

                    @error('email')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror


                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

                        <div class="mt-3 rounded-xl
                                    bg-yellow-50
                                    border border-yellow-100
                                    px-4 py-3">

                            <p class="text-sm text-yellow-700">
                                {{ __('Your email address is unverified.') }}
                            </p>

                            <button
                                form="send-verification"
                                class="mt-1 text-sm font-medium
                                       text-[#6C63FF]
                                       hover:text-[#5A52E0]
                                       underline
                                       transition">

                                {{ __('Click here to re-send the verification email.') }}

                            </button>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 text-sm font-medium text-green-600">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif

                        </div>

                    @endif

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

                        {{ __('Save Changes') }}

                    </button>

                    @if (session('status') === 'profile-updated')

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
