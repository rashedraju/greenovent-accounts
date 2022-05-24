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
            <h3 class="pb-5 text-center">Expense Records Month of {{ now()->month($data['month'])->format('F') }}
                - {{ $data['year'] }} </h3>

            <div class="d-flex overflow-scroll px-3 py-5">
                <div class="bg-primary p-5 record_card" style="border-radius: 2rem 0 0 0">
                    <p class="text-white">Total</p>
                    <h1 class="text-white">
                        <x-utils.currency />{{ number_format($data['total']) }}
                    </h1>
                </div>
                @foreach ($data['expenses'] as $expense)
                    <div class="bg-light p-5 text-white border border-gray-300">
                        <p class="text-gray-700">{{ $expense['name'] }}</p>
                        <h1 class="text-gray-700">
                            <x-utils.currency />{{ number_format($expense['amount']) }}
                        </h1>
                    </div>
                @endforeach

            </div>

            <div class="d-flex gap-3 justify-content-end">
                <button type="button" class="btn btn-sm my-2 px-6 py-0 btn-success" id="add_expense_drawer_btn">
                    <x-utils.add-icon /> Add New Record
                </button>
                {{-- <a href="{{ route('accounts.expenses.export', [$year, $month]) }}"
                    class="btn btn-sm my-2 px-10 py-0 btn-danger">
                    <x-utils.download /> Export
                </a> --}}
            </div>

            <x-validation-error />

            <div x-data="{ expenseType: $persist('salary') }">

                <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                    <li class="nav-item">
                        <a class="nav-link" :class="expenseType === 'salary' && 'active'" data-bs-toggle="tab"
                            href="#expense_tab_salary" x-on:click="expenseType = 'salary'"> Salary </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="expenseType === 'daily_conveyance' && 'active'"
                            data-bs-toggle="tab" href="#expense_tab_daily_conveyance"
                            x-on:click="expenseType = 'daily_conveyance'"> Daily Conveyance </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="expenseType === 'project' && 'active'" data-bs-toggle="tab"
                            href="#expense_tab_project" x-on:click="expenseType = 'project'"> Project </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="expenseType === 'loan' && 'active'" data-bs-toggle="tab"
                            href="#expense_tab_loan" x-on:click="expenseType = 'loan'"> Loan </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="expenseType === 'investment' && 'active'" data-bs-toggle="tab"
                            href="#expense_tab_investment" x-on:click="expenseType = 'investment'"> Investment </a>
                    </li>

                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade" :class="expenseType === 'salary' && 'show active'"
                        id="expense_tab_salary" role="tabpanel">
                        <x-accounts.expenses.salary :expenses="$data['expenses']['salary']['records']" :employees="$data['employees']" :transactionTypes="$data['transaction_types']" />
                    </div>

                    <div class="tab-pane fade" :class="expenseType === 'daily_conveyance' && 'show active'"
                        id="expense_tab_daily_conveyance" role="tabpanel">
                        <x-accounts.expenses.daily-conveyance :heads="$data['expenses']['daily_conveyance']['heads']" :expenses="$data['expenses']['daily_conveyance']['records']" :employees="$data['employees']"
                            :transactionTypes="$data['transaction_types']" />
                    </div>
                    <div class="tab-pane fade" :class="expenseType === 'project' && 'show active'"
                        id="expense_tab_project" role="tabpanel">
                        <x-accounts.expenses.project :heads="$data['expenses']['project']['heads']" :projects="$data['projects']" :expenses="$data['expenses']['project']['records']"
                            :employees="$data['employees']" :transactionTypes="$data['transaction_types']" />
                    </div>
                    <div class="tab-pane fade" :class="expenseType === 'loan' && 'show active'" id="expense_tab_loan"
                        role="tabpanel">
                        <x-accounts.expenses.loan :expenses="$data['expenses']['loan']['records']" :employees="$data['employees']" :transactionTypes="$data['transaction_types']" />
                    </div>
                    <div class="tab-pane fade" :class="expenseType === 'investment' && 'show active'"
                        id="expense_tab_investment" role="tabpanel">
                        <x-accounts.expenses.investment :expenses="$data['expenses']['investment']['records']" :employees="$data['employees']" :transactionTypes="$data['transaction_types']" />
                    </div>
                </div>

                <x-drawer btnId="add_expense_drawer_btn" drawerId="add_expense_drawer" title="Add new expense record">
                    <template x-if="expenseType === 'salary'">
                        <x-forms.accounts.expenses.add-salary :employees="$data['employees']" :transactionTypes="$data['transaction_types']" :startDate="$data['start_date']"
                            :endDate="$data['end_date']" />
                    </template>
                    <template x-if="expenseType === 'daily_conveyance'">
                        <x-forms.accounts.expenses.add-daily-conveyance :heads="$data['expenses']['daily_conveyance']['heads']" :employees="$data['employees']"
                            :transactionTypes="$data['transaction_types']" :startDate="$data['start_date']" :endDate="$data['end_date']" />
                    </template>
                    <template x-if="expenseType === 'project'">
                        <x-forms.accounts.expenses.add-project :heads="$data['expenses']['project']['heads']" :projects="$data['projects']" :employees="$data['employees']"
                            :transactionTypes="$data['transaction_types']" :startDate="$data['start_date']" :endDate="$data['end_date']" />
                    </template>
                    <template x-if="expenseType === 'loan'">
                        <x-forms.accounts.expenses.add-loan :employees="$data['employees']" :transactionTypes="$data['transaction_types']" :startDate="$data['start_date']"
                            :endDate="$data['end_date']" />
                    </template>
                    <template x-if="expenseType === 'investment'">
                        <x-forms.accounts.expenses.add-investment :employees="$data['employees']" :transactionTypes="$data['transaction_types']"
                            :startDate="$data['start_date']" :endDate="$data['end_date']" />
                    </template>
                </x-drawer>
            </div>
        </div>
    </div>
</x-app-layout>