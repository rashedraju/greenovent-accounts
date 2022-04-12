<x-app-layout>
    <div class="p-2 py-5">
        <h1 class="text-center">Accounts</h1>
    </div>

    <x-accounts-navigation />

    <div class="card mt-3">
        <div class="card-body py-4">
            <h3 class="pb-5 text-center">Finance Records Month of {{ now()->year($year)->month($month)->format('F') }}
                - {{ $year }} </h3>

            <div class="d-flex gap-3">
                <div class="border p-3">
                    <h4>Total Expenses</h4>
                    <table class="table table-striped table-light">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expensesOfThisMonth as $expenseOfThisMonth)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $expenseOfThisMonth->head }}</td>
                                    <td>{{ $expenseOfThisMonth->amount }}</td>
                                </tr>
                            @endforeach
                            <tr class="table-warning">
                                <td></td>
                                <td></td>
                                <td><strong> Total = {{ $totalExpenseAmountOfThisMonth }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="border p-3">
                    <h4>Revenues</h4>
                    <table class="table table-striped table-light">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Project Name</th>
                                <th scope="col">Client Name</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($revenuesOfThisMonth as $revenueOfThisMonth)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $revenueOfThisMonth->name }}</td>
                                    <td>{{ $revenueOfThisMonth->client->company_name }}</td>
                                    <td>{{ number_format($revenueOfThisMonth->po_value) }}</td>
                                </tr>
                            @endforeach
                            <tr class="table-warning">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>Total = {{ number_format($totalRevenueAmountOfThisMonth) }}</strong></td>
                            </tr>
                            <tr class="table-success">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>Net Profit = {{ number_format($netProfitOfThisMonth) }}</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
