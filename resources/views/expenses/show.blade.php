<x-app-layout>
    <style>
        table {
            border-collapse: collapse;
        }

        tr:nth-child(3) {
            border: solid thin;
        }

    </style>

    <div class="card mt-3">
        <div class="card-body py-4">
            <h3 class="pb-5 text-center">Expense Records Month of {{ now()->year($year)->month($month)->format('F') }}
                - {{ $year }} </h3>

            {{-- Import and Export excel file --}}

            <div class="d-flex gap-3 justify-content-end">
                <a href="{{ route('accounts.expenses.export', [$year, $month]) }}"
                    class="btn btn-sm my-2 px-10 py-0 btn-danger">
                    <x-utils.download /> Export
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="fw-bolder fs-6 bg-gray-300 text-dark border border-dark">
                            <th class="px-2">#</th>
                            <th class="px-2">Head</th>
                            <th class="px-2">Date</th>
                            <th class="px-2">Billing Person</th>
                            <th class="px-2">Project Name</th>
                            <th class="px-2">Description</th>
                            <th class="px-2">Expense Type</th>
                            <th class="px-2">Transaction Type</th>
                            <th class="px-2">Amount(
                                <x-utils.currency />)
                            </th>
                            <th class="px-2">Aproval</th>
                            <th class="px-2">Last Edited</th>
                            <th class="px-2">Filter</th>
                        </tr>
                    </thead>
                    <tbody class="border border-dark">
                        @foreach ($expenseRecords as $expense)
                            <tr class="border border-dark fw-bold">
                                <td class="p-2">{{ $loop->iteration }}</td>
                                <td class="p-2">{{ $expense->head }}</td>
                                <td class="px-2">{{ $expense->date }}</td>
                                <td class="px-2">{{ $expense->billingPerson->name }}</td>
                                <td class="px-2">{{ $expense->project->name }}</td>
                                <td class="px-2">{{ $expense->description }}</td>
                                <td class="px-2">{{ $expense->expenseType->name }}</td>
                                <td class="px-2">{{ $expense->transactionType->name }}</td>
                                <td class="px-2">{{ number_format($expense->amount) }}</td>
                                <td class="px-2"> <span class="text-white p-1 rounded"
                                        style="background: {{ $expense->aproval->status->color }}">
                                        {{ $expense->aproval->status->name }} </span> </td>
                                <td class="px-2">{{ $expense->modified }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td> Total: <strong> {{ number_format($totalExpensesOfThisMonth) }} </strong> </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <form action="{{ route('expenses.show', [$year, $month]) }}" method="GET">
                                <td></td>
                                <td>
                                    <input type="text" class="form-control" name="head" list="expenseHeadLists"
                                        placeholder="Head">
                                    <datalist id="expenseHeadLists">
                                        @foreach ($expenseHeadsOfThisMonth as $expenseHead)
                                            <option value="{{ $expenseHead }}">
                                        @endforeach
                                    </datalist>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <select class="form-select" name="user_id" data-control="select2"
                                        data-placeholder="Select">
                                        <option></option>
                                        @foreach ($billingPersonsOfThisMonth as $billingPersonOfThisMonthId => $billingPersonOfThisMonthName)
                                            <option value="{{ $billingPersonOfThisMonthId }}">
                                                {{ $billingPersonOfThisMonthName }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="project_id" data-control="select2"
                                        data-placeholder="Select">
                                        <option></option>
                                        @foreach ($projectsOfThisMonth as $projectsOfThisMonthId => $projectsOfThisMonthName)
                                            <option value="{{ $projectsOfThisMonthId }}">
                                                {{ $projectsOfThisMonthName }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td></td>
                                <td>
                                    <select name="expense_type_id" class="form-select" data-control="select2"
                                        data-placeholder="Select">
                                        <option></option>

                                        @foreach ($expenseTypes as $expenseTypeId => $expenseTypeName)
                                            <option value="{{ $expenseTypeId }}">
                                                {{ $expenseTypeName }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="transaction_type_id" class="form-select" data-control="select2"
                                        data-placeholder="Select">
                                        <option></option>

                                        @foreach ($transactionTypes as $transactionTypeId => $transactionTypeName)
                                            <option value="{{ $transactionTypeId }}">
                                                {{ $transactionTypeName }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="p-2 text-center">
                                    @if (request()->hasAny(['head', 'user_id', 'project_id', 'expense_type_id', 'transaction_type_id']))
                                        <a href="{{ route('expenses.show', [$year, $month]) }}"
                                            class="btn btn-danger px-10 py-3">Clear</a>
                                    @else
                                        <button type="submit" class="btn btn-primary px-10 py-3">Filter</button>
                                    @endif

                                </td>
                            </form>
                        </tr>
                    </tbody>
                </table>
            </div>
            <x-validation-error />
        </div>
    </div>
</x-app-layout>
