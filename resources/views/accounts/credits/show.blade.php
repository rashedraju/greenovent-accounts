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
            <h3 class="pb-5 text-center">Credit Records Month of {{ now()->year($year)->month($month)->format('F') }}
                - {{ $year }} </h3>

            {{-- Import and Export excel file --}}
            <div class="d-flex gap-3 justify-content-end">
                <a href="{{ route('accounts.credits.export', [$year, $month]) }}"
                    class="btn btn-sm my-2 px-10 py-0 btn-danger">
                    <x-utils.download /> Export
                </a>
            </div>
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr class="fw-bolder fs-6 bg-gray-300 text-dark border border-dark">
                        <th class="px-2">#</th>
                        <th class="px-2">Date</th>
                        <th class="px-2">Received by</th>
                        <th class="px-2">Category</th>
                        <th class="px-2">Project Name</th>
                        <th class="px-2">Loan Lender</th>
                        <th class="px-2">Investor</th>
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
                    @foreach ($creditRecords as $credit)
                        <tr class="border border-dark fw-bold">
                            <td class="p-2">{{ $loop->iteration }}</td>
                            <td class="px-2">{{ $credit->date }}</td>
                            <td class="px-2">{{ $credit->receivedPerson->name }}</td>
                            <td class="px-2">{{ $credit->category->name }}</td>
                            <td class="px-2">{{ $credit->project->name ?? '--' }}</td>
                            <td class="px-2"> {{ $credit->loanLender->name ?? '--' }} </td>
                            <td class="px-2"> {{ $credit->investor->name ?? '--' }} </td>
                            <td class="px-2">{{ $credit->transactionType->name }}</td>
                            <td class="px-2">{{ number_format($credit->amount) }}</td>
                            <td class="px-2"> <span class="text-white p-1 rounded"
                                    style="background: {{ $credit->aproval->status->color }}">
                                    {{ $credit->aproval->status->name }} </span> </td>
                            <td class="px-2">{{ $credit->modified }}</td>
                            <td class="px-2">{{ $credit->note }}</td>

                            <td>
                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm d-flex"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <x-utils.down-arrow />
                                </a>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                    data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <button type="submit" class="menu-link px-3 border-0 w-100 bg-transparent"
                                            data-bs-toggle="modal"
                                            data-bs-target="#edit_credit_{{ $credit->id }}">Edit</button>
                                    </div>
                                    <div class="menu-item px-3">
                                        <form action="{{ route('accounts.credits.delete', $credit) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="menu-link px-3 border-0 w-100 bg-transparent">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>

                            <div class="modal fade" tabindex="-1" id="edit_credit_{{ $credit->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit: #{{ $credit->id }}
                                            </h5>
                                        </div>

                                        <div class="modal-body">
                                            <form action="{{ route('accounts.credits.update', $credit) }}"
                                                method="post">
                                                @csrf
                                                @method('put')

                                                <label class="form-label mt-2 mb-0">Date</label>
                                                <input type="text" class="form-control" name="date"
                                                    value="{{ $credit->date }}">

                                                <label class="form-label mt-2 mb-0">Received by</label>
                                                <select class="form-select" name="user_id">
                                                    @foreach ($receivedPersons as $receivedPersonId => $receivedPersonName)
                                                        <option value="{{ $receivedPersonId }}"
                                                            {{ $receivedPersonId == $credit->user_id ? 'selected' : '' }}>
                                                            {{ $receivedPersonName }}</option>
                                                    @endforeach
                                                </select>

                                                <label class="form-label mt-2 mb-0">Project Name</label>
                                                <select class="form-select" name="project_id">
                                                    @foreach ($projects as $projectId => $projectName)
                                                        <option value="{{ $projectId }}"
                                                            {{ $projectId == $credit->project_id ? 'selected' : '' }}>
                                                            {{ $projectName }}</option>
                                                    @endforeach
                                                </select>

                                                <label class="form-label mt-2 mb-0">Transaction Type</label>
                                                <select class="form-select" name="transaction_type_id">
                                                    @foreach ($transactionTypes as $transactionTypeId => $transactionTypeName)
                                                        <option value="{{ $transactionTypeId }}"
                                                            {{ $transactionTypeId == $credit->transaction_type_id ? 'selected' : '' }}>
                                                            {{ $transactionTypeName }}</option>
                                                    @endforeach
                                                </select>

                                                <label class="form-label mt-2 mb-0">Amount</label>
                                                <input type="number" class="form-control" name="amount"
                                                    value="{{ $credit->amount }}">

                                                <label class="form-label mt-2 mb-0">Note</label>
                                                <textarea type="text" class="form-control" name="note" rows="1"> {{ $credit->note }} </textarea>

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
                        <td> Total: <strong> {{ number_format($totalCreditsOfThisMonth) }} </strong> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <form action="{{ route('accounts.credits.show', [$year, $month]) }}" method="GET">
                            <td></td>
                            <td></td>
                            <td>
                                <select class="form-select" name="user_id" data-control="select2"
                                    data-placeholder="Select">
                                    <option></option>
                                    @foreach ($receivedPersonsOfThisMonth as $receivedPersonOfThisMonthId => $receivedPersonOfThisMonthName)
                                        <option value="{{ $receivedPersonOfThisMonthId }}">
                                            {{ $receivedPersonOfThisMonthName }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-select" name="category_id" data-control="select2"
                                    data-placeholder="Select">
                                    <option></option>
                                    @foreach ($creditCategories as $creditCategoryId => $creditCategoryName)
                                        <option value="{{ $creditCategoryId }}">
                                            {{ $creditCategoryName }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-select" name="project_id" data-control="select2"
                                    data-placeholder="Select">
                                    <option></option>
                                    @foreach ($projectsOfThisMonth as $projectsOfThisMonthId => $projectsOfThisMonthName)
                                        <option value="{{ $projectsOfThisMonthId }}">
                                            {{ $projectsOfThisMonthName }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="loan_lender_id" class="form-select" data-control="select2"
                                    data-placeholder="Select">
                                    <option></option>

                                    @foreach ($loanLenders as $loanLenderId => $loanLenderName)
                                        <option value="{{ $loanLenderId }}">
                                            {{ $loanLenderName }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="investor_id" class="form-select" data-control="select2"
                                    data-placeholder="Select">
                                    <option></option>

                                    @foreach ($companyInvestors as $companyInvestorId => $companyInvestorName)
                                        <option value="{{ $companyInvestorId }}">
                                            {{ $companyInvestorName }}
                                        </option>
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
                                @if (request()->hasAny(['year', 'month', 'user_id', 'project_id', 'transaction_type_id']))
                                    <a href="{{ route('accounts.credits.show', [$year, $month]) }}"
                                        class="btn btn-danger px-10 py-3">Clear</a>
                                @else
                                    <button type="submit" class="btn btn-primary px-10 py-3">Filter</button>
                                @endif

                            </td>
                        </form>
                    </tr>

                    <tr>
                        <form action="{{ route('accounts.credits.store') }}" method="post" class="d-flex gap-1">
                            @csrf
                            <td class="p-2"></td>
                            <td class="p-2">
                                <input type="text" class="form-control" name="date" placeholder="YYYY-MM-DD">
                            </td>
                            <td class="p-2">
                                <select class="form-select" name="user_id" data-control="select2"
                                    data-placeholder="Select">
                                    <option></option>
                                    @foreach ($receivedPersons as $receivedPersonId => $receivedPersonName)
                                        <option value="{{ $receivedPersonId }}">
                                            {{ $receivedPersonName }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="p-2">
                                <select class="form-select" name="category_id" data-control="select2"
                                    data-placeholder="Select" onChange="creditCategoryChangeHandler(event)">
                                    <option></option>
                                    @foreach ($creditCategories as $creditCategoryId => $creditCategoryName)
                                        <option value="{{ $creditCategoryId }}">
                                            {{ $creditCategoryName }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="p-2">
                                <div id="projectSelectWrapper">
                                    <div id="projectSelect">
                                        <select class="form-select" name="project_id" data-control="select2"
                                            data-placeholder="Select">
                                            <option></option>
                                            @foreach ($projects as $projectId => $projectName)
                                                <option value="{{ $projectId }}">
                                                    {{ $projectName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </td>
                            
                            <td>
                                <div id="loanLenderSelectWrapper">
                                    <div id="loanLenderSelect">
                                        <select name="loan_lender_id" class="form-select" data-control="select2"
                                            data-placeholder="Select">
                                            <option></option>

                                            @foreach ($loanLenders as $loanLenderId => $loanLenderName)
                                                <option value="{{ $loanLenderId }}">
                                                    {{ $loanLenderName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div id="investorSelectWrapper">
                                    <div id="investorSelect">
                                        <select name="investor_id" class="form-select" data-control="select2"
                                            data-placeholder="Select">
                                            <option></option>

                                            @foreach ($companyInvestors as $companyInvestorId => $companyInvestorName)
                                                <option value="{{ $companyInvestorId }}">
                                                    {{ $companyInvestorName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td class="p-2">
                                <select name="transaction_type_id" class="form-select" data-control="select2"
                                    data-placeholder="Select">
                                    <option></option>
                                    @foreach ($transactionTypes as $transactionTypeId => $transactionTypeName)
                                        <option value="{{ $transactionTypeId }}">
                                            {{ $transactionTypeName }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td class="p-2">
                                <input type="number" class="form-control" name="amount">
                            </td>
                            <td class="p-2">
                                --
                            </td>
                            <td class="p-2">
                                --
                            </td>
                            <td class="p-2">
                                <textarea type="text" class="form-control" name="note" rows="1"> </textarea>
                            </td>

                            <td class="p-2 text-center">
                                <button type="submit" class="btn btn-success px-10 py-3">Add</button>
                            </td>
                        </form>
                    </tr>
                </tbody>
            </table>

            <x-validation-error />
        </div>
    </div>

    <x-slot name="script">
        <script>
            // change project/loan lender/investor based on selected category
            var projectSelectWrapper = document.getElementById("projectSelectWrapper");
            var loanLenderSelectWrapper = document.getElementById("loanLenderSelectWrapper");
            var investorSelectWrapper = document.getElementById("investorSelectWrapper");

            var projectSelect = document.getElementById("projectSelect");
            var loanLenderSelect = document.getElementById("loanLenderSelect");
            var investorSelect = document.getElementById("investorSelect");

            // replace selector wrapper child with empty div
            // create empty node
            var emptyNode1 = document.createElement('div');
            emptyNode1.innerHTML = '--';
            var emptyNode2 = document.createElement('div');
            emptyNode2.innerHTML = '--';
            var emptyNode3 = document.createElement('div');
            emptyNode3.innerHTML = '--';

            // replace with new child
            projectSelectWrapper.replaceChildren(emptyNode1);
            loanLenderSelectWrapper.replaceChildren(emptyNode2);
            investorSelectWrapper.replaceChildren(emptyNode3);

            // change slected wrapper child when category change
            function creditCategoryChangeHandler(event) {
                var value = event.target.options[event.target.selectedIndex].value;

                if (value == 1) {
                    // show project list
                    projectSelectWrapper.replaceChildren(projectSelect);
                    loanLenderSelectWrapper.replaceChildren(emptyNode2);
                    investorSelectWrapper.replaceChildren(emptyNode3);

                } else if (value == 2) {
                    // show loan lenders
                    projectSelectWrapper.replaceChildren(emptyNode1);
                    loanLenderSelectWrapper.replaceChildren(loanLenderSelect);
                    investorSelectWrapper.replaceChildren(emptyNode3);
                } else if (value == 3) {
                    // show investors
                    projectSelectWrapper.replaceChildren(emptyNode1);
                    loanLenderSelectWrapper.replaceChildren(emptyNode2);
                    investorSelectWrapper.replaceChildren(investorSelect);
                }
            }
        </script>
    </x-slot>
</x-app-layout>
