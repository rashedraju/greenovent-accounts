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
            <h3 class="pb-5 text-center">Expense Records Month of
                {{ now()->year($data['year'])->month($data['month'])->format('F') }}
                - {{ $data['year'] }} </h3>

            <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#expense_tab_salary"> Salary </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#expense_tab_daily_conveyance"> Daily Conveyance
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#expense_tab_project"> Project </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#expense_tab_loan"> Loan </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#expense_tab_investment"> Investment </a>
                </li>

            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="expense_tab_salary" role="tabpanel">
                    <x-accounts.expenses.salary :expenses="$data['expenses']['salary']['records']" :employees="$data['employees']" :transactionTypes="$data['transaction_types']"
                        :editable="false" />
                </div>

                <div class="tab-pane fade" id="expense_tab_daily_conveyance" role="tabpanel">
                    <x-accounts.expenses.daily-conveyance :expenses="$data['expenses']['daily_conveyance']['records']" :employees="$data['employees']" :transactionTypes="$data['transaction_types']"
                        :editable="false" />
                </div>
                <div class="tab-pane fade" id="expense_tab_project" role="tabpanel">
                    <x-accounts.expenses.project :projects="$data['projects']" :expenses="$data['expenses']['project']['records']" :employees="$data['employees']"
                        :transactionTypes="$data['transaction_types']" :editable="false" />
                </div>
                <div class="tab-pane fade" id="expense_tab_loan" role="tabpanel">
                    <x-accounts.expenses.loan :expenses="$data['expenses']['loan']['records']" :employees="$data['employees']" :transactionTypes="$data['transaction_types']" :editable="false" />
                </div>
                <div class="tab-pane fade" id="expense_tab_investment" role="tabpanel">
                    <x-accounts.expenses.investment :expenses="$data['expenses']['investment']['records']" :employees="$data['employees']" :transactionTypes="$data['transaction_types']" :editable="false" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
