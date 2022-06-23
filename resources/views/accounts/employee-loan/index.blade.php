<x-app-layout>
    <style>
        /*From Right/Left */
        .modal.drawer {
            display: flex !important;
            pointer-events: none;
        }

        .modal.drawer * {
            pointer-events: none;
        }

        .modal.drawer .modal-dialog {
            margin: 0px;
            display: flex;
            flex: auto;
            transform: translate(25%, 0);
        }

        .modal.drawer .modal-dialog .modal-content {
            border: none;
            border-radius: 0px;
        }

        .modal.drawer .modal-dialog .modal-content .modal-body {
            overflow: auto;
        }

        .modal.drawer.show {
            pointer-events: auto;
        }

        .modal.drawer.show * {
            pointer-events: auto;
        }

        .modal.drawer.show .modal-dialog {
            transform: translate(0, 0);
        }

        .modal.drawer.right-align {
            flex-direction: row-reverse;
        }

        .modal.drawer.left-align:not(.show) .modal-dialog {
            transform: translate(-25%, 0);
        }
    </style>
    <div class="p-2 py-5">
        <h1 class="text-center">Accounts</h1>
    </div>

    <x-accounts-navigation :year="$year" :month="$month" />

    <div class="card mt-3">
        <h3 class="border-bottom border-dark py-5 text-center">Employee Loans</h3>
        <div class="card-body py-4">
            <div class="d-flex gap-3 justify-content-end">
                <button type="button" class="btn btn-sm my-2 px-6 py-0 btn-success" id="add_load_drawer_btn">
                    <x-utils.add-icon /> Add
                </button>
            </div>
            <div class="table-responsive py-5">
                <table class="table table-secondary table-striped table-hover">
                    <thead>
                        <tr class="fw-bolder fs-6 bg-gray-300">
                            <th scope="col" class="px-2 py-5">SL</th>
                            <th scope="col" class="px-2 py-5">Date</th>
                            <th scope="col" class="px-2 py-5">Employee Name</th>
                            <th scope="col" class="px-2 py-5">Loan Amount</th>
                            <th scope="col" class="px-2 py-5">Paid</th>
                            <th scope="col" class="px-2 py-5">Due</th>
                            <th scope="col" class="px-2 py-5">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $loan)
                            <tr>
                                <td class="px-2 py-5">{{ $loop->iteration }}</td>
                                <td class="px-2 py-5">{{ date('M d, Y', strtotime($loan->date)) }}</td>
                                <td class="px-2 py-5">{{ $loan->user->name }}</td>
                                <td class="px-2 py-5">{{ number_format($loan->amount) }}</td>
                                <td class="px-2 py-5">{{ number_format($loan->paid) }}</td>
                                <td class="px-2 py-5">{{ number_format($loan->due()) }}</td>
                                <td class="px-2 py-5 d-flex">
                                    <button type="button" class="btn btn-sm bg-transparent p-0 m-0"
                                        id="edit_load_drawer_btn_{{ $loan->id }}">
                                        <x-utils.edit-icon />
                                    </button>

                                    <form method="post"
                                        action="{{ route('accounts.employee-loan.delete', ['year' => $year, 'month' => $month, 'accountsEmployeeLoan' => $loan]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm bg-transparent p-0 m-0">
                                            <x-utils.delete-icon />
                                        </button>
                                    </form>
                                    <x-drawer btnId="edit_load_drawer_btn_{{ $loan->id }}"
                                        drawerId="edit_load_drawer_{{ $loan->id }}" title="Edit Loan">
                                        <form
                                            action="{{ route('accounts.employee-loan.update', ['year' => $year, 'month' => $month, 'accountsEmployeeLoan' => $loan]) }}"
                                            method="post">
                                            @csrf
                                            @method('put')

                                            <label class="form-label mt-2 mb-0">Amount</label>
                                            <input type="number" class="form-control" name="amount"
                                                value="{{ $loan->amount }}">

                                            <label class="form-label mt-2 mb-0">Paid</label>
                                            <input type="number" class="form-control" name="paid"
                                                value="{{ $loan->paid }}">

                                            <div class="py-3">
                                                <strong>Due: {{ number_format($loan->due()) }}</strong>
                                            </div>

                                            <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
                                        </form>
                                    </x-drawer>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $loans->links() }}
            </div>
        </div>
    </div>

    <x-drawer btnId="add_load_drawer_btn" drawerId="add_load_drawer" title="Add Employee Loan">
        <form action="{{ route('accounts.employee-loan.store', ['year' => $year, 'month' => $month]) }}"
            method="post">
            @csrf

            <label class="form-label mt-2 mb-0">Date</label>
            <input type="date" pattern="\d{4}-\d{2}-\d{2}" class="form-control" name="date"
                placeholder="DD-MM-YYYY">

            <label class="form-label mt-2 mb-0">Employee Name</label>
            <select class="form-select" name="user_id" data-control="select2" data-placeholder="Select">
                <option></option>
                @foreach ($users as $userId => $userName)
                    <option value="{{ $userId }}">
                        {{ $userName }}</option>
                @endforeach
            </select>

            <label class="form-label mt-2 mb-0">Amount</label>
            <input type="number" class="form-control" name="amount">

            <button type="submit" class="btn btn-primary mt-2">Add</button>
        </form>
    </x-drawer>
    <!--end::View component-->

</x-app-layout>
