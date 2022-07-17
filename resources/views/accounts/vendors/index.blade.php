<x-app-layout>
    <style>
        table th,
        table td {
            white-space: nowrap;
        }
    </style>
    <div class="p-1 mt-sm-1 mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4 active"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                <li class="breadcrumb-item fs-4 active"><a
                        href="{{ route('accounts.show.year', $data['year']) }}">{{ $data['year'] }}</a></li>
                <li class="breadcrumb-item fs-4"><a
                        href="{{ route('accounts.show.year.month', ['year' => $data['year'], 'month' => $data['year']]) }}">{{ now()->month($data['month'])->format('F') }}</a>
                </li>
                <li class="breadcrumb-item fs-4">Vendors</li>
            </ol>
        </nav>
    </div>

    <x-accounts-navigation :year="$data['year']" :month="$data['month']" />

    <div class="d-flex justify-content-end border border-bottom gap-3">
        <button type="button" class="btn btn-sm my-2 px-6 btn-success" id="add_record_btn">
            <x-utils.add-icon /> Add Record
        </button>
        <button class="btn btn-sm my-2 px-6 btn-secondary" id="add_new_vendor_btn">Add new vendor</button>
    </div>

    <div class="card my-3">
        <div class="p-3 my-3">
            <form action="{{ route('accounts.vendors.index', ['year' => $data['year'], 'month' => $data['month']]) }}"
                method="get">
                <div class="d-flex gap-3 align-items-center">
                    <div>
                        <label for="year">Year</label>
                        <select class="form-select" aria-label="Default select example" name="year">
                            <option value="0" selected> All </option>
                            <option value="2022"
                                {{ request()->year == 2022 || $data['year'] == 2022 ? 'selected' : '' }}>2022</option>
                            <option value="2021"
                                {{ request()->year == 2021 || $data['year'] == 2021 ? 'selected' : '' }}>2021</option>
                        </select>
                    </div>
                    <div>
                        <label for="month">Month</label>
                        <select class="form-select" aria-label="Default select example" name="month">
                            <option value="0">All</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}"
                                    {{ request()->month == $i || $data['month'] == $i ? 'selected' : '' }}>
                                    {{ now()->month($i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label for="client">Vendor Name</label>
                        <select class="form-select" aria-label="Default select example" name="client">
                            <option value="0">All</option>
                            @foreach ($data['vendors'] as $vendor)
                                <option value="{{ $vendor->id }}"
                                    {{ request()->vendor_id == $vendor->id ? 'selected' : '' }}>
                                    {{ $vendor->vendor_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="bill">Bill</label>
                        <select class="form-select" aria-label="Default select example" name="bill">
                            <option value="0" {{ request()->bill == 0 ? 'selected' : '' }}>All</option>
                            <option value="due" {{ request()->bill == 'due' ? 'selected' : '' }}>Due</option>
                            <option value="paid" {{ request()->bill == 'paid' ? 'selected' : '' }}>Paid</option>
                        </select>
                    </div>
                    <div>
                        <div>&nbsp;</div>
                        <button class="btn btn-secondary px-10">Sbumit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-secondary table-hover bs-table-bordered">
                <thead>
                    <tr class="border border-dark">
                        <td class="px-2 py-5 fw-bolder fs-6">SL</td>
                        <td class="px-2 py-5 fw-bolder fs-6">Vendor Name</td>
                        <td class="px-2 py-5 fw-bolder fs-6">Description</td>
                        <td class="px-2 py-5 fw-bolder fs-6">Bill Date</td>
                        <td class="px-2 py-5 fw-bolder fs-6">Bill No.</td>
                        <td class="px-2 py-5 fw-bolder fs-6">Bill Amount</td>
                        <td class="px-2 py-5 fw-bolder fs-6">Date Adv.</td>
                        <td class="px-2 py-5 fw-bolder fs-6">Advance</td>
                        <td class="px-2 py-5 fw-bolder fs-6">Date Pay</td>
                        <td class="px-2 py-5 fw-bolder fs-6">Payment</td>
                        <td class="px-2 py-5 fw-bolder fs-6">Due</td>
                        <td class="px-2 py-5 fw-bolder fs-6">Project Name </td>
                        <td class="px-2 py-5 fw-bolder fs-6"> Edit </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['accountsVendorsRecords'] as $vendorRecord)
                        <tr
                            class="border border-gray-500 cursor-pointer {{ $vendorRecord->due > 0 ? 'table-danger' : '' }}">
                            <td class="px-2 py-5">{{ $loop->iteration }}</td>
                            <td class="px-2 py-5">{{ $vendorRecord->vendor->vendor_name }}</td>
                            <td class="px-2 py-5">{{ $vendorRecord->description }}</td>
                            <td class="px-2 py-5">{{ $vendorRecord->date_bill }}</td>
                            <td class="px-2 py-5">{{ $vendorRecord->bill_no }}</td>
                            <td class="px-2 py-5">
                                {{ number_format((float) $vendorRecord->bill_amount, 2, '.', ',') }}</td>
                            <td class="px-2 py-5">{{ $vendorRecord->date_adv }}</td>
                            <td class="px-2 py-5">
                                {{ number_format((float) $vendorRecord->advance, 2, '.', ',') }}
                            </td>
                            <td class="px-2 py-5">{{ $vendorRecord->date_pay }}</td>
                            <td class="px-2 py-5">
                                {{ number_format((float) $vendorRecord->paid, 2, '.', ',') }}</td>
                            <td class="px-2 py-5">
                                {{ number_format((float) $vendorRecord->due, 2, '.', ',') }}</td>
                            <td class="px-2 py-5">{{ $vendorRecord->project_name }}</td>
                            <td class="px-2 py-5">
                                <button class="btn btn-sm btn-transparent p-0"
                                    id="edit_record_btn_{{ $vendorRecord->id }}">
                                    <x-utils.edit-icon />
                                </button>
                            </td>
                        </tr>
                        <x-drawer btnId="edit_record_btn_{{ $vendorRecord->id }}"
                            drawerId="edit_record_drawer_{{ $vendorRecord->id }}" title="Edit record">
                            <form
                                action="{{ route('accounts.vendors.update', ['year' => $data['year'], 'month' => $data['month'], 'accountsVendor' => $vendorRecord]) }}"
                                method="post">
                                @csrf
                                @method('put')

                                <label class="form-label mt-5 mb-0">Vendor Name
                                    <x-utils.required />
                                </label>
                                <select class="form-select" name="vendor_id">
                                    <option value="0" disabled selected>Select</option>
                                    @foreach ($data['vendors'] as $vendor)
                                        <option value="{{ $vendor->id }}"
                                            {{ $vendor->id == $vendorRecord->vendor_id ? 'selected' : '' }}>
                                            {{ $vendor->vendor_name }}</option>
                                    @endforeach
                                </select>

                                <label class="form-label mt-5 mb-0">Description</label>
                                <input type="text" class="form-control" name="description"
                                    value="{{ $vendorRecord->description }}">

                                <label class="form-label mt-5 mb-0">Bill Date </label>
                                <input type="date" pattern="\d{4}-\d{2}-\d{2}" class="form-control" name="date_bill"
                                    placeholder="DD-MM-YYYY" value="{{ $vendorRecord->date_bill }}">

                                <label class="form-label mt-5 mb-0">Bill No.</label>
                                <input type="text" class="form-control" name="bill_no"
                                    value="{{ $vendorRecord->bill_no }}">

                                <label class="form-label mt-5 mb-0">Bill Amount</label>
                                <input type="number" class="form-control" name="bill_amount"
                                    value="{{ $vendorRecord->bill_amount }}">

                                <label class="form-label mt-5 mb-0">Date Adv. </label>
                                <input type="date" pattern="\d{4}-\d{2}-\d{2}" class="form-control"
                                    name="date_adv" placeholder="DD-MM-YYYY"
                                    value="{{ $vendorRecord->date_adv }}">

                                <label class="form-label mt-5 mb-0">Advance</label>
                                <input type="number" class="form-control" name="advance"
                                    value="{{ $vendorRecord->advance }}">

                                <label class="form-label mt-5 mb-0">Date Pay </label>
                                <input type="date" pattern="\d{4}-\d{2}-\d{2}" class="form-control"
                                    name="date_pay" placeholder="DD-MM-YYYY"
                                    value="{{ $vendorRecord->date_pay }}">

                                <label class="form-label mt-5 mb-0">Payment</label>
                                <input type="number" class="form-control" name="paid"
                                    value="{{ $vendorRecord->paid }}">

                                <label class="form-label mt-5 mb-0">Project Name</label>
                                <input type="text" class="form-control" list="projects" name="project_name"
                                    value="{{ $vendorRecord->project_name }}">

                                <datalist id="projects">
                                    @foreach ($data['projects'] as $project)
                                        <option value="{{ $project }}">
                                    @endforeach
                                </datalist>

                                <button type="submit" class="my-3 btn btn-primary w-100">Save changes</button>
                            </form>
                        </x-drawer>
                    @endforeach
                    <tr class="border border-gray-500 cursor-pointer table-success">
                        <td class="px-2 py-5 fw-bolder" colspan="5"></td>
                        <td class="px-2 py-5 fw-bolder" colspan="1">
                            {{ number_format((float) 0, 2, '.', ',') }}</td>
                        <td class="px-2 py-5 fw-bolder" colspan="3"></td>
                        <td class="px-2 py-5 fw-bolder" colspan="1">
                            {{ number_format((float) 0, 2, '.', ',') }}</td>
                        <td class="px-2 py-5 fw-bolder" colspan="1">
                            {{ number_format((float) 0, 2, '.', ',') }}</td>
                        <td class="px-2 py-5 fw-bolder" colspan="2"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <x-drawer btnId="add_new_vendor_btn" drawerId="add_new_vendor_drawer" title="Add new vendor">
        <form
            action="{{ route('accounts.vendors.createVendor', ['year' => $data['year'], 'month' => $data['month']]) }}"
            method="post">
            @csrf

            <label class="form-label mt-5 mb-0">Vendor Name
                <x-utils.required />
            </label>
            <input type="text" class="form-control" name="vendor_name" :value="old('vendor_name')">

            <label class="form-label mt-5 mb-0">
                Contact person name
            </label>
            <input type="text" class="form-control" name="contact_name" :value="old('contact_name')">

            <label class="form-label mt-5 mb-0">
                Contact person phone
            </label>
            <input type="text" class="form-control" name="contact_phone" :value="old('contact_phone')">

            <button type="submit" class="my-3 btn btn-primary w-100">Submit</button>
        </form>
    </x-drawer>

    <x-drawer btnId="add_record_btn" drawerId="add_record_drawer" title="Add new record">
        <form action="{{ route('accounts.vendors.store', ['year' => $data['year'], 'month' => $data['month']]) }}"
            method="post">
            @csrf

            <label class="form-label mt-5 mb-0">Vendor Name
                <x-utils.required />
            </label>
            <select class="form-select" name="vendor_id">
                <option value="0" disabled selected>Select</option>
                @foreach ($data['vendors'] as $vendor)
                    <option value="{{ $vendor->id }}" {{ $vendor->id == old('vendor_id') ? 'selected' : '' }}>
                        {{ $vendor->vendor_name }}</option>
                @endforeach
            </select>

            <label class="form-label mt-5 mb-0">Description</label>
            <input type="text" class="form-control" name="description" :value="old('description')">

            <label class="form-label mt-5 mb-0">Bill Date </label>
            <input type="date" pattern="\d{4}-\d{2}-\d{2}" class="form-control" name="date_bill"
                placeholder="DD-MM-YYYY" :value="old('date_bill')">

            <label class="form-label mt-5 mb-0">Bill No.</label>
            <input type="text" class="form-control" name="bill_no" :value="old('bill_no')">

            <label class="form-label mt-5 mb-0">Bill Amount</label>
            <input type="number" class="form-control" name="bill_amount" :value="old('bill_amount')">

            <label class="form-label mt-5 mb-0">Date Adv. </label>
            <input type="date" pattern="\d{4}-\d{2}-\d{2}" class="form-control" name="date_adv"
                placeholder="DD-MM-YYYY" :value="old('date_adv')">

            <label class="form-label mt-5 mb-0">Advance</label>
            <input type="number" class="form-control" name="advance" :value="old('advance')">

            <label class="form-label mt-5 mb-0">Date Pay </label>
            <input type="date" pattern="\d{4}-\d{2}-\d{2}" class="form-control" name="date_pay"
                placeholder="DD-MM-YYYY" :value="old('date_pay')">

            <label class="form-label mt-5 mb-0">Payment</label>
            <input type="number" class="form-control" name="paid" :value="old('paid')">

            <label class="form-label mt-5 mb-0">Project Name</label>
            <input type="text" class="form-control" list="projects" name="project_name"
                :value="old('project_name')">

            <datalist id="projects">
                @foreach ($data['projects'] as $project)
                    <option value="{{ $project }}">
                @endforeach
            </datalist>

            <button type="submit" class="my-3 btn btn-primary w-100">Submit</button>
        </form>
    </x-drawer>

</x-app-layout>
