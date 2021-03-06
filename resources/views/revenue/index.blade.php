<x-app-layout>
    <div class="p-2 py-5">
        <h1 class="text-center">Revenue</h1>
    </div>

    <h3 class="border-bottom border-dark pb-5 text-center">Revenue of This Year - {{ now()->year }}</h3>
    <div class="card card-body mt-3">
        <h3>Monthly revenue chart</h3>
        <div id="revenue_by_month_chart" style="height: 300px;"></div>
    </div>

    <div class="card card-body mt-3">
        <h3>Revenue by client chart</h3>
        <div id="revenue_by_client_chart" style="height: 300px;"></div>
    </div>
    <div class="card mt-3">
        <div class="card-body py-4">

            <div class="card card-body mt-5">
                <div class="d-flex overflow-scroll">
                    <div class="bg-primary p-5" style="border-radius: 2rem 0 0 0">
                        <p class="text-white">Total Sales</p>
                        <h1 class="text-white">
                            <x-utils.currency />{{ number_format($totalSalesByYear) }}
                        </h1>
                    </div>
                    <div class="bg-light p-5">
                        <p class="text-gray-700">Total Expenses</p>
                        <h1 class="text-gray-700">
                            <x-utils.currency />{{ number_format($totalExpensesOfProjectsByYear) }}
                        </h1>
                    </div>
                    <div class="bg-secondary p-5">
                        <p class="text-gray-700">Total Due</p>
                        <h1 class="text-gray-700">
                            <x-utils.currency />{{ number_format($totalDueAmountOfProjectsByYear) }}
                        </h1>
                    </div>
                    <div class="bg-success p-5">
                        <p class="text-white">Gross Profit</p>
                        <h1 class="text-white">
                            <x-utils.currency />{{ number_format($totalGrossProfitOfProjectsByYear) }}
                        </h1>
                    </div>
                </div>
            </div>

            <ul class="list-unstyled">
                @for ($i = 1; $i <= now()->month; $i++)
                    <li class="p-3 bg-gray-300 m-3">
                        <a href="{{ route('revenue.show', [now()->year, $i]) }}"> Revenues
                            Record Month
                            of {{ now()->month($i)->format('F') }} -
                            {{ now()->year }}</a>
                    </li>
                @endfor
            </ul>
        </div>
    </div>

    <x-slot name="script">
        <script>
            // net profit chart
            new Chartisan({
                el: '#revenue_by_month_chart',
                url: "@chart('revenue_by_month_chart')",
                hooks: new ChartisanHooks()
                    .legend()
                    .colors()
                    .tooltip()
            });
            new Chartisan({
                el: '#revenue_by_client_chart',
                url: "@chart('revenue_by_client_chart')",
                hooks: new ChartisanHooks()
                    .legend()
                    .colors()
                    .tooltip()
            });
        </script>
    </x-slot>
</x-app-layout>
