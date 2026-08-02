<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Add Transaction
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">
                    Choose Transaction Type
                </h1>
                <p class="text-gray-500 mt-2">
                    Select the type of transaction you want to record.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Income --}}
                <a href="{{ route('transactions.create.income') }}"
                   class="group">
                    <div class="bg-white border border-green-200 rounded-xl p-6
                                transition-all duration-300
                                hover:-translate-y-1
                                hover:shadow-xl">
                        <div class="w-14 h-14 rounded-full bg-green-100
                                    flex items-center justify-center
                                    text-3xl mb-5">
                            💰
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">
                            Income
                        </h3>
                        <p class="text-gray-500 mt-2">
                            Record money coming in such as allowance,
                            salary, or bonus.
                        </p>
                    </div>
                </a>

                {{-- Expense --}}
                <a href="{{ route('transactions.create.expense') }}"
                   class="group">
                    <div class="bg-white border border-red-200 rounded-xl p-6
                                transition-all duration-300
                                hover:-translate-y-1
                                hover:shadow-xl">
                        <div class="w-14 h-14 rounded-full bg-red-100
                                    flex items-center justify-center
                                    text-3xl mb-5">
                            💸
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">
                            Expense
                        </h3>
                        <p class="text-gray-500 mt-2">
                            Record your daily spending such as food,
                            transport, or shopping.
                        </p>
                    </div>
                </a>
                {{-- Transfer --}}
                <a href="{{ route('transactions.create.transfer') }}"
                   class="group">
                    <div class="bg-white border border-blue-200 rounded-xl p-6
                                transition-all duration-300
                                hover:-translate-y-1
                                hover:shadow-xl">

                        <div class="w-14 h-14 rounded-full bg-blue-100
                                    flex items-center justify-center
                                    text-3xl mb-5">
                            🔄
                        </div>

                        <h3 class="text-xl font-semibold text-gray-800">
                            Transfer
                        </h3>

                        <p class="text-gray-500 mt-2">
                            Move money between your accounts.
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </div>

</x-app-layout>