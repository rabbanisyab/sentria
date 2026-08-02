<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Add Account
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form action="{{ route('accounts.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Account Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full border rounded-lg px-4 py-2"
                        >

                        @error('name')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Account Type
                        </label>
                        <select name="type" class="w-full border rounded-lg px-4 py-2">
                            <option value="bank" {{ old('type') == 'bank' ? 'selected' : '' }}>Bank</option>
                            <option value="ewallet" {{ old('type') == 'ewallet' ? 'selected' : '' }}>E-Wallet</option>
                            <option value="cash" {{ old('type') == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="electronic_card" {{ old('type') == 'electronic_card' ? 'selected' : '' }}>Electronic Card</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">

                        <label class="block font-medium mb-2">
                            Saldo
                        </label>

                        <input
                            type="number"
                            name="balance"
                            value="{{ old('balance', 0) }}"
                            class="w-full border rounded-lg px-4 py-2"
                        >
                        @error('balance')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                            Save
                        </button>

                        <a href="{{ route('accounts.index') }}" class="px-5 py-2 border rounded-lg">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>