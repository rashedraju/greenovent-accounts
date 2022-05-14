<x-app-layout>
    <div class="p-2 py-5">
        <h1 class="text-center">Profit/Loss</h1>
    </div>

    <div class="card mt-3">
        <div class="card-body py-4 bg-secondary">
            <h3 class="pb-5 text-center">Profit/Loss Records Month of {{ now()->year($year)->month($month)->format('F') }}
                - {{ $year }} </h3>

            <div class="card card-body mt-5">
                <div class="d-flex overflow-scroll">
                    <div class="bg-primary p-5" style="border-radius: 2rem 0 0 0">
                        <p class="text-white">Total Sales</p>
                        <h1 class="text-white">
                            <x-utils.currency />{{ number_format($totalSalesByYearAndMonth) }}
                        </h1>
                    </div>
                    <div class="bg-light p-5">
                        <p class="text-gray-700">Total Expenses</p>
                        <h1 class="text-gray-700">
                            <x-utils.currency />{{ number_format($totalExpensesOfProjectsByYearAndMonth) }}
                        </h1>
                    </div>

                    <div class="bg-success p-5">
                        <p class="text-white">Net Profit</p>
                        <h1 class="text-white">
                            <x-utils.currency />{{ number_format($totalGrossProfitOfProjectsByYearAndMonth) }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
