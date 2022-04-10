<x-app-layout>
    <!--begin::Content-->
    <div class="flex-lg-row-fluid ms-lg-15">
        <x-project.navigation :project="$project" active="external" />
        <!--begin:::Tab pane-->
        <div>
            <x-validation-error />

            <div class="card">
                <div class="card-body">
                    @if ($project->external)
                        <div class="d-flex justify-content-between">
                            <div class="fs-5 d-flex">
                                <div class="d-flex flex-column gap-3 text-end">
                                    <div class="px-5">
                                        <strong>Total:</strong>
                                    </div>
                                    <div class="border-bottom border-gray-500 px-5">
                                        ASF {{ $project->external->asf }}%:
                                    </div>
                                    <div class="px-5">
                                        <strong>Sub Total:</strong>
                                    </div>
                                    <div class="border-bottom border-gray-500 px-5">
                                        VAT {{ $project->external->vat }}%:
                                    </div>
                                    <div class="px-5">
                                        <strong>Grand Total:</strong>
                                    </div>
                                </div>
                                <div class="d-flex flex-column gap-3 text-end">
                                    <div class="px-5">
                                        {{ number_format($project->external->total) }}
                                    </div class="px-5">
                                    <div class="border-bottom border-gray-500 px-5">
                                        {{ number_format($project->external->asfTotal()) }}
                                    </div>
                                    <div class="px-5">
                                        {{ number_format($project->external->asfSubTotal()) }}
                                    </div>
                                    <div class="border-bottom border-gray-500 px-5">
                                        {{ number_format($project->external->vatTotal()) }}
                                    </div>
                                    <div class="px-5">
                                        {{ number_format($project->external->grandTotal()) }}
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 d-flex flex-column gap-3" style="border-left: 2px solid #ddd">
                                <div>PO Value: <strong>{{ number_format($project->po_value) }}</strong></div>
                                <div>Added: <strong>{{ $project->external->created_at }}</strong></div>
                                <div>Last Edited: <strong>{{ $project->external->updated_at }}</strong></div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning"> No estimate added to this project. </div>
                    @endif
                </div>
            </div>
            {{-- Add/Edit/Delete/Download project external --}}
            <div class="d-flex gap-3 mt-2">
                @if ($project->external)
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-sm px-10 py-0 btn-success" data-bs-toggle="modal"
                            data-bs-target="#edit_external_modal">
                            <x-utils.upload /> Edit
                        </button>

                        <a href="{{ asset("/public/uploads/{$project->external->file->file}") }}"
                            class="btn btn-sm px-10 py-0 btn-danger">
                            <x-utils.download /> Export
                        </a>
                    </div>

                    <div class="modal fade" tabindex="-1" id="edit_external_modal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div>
                                        <h5 class="modal-title">Edit Estimate</h5>
                                        {{-- <small class="text-danger">After edit the estimate a
                                                request send to
                                                the business manager for
                                                approval.</small> --}}
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <form
                                        action="{{ route('projects.external.update', [$project, $project->external]) }}"
                                        method="post" class="my-2" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')

                                        <label class="form-label fs-6 fw-bolder text-dark">
                                            Total
                                        </label>
                                        <input class="form-control form-control" type="number" name="total"
                                            value="{{ $project->external->total }}" />

                                        <label class="form-label fs-6 fw-bolder text-dark mt-2">
                                            ASF(%)
                                        </label>
                                        <input class="form-control form-control" type="number" name="asf"
                                            value="{{ $project->external->asf }}" />

                                        <label class="form-label fs-6 fw-bolder text-dark mt-2">
                                            VAT(%)
                                        </label>
                                        <input class="form-control form-control" type="number" name="vat"
                                            value="{{ $project->external->vat }}" />

                                        <label class="form-label fs-6 fw-bolder text-dark mt-2">
                                            Extimate File (.xlsx)
                                        </label>
                                        <input type="file" class="form-control" name="file">

                                        <label class="form-label mt-2">Note</label>
                                        <textarea type="text" class="form-control" name="note" rows="1"> {{ $project->external->note }} </textarea>

                                        <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <button type="button" class="btn btn-sm px-10 py-0 btn-success" data-bs-toggle="modal"
                        data-bs-target="#import_external_modal">
                        <x-utils.upload /> Add
                    </button>
                @endif
            </div>
        </div>
        <!--end:::Tab content-->
    </div>
    <!--end::Content-->

    <div class="modal fade" tabindex="-1" id="import_external_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Estimate</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('projects.external.store', $project) }}" method="post"
                        class="my-2" enctype="multipart/form-data">
                        @csrf

                        <label class="form-label fs-6 fw-bolder text-dark">
                            Total
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control" type="number" name="total" />

                        <label class="form-label fs-6 fw-bolder text-dark mt-2">
                            ASF(%)
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control" type="number" name="asf" />

                        <label class="form-label fs-6 fw-bolder text-dark mt-2">
                            VAT(%)
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control" type="number" name="vat" />

                        <label class="form-label fs-6 fw-bolder text-dark mt-2">
                            Extimate File (.xlsx)
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
