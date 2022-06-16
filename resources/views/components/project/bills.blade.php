@props(['project', 'billType', 'billStatuses', 'bills', 'billSheets'])

@if ($bills->count() > 0)
    @foreach ($bills as $bill)
        <div class="border p-3 m-3">
            <div class="d-flex bg-light justify-content-between align-items-center px-3">
                <h4 class="text-center py-5">Bill Month -
                    {{ $bill->billMonth() }} - {{ $bill->billYear() }}</h4>
                <div>
                    <button type="button" class="btn btn-sm px-5 py-1 btn-primary"
                        id="edit_bill_btn-{{ $bill->id }}">
                        <x-utils.edit-icon /> Edit Bill
                    </button>
                </div>
            </div>

            <div class="d-flex justify-content-between flex-wrap">
                <div class="p-3 m-3 mb-5 d-flex flex-column gap-3">
                    <div> <strong>Bill Type:</strong> {{ $billType }}
                    </div>
                    <div> <strong>Bill Status:</strong> {{ $bill->status->name }}
                    </div>
                    <div> <strong>Date:</strong> {{ $bill->date }} </div>
                </div>

                <div class="fs-5 d-flex">
                    <div class="d-flex flex-column gap-3 text-end">
                        <div class="px-5">
                            <strong>Total:</strong>
                        </div>
                        <div class="border-bottom border-gray-500 px-5">
                            ASF ({{ $bill->asf }}%):
                        </div>
                        <div class="px-5">
                            <strong>Sub Total:</strong>
                        </div>
                        <div class="border-bottom border-gray-500 px-5">
                            VAT ({{ $bill->vat }}%):
                        </div>
                        <div class="px-5">
                            <strong>Grand Total:</strong>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-3 text-end">
                        <div class="px-5">
                            {{ number_format($bill->total, 2) }}
                        </div class="px-5">
                        <div class="border-bottom border-gray-500 px-5">
                            {{ number_format($bill->asfTotal(), 2) }}
                        </div>
                        <div class="px-5">
                            {{ number_format($bill->asfSubTotal(), 2) }}
                        </div>
                        <div class="border-bottom border-gray-500 px-5">
                            {{ number_format($bill->vatTotal(), 2) }}
                        </div>
                        <div class="px-5">
                            {{ number_format($bill->grandTotal(), 2) }}
                        </div>
                    </div>
                </div>

                <div>
                    <div class="border p-2 m-3">
                        <div>
                            <h5 class="py-3 mb-3">Bill File: </h5>
                            @if ($bill->file)
                                <div>
                                    <strong> {{ explode('/', $bill->file->file)[1] }}
                                    </strong>
                                    <a href="{{ asset("/public/uploads/{$bill->file?->file}") }}"
                                        class="btn btn-sm p-1 btn-secondary">
                                        Download
                                    </a>
                                </div>
                            @else
                                <div class="alert alert-warning fs-6" role="alert">
                                    No bill file added!
                                </div>
                            @endif
                        </div>
                        <div class="border-top border-gray-300 mt-5">
                            <h5 class="py-3 mb-5">Supporting File:
                            </h5>
                            @if ($bill->supporting)
                                <div>
                                    <strong> {{ explode('/', $bill->supporting->file)[1] }}
                                    </strong>
                                    <a href="{{ asset("/public/uploads/{$bill->supporting?->file}") }}" download
                                        class="btn btn-sm p-1 btn-secondary">
                                        Download
                                    </a>
                                </div>
                            @else
                                <div class="alert alert-warning fs-6" role="alert">
                                    No supporting file added!
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

            <div class="border border-secondary">
                @foreach ($billSheets as $billSheet)
                    {!! $billSheet[0] !!}
                    {!! $billSheet[1] !!}
                    {!! $billSheet[2] !!}
                @endforeach
            </div>

            <x-drawer btnId="edit_bill_btn-{{ $bill->id }}" drawerId="edit_bill_drawer-{{ $bill->id }}"
                title="Edit Bill">
                <form action="{{ route('projects.bill.update', [$project, $bill]) }}" method="post"
                    class="my-2" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <label class="form-label mt-5">Date</label>

                    <input type="date" pattern="\d{4}-\d{2}-\d{2}" class="form-control" name="date"
                        placeholder="DD-MM-YYYY" value="{{ $bill->date }}">

                    <label class="form-label mt-5 mb-0">Bill Status
                        <x-utils.required />
                    </label>
                    <select class="form-select" name="bill_status_id">
                        @foreach ($billStatuses as $billStatus)
                            <option value="{{ $billStatus->id }}"
                                {{ $billStatus->id == $bill->bill_status_id ? 'selected' : '' }}>
                                {{ $billStatus->name }}</option>
                        @endforeach
                    </select>

                    <label class="form-label fs-6 fw-bolder text-dark mt-5">
                        Total
                        <x-utils.required />
                    </label>
                    <input class="form-control" type="text" name="total" value="{{ $bill->total }}" />

                    <label class="form-label fs-6 fw-bolder text-dark mt-5">
                        ASF
                        <x-utils.required />
                    </label>
                    <input class="form-control" type="text" name="asf" value="{{ $bill->asf }}" />

                    <label class="form-label fs-6 fw-bolder text-dark mt-5">
                        VAT
                        <x-utils.required />
                    </label>
                    <input class="form-control" type="text" name="vat" value="{{ $bill->vat }}" />

                    <label class="form-label fs-6 fw-bolder text-dark mt-5">
                        Bill File(xlsx)
                    </label>
                    <input type="file" class="form-control" name="file">

                    <label class="form-label fs-6 fw-bolder text-dark mt-5">
                        Supporting File (PDF/DOCX/JPG)
                    </label>
                    <input type="file" class="form-control" name="supporting_file">

                    <button type="submit" class="btn btn-primary mt-5">Save
                        Changes</button>
                </form>
            </x-drawer>
        </div>
    @endforeach
@else
    <div class="alert alert-warning"> No bill added to this project. </div>
@endif
