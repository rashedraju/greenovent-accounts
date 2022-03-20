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
    <div class="card">
        <div class="card-body py-4">
            <div class="row">
                <div class="col-12">
                    <x-accounts-navigation />
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body py-4">
            <div class="">
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr class="fw-bolder fs-6 bg-gray-300 text-dark border border-dark">
                            <th class="px-2">#</th>
                            <th class="px-2">Date</th>
                            <th class="px-2">Billing Person</th>
                            <th class="px-2">Project Name</th>
                            <th class="px-2">Description</th>
                            <th class="px-2">Expense Type</th>
                            <th class="px-2">Transaction Type</th>
                            <th class="px-2">Amount</th>
                            <th class="px-2">Aproval</th>
                            <th class="px-2">Last Edited</th>
                            <th class="px-2">Note</th>
                        </tr>
                    </thead>
                    <tbody class="border border-dark">
                        @foreach ($expenses as $expense)
                            <tr class="border border-dark">
                                <td class="p-2">{{ $loop->iteration }}</td>
                                <td class="px-2">{{ $expense->created_at }}</td>
                                <td class="px-2">{{ $expense->billingPerson->name }}</td>
                                <td class="px-2">{{ $expense->project->name }}</td>
                                <td class="px-2">{{ $expense->description }}</td>
                                <td class="px-2">{{ $expense->expenseType->name }}</td>
                                <td class="px-2">{{ $expense->transactionType->name }}</td>
                                <td class="px-2">{{ $expense->amount }}</td>
                                <td class="px-2"> <span class="text-white p-2 rounded"
                                        style="background: {{ $expense->aproval->status->color }}">
                                        {{ $expense->aproval->status->name }} </span> </td>
                                <td class="px-2">{{ $expense->updated_at }}</td>
                                <td class="px-2">{{ $expense->note }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
