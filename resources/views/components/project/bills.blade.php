@props(['project', 'billType', 'billStatuses', 'bills'])

@if ($bills->count() > 0)
    @foreach ($bills as $bill)
        <div class="border p-3 m-3">
            <div class="d-flex bg-light justify-content-between align-items-center px-3">
                <h4 class="text-center py-5">Bill Month -
                    {{ $bill->billMonth() }} - {{ $bill->billYear() }}</h4>
                <div>
                    <button type="button" class="btn btn-sm px-5 py-1 btn-primary" data-bs-toggle="modal"
                        data-bs-target="#edit_bill_modal-{{ $bill->id }}">
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
                    <div> <strong>Subject:</strong> {{ $bill->subject }}</div>
                    <div> <strong>Date:</strong> {{ $bill->date }} </div>
                </div>

                <div class="fs-5 d-flex">
                    <div class="d-flex flex-column gap-3 text-end">
                        <div class="px-5">
                            <strong>Total:</strong>
                        </div>
                        <div class="border-bottom border-gray-500 px-5">
                            ASF {{ $bill->asf }}%:
                        </div>
                        <div class="px-5">
                            <strong>Sub Total:</strong>
                        </div>
                        <div class="border-bottom border-gray-500 px-5">
                            VAT {{ $bill->vat }}%:
                        </div>
                        <div class="px-5">
                            <strong>Grand Total:</strong>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-3 text-end">
                        <div class="px-5">
                            {{ number_format($bill->total) }}
                        </div class="px-5">
                        <div class="border-bottom border-gray-500 px-5">
                            {{ number_format($bill->asfTotal()) }}
                        </div>
                        <div class="px-5">
                            {{ number_format($bill->asfSubTotal()) }}
                        </div>
                        <div class="border-bottom border-gray-500 px-5">
                            {{ number_format($bill->vatTotal()) }}
                        </div>
                        <div class="px-5">
                            {{ number_format($bill->grandTotal()) }}
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
                        <div class="border-top border-gray-300 mt-2">
                            <h5 class="py-3 mb-5">Supporting File:
                            </h5>
                            @if ($bill->supporting)
                                <div>
                                    <strong> {{ explode('/', $bill->supporting->file)[1] }}
                                    </strong>
                                    <a href="{{ asset("/public/uploads/{$bill->supporting?->file}") }}"
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

            <div class="modal fade" tabindex="-1" id="edit_bill_modal-{{ $bill->id }}">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div>
                                <h5 class="modal-title">Edit Bill</h5>
                            </div>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('projects.bill.update', [$project, $bill]) }}" method="post"
                                class="my-2" enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <label class="form-label fs-6 fw-bolder text-dark">
                                    Date
                                </label>
                                <input class="form-control form-control" type="text" name="date"
                                    value="{{ $bill->date }}" />

                                <label class="form-label fs-6 fw-bolder text-dark">
                                    Bill NO
                                </label>
                                <input class="form-control form-control" type="text" name="bill_no"
                                    value="{{ $bill->bill_no }}" />

                                <label class="form-label fs-6 fw-bolder text-dark">
                                    Subject
                                </label>
                                <input class="form-control form-control" type="text" name="subject"
                                    value="{{ $bill->subject }}" />

                                <label class="form-label mt-2 mb-0">Bill Status</label>
                                <select class="form-select" name="bill_status_id">
                                    @foreach ($billStatuses as $billStatus)
                                        <option value="{{ $billStatus->id }}"
                                            {{ $billStatus->id == $bill->bill_status_id ? 'selected' : '' }}>
                                            {{ $billStatus->name }}</option>
                                    @endforeach
                                </select>

                                <label class="form-label fs-6 fw-bolder text-dark">
                                    Total
                                </label>
                                <input class="form-control form-control" type="text" name="total"
                                    value="{{ $bill->total }}" />

                                <label class="form-label fs-6 fw-bolder text-dark">
                                    ASF
                                </label>
                                <input class="form-control form-control" type="text" name="asf"
                                    value="{{ $bill->asf }}" />

                                <label class="form-label fs-6 fw-bolder text-dark">
                                    VAT
                                </label>
                                <input class="form-control form-control" type="text" name="vat"
                                    value="{{ $bill->vat }}" />

                                <label class="form-label fs-6 fw-bolder text-dark mt-2">
                                    Bill File (xlsx)
                                </label>
                                <input type="file" class="form-control" name="file">

                                <label class="form-label fs-6 fw-bolder text-dark mt-2">
                                    Supporting File (pdf/docx)
                                </label>
                                <input type="file" class="form-control" name="supporting_file">

                                <button type="submit" class="btn btn-primary mt-2">Save
                                    Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="alert alert-warning"> No bill added to this project. </div>
@endif
