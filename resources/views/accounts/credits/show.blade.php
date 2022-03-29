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
                <button type="button" class="btn btn-sm my-2 px-6 py-0 btn-success" data-bs-toggle="modal"
                    data-bs-target="#add_credit">
                    <x-utils.add-icon /> Add
                </button>
                <a href="{{ route('accounts.credits.export', [$year, $month]) }}"
                    class="btn btn-sm my-2 px-10 py-0 btn-danger">
                    <x-utils.download /> Export
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
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
                            <th class="px-2">Actions</th>
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
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-sm bg-transparent text-warning p-0 m-0"
                                            data-bs-toggle="modal" data-bs-target="#edit_credit_{{ $credit->id }}">
                                            <x-utils.edit-icon />
                                        </button>

                                        <button type="submit" class="btn btn-sm bg-transparent p-0 m-0"
                                            data-bs-toggle="modal" data-bs-target="#delete_credit_{{ $credit->id }}">
                                            <x-utils.delete-icon />
                                        </button>
                                    </div>
                                </td>

                                <div class="modal fade" tabindex="-1" id="delete_credit_{{ $credit->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Are you sure?</h5>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ route('accounts.credits.delete', $credit) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')

                                                    <p>Are you sure you want to delete this credit record? You can not
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

                                <div class="modal fade" tabindex="-1" id="edit_credit_{{ $credit->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit: #{{ $loop->iteration }}
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

                                                    @if ($credit->category_id == 1)
                                                        <label class="form-label mt-2 mb-0">Project Name</label>
                                                        <select class="form-select" name="project_id">
                                                            @foreach ($projects as $projectId => $projectName)
                                                                <option value="{{ $projectId }}"
                                                                    {{ $projectId == $credit->project_id ? 'selected' : '' }}>
                                                                    {{ $projectName }}</option>
                                                            @endforeach
                                                        </select>
                                                    @elseif ($credit->category_id == 2)
                                                        <label class="form-label mt-2 mb-0">Loan Lender</label>
                                                        <select class="form-select" name="loan_lender_id">
                                                            @foreach ($loanLenders as $loanLenderId => $loanLenderName)
                                                                <option value="{{ $loanLenderId }}"
                                                                    {{ $credit->loan_lender_id == $loanLenderId ? 'selected' : '' }}>
                                                                    {{ $loanLenderName }}</option>
                                                            @endforeach
                                                        </select>
                                                    @elseif ($credit->category_id == 3)
                                                        <label class="form-label mt-2 mb-0">Investor</label>
                                                        <select class="form-select" name="project_id">
                                                            @foreach ($companyInvestors as $companyInvestorId => $companyInvestorName)
                                                                <option value="{{ $companyInvestorId }}"
                                                                    {{ $credit->investor_id == $credit->investor_id ? 'selected' : '' }}>
                                                                    {{ $companyInvestorName }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @endif

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
                    </tbody>
                </table>
            </div>

            <x-validation-error />
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="add_credit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new credit record</h5>
                </div>

                <div class="modal-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">Bill</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                aria-selected="false">Loan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                data-bs-target="#contact" type="button" role="tab" aria-controls="contact"
                                aria-selected="false">Investment</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <form action="{{ route('accounts.credits.store') }}" method="post">
                                @csrf

                                <label class="form-label mt-2 mb-0">Date</label>
                                <input type="text" class="form-control" name="date" placeholder="YYYY-MM-DD">

                                <label class="form-label mt-2 mb-0">Received by</label>
                                <select class="form-select" name="user_id" data-control="select2"
                                    data-placeholder="Select">
                                    <option></option>
                                    @foreach ($receivedPersons as $receivedPersonId => $receivedPersonName)
                                        <option value="{{ $receivedPersonId }}">
                                            {{ $receivedPersonName }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="category_id" value="1">

                                <label class="form-label mt-2 mb-0">Project Name</label>
                                <select class="form-select" name="project_id" data-control="select2"
                                    data-placeholder="Select">
                                    <option></option>
                                    @foreach ($projects as $projectId => $projectName)
                                        <option value="{{ $projectId }}">
                                            {{ $projectName }}</option>
                                    @endforeach
                                </select>

                                <label class="form-label mt-2 mb-0">Transaction Type</label>
                                <select name="transaction_type_id" class="form-select" data-control="select2"
                                    data-placeholder="Select">
                                    <option></option>
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
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <form action="{{ route('accounts.credits.store') }}" method="post">
                                @csrf

                                <label class="form-label mt-2 mb-0">Date</label>
                                <input type="text" class="form-control" name="date" placeholder="YYYY-MM-DD">

                                <label class="form-label mt-2 mb-0">Received by</label>
                                <select class="form-select" name="user_id" data-control="select2"
                                    data-placeholder="Select">
                                    <option></option>
                                    @foreach ($receivedPersons as $receivedPersonId => $receivedPersonName)
                                        <option value="{{ $receivedPersonId }}">
                                            {{ $receivedPersonName }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="category_id" value="2">

                                <label class="form-label mt-2 mb-0">Loan Lender</label>
                                <select name="loan_lender_id" class="form-select" data-control="select2"
                                    data-placeholder="Select">
                                    <option></option>

                                    @foreach ($loanLenders as $loanLenderId => $loanLenderName)
                                        <option value="{{ $loanLenderId }}">
                                            {{ $loanLenderName }}</option>
                                    @endforeach
                                </select>

                                <label class="form-label mt-2 mb-0">Transaction Type</label>
                                <select name="transaction_type_id" class="form-select" data-control="select2"
                                    data-placeholder="Select">
                                    <option></option>
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
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <form action="{{ route('accounts.credits.store') }}" method="post">
                                @csrf

                                <label class="form-label mt-2 mb-0">Date</label>
                                <input type="text" class="form-control" name="date" placeholder="YYYY-MM-DD">

                                <label class="form-label mt-2 mb-0">Received by</label>
                                <select class="form-select" name="user_id" data-control="select2"
                                    data-placeholder="Select">
                                    <option></option>
                                    @foreach ($receivedPersons as $receivedPersonId => $receivedPersonName)
                                        <option value="{{ $receivedPersonId }}">
                                            {{ $receivedPersonName }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="category_id" value="3">

                                <label class="form-label mt-2 mb-0">Investor</label>
                                <select name="investor_id" class="form-select" data-control="select2"
                                    data-placeholder="Select">
                                    <option></option>

                                    @foreach ($companyInvestors as $companyInvestorId => $companyInvestorName)
                                        <option value="{{ $companyInvestorId }}">
                                            {{ $companyInvestorName }}
                                        </option>
                                    @endforeach
                                </select>

                                <label class="form-label mt-2 mb-0">Transaction Type</label>
                                <select name="transaction_type_id" class="form-select" data-control="select2"
                                    data-placeholder="Select">
                                    <option></option>
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
        </div>
    </div>
</x-app-layout>
