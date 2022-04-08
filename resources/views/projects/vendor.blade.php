<x-app-layout>
    <!--begin::Content-->
    <div class="flex-lg-row-fluid ms-lg-15">
        <x-project.navigation :project="$project" active="vendor" />
        <!--begin:::Tab pane-->
        <div>
            <x-validation-error />

            <div class="card">
                <div class="card-body">
                    @if ($project->vendor)
                        <div class="d-flex justify-content-between">
                            <div class="fs-5 d-flex">
                                <div class="d-flex flex-column gap-3 text-end">
                                    <div class="border-bottom border-gray-500 px-5">
                                        <strong>Total:</strong>
                                    </div>
                                </div>
                                <div class="d-flex flex-column gap-3 text-end">
                                    <div class="border-bottom border-gray-500 px-5">
                                        {{ number_format($project->vendor->total) }}
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 d-flex flex-column gap-3" style="border-left: 2px solid #ddd">
                                <div>Internal:
                                    <strong>{{ number_format($project->internal?->total) }}</strong>
                                </div>
                                <div>Added: <strong>{{ $project->vendor->created_at }}</strong></div>
                                <div>Last Edited: <strong>{{ $project->vendor->updated_at }}</strong></div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning"> No vendor added to this project. </div>
                    @endif
                </div>
            </div>

            <div class="d-flex gap-3 mt-2">
                @if ($project->vendor)
                    <button type="button" class="btn btn-sm px-10 py-0 btn-success" data-bs-toggle="modal"
                        data-bs-target="#edit_vendor_modal">
                        <x-utils.upload /> Edit
                    </button>

                    <div class="modal fade" tabindex="-1" id="edit_vendor_modal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div>
                                        <h5 class="modal-title">Edit vendor</h5>
                                        {{-- <small class="text-danger">After edit the vendor a
                                                request send to
                                                the business manager for
                                                approval.</small> --}}
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('projects.vendor.update', [$project, $project->vendor]) }}"
                                        method="post" class="my-2" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')

                                        <label class="form-label fs-6 fw-bolder text-dark">
                                            Total
                                        </label>

                                        <input class="form-control form-control" type="number" name="total"
                                            value="{{ $project->vendor->total }}" />

                                        <label class="form-label fs-6 fw-bolder text-dark mt-2">
                                            Vendor File (.xlsx)
                                        </label>
                                        <input type="file" class="form-control" name="file">

                                        <label class="form-label mt-2">Note</label>
                                        <textarea type="text" class="form-control" name="note" rows="1"> {{ $project->vendor->note }} </textarea>

                                        <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ asset("/public/uploads/{$project->vendor->file->file}") }}"
                        class="btn btn-sm px-10 py-0 btn-danger">
                        <x-utils.download /> Export
                    </a>
                @else
                    <button type="button" class="btn btn-sm px-10 py-0 btn-success" data-bs-toggle="modal"
                        data-bs-target="#import_vendor_modal">
                        <x-utils.upload /> Add
                    </button>
                @endif
            </div>
        </div>
        <!--end:::Tab content-->
    </div>
    <!--end::Content-->
    <div class="modal fade" tabindex="-1" id="import_vendor_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add vendor</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('projects.vendor.store', $project) }}" method="post" class="my-2"
                        enctype="multipart/form-data">
                        @csrf

                        <label class="form-label fs-6 fw-bolder text-dark">
                            Total
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control" type="number" name="total" />

                        <label class="form-label fs-6 fw-bolder text-dark mt-2">
                            Vendor File (.xlsx)
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
