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

    <x-accounts-navigation />

    <div class="card mt-3">
        <h3 class="border-bottom border-dark py-5 text-center">Employee Loans</h3>
        <div class="card-body py-4">
            <div class="d-flex gap-3 justify-content-end">
                <button type="button" class="btn btn-sm my-2 px-6 py-0 btn-success" id="add_load_drawer_btn">
                    <x-utils.add-icon /> Add
                </button>
                <button type="button" class="btn btn-sm my-2 px-6 py-0 btn-primary" id="pay_load_drawer_btn">
                    <x-utils.add-icon /> Play Loan
                </button>
            </div>
            <div class="table-responsive py-5">
                <table class="table table-secondary table-striped">
                    <thead>
                        <tr class="fw-bolder fs-6 bg-gray-300">
                            <th scope="col" class="px-2 py-5">SL</th>
                            <th scope="col" class="px-2 py-5">Date</th>
                            <th scope="col" class="px-2 py-5">Employee Name</th>
                            <th scope="col" class="px-2 py-5">Loan Amount</th>
                            <th scope="col" class="px-2 py-5">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $loan)
                            <td class="px-2 py-5">{{ $loop->iteration }}</td>
                            <td class="px-2 py-5">{{ date('M d, Y', strtotime($loan->date)) }}</td>
                            <td class="px-2 py-5">{{ $loan->user->name }}</td>
                            <td class="px-2 py-5">{{ number_format($loan->amount) }}</td>
                            <td class="px-2 py-5">
                                <form method="post" action="{{ route('accounts.employee-loan.delete', $loan) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm bg-transparent p-0 m-0">
                                        <x-utils.delete-icon />
                                    </button>
                                </form>
                            </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-drawer btnId="add_load_drawer_btn" drawerId="add_load_drawer" title="Add Employee Loan">
        <form action="{{ route('accounts.employee-loan.store') }}" method="post">
            @csrf

            <label class="form-label mt-2 mb-0">Date</label>
            <input type="text" class="form-control" name="date" placeholder="YYYY-MM-DD">

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

    <x-drawer btnId="pay_load_drawer_btn" drawerId="pay_load_drawer" title="Pay Loan">
        <form action="{{ route('accounts.employee-loan.update') }}" method="post">
            @csrf
            @method('put')

            <label class="form-label mt-2 mb-0">Date</label>
            <input type="text" class="form-control" name="date" placeholder="YYYY-MM-DD">

            <label class="form-label mt-2 mb-0">Select Loan</label>
            <select class="form-select" name="loan_id" data-control="select2" data-placeholder="Select">
                <option></option>
                @foreach ($loans as $loan)
                    <option value="{{ $loan->id }}">
                        #{{ $loan->date }}_{{ $loan->user->name }}_due:{{ $loan->due() }}
                    </option>
                @endforeach
            </select>

            <label class="form-label mt-2 mb-0">Amount</label>
            <input type="number" class="form-control" name="amount">

            <button type="submit" class="btn btn-primary mt-2">Pay Loan</button>
        </form>
    </x-drawer>
    <!--end::View component-->

</x-app-layout>
