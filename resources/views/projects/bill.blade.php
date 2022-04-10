<x-app-layout>
    <div class="flex-lg-row-fluid ms-lg-15">
        <x-project.navigation :project="$project" active="bill" />
        <!--begin:::Tab pane-->
        <div>
            <x-validation-error />

            <div class="card">
                <div class="card-body">
                    @if ($project->bill_type == 1)
                        @php
                            $projectBill = $project->bills->first();
                        @endphp

                        @if ($projectBill)
                            <div class="d-flex justify-content-between">
                                <div class="p-3 m-3 mb-5 border-bottom border-gray-500 d-flex flex-column gap-3">
                                    <div> <strong>Bill Type:</strong> {{ $project->billType->name }}</div>
                                    <div> <strong>Bill Status:</strong> {{ $project->billStatus() }}</div>
                                    <div> <strong>Subject:</strong> {{ $projectBill->subject }}</div>
                                    <div> <strong>Date:</strong> {{ $projectBill->date }} </div>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-sm px-5 py-1 btn-success" data-bs-toggle="modal"
                                        data-bs-target="#edit_bill_modal">
                                        <x-utils.edit-icon /> Edit Bill
                                    </button>
                                </div>
                            </div>
                            <div class="fs-5 d-flex mb-10">
                                <div class="fs-5 d-flex">
                                    <div class="d-flex flex-column gap-3 text-end">
                                        <div class="px-5">
                                            <strong>Total:</strong>
                                        </div>
                                        <div class="border-bottom border-gray-500 px-5">
                                            ASF {{ $projectBill->asf }}%:
                                        </div>
                                        <div class="px-5">
                                            <strong>Sub Total:</strong>
                                        </div>
                                        <div class="border-bottom border-gray-500 px-5">
                                            VAT {{ $projectBill->vat }}%:
                                        </div>
                                        <div class="px-5">
                                            <strong>Grand Total:</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-3 text-end">
                                        <div class="px-5">
                                            {{ number_format($projectBill->total) }}
                                        </div class="px-5">
                                        <div class="border-bottom border-gray-500 px-5">
                                            {{ number_format($projectBill->asfTotal()) }}
                                        </div>
                                        <div class="px-5">
                                            {{ number_format($projectBill->asfSubTotal()) }}
                                        </div>
                                        <div class="border-bottom border-gray-500 px-5">
                                            {{ number_format($projectBill->vatTotal()) }}
                                        </div>
                                        <div class="px-5">
                                            {{ number_format($projectBill->grandTotal()) }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-3 justify-content-between border p-5 mt-10 border-gray-500">
                                <div>
                                    <h5 class="border-bottom border-gray-300 py-3 mb-5">Bill File: </h5>
                                    @if ($projectBill->file)
                                        <div>
                                            <strong> {{ explode('/', $projectBill->file->file)[1] }} </strong>
                                            <a href="{{ asset("/public/uploads/{$projectBill->file?->file}") }}"
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
                                <div>
                                    <h5 class="border-bottom border-gray-300 py-3 mb-5">Supporting File: </h5>
                                    @if ($projectBill->supporting)
                                        <div>
                                            <strong> {{ explode('/', $projectBill->supporting->file)[1] }} </strong>
                                            <a href="{{ asset("/public/uploads/{$projectBill->supporting?->file}") }}"
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

                            <div class="modal fade" tabindex="-1" id="edit_bill_modal">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div>
                                                <h5 class="modal-title">Edit Bill</h5>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <form
                                                action="{{ route('projects.bill.update', [$project, $projectBill]) }}"
                                                method="post" class="my-2" enctype="multipart/form-data">
                                                @csrf
                                                @method('put')

                                                <label class="form-label fs-6 fw-bolder text-dark">
                                                    Date
                                                </label>
                                                <input class="form-control form-control" type="text" name="date"
                                                    value="{{ $projectBill->date }}" />

                                                <label class="form-label fs-6 fw-bolder text-dark">
                                                    Bill NO
                                                </label>
                                                <input class="form-control form-control" type="text" name="bill_no"
                                                    value="{{ $projectBill->bill_no }}" />

                                                <label class="form-label fs-6 fw-bolder text-dark">
                                                    Subject
                                                </label>
                                                <input class="form-control form-control" type="text" name="subject"
                                                    value="{{ $projectBill->subject }}" />

                                                <label class="form-label mt-2 mb-0">Bill Status</label>
                                                <select class="form-select" name="bill_status_id">
                                                    @foreach ($billStatuses as $billStatus)
                                                        <option value="{{ $billStatus->id }}"
                                                            {{ $billStatus->id == $projectBill->bill_status_id ? 'selected' : '' }}>
                                                            {{ $billStatus->name }}</option>
                                                    @endforeach
                                                </select>

                                                <label class="form-label fs-6 fw-bolder text-dark">
                                                    Total
                                                </label>
                                                <input class="form-control form-control" type="text" name="total"
                                                    value="{{ $projectBill->total }}" />

                                                <label class="form-label fs-6 fw-bolder text-dark">
                                                    ASF
                                                </label>
                                                <input class="form-control form-control" type="text" name="asf"
                                                    value="{{ $projectBill->asf }}" />

                                                <label class="form-label fs-6 fw-bolder text-dark">
                                                    VAT
                                                </label>
                                                <input class="form-control form-control" type="text" name="vat"
                                                    value="{{ $projectBill->vat }}" />

                                                <label class="form-label fs-6 fw-bolder text-dark mt-2">
                                                    Bill File (xlsx)
                                                </label>
                                                <input type="file" class="form-control" name="file">

                                                <label class="form-label fs-6 fw-bolder text-dark mt-2">
                                                    Supporting File (pdf/docx)
                                                </label>
                                                <input type="file" class="form-control" name="supporting_file">

                                                <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning"> No bill added to this project. </div>
                            <button type="button" class="btn btn-sm px-5 py-1 btn-success" data-bs-toggle="modal"
                                data-bs-target="#add_bill_modal">
                                <x-utils.add-icon /> Add Bill
                            </button>

                            <div class="modal fade" tabindex="-1" id="add_bill_modal">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div>
                                                <h5 class="modal-title">Add Bill</h5>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('projects.bill.store', [$project]) }}"
                                                method="post" class="my-2" enctype="multipart/form-data">
                                                @csrf

                                                <label class="form-label fs-6 fw-bolder text-dark">
                                                    Date
                                                </label>
                                                <input class="form-control form-control" type="text" name="date" />

                                                <label class="form-label fs-6 fw-bolder text-dark">
                                                    Bill NO
                                                </label>
                                                <input class="form-control form-control" type="text" name="bill_no" />

                                                <label class="form-label fs-6 fw-bolder text-dark">
                                                    Subject
                                                </label>
                                                <input class="form-control form-control" type="text" name="subject" />

                                                <label class="form-label mt-2 mb-0">Bill Status</label>
                                                <select class="form-select" name="bill_status_id">
                                                    @foreach ($billStatuses as $billStatus)
                                                        <option value="{{ $billStatus->id }}">
                                                            {{ $billStatus->name }}</option>
                                                    @endforeach
                                                </select>

                                                <label class="form-label fs-6 fw-bolder text-dark">
                                                    Total
                                                </label>
                                                <input class="form-control form-control" type="number" name="total" />

                                                <label class="form-label fs-6 fw-bolder text-dark">
                                                    ASF
                                                </label>
                                                <input class="form-control form-control" type="number" name="asf" />

                                                <label class="form-label fs-6 fw-bolder text-dark">
                                                    VAT
                                                </label>
                                                <input class="form-control form-control" type="number" name="vat" />

                                                <label class="form-label fs-6 fw-bolder text-dark mt-2">
                                                    Bill File (xlsx)
                                                </label>
                                                <input type="file" class="form-control" name="file">

                                                <label class="form-label fs-6 fw-bolder text-dark mt-2">
                                                    Supporting File (pdf/docx)
                                                </label>
                                                <input type="file" class="form-control" name="supporting_file">

                                                <button type="submit" class="btn btn-primary mt-2">Add Bill</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="alert alert-warning"> Multiple bill </div>
                    @endif
                </div>
            </div>
        </div>
        <!--end:::Tab content-->
    </div>
    <!--end::Content-->
</x-app-layout>
