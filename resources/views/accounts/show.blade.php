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
            <h3 class="pb-5 text-center">
                Finance Records Year of {{ $year }}
            </h3>
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr class="fw-bolder fs-6 bg-gray-300 text-dark border border-dark">
                                <th class="px-2">Cash(
                                    <x-utils.currency />)
                                </th>
                                <th class="px-2">Bank(
                                    <x-utils.currency />)
                                </th>
                                <th class="px-2">Loan(
                                    <x-utils.currency />)
                                </th>
                                <th class="px-2">Investment Income(
                                    <x-utils.currency />)
                                </th>
                            </tr>
                        </thead>
                        <tbody class="border border-dark">
                            <tr class="border border-dark fw-bold">
                                <td class="px-2">{{ number_format($accountsCashFinanceByYear) }}</td>
                                <td class="px-2">{{ number_format($accountsBankFinanceByYear) }}</td>
                                <td class="px-2">{{ number_format($accountsLoanFinanceByYear) }}</td>
                                <td class="px-2">{{ number_format($accountsInvestmentFinanceByYear) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
