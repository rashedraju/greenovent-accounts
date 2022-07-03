@extends('accounts.expenses.layout')

@section('content')
    <div class="col-12 col-sm-9">
        <h2 class="py-5 pr-5">{{ $data['accountsExpenseType']->name }}</h2>
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
                        @hasrole('Accounts Executive')
                            <th class="px-2 py-5">Action</th>
                        @endhasrole
                    </tr>
                </thead>
                <tbody>
                    @if (count($data['expenses']) > 0)
                        @foreach ($data['expenses'] as $expense)
                            <tr class="fw-bold">
                                <td class="px-2 py-5">{{ $loop->iteration }}</td>
                                <td class="px-2 py-5">{{ date('d-m-Y', strtotime($expense->date)) }}</a>
                                </td>
                                <td class="px-2 py-5">{{ $expense->item }}</a> </td>
                                <td class="px-2 py-5">{{ $expense->description }}</a> </td>
                                <td class="px-2 py-5">{{ number_format($expense->amount) }}</a> </td>
                                <td class="px-2 py-5">{{ $expense->transactionType->name }}</a> </td>
                                @hasrole('Accounts Executive')
                                    <td class="px-2 py-5"> <button class="btn btn-outlined-primary"
                                            id="expense_edit_btn_{{ $expense->id }}">
                                            <x-utils.edit-icon />
                                        </button>
                                    </td>
                                    <x-drawer btnId="expense_edit_btn_{{ $expense->id }}"
                                        drawerId="expense_edit_drawer_{{ $expense->id }}" title="Edit Expense">
                                        <form
                                            action="{{ route('accounts.expenses.update', ['year' => $data['year'], 'month' => $data['month'], 'accountsExpense' => $expense]) }}"
                                            method="post">
                                            @csrf
                                            @method('put')

                                            <label class="form-label mt-5 mb-0">Date</label>
                                            <input type="date" pattern="\d{4}-\d{2}-\d{2}" max="{{ $data['endDate'] }}"
                                                min="{{ $data['startDate'] }}" class="form-control" name="date"
                                                placeholder="DD-MM-YYYY" value="{{ $expense->date }}">

                                            <label class="form-label mt-5 mb-0">Expense Type
                                                <x-utils.required />
                                            </label>
                                            <select class="form-select" data-kt-select name="expense_type_id">
                                                <option></option>
                                                <option value="0" disabled selected>Select</option>
                                                @foreach ($data['expenseTypes'] as $expenseType)
                                                    <option value="{{ $expenseType->id }}"
                                                        {{ $expenseType->id == $expense->expense_type_id ? 'selected' : '' }}>
                                                        {{ $expenseType->name }}</option>
                                                @endforeach
                                            </select>

                                            <label class="form-label mt-5 mb-0">Item
                                                <x-utils.required />
                                            </label>
                                            <input type="text" class="form-control" name="item"
                                                value="{{ $expense->item }}">

                                            <label class="form-label mt-5 mb-0">Description
                                                <x-utils.required />
                                            </label>
                                            <input type="text" class="form-control" name="description"
                                                value="{{ $expense->description }}">

                                            <label class="form-label mt-5 mb-0">Amount
                                                <x-utils.required />
                                            </label>
                                            <input type="number" class="form-control" name="amount"
                                                value="{{ $expense->amount }}">

                                            <label class="form-label mt-5 mb-0">Transaction Types
                                                <x-utils.required />
                                            </label>
                                            <select class="form-select" name="transaction_type_id">
                                                <option value="0" disabled selected>Select</option>
                                                @foreach ($data['transactionTypes'] as $transactionType)
                                                    <option value="{{ $transactionType->id }}"
                                                        {{ $transactionType->id == $expense->transaction_type_id ? 'selected' : '' }}>
                                                        {{ $transactionType->name }}</option>
                                                @endforeach
                                            </select>

                                            <button type="submit" class="my-3 btn btn-primary w-100">Submit</button>
                                        </form>
                                    </x-drawer>
                                @endhasrole
                            </tr>
                        @endforeach
                        <tr class="fw-bold border border-secondary">
                            <td class="px-2 py-5 fs-2" colspan="4">Total Amount</td>
                            <td class="px-2 py-5 fs-2" colspan="7">
                                {{ number_format($data['totalExpenseByType']) }}</td>
                        </tr>
                    @else
                        <tr class="fw-bold border border-secondary">
                            <td class="px-2 py-5 fs-2 text-center" colspan="100">No records found!</td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
@endsection
