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
            <h3 class="pb-5 text-center">Deposit Records Month of
                {{ now()->year($year)->month($month)->format('F') }}
                - {{ $year }} </h3>

            {{-- Import and Export excel file --}}

            <div class="d-flex gap-3 justify-content-end">
                <button type="button" class="btn btn-sm my-2 px-6 py-0 btn-success" data-bs-toggle="modal"
                    data-bs-target="#add_deposit">
                    <x-utils.add-icon /> Add
                </button>
                <a href="{{ route('accounts.deposits.export', [$year, $month]) }}"
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
                            <th class="px-2">Deposit By</th>
                            <th class="px-2">Bank Name</th>
                            <th class="px-2">Slip Number</th>
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
                        @foreach ($depositRecords as $deposit)
                            <tr class="border border-dark fw-bold">
                                <td class="p-2">{{ $loop->iteration }}</td>
                                <td class="px-2">{{ $deposit->date }}</td>
                                <td class="px-2">{{ $deposit->depositPerson->name }}</td>
                                <td class="px-2">{{ $deposit->bank_name }}</td>
                                <td class="px-2">{{ $deposit->slip_number }}</td>
                                <td class="px-2">{{ number_format($deposit->amount) }}</td>
                                <td class="px-2"> <span class="text-white p-1 rounded"
                                        style="background: {{ $deposit->aproval->status->color }}">
                                        {{ $deposit->aproval->status->name }} </span> </td>
                                <td class="px-2">{{ $deposit->modified }}</td>
                                <td class="px-2">{{ $deposit->note }}</td>

                                <td>
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-sm bg-transparent text-warning p-0 m-0"
                                            data-bs-toggle="modal" data-bs-target="#edit_deposit_{{ $deposit->id }}">
                                            <x-utils.edit-icon />
                                        </button>

                                        <button type="submit" class="btn btn-sm bg-transparent p-0 m-0"
                                            data-bs-toggle="modal"
                                            data-bs-target="#delete_deposit_{{ $deposit->id }}">
                                            <x-utils.delete-icon />
                                        </button>
                                    </div>
                                </td>

                                <div class="modal fade" tabindex="-1" id="edit_deposit_{{ $deposit->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">#{{ $deposit->id }}:
                                                    {{ $deposit->slip_number }}
                                                </h5>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ route('accounts.deposits.update', $deposit) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('put')

                                                    <label class="form-label mt-2 mb-0">Date</label>
                                                    <input type="text" class="form-control" name="date"
                                                        value="{{ $deposit->date }}">

                                                    <label class="form-label mt-2 mb-0">Deposit By</label>
                                                    <select class="form-select" name="user_id">
                                                        @foreach ($depositPersons as $depositPersonId => $depositPersonName)
                                                            <option value="{{ $depositPersonId }}"
                                                                {{ $depositPersonId == $deposit->user_id ? 'selected' : '' }}>
                                                                {{ $depositPersonName }}</option>
                                                        @endforeach
                                                    </select>

                                                    <label class="form-label mt-2 mb-0">Amount</label>
                                                    <input type="number" class="form-control" name="amount"
                                                        value="{{ $deposit->amount }}">

                                                    <label class="form-label mt-2 mb-0">Bank Name</label>
                                                    <input type="text" class="form-control" name="bank_name"
                                                        value="{{ $deposit->bank_name }}">

                                                    <label class="form-label mt-2 mb-0">Slip Number</label>
                                                    <input type="text" class="form-control" name="slip_number"
                                                        value="{{ $deposit->slip_number }}">

                                                    <label class="form-label mt-2 mb-0">Note</label>
                                                    <textarea type="text" class="form-control" name="note" rows="1">{{ $deposit->note }}</textarea>

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
                                <div class="modal fade" tabindex="-1" id="delete_deposit_{{ $deposit->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Are you sure?</h5>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ route('accounts.deposits.delete', $deposit) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')

                                                    <p>Are you sure you want to delete this deposit record? You can not
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
                            <td> Total: <strong> {{ number_format($totalDepositsOfThisMonth) }} </strong> </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <form action="{{ route('accounts.deposits.show', [$year, $month]) }}" method="GET">
                                <td></td>
                                <td></td>
                                <td>
                                    <select class="form-select" name="user_id" data-control="select2"
                                        data-placeholder="Select">
                                        <option></option>
                                        @foreach ($depositPersonsOfThisMonth as $depositPersonOfThisMonthId => $depositPersonsOfThisMonthName)
                                            <option value="{{ $depositPersonOfThisMonthId }}">
                                                {{ $depositPersonsOfThisMonthName }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="bank_name" list="depositBanksList">
                                    <datalist id="depositBanksList">
                                        @foreach ($depositBanksOfThisMonth as $bankName)
                                            <option value="{{ $bankName }}">
                                        @endforeach
                                    </datalist>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="p-2 text-center">
                                    @if (request()->hasAny(['user_id', 'bank_name']))
                                        <a href="{{ route('accounts.deposits.show', [$year, $month]) }}"
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

    <div class="modal fade" tabindex="-1" id="add_deposit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new deposit record</h5>
                </div>

                <div class="modal-body">
                    <form action="{{ route('accounts.deposits.store') }}" method="post">
                        @csrf

                        <label class="form-label mt-2 mb-0">Date</label>
                        <input type="text" class="form-control" name="date" placeholder="YYYY-MM-DD">

                        <label class="form-label mt-2 mb-0">Deposit By</label>
                        <select class="form-select" data-control="select2" data-placeholder="Select" name="user_id">
                            <option></option>
                            @foreach ($depositPersons as $depositPersonId => $depositPersonName)
                                <option value="{{ $depositPersonId }}">
                                    {{ $depositPersonName }}</option>
                            @endforeach
                        </select>

                        <label class="form-label mt-2 mb-0">Bank Name</label>
                        <input type="text" class="form-control" name="bank_name">

                        <label class="form-label mt-2 mb-0">Slip Number</label>
                        <input type="text" class="form-control" name="slip_number">

                        <label class="form-label mt-2 mb-0">Amount</label>
                        <input type="number" class="form-control" name="amount">

                        <label class="form-label mt-2 mb-0">Note</label>
                        <textarea type="text" class="form-control" name="note" rows="1"></textarea>

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
