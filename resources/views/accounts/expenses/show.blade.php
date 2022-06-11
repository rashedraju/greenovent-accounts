<x-app-layout>
    <div class="p-1 mt-sm-1 mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4 active"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                <li class="breadcrumb-item fs-4 active"><a
                        href="{{ route('accounts.show.year', $data['year']) }}">{{ $data['year'] }}</a></li>
                <li class="breadcrumb-item fs-4"><a
                        href="{{ route('accounts.show.year.month', ['year' => $data['year'], 'month' => $data['year']]) }}">{{ now()->month($data['month'])->format('F') }}</a>
                </li>
                <li class="breadcrumb-item fs-4 active"><a
                        href="{{ route('accounts.expenses.index', ['year' => $data['year'], 'month' => $data['month']]) }}">Expenses</a>
                </li>
            </ol>
        </nav>
    </div>

    <x-accounts-navigation :year="$data['year']" :month="$data['month']" />

    <div class="card mt-3">
        <div class="row">
            <div class="col-12 col-sm-3">
                <div class="row style=" style="margin-left: 0">
                    <div class="col-2 px-2 py-5 border border-secondary flex-grow-1 fs-2">Descriptoin</div>
                    <div class="col-1 px-2 py-5 border border-secondary flex-grow-1 fs-2">Amount</div>
                </div>
                @foreach ($data['expenseTypes'] as $expenseType)
                    <a href="{{ route('accounts.expenses.show', ['year' => $data['year'], 'month' => $data['month'], 'accountsExpenseType' => $expenseType->id]) }}"
                        class="row bg-hover-secondary" style="margin-left: 0">
                        <div class="col-2 px-2 py-5 border border-secondary flex-grow-1">{{ $expenseType->name }}
                        </div>
                        <div class="col-1 px-2 py-5 border border-secondary flex-grow-1">
                            {{ number_format($expenseType->expenses->sum(fn($item) => $item->amount)) }}</div>
                    </a>
                @endforeach
                <div class="row style=" style="margin-left: 0">
                    <div class="col-2 px-2 py-5 border border-secondary flex-grow-1 fs-2">Total Expense</div>
                    <div class="col-1 px-2 py-5 border border-secondary flex-grow-1 fs-2">
                        {{ number_format($data['totalExpense']) }}</div>
                </div>
            </div>
            <div class="col-12 col-sm-9">
                <div class="d-flex justify-content-between border border-bottom">
                    <h3 class="text-center p-3">{{ $data['accountsExpenseType']->name }}</h3>
                    <button type="button" class="btn btn-sm my-2 px-6 py-0 btn-success" id="add_expense_drawer_btn">
                        <x-utils.add-icon /> Add Expense
                    </button>
                </div>

                <x-validation-error />

                <div class="table-responsive">
                    <table class="table table-secondary table-striped">
                        <thead>
                            <tr class="fw-bolder fs-6">
                                <th class="px-2 py-5">SL</th>
                                <th class="px-2 py-5">Date</th>
                                <th class="px-2 py-5">Item</th>
                                <th class="px-2 py-5">Description</th>
                                <th class="px-2 py-5">Amount</th>
                                <th class="px-2 py-5">Transaction Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['expenses'] as $expense)
                                <tr class="fw-bold">
                                    <td class="px-2 py-5">{{ $loop->iteration }}</td>
                                    <td class="px-2 py-5">{{ date('d-m-Y', strtotime($expense->date)) }}</a>
                                    </td>
                                    <td class="px-2 py-5">{{ $expense->item }}</a> </td>
                                    <td class="px-2 py-5">{{ $expense->description }}</a> </td>
                                    <td class="px-2 py-5">{{ number_format($expense->amount) }}</a> </td>
                                    <td class="px-2 py-5">{{ $expense->transactionType->name }}</a> </td>
                                </tr>
                            @endforeach
                            <tr class="fw-bold border border-secondary">
                                <td class="px-2 py-5 fs-2" colspan="4">Total Amount</td>
                                <td class="px-2 py-5 fs-2" colspan="6">
                                    {{ number_format($data['totalExpenseByType']) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-drawer btnId="add_expense_drawer_btn" drawerId="add_expense_drawer" title="Add Expense">
        <form action="{{ route('accounts.expenses.store', ['year' => $data['year'], 'month' => $data['month']]) }}"
            method="post">
            @csrf

            <label class="form-label mt-5 mb-0">Date
                <x-utils.required />
            </label>
            <input type="date" pattern="\d{4}-\d{2}-\d{2}" max="{{ $data['endDate'] }}"
                min="{{ $data['startDate'] }}" class="form-control" name="date" placeholder="DD-MM-YYYY"
                :value="old('date')">

            <label class="form-label mt-5 mb-0">Expense Type
                <x-utils.required />
            </label>
            <select class="form-select" data-kt-select name="expense_type_id">
                <option></option>
                <option value="0" disabled selected>Select</option>
                @foreach ($data['expenseTypes'] as $expenseType)
                    <option value="{{ $expenseType->id }}"
                        {{ $expenseType->id == old('expense_type_id') ? 'selected' : '' }}>
                        {{ $expenseType->name }}</option>
                @endforeach
            </select>

            <label class="form-label mt-5 mb-0">Item
                <x-utils.required />
            </label>
            <input type="text" class="form-control" name="item" :value="old('item')">

            <label class="form-label mt-5 mb-0">Description
                <x-utils.required />
            </label>
            <input type="text" class="form-control" name="description" :value="old('description')">

            <label class="form-label mt-5 mb-0">Amount
                <x-utils.required />
            </label>
            <input type="number" class="form-control" name="amount" :value="old('amount')">

            <label class="form-label mt-5 mb-0">Transaction Types
                <x-utils.required />
            </label>
            <select class="form-select" name="transaction_type_id">
                <option value="0" disabled selected>Select</option>
                @foreach ($data['transactionTypes'] as $transactionType)
                    <option value="{{ $transactionType->id }}"
                        {{ $transactionType->id == old('transaction_type_id') ? 'selected' : '' }}>
                        {{ $transactionType->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="my-3 btn btn-primary w-100">Submit</button>
        </form>


    </x-drawer>

</x-app-layout>
