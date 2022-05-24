<x-app-layout>
    <div class="p-2 py-5">
        <h1 class="text-center">Accounts</h1>
    </div>

    <x-accounts-navigation />

    <div class="card mt-3">
        <div class="card-body py-4">
            <h3 class="pb-5 text-center">Credit Records Month of {{ now()->month($data['month'])->format('F') }}
                - {{ $data['year'] }} </h3>

            <div class="d-flex overflow-scroll px-3 py-5">
                <div class="bg-primary p-5 record_card" style="border-radius: 2rem 0 0 0">
                    <p class="text-white">Total</p>
                    <h1 class="text-white">
                        <x-utils.currency />{{ number_format($data['total']) }}
                    </h1>
                </div>
                @foreach ($data['credits'] as $credit)
                    <div class="bg-light p-5 text-white border border-gray-300">
                        <p class="text-gray-700">{{ $credit['name'] }}</p>
                        <h1 class="text-gray-700">
                            <x-utils.currency />{{ number_format($credit['amount']) }}
                        </h1>
                    </div>
                @endforeach

            </div>

            <div class="d-flex gap-3 justify-content-end">
                <button type="button" class="btn btn-sm my-2 px-6 py-0 btn-success" id="add_credit_drawer_btn">
                    <x-utils.add-icon /> Add New Record
                </button>
                {{-- <a href="{{ route('accounts.expenses.export', [$year, $month]) }}"
                    class="btn btn-sm my-2 px-10 py-0 btn-danger">
                    <x-utils.download /> Export
                </a> --}}
            </div>

            <x-validation-error />

            <div x-data="{ creditType: $persist('project') }">

                <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                    <li class="nav-item">
                        <a class="nav-link" :class="creditType === 'project' && 'active'" data-bs-toggle="tab"
                            href="#credit_tab_project" x-on:click="creditType = 'project'"> Project </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="creditType === 'loan' && 'active'" data-bs-toggle="tab"
                            href="#credit_tab_loan" x-on:click="creditType = 'loan'"> Loan </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="creditType === 'investment' && 'active'" data-bs-toggle="tab"
                            href="#credit_tab_investment" x-on:click="creditType = 'investment'"> Investment </a>
                    </li>

                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade" :class="creditType === 'project' && 'show active'"
                        id="credit_tab_project" role="tabpanel">
                        <div class="my-2">
                            <form
                                action="{{ route('accounts.credits.show.year.month', [$data['year'], $data['month']]) }}"
                                method="get" class="d-inline-flex gap-3">
                                @csrf

                                <input type="text" class="form-control" name="head" list="heads" placeholder="Head">
                                <datalist id="heads">
                                    @foreach ($data['credits']['project']['heads'] as $head)
                                        <option value="{{ $head }}">
                                    @endforeach
                                </datalist>

                                <select class="form-select py-0" name="project_id">
                                    <option value="0" disabled selected>Project Name</option>
                                    @foreach ($data['projects'] as $projectId => $projectName)
                                        <option value="{{ $projectId }}">
                                            {{ $projectName }}</option>
                                    @endforeach
                                </select>

                                <button type="submit" class="my-3 btn btn-primary w-100">Filter</button>
                                <a href="{{ route('accounts.credits.show.year.month', [$data['year'], $data['month']]) }}"
                                    class="my-3 btn btn-secondary w-100">Clear</a>
                            </form>
                        </div>
                        <x-accounts.credits.project :heads="$data['credits']['project']['heads']" :projects="$data['projects']" :credits="$data['credits']['project']['records']"
                            :employees="$data['employees']" :transactionTypes="$data['transaction_types']" />
                    </div>
                    <div class="tab-pane fade" :class="creditType === 'loan' && 'show active'" id="credit_tab_loan"
                        role="tabpanel">
                        <div class="my-2">
                            <form
                                action="{{ route('accounts.credits.show.year.month', [$data['year'], $data['month']]) }}"
                                method="get" class="d-inline-flex gap-3">
                                @csrf

                                <input type="text" class="form-control" name="loan_provider" list="loan_providers"
                                    placeholder="Loan Provider">
                                <datalist id="loan_providers">
                                    @foreach ($data['loan_providers'] as $loanProvider)
                                        <option value="{{ $loanProvider }}">
                                    @endforeach
                                </datalist>

                                <button type="submit" class="my-3 btn btn-primary w-100">Filter</button>
                                <a href="{{ route('accounts.credits.show.year.month', [$data['year'], $data['month']]) }}"
                                    class="my-3 btn btn-secondary w-100">Clear</a>
                            </form>
                        </div>
                        <x-accounts.credits.loan :credits="$data['credits']['loan']['records']" :employees="$data['employees']" :transactionTypes="$data['transaction_types']" />
                    </div>
                    <div class="tab-pane fade" :class="creditType === 'investment' && 'show active'"
                        id="credit_tab_investment" role="tabpanel">
                        <div class="my-2">
                            <form
                                action="{{ route('accounts.credits.show.year.month', [$data['year'], $data['month']]) }}"
                                method="get" class="d-inline-flex gap-3">
                                @csrf

                                <input type="text" class="form-control" name="company_name" list="company_names"
                                    placeholder="Company Name">
                                <datalist id="company_names">
                                    @foreach ($data['company_names'] as $compnay)
                                        <option value="{{ $compnay }}">
                                    @endforeach
                                </datalist>

                                <button type="submit" class="my-3 btn btn-primary w-100">Filter</button>
                                <a href="{{ route('accounts.credits.show.year.month', [$data['year'], $data['month']]) }}"
                                    class="my-3 btn btn-secondary w-100">Clear</a>

                            </form>
                        </div>
                        <x-accounts.credits.investment :credits="$data['credits']['investment']['records']" :employees="$data['employees']" :transactionTypes="$data['transaction_types']" />
                    </div>
                </div>

                <x-drawer btnId="add_credit_drawer_btn" drawerId="add_credit_drawer" title="Add new credit record">
                    <template x-if="creditType === 'project'">
                        <x-forms.accounts.credits.add-project :heads="$data['credits']['project']['heads']" :projects="$data['projects']" :employees="$data['employees']"
                            :transactionTypes="$data['transaction_types']" :startDate="$data['start_date']" :endDate="$data['end_date']" />
                    </template>
                    <template x-if="creditType === 'loan'">
                        <x-forms.accounts.credits.add-loan :employees="$data['employees']" :transactionTypes="$data['transaction_types']" :startDate="$data['start_date']"
                            :endDate="$data['end_date']" />
                    </template>
                    <template x-if="creditType === 'investment'">
                        <x-forms.accounts.credits.add-investment :employees="$data['employees']" :transactionTypes="$data['transaction_types']"
                            :startDate="$data['start_date']" :endDate="$data['end_date']" />
                    </template>
                </x-drawer>
            </div>
        </div>
    </div>
</x-app-layout>
