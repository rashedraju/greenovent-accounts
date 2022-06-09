<x-app-layout>
    <div class="p-1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4 active"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                <li class="breadcrumb-item fs-4 active"><a
                        href="{{ route('accounts.show.year', $data['year']) }}">{{ $data['year'] }}</a></li>
                <li class="breadcrumb-item fs-4">Expenses</li>
                <li class="breadcrumb-item fs-4"> Salary</li>
            </ol>
        </nav>
    </div>
    <div class="card mt-3">
        <div class="card-body py-4">
            <h3 class="pb-5 text-center">
                {{ now()->month($data['month'])->format('F') }} - {{ $data['year'] }}
            </h3>

            <x-accounts-navigation :year="$data['year']" :month="$data['month']" />
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <x-validation-error />
            <div class="d-flex gap-3 justify-content-end">
                <button type="button" class="btn btn-sm my-2 px-6 py-0 btn-success" id="add_salary_expense_btn">
                    <x-utils.add-icon /> Add Salary Expense
                </button>
            </div>
            <x-accounts.expenses.salary :expenses="$data['expenses']['records']" :employees="$data['employees']" :transactionTypes="$data['transaction_types']" :year="$data['year']"
                :month="$data['month']" />

            <x-drawer btnId="add_salary_expense_btn" drawerId="add_salary_expense_drawer"
                title="Add new salary expense">
                <x-forms.accounts.expenses.add-salary :employees="$data['employees']" :transactionTypes="$data['transaction_types']" :startDate="$data['start_date']"
                    :endDate="$data['end_date']" :year="$data['year']" :month="$data['month']" />
            </x-drawer>
        </div>
    </div>
</x-app-layout>
