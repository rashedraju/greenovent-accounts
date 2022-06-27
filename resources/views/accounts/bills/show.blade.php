<x-app-layout>
    <style>
        th {
            white-space: nowrap;
        }
    </style>
    <div class="p-2 py-5">
        <h1 class="text-center">Accounts</h1>
    </div>

    <x-accounts-navigation :year="$data['year']" :month="$data['month']" />

    <h3 class="py-5 text-center">Bill of {{ $data['client']->company_name }}</h3>
    <div class="d-flex gap-3 justify-content-end">
        <button type="button" class="btn btn-sm my-2 px-6 py-0 btn-success" id="add_bill_drawer_btn">
            <x-utils.add-icon /> Add New Record
        </button>
    </div>
    <x-validation-error />

    <div class="table-responsive">
        <table class="table table-secondary table-striped table-border table-hover">
            <thead>
                <tr class="fs-6 text-center border border-gray-500">
                    <th class="px-1 py-5">SL</th>
                    <th class="px-1 py-5">Date</th>
                    <th class="px-1 py-5">Description</th>
                    <th class="px-1 py-5">Bill No</th>
                    <th class="px-1 py-5">Invoice amount</th>
                    <th class="px-1 py-5">Vat</th>
                    <th class="px-1 py-5">Gross invoice value</th>
                    <th class="px-1 py-5">AIT(TK)</th>
                    <th class="px-1 py-5">Cash suppose to receipt</th>
                    <th class="px-1 py-5">Receipt umber</th>
                    <th class="px-1 py-5">Receipt date</th>
                    <th class="px-1 py-5">Cash cheque receipt</th>
                    <th class="px-1 py-5">Advance</th>
                    <th class="px-1 py-5">Discount</th>
                    <th class="px-1 py-5">Due</th>
                    <th class="px-1 py-5">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['bills'] as $bill)
                    <tr class="fw-bold border border-gray-500 text-center {{ $bill->due ? 'table-danger' : '' }}">
                        <td class="px-1 py-5" style="white-space: nowrap;">{{ $loop->iteration }}</td>
                        <td class="px-1 py-5" style="white-space: nowrap;">
                            {{ date('d-m-yy', strtotime($bill->date)) }}</a> </td>
                        <td class="px-1 py-5" style="white-space: nowrap;">{{ $bill->description }}</td>
                        <td class="px-1 py-5" style="white-space: nowrap;">{{ $bill->bill_no }}</td>
                        <td class="px-1 py-5" style="white-space: nowrap;">{{ $bill->invoice_amount }}</td>
                        <td class="px-1 py-5" style="white-space: nowrap;">{{ $bill->vat }}</td>
                        <td class="px-1 py-5" style="white-space: nowrap;">{{ $bill->gross_invoice_value }}</td>
                        <td class="px-1 py-5" style="white-space: nowrap;">{{ $bill->ait }}</td>
                        <td class="px-1 py-5" style="white-space: nowrap;">{{ $bill->cash_suppose_to_receipt }}
                        </td>
                        <td class="px-1 py-5" style="white-space: nowrap;">{{ $bill->receipt_number }}</td>
                        <td class="px-1 py-5" style="white-space: nowrap;">{{ $bill->receipt_date }}</td>
                        <td class="px-1 py-5" style="white-space: nowrap;">{{ $bill->cash_cheque_receipt }}</td>
                        <td class="px-1 py-5" style="white-space: nowrap;">{{ $bill->advance }}</td>
                        <td class="px-1 py-5" style="white-space: nowrap;">{{ $bill->discount }}</td>
                        <td class="px-1 py-5" style="white-space: nowrap;">{{ $bill->due }}</td>
                        <td class="px-2 py-5">
                            <div class="d-flex gap-3 cursor-pointer">
                                <div id="edit_bill_drawer_btn_{{ $loop->iteration }}">
                                    <x-utils.edit-icon />
                                </div>
                                <div id="delete_bill_drawer_btn_{{ $loop->iteration }}">
                                    <x-utils.delete-icon />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <x-drawer btnId="edit_bill_drawer_btn_{{ $loop->iteration }}"
                        drawerId="edit_bill_drawer_{{ $loop->iteration }}" title="Edit bill record">
                        <form
                            action="{{ route('accounts.bills.update', ['year' => $data['year'], 'month' => $data['month'], 'accountsBill' => $bill]) }}"
                            method="post">
                            @csrf
                            @method('put')

                            <label class="form-label mt-2 mb-0">Date</label>
                            <input type="date" pattern="\d{4}-\d{2}-\d{2}" class="form-control" name="date"
                                value="{{ $bill->date }}" placeholder="DD-MM-YYYY">

                            <label class="form-label mt-2 mb-0">Description</label>
                            <input type="text" class="form-control" name="description"
                                value="{{ $bill->description }}">

                            <label class="form-label mt-2 mb-0">bill no</label>
                            <input type="text" class="form-control" name="bill_no" value="{{ $bill->bill_no }}">

                            <label class="form-label mt-2 mb-0">Invoice amount</label>
                            <input type="number" class="form-control" name="invoice_amount"
                                value="{{ $bill->invoice_amount }}">

                            <label class="form-label mt-2 mb-0">VAT(TK)</label>
                            <input type="number" class="form-control" name="vat" value="{{ $bill->vat }}">

                            <label class="form-label mt-2 mb-0">Gross invoice value</label>
                            <input type="number" class="form-control" name="gross_invoice_value"
                                value="{{ $bill->gross_invoice_value }}">

                            <label class="form-label mt-2 mb-0">AIT</label>
                            <input type="number" class="form-control" name="ait" value="{{ $bill->ait }}">

                            <label class="form-label mt-2 mb-0">Cash suppose to receipt</label>
                            <input type="number" class="form-control" name="cash_suppose_to_receipt"
                                value="{{ $bill->cash_suppose_to_receipt }}">

                            <label class="form-label mt-2 mb-0">Receipt number</label>
                            <input type="string" class="form-control" name="receipt_number"
                                value="{{ $bill->receipt_number }}">

                            <label class="form-label mt-2 mb-0">Receipt date</label>
                            <input type="date" pattern="\d{4}-\d{2}-\d{2}" class="form-control"
                                name="receipt_date" placeholder="DD-MM-YYYY" value="{{ $bill->receipt_date }}">

                            <label class="form-label mt-2 mb-0">Cash cheque receipt</label>
                            <input type="number" class="form-control" name="cash_cheque_receipt"
                                value="{{ $bill->cash_cheque_receipt }}">

                            <label class="form-label mt-2 mb-0">Advance</label>
                            <input type="number" class="form-control" name="advance"
                                value="{{ $bill->advance }}">

                            <label class="form-label mt-2 mb-0">Discount</label>
                            <input type="number" class="form-control" name="discount"
                                value="{{ $bill->discount }}">

                            <label class="form-label mt-2 mb-0">Due</label>
                            <input type="number" class="form-control" name="due" value="{{ $bill->due }}">

                            <button type="submit" class="my-3 btn btn-primary w-100">Submit</button>
                        </form>
                    </x-drawer>

                    <x-drawer btnId="delete_bill_drawer_btn_{{ $loop->iteration }}"
                        drawerId="delete_bill_drawer_{{ $loop->iteration }}" title="Delete Bill Record">
                        <form method="post"
                            action="{{ route('accounts.bills.delete', ['year' => $data['year'], 'month' => $data['month'], 'accountsBill' => $bill]) }}">
                            @csrf
                            @method('delete')
                            <h2 class="mb-3">Are you sure you want to delete this?</h2>

                            <div class="d-flex my-3 gap-3">
                                <button type="button" class="btn btn-sm btn-light w-100"
                                    data-kt-drawer-dismiss="true">Cancel</button>
                                <button type="submit" class="btn btn-sm btn-danger w-100">Delete</button>
                            </div>
                        </form>
                    </x-drawer>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-drawer btnId="add_bill_drawer_btn" drawerId="add_bill_drawer" title="Add new bill record">
        <form action="{{ route('accounts.bills.store', ['year' => $data['year'], 'month' => $data['month']]) }}"
            method="post">
            @csrf

            <input type="hidden" name="client_id" value="{{ $data['client']->id }}">

            <label class="form-label mt-2 mb-0">Date</label>
            <input type="date" pattern="\d{4}-\d{2}-\d{2}" class="form-control" name="date"
                placeholder="DD-MM-YYYY">

            <label class="form-label mt-2 mb-0">Description</label>
            <input type="text" class="form-control" name="description">

            <label class="form-label mt-2 mb-0">bill no</label>
            <input type="text" class="form-control" name="bill_no">

            <label class="form-label mt-2 mb-0">Invoice amount</label>
            <input type="number" class="form-control" name="invoice_amount">

            <label class="form-label mt-2 mb-0">VAT(TK)</label>
            <input type="number" class="form-control" name="vat">

            <label class="form-label mt-2 mb-0">Gross invoice value</label>
            <input type="number" class="form-control" name="gross_invoice_value">

            <label class="form-label mt-2 mb-0">AIT</label>
            <input type="number" class="form-control" name="ait">

            <label class="form-label mt-2 mb-0">Cash suppose to receipt</label>
            <input type="number" class="form-control" name="cash_suppose_to_receipt">

            <label class="form-label mt-2 mb-0">Receipt number</label>
            <input type="string" class="form-control" name="receipt_number">

            <label class="form-label mt-2 mb-0">Receipt date</label>
            <input type="date" pattern="\d{4}-\d{2}-\d{2}" class="form-control" name="receipt_date"
                placeholder="DD-MM-YYYY">

            <label class="form-label mt-2 mb-0">Cash cheque receipt</label>
            <input type="number" class="form-control" name="cash_cheque_receipt">

            <label class="form-label mt-2 mb-0">Advance</label>
            <input type="number" class="form-control" name="advance">

            <label class="form-label mt-2 mb-0">Discount</label>
            <input type="number" class="form-control" name="discount">

            <label class="form-label mt-2 mb-0">Due</label>
            <input type="number" class="form-control" name="due">

            <button type="submit" class="my-3 btn btn-primary w-100">Submit</button>
        </form>

    </x-drawer>
</x-app-layout>
