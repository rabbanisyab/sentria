<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Accounts
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-700 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold">
                        My Accounts
                    </h3>
                    <a href="{{ route('accounts.create') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        + Add Account
                    </a>
                </div>

                @if ($accounts->isEmpty())
                    <div class="text-center text-gray-500 py-10">
                        You don't have any accounts yet.
                    </div>
                @else
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3">Name</th>
                                <th class="text-left py-3">Type</th>
                                <th class="text-right py-3">Balance</th>
                                <th class="text-center py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($accounts as $account)
                                <tr class="border-b">
                                    <td class="py-4">
                                        {{ $account->name }}
                                    </td>

                                    <td>
                                        {{ ucfirst($account->type) }}
                                    </td>

                                    <td class="text-right">
                                        Rp {{ number_format($account->balance, 0, ',', '.') }}
                                    </td>

                                    <td class="text-center space-x-2">
                                        <a href="{{ route('accounts.edit', $account->id) }}"
                                        class="text-blue-600 hover:text-blue-800">
                                            Edit
                                        </a>
                                        <form action="{{ route('accounts.destroy', $account->id) }}"
                                            method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                onclick="return confirm('Nonaktifkan akun ini?')"
                                                class="text-red-600 hover:text-red-800">
                                                Deactivate
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>