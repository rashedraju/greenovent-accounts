<x-app-layout>
    <style>
        table {
            border-collapse: collapse;
        }

        tr:nth-child(3) {
            border: solid thin;
        }

    </style>
    <div class="p-2 py-5">
        <h1 class="text-center">Accounts</h1>
    </div>

    <x-accounts-navigation />

    <div class="card mt-3">
        <div class="card-body py-4">
            <h3 class="border-bottom border-dark pb-5 text-center">Withdrawals Records of This Year - {{ $year }}
            </h3>
            <div class="d-flex">
                <div class="bg-success p-5 mx-3 text-white">
                    <p class="text-white">Total Withdrawals</p>
                    <h1 class="text-white">
                        <x-utils.currency />{{ number_format($totalWithdrawalAmountOfThisYear) }}
                    </h1>
                </div>
            </div>
            <ul class="list-unstyled">
                @for ($i = now()->month; $i >= 1; $i--)
                    <li class="p-3 bg-gray-300 m-3">
                        <a href="{{ route('accounts.withdrawals.show', [$year, $i]) }}"> Withdrawals
                            Record Month
                            of {{ now()->month($i)->format('F') }} -
                            {{ $year }}</a>
                    </li>
                @endfor
            </ul>
        </div>
    </div>
</x-app-layout>
