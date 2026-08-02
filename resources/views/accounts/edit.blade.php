<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Edit Account
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form action="{{ route('accounts.update', $account->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Account Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $account->name) }}"
                            class="w-full border rounded-lg px-4 py-2">
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
                            <option value="bank" {{ $account->type == 'bank' ? 'selected' : '' }}>
                                Bank
                            </option>
                            <option value="ewallet" {{ $account->type == 'ewallet' ? 'selected' : '' }}>
                                E-Wallet
                            </option>
                            <option value="cash" {{ $account->type == 'cash' ? 'selected' : '' }}>
                                Cash
                            </option>
                            <option value="electronic_card" {{ $account->type == 'electronic_card' ? 'selected' : '' }}>
                                Electronic Card
                            </option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium mb-2">
                            Balance
                        </label>
                        <input
                            type="number"
                            name="balance"
                            value="{{ old('balance', $account->balance) }}"
                            class="w-full border rounded-lg px-4 py-2">
                    </div>

                    <div class="flex gap-3">
                        <button class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                            Update
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