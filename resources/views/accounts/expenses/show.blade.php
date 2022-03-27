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
            <h3 class="pb-5 text-center">Expense Records Month of {{ now()->year($year)->month($month)->format('F') }}
                - {{ $year }} </h3>

            {{-- Import and Export excel file --}}

            <div class="d-flex gap-3 justify-content-end">
                <button type="button" class="btn btn-sm my-2 px-6 py-0 btn-success" data-bs-toggle="modal"
                    data-bs-target="#add_debit">
                    <x-utils.add-icon /> Add
                </button>
                <a href="{{ route('accounts.expenses.export', [$year, $month]) }}"
                    class="btn btn-sm my-2 px-10 py-0 btn-danger">
                    <x-utils.download /> Export
                </a>
            </div>

            <table class="table table-bordered table-responsive">
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
                        <th class="px-2">Note</th>
                        <th class="px-2">Action</th>
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
                            <td class="px-2">{{ $expense->note }}</td>

                            <td>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-sm bg-transparent text-warning p-0 m-0"
                                        data-bs-toggle="modal" data-bs-target="#edit_expense_{{ $expense->id }}">
                                        <x-utils.edit-icon />
                                    </button>

                                    <button type="submit" class="btn btn-sm bg-transparent p-0 m-0"
                                        data-bs-toggle="modal" data-bs-target="#delete_expense_{{ $expense->id }}">
                                        <x-utils.delete-icon />
                                    </button>
                                </div>
                            </td>

                            <div class="modal fade" tabindex="-1" id="edit_expense_{{ $expense->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">#{{ $expense->id }}: {{ $expense->head }}
                                            </h5>
                                        </div>

                                        <div class="modal-body">
                                            <form action="{{ route('accounts.expenses.update', $expense) }}"
                                                method="post">
                                                @csrf
                                                @method('put')

                                                <label class="form-label">Head</label>
                                                <input type="text" class="form-control" name="head"
                                                    value="{{ $expense->head }}">

                                                <label class="form-label mt-2 mb-0">Date</label>
                                                <input type="text" class="form-control" name="date"
                                                    value="{{ $expense->date }}">

                                                <label class="form-label mt-2 mb-0">Billing Person</label>
                                                <select class="form-select" name="user_id">
                                                    @foreach ($billingPersons as $billingPersonId => $billingPersonName)
                                                        <option value="{{ $billingPersonId }}"
                                                            {{ $billingPersonId == $expense->user_id ? 'selected' : '' }}>
                                                            {{ $billingPersonName }}</option>
                                                    @endforeach
                                                </select>

                                                <label class="form-label mt-2 mb-0">Project Name</label>
                                                <select class="form-select" name="project_id">
                                                    @foreach ($projects as $projectId => $projectName)
                                                        <option value="{{ $projectId }}"
                                                            {{ $projectId == $expense->project_id ? 'selected' : '' }}>
                                                            {{ $projectName }}</option>
                                                    @endforeach
                                                </select>

                                                <label class="form-label mt-2 mb-0">Description</label>
                                                <input type="text" class="form-control" name="description"
                                                    value="{{ $expense->description }}">

                                                <label class="form-label mt-2 mb-0">Expense Type</label>
                                                <select class="form-select" name="expense_type_id">
                                                    @foreach ($expenseTypes as $expenseTypeId => $expenseTypeName)
                                                        <option value="{{ $expenseTypeId }}"
                                                            {{ $expenseTypeId == $expense->expense_type_id ? 'selected' : '' }}>
                                                            {{ $expenseTypeName }}</option>
                                                    @endforeach
                                                </select>

                                                <label class="form-label mt-2 mb-0">Transaction Type</label>
                                                <select class="form-select" name="transaction_type_id">
                                                    @foreach ($transactionTypes as $transactionTypeId => $transactionTypeName)
                                                        <option value="{{ $transactionTypeId }}"
                                                            {{ $transactionTypeId == $expense->transaction_type_id ? 'selected' : '' }}>
                                                            {{ $transactionTypeName }}</option>
                                                    @endforeach
                                                </select>

                                                <label class="form-label mt-2 mb-0">Amount</label>
                                                <input type="number" class="form-control" name="amount"
                                                    value="{{ $expense->amount }}">

                                                <label class="form-label mt-2 mb-0">Note</label>
                                                <textarea type="text" class="form-control" name="note" rows="1"> {{ $expense->note }} </textarea>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save
                                                        changes</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" tabindex="-1" id="delete_expense_{{ $expense->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Are you sure?</h5>
                                        </div>

                                        <div class="modal-body">
                                            <form action="{{ route('accounts.expenses.delete', $expense) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')

                                                <p>Are you sure you want to delete this expense record? You can not
                                                    get
                                                    back this data if you delete.</p>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Delete</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
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
                        <td></td>
                    </tr>
                    <tr>
                        <form action="{{ route('accounts.expenses.show', [$year, $month]) }}" method="GET">
                            <td></td>
                            <td>
                                <input type="text" class="form-control" name="head" list="expenseHeadLists">
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
                                    <a href="{{ route('accounts.expenses.show', [$year, $month]) }}"
                                        class="btn btn-danger px-10 py-3">Clear</a>
                                @else
                                    <button type="submit" class="btn btn-primary px-10 py-3">Filter</button>
                                @endif

                            </td>
                        </form>
                    </tr>
                </tbody>
            </table>

            <x-validation-error />
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="add_debit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new expense record</h5>
                </div>

                <div class="modal-body">
                    <form action="{{ route('accounts.expenses.store') }}" method="post">
                        @csrf

                        <label class="form-label mt-2 mb-0">Date</label>
                        <input type="text" class="form-control" name="date" placeholder="YYYY-MM-DD">

                        <label class="form-label mt-2 mb-0">Head</label>
                        <input type="text" class="form-control" name="head">

                        <label class="form-label mt-2 mb-0">Billing Person</label>
                        <select class="form-select" name="user_id">
                            <option value="0" disabled selected>Select</option>
                            @foreach ($billingPersons as $billingPersonId => $billingPersonName)
                                <option value="{{ $billingPersonId }}">
                                    {{ $billingPersonName }}</option>
                            @endforeach
                        </select>

                        <label class="form-label mt-2 mb-0">Project Name</label>
                        <select class="form-select" name="project_id">
                            <option value="0" disabled selected>Select</option>
                            @foreach ($projects as $projectId => $projectName)
                                <option value="{{ $projectId }}">
                                    {{ $projectName }}</option>
                            @endforeach
                        </select>

                        <label class="form-label mt-2 mb-0">Description</label>
                        <input type="text" class="form-control" name="description">

                        <label class="form-label mt-2 mb-0">Expense Type</label>
                        <select class="form-select" name="expense_type_id">
                            <option value="0" disabled selected>Select</option>
                            @foreach ($expenseTypes as $expenseTypeId => $expenseTypeName)
                                <option value="{{ $expenseTypeId }}">
                                    {{ $expenseTypeName }}</option>
                            @endforeach
                        </select>

                        <label class="form-label mt-2 mb-0">Transaction Type</label>
                        <select class="form-select" name="transaction_type_id">
                            <option value="0" disabled selected>Select</option>
                            @foreach ($transactionTypes as $transactionTypeId => $transactionTypeName)
                                <option value="{{ $transactionTypeId }}">
                                    {{ $transactionTypeName }}</option>
                            @endforeach
                        </select>

                        <label class="form-label mt-2 mb-0">Amount</label>
                        <input type="number" class="form-control" name="amount">

                        <label class="form-label mt-2 mb-0">Note</label>
                        <textarea type="text" class="form-control" name="note" rows="1"> </textarea>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

</x-app-layout>
