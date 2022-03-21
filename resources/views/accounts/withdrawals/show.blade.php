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
            <h3 class="pb-5 text-center">Withdrawal Records Month of
                {{ now()->year($year)->month($month)->format('F') }}
                - {{ $year }} </h3>
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr class="fw-bolder fs-6 bg-gray-300 text-dark border border-dark">
                        <th class="px-2">#</th>
                        <th class="px-2">Date</th>
                        <th class="px-2">Withdrawal By</th>
                        <th class="px-2">Bank Name</th>
                        <th class="px-2">Slip Number</th>
                        <th class="px-2">Amount</th>
                        <th class="px-2">Aproval</th>
                        <th class="px-2">Last Edited</th>
                        <th class="px-2">Note</th>
                        <th class="px-2">Action</th>
                    </tr>
                </thead>
                <tbody class="border border-dark">
                    @foreach ($withdrawalRecords as $withdrawal)
                        <tr class="border border-dark fw-bold">
                            <td class="p-2">{{ $loop->iteration }}</td>
                            <td class="px-2">{{ $withdrawal->date }}</td>
                            <td class="px-2">{{ $withdrawal->withdrawalPerson->name }}</td>
                            <td class="px-2">{{ $withdrawal->bank_name }}</td>
                            <td class="px-2">{{ $withdrawal->slip_number }}</td>
                            <td class="px-2">{{ number_format($withdrawal->amount) }}</td>
                            <td class="px-2"> <span class="text-white p-1 rounded"
                                    style="background: {{ $withdrawal->aproval->status->color }}">
                                    {{ $withdrawal->aproval->status->name }} </span> </td>
                            <td class="px-2">{{ $withdrawal->modified }}</td>
                            <td class="px-2">{{ $withdrawal->note }}</td>

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
                                            data-bs-target="#edit_withdrawal_{{ $withdrawal->id }}">Edit</button>
                                    </div>
                                    <div class="menu-item px-3">
                                        <form action="{{ route('accounts.withdrawals.delete', $withdrawal) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="menu-link px-3 border-0 w-100 bg-transparent">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>

                            <div class="modal fade" tabindex="-1" id="edit_withdrawal_{{ $withdrawal->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">#{{ $withdrawal->id }}:
                                                {{ $withdrawal->slip_number }}
                                            </h5>
                                        </div>

                                        <div class="modal-body">
                                            <form action="{{ route('accounts.withdrawals.update', $withdrawal) }}"
                                                method="post">
                                                @csrf
                                                @method('put')

                                                <label class="form-label mt-2 mb-0">Date</label>
                                                <input type="text" class="form-control" name="date"
                                                    value="{{ $withdrawal->date }}">

                                                <label class="form-label mt-2 mb-0">Withdrawal By</label>
                                                <select class="form-select" name="user_id">
                                                    @foreach ($withdrawalPersons as $withdrawalPersonId => $withdrawalPersonName)
                                                        <option value="{{ $withdrawalPersonId }}"
                                                            {{ $withdrawalPersonId == $withdrawal->user_id ? 'selected' : '' }}>
                                                            {{ $withdrawalPersonName }}</option>
                                                    @endforeach
                                                </select>

                                                <label class="form-label mt-2 mb-0">Amount</label>
                                                <input type="number" class="form-control" name="amount"
                                                    value="{{ $withdrawal->amount }}">

                                                <label class="form-label mt-2 mb-0">Bank Name</label>
                                                <input type="text" class="form-control" name="bank_name"
                                                    value="{{ $withdrawal->bank_name }}">

                                                <label class="form-label mt-2 mb-0">Slip Number</label>
                                                <input type="text" class="form-control" name="slip_number"
                                                    value="{{ $withdrawal->slip_number }}">

                                                <label class="form-label mt-2 mb-0">Note</label>
                                                <textarea type="text" class="form-control" name="note" rows="1"> {{ $withdrawal->note }} </textarea>

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
                        <td> Total: <strong> {{ number_format($totalWithdrawalsOfThisMonth) }} </strong> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <form action="{{ route('accounts.withdrawals.show', [$year, $month]) }}" method="GET">
                            <td></td>
                            <td></td>
                            <td>
                                <select class="form-select" name="user_id" data-control="select2"
                                    data-placeholder="Select">
                                    <option></option>
                                    @foreach ($withdrawalPersonsOfThisMonth as $withdrawalPersonOfThisMonthId => $withdrawalPersonsOfThisMonthName)
                                        <option value="{{ $withdrawalPersonOfThisMonthId }}">
                                            {{ $withdrawalPersonsOfThisMonthName }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="bank_name" list="withdrawalBanksList">
                                <datalist id="withdrawalBanksList">
                                    @foreach ($withdrawalBanksOfThisMonth as $bankName)
                                        <option value="{{ $bankName }}">
                                    @endforeach
                                </datalist>
                            </td>
                            <td class="p-2 text-center">
                                @if (request()->hasAny(['user_id', 'bank_name']))
                                    <a href="{{ route('accounts.withdrawals.show', [$year, $month]) }}"
                                        class="btn btn-danger px-10 py-3">Clear</a>
                                @else
                                    <button type="submit" class="btn btn-primary px-10 py-3">Filter</button>
                                @endif

                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </form>
                    </tr>

                    <tr>
                        <form action="{{ route('accounts.withdrawals.store') }}" method="post"
                            class="d-flex gap-1">
                            @csrf
                            <td class="p-2"></td>
                            <td class="p-2">
                                <input type="text" class="form-control" name="date" placeholder="YYYY-MM-DD">
                            </td>
                            <td class="p-2">
                                <select class="form-select" name="user_id">
                                    <option value="0" disabled selected>Select</option>
                                    @foreach ($withdrawalPersons as $withdrawalPersonId => $withdrawalPersonName)
                                        <option value="{{ $withdrawalPersonId }}">
                                            {{ $withdrawalPersonName }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td class="p-2">
                                <input type="number" class="form-control" name="amount">
                            </td>

                            <td class="p-2">
                                <input type="text" class="form-control" name="bank_name">
                            </td>

                            <td class="p-2">
                                <input type="text" class="form-control" name="slip_number">
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
</x-app-layout>
