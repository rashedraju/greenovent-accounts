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
            <div class="d-flex">
                <div class="bg-primary p-5 record_card" style="min-width: 132px; border-radius: 2rem 0 0 0">
                    <p class="text-white">Total</p>
                    <h1 class="text-white">
                        <x-utils.currency />{{ number_format($totalAmountByYear) }}
                    </h1>
                </div>

                <div class="bg-success p-5 text-white" style="min-width: 132px">
                    <p class="text-white">Bank</p>
                    <h1 class="text-white">
                        <x-utils.currency />{{ number_format($totalBankAmountByYear) }}
                    </h1>
                </div>

                <div class="bg-info p-5 text-white" style="min-width: 132px">
                    <p class="text-white">Cash</p>
                    <h1 class="text-white">
                        <x-utils.currency />{{ number_format($totalCashAmountByYear) }}
                    </h1>
                </div>

                <div class="bg-light p-5 text-white border border-gray-300" style="min-width: 132px">
                    <p class="text-gray-700">Loan</p>
                    <h1 class="text-gray-700">
                        <x-utils.currency />{{ number_format($totalLoanAmountByYear) }}
                    </h1>
                </div>

                <div class="bg-light p-5 text-white border border-gray-300" style="min-width: 132px">
                    <p class="text-gray-700">Investment</p>
                    <h1 class="text-gray-700">
                        <x-utils.currency />{{ number_format($totalInvestmentAmountByYear) }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
