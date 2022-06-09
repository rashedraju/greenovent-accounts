@props(['expenses', 'employees', 'transactionTypes', 'editable' => true, 'year', 'month'])
<div class="table-responsive">
    <table class="table table-secondary table-striped">
        <thead>
            <tr class="fw-bolder fs-6">
                <th class="px-2 py-5">SL</th>
                <th class="px-2 py-5">Date</th>
                <th class="px-2 py-5">Employee Name</th>
                <th class="px-2 py-5">Amount</th>
                <th class="px-2 py-5">Transaction Type</th>
                @if ($editable)
                    <th class="px-2 py-5=">Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $expense)
                <tr class="fw-bold">
                    <td class="px-2 py-5">{{ $loop->iteration }}</td>
                    <td class="px-2 py-5">{{ date('d-m-Y', strtotime($expense->date)) }}</a> </td>
                    <td class="px-2 py-5">{{ $expense->user->name }}</a> </td>
                    <td class="px-2 py-5">{{ number_format($expense->amount) }}</a> </td>
                    <td class="px-2 py-5">{{ $expense->transactionType->name }}</a> </td>
                    @if ($editable)
                        <td class="px-2 py-5">
                            <div class="d-flex gap-3 cursor-pointer">
                                <div id="edit_salary_drawer_btn_{{ $loop->iteration }}">
                                    <x-utils.edit-icon />
                                </div>
                                <div id="delete_salary_drawer_btn_{{ $loop->iteration }}">
                                    <x-utils.delete-icon />
                                </div>
                            </div>
                        </td>
                    @endif
                </tr>
                @if ($editable)
                    <x-drawer btnId="edit_salary_drawer_btn_{{ $loop->iteration }}"
                        drawerId="edit_expense_drawer_{{ $loop->iteration }}" title="Edit Salary expense record">
                        <x-forms.accounts.expenses.edit-salary :expense="$expense" :employees="$employees" :transactionTypes="$transactionTypes"
                            :year="$year" :month="$month" />
                    </x-drawer>

                    <x-drawer btnId="delete_salary_drawer_btn_{{ $loop->iteration }}"
                        drawerId="delete_salary_drawer_{{ $loop->iteration }}" title="Delete Record">
                        <form method="post"
                            action="{{ route('accounts.expenses.salary.delete', ['year' => $year, 'month' => $month, 'salaryExpense' => $expense]) }}">
                            @csrf
                            @method('delete')
                            <h2 class="mb-3">Are you sure you want to delete this?</h2>

                            <div class="d-flex my-3 gap-3">
                                <button type="button" class="btn btn-sm btn-light w-100"
                                    data-kt-drawer-dismiss="true">Cancel</button>
                                <button type="submit" class="btn btn-sm btn-danger w-100">Delete</button>
                            </div>
                        </form>
                    </x-drawer>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
