<x-app-layout>
    <div class="p-2 py-5">
        <h1 class="text-center">Accounts</h1>
    </div>
    <x-accounts-navigation />
    <div class="card mt-3">
        <div class="card-body py-4">
            <h3 class="pb-5 text-center">
                Finance Records Year of {{ $year }}
            </h3>
            <div class="d-flex flex-wrap justify-content-between">
                <div class="d-flex overflow-scroll">
                    <div class="bg-primary p-5" style="border-radius: 2rem 0 0 0">
                        <p class="text-white">Total Balance</p>
                        <h1 class="text-white">
                            <x-utils.currency />{{ number_format($totalBalanceByYear) }}
                        </h1>
                    </div>

                    <div class="bg-light p-5 text-white border border-gray-300">
                        <p class="text-gray-700">Bank</p>
                        <h1 class="text-gray-700">
                            <x-utils.currency />{{ number_format($totalBankAmountByYear) }}
                        </h1>
                    </div>

                    <div class="bg-light p-5 text-white border border-gray-300">
                        <p class="text-gray-700">Cash</p>
                        <h1 class="text-gray-700">
                            <x-utils.currency />{{ number_format($totalCashAmountByYear) }}
                        </h1>
                    </div>

                    <div class="bg-light p-5 text-white border border-gray-300">
                        <p class="text-gray-700">Loan</p>
                        <h1 class="text-gray-700">
                            <x-utils.currency />{{ number_format($totalLoanAmountByYear) }}
                        </h1>
                    </div>

                    <div class="bg-light p-5 text-white border border-gray-300">
                        <p class="text-gray-700">Investment</p>
                        <h1 class="text-gray-700">
                            <x-utils.currency />{{ number_format($totalInvestmentAmountByYear) }}
                        </h1>
                    </div>
                    <div class="bg-info p-5">
                        <p class="text-white">Sales</p>
                        <h1 class="text-white">
                            <x-utils.currency />{{ number_format($totalSalesByYear) }}
                        </h1>
                    </div>

                    <div class="bg-light p-5">
                        <p class="text-gray-700">Expense</p>
                        <h1 class="text-gray-700">
                            <x-utils.currency />{{ number_format($totalExpenseByYear) }}
                        </h1>
                    </div>

                    <div class="bg-success p-5 text-white" style="border-radius: 0 2rem 0 0">
                        <p class="text-white">Net Profit</p>
                        <h1 class="text-white">
                            <x-utils.currency />{{ number_format($netProfitByYear) }}
                        </h1>
                    </div>
                </div>
            </div>

            <ul class="list-unstyled">
                @for ($i = now()->month; $i >= 1; $i--)
                    <li class="p-3 bg-gray-300 m-3">
                        <a href="{{ route('accounts.finances.show', [now()->year, $i]) }}"> Finance
                            Record Month
                            of {{ now()->month($i)->format('F') }} -
                            {{ now()->year }}</a>
                    </li>
                @endfor
            </ul>
        </div>
    </div>
</x-app-layout>
