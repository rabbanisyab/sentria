<x-app-layout>

<x-slot name="header">
    <h2 class="text-xl font-semibold text-gray-800">
        Add Income
    </h2>
</x-slot>


<div class="py-6">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <form action="{{ route('transactions.store.income') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">
                        Account
                    </label>
                    <select name="account_id" class="mt-1 w-full rounded-lg border-gray-300">
                    <option value="">
                        Choose Account
                    </option>

                    @foreach($accounts as $account)
                    <option value="{{ $account->id }}">
                        {{ $account->name }}
                    </option>
                    @endforeach

                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">
                        Category
                    </label>
                    <select name="category_id" class="mt-1 w-full rounded-lg border-gray-300">
                    <option value="">
                        Choose Category
                    </option>

                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                    @endforeach

                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">
                        Amount
                    </label>
                    <input type="number" name="amount" class="mt-1 w-full rounded-lg border-gray-300" placeholder="0">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">
                        Date
                    </label>
                    <input type="date" name="transaction_date" class="mt-1 w-full rounded-lg border-gray-300">
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('transactions.index') }}"
                    class="px-5 py-2 rounded-lg border border-red-300 text-red-600 hover:bg-red-100 transition">
                        Cancel
                    </a>

                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-lg">
                        Save Income
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>

</x-app-layout>