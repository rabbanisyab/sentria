<section class="mt-7">

    {{-- Header --}}
    <div class="mb-5">
        <div class="flex items-center gap-3">

            <div class="w-10 h-10 shrink-0 rounded-xl bg-red-50 text-red-500flex items-center justify-center">

                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="w-5 h-5">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 7.5h12" />

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 7.5V5.25A1.25 1.25 0 0110.25 4h3.5A1.25 1.25 0 0115 5.25V7.5" />

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M7.5 7.5l.75 12h7.5l.75-12" />

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10.5 11v5.5M13.5 11v5.5" />

                </svg>

            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-800">
                    {{ __('Delete Account') }}
                </h2>

                <p class="text-sm text-gray-500 mt-0.5">
                    {{ __('Permanently remove your account and all associated data.') }}
                </p>
            </div>

        </div>
    </div>


    {{-- Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-red-100 overflow-hidden">

        <div class="h-1 w-full bg-red-500"></div>

        <div class="p-5 sm:p-6">

            <p class="text-sm leading-6 text-gray-600 mb-5">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </p>


            <button
                type="button"
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                class="w-full py-3 rounded-xl bg-red-500 hover:bg-red-600 text-white
                       text-sm font-semibold shadow-sm hover:shadow-md transition">

                {{ __('Delete Account') }}

            </button>

        </div>
    </div>


    {{-- Confirmation Modal --}}
    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable>

        <form
            method="post"
            action="{{ route('profile.destroy') }}"
            class="p-6">

            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-gray-800">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-2 text-sm leading-6 text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>


            <div class="mt-5">

                <label
                    for="password"
                    class="block text-sm font-semibold text-gray-700 mb-2">

                    {{ __('Password') }}

                </label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="{{ __('Password') }}"
                    class="w-full rounded-xl
                           border-gray-200
                           bg-gray-50
                           focus:border-red-500
                           focus:ring-red-500
                           text-gray-700
                           py-2.5">

                @error('password', 'userDeletion')
                    <p class="mt-2 text-sm text-red-500">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            <div class="mt-5 flex justify-end gap-3">

                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="px-5 py-2.5
                           rounded-xl
                           border border-gray-200
                           bg-white
                           text-sm
                           text-gray-700
                           font-semibold
                           hover:bg-gray-50
                           transition">

                    {{ __('Cancel') }}

                </button>


                <button
                    type="submit"
                    class="px-5 py-2.5
                           rounded-xl
                           bg-red-500
                           hover:bg-red-600
                           text-white
                           text-sm
                           font-semibold
                           shadow-sm
                           transition">

                    {{ __('Delete Account') }}

                </button>

            </div>

        </form>

    </x-modal>

</section>
