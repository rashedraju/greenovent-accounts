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
                            <div class="p-3 m-3 mb-5 border-bottom border-gray-500">
                                <div> <strong>Bill Type:</strong> {{ $project->billType->name }}</div>
                                <div> <strong>Bill Status:</strong> {{ $project->billStatus() }}</div>
                            </div>
                            <div class="fs-5 d-flex">
                                <div class="fs-5 d-flex">
                                    <div class="d-flex flex-column gap-3 text-end">
                                        <div class="px-5">
                                            <strong>Date:</strong>
                                        </div>
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
                                            {{ $projectBill->date }}
                                        </div class="px-5">
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
                        @else
                            <div class="alert alert-warning"> No bill added to this project. </div>
                        @endif
                    @else
                        <div class="alert alert-warning"> Multiple bill </div>
                    @endif
                </div>
            </div>

            <div class="d-flex gap-3 mt-2">
                @if ($project->internal)
                    <button type="button" class="btn btn-sm px-10 py-0 btn-success" data-bs-toggle="modal"
                        data-bs-target="#edit_internal_modal">
                        <x-utils.upload /> Edit
                    </button>

                    <div class="modal fade" tabindex="-1" id="edit_internal_modal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div>
                                        <h5 class="modal-title">Edit internal</h5>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <form
                                        action="{{ route('projects.internal.update', [$project, $project->internal]) }}"
                                        method="post" class="my-2" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')

                                        <label class="form-label fs-6 fw-bolder text-dark">
                                            Total
                                        </label>

                                        <input class="form-control form-control" type="number" name="total"
                                            value="{{ $project->internal->total }}" />

                                        <label class="form-label fs-6 fw-bolder text-dark mt-2">
                                            Internal File (.xlsx)
                                        </label>
                                        <input type="file" class="form-control" name="file">

                                        <label class="form-label mt-2">Note</label>
                                        <textarea type="text" class="form-control" name="note" rows="1"> {{ $project->internal->note }} </textarea>

                                        <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ asset("/public/uploads/{$project->internal->file->file}") }}"
                        class="btn btn-sm px-10 py-0 btn-danger">
                        <x-utils.download /> Export
                    </a>
                @else
                    <button type="button" class="btn btn-sm px-10 py-0 btn-success" data-bs-toggle="modal"
                        data-bs-target="#add_bill_modal">
                        <x-utils.upload /> Add Bill
                    </button>
                @endif
            </div>
        </div>
        <!--end:::Tab content-->
    </div>
    <!--end::Content-->

    <div class="modal fade" tabindex="-1" id="import_internal_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Bill</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('projects.internal.store', $project) }}" method="post"
                        class="my-2" enctype="multipart/form-data">
                        @csrf

                        <label class="form-label fs-6 fw-bolder text-dark">
                            Total
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control" type="number" name="total" />

                        <label class="form-label fs-6 fw-bolder text-dark mt-2">
                            Internal File (.xlsx)
                            <x-utils.required />
                        </label>
                        <input type="file" class="form-control" name="file">

                        <label class="form-label mt-2">Note</label>
                        <textarea type="text" class="form-control" name="note" rows="1"> </textarea>

                        <button type="submit" class="btn btn-primary mt-2">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
