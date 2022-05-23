<x-app-layout>
    <div class="p-2 py-5">
        <h1 class="text-center">Accounts</h1>
    </div>
    <x-accounts-navigation />
    <div class="card mt-3">
        <div class="card-body py-4">
            <h3 class="pb-5 text-center">
                Finance Records Year of {{ $data['year'] }}
            </h3>
            <div class="d-flex flex-wrap justify-content-between">
                <div class="d-flex overflow-scroll">
                    <div class="bg-info p-5" style="border-radius: 2rem 0 0 0">
                        <p class="text-white">Sales</p>
                        <h1 class="text-white">
                            <x-utils.currency />{{ number_format($data['sales']) }}
                        </h1>
                    </div>

                    <div class="bg-light p-5">
                        <p class="text-gray-700">Expense</p>
                        <h1 class="text-gray-700">
                            <x-utils.currency />{{ number_format($data['expense']) }}
                        </h1>
                    </div>
                    <div class="bg-success p-5 text-white">
                        <p class="text-white">Net Profit</p>
                        <h1 class="text-white">
                            <x-utils.currency />{{ number_format($data['net_profit']) }}
                        </h1>
                    </div>

                    <div class="bg-primary p-5">
                        <p class="text-white">Current Balance</p>
                        <h1 class="text-white">
                            <x-utils.currency />{{ number_format($data['balance']) }}
                        </h1>
                    </div>

                    <div class="bg-light p-5 text-white border border-gray-300">
                        <p class="text-gray-700">Bank</p>
                        <h1 class="text-gray-700">
                            <x-utils.currency />{{ number_format($data['bank_amount']) }}
                        </h1>
                    </div>

                    <div class="bg-light p-5 text-white border border-gray-300">
                        <p class="text-gray-700">Cash</p>
                        <h1 class="text-gray-700">
                            <x-utils.currency />{{ number_format($data['cash_amount']) }}
                        </h1>
                    </div>
                </div>
            </div>

            <ul class="list-unstyled">
                @for ($i = 1; $i <= now()->month; $i++)
                    <li class="p-3 bg-gray-300 m-3">
                        <a href="{{ route('accounts.finances.show.year.month', [$data['year'], $i]) }}"> Finance
                            Record Month
                            of {{ now()->month($i)->format('F') }} -
                            {{ $data['year'] }}</a>
                    </li>
                @endfor
            </ul>
        </div>
    </div>
</x-app-layout>
