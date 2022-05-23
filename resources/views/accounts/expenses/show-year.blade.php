<x-app-layout>
    <div class="p-2 py-5">
        <h1 class="text-center">Accounts</h1>
    </div>

    <x-accounts-navigation />

    <div class="card mt-3">
        <div class="card-body py-4">
            <h3 class="border-bottom border-dark pb-5 text-center">Expense Records of This Year - {{ $year }}
            </h3>
            <div class="d-flex overflow-scroll px-3 py-5">
                <div class="bg-primary p-5 record_card" style="border-radius: 2rem 0 0 0">
                    <p class="text-white">Total</p>
                    <h1 class="text-white">
                        <x-utils.currency />{{ number_format($expenseData['total']) }}
                    </h1>
                </div>
                @foreach ($expenseData['expenseByType'] as $expense)
                    <div class="bg-light p-5 text-white border border-gray-300">
                        <p class="text-gray-700">{{ $expense['name'] }}</p>
                        <h1 class="text-gray-700">
                            <x-utils.currency />{{ number_format($expense['amount']) }}
                        </h1>
                    </div>
                @endforeach

            </div>

            <ul class="list-unstyled">
                @for ($i = 1; $i <= now()->month; $i++)
                    <li class="p-3 bg-gray-300 m-3">
                        <a href="{{ route('accounts.expenses.show.year.month', [$year, $i]) }}"> Expense
                            Record Month
                            of {{ now()->month($i)->format('F') }} -
                            {{ $year }}</a>
                    </li>
                @endfor
            </ul>
        </div>
    </div>
</x-app-layout>
