<x-app-layout>
    <div class="d-flex flex-column flex-xl-row">
        <x-project.aside :project="$project" />
        <!--begin::Content-->
        <div class="flex-lg-row-fluid ms-lg-15">
            <x-project.navigation :project="$project" active="externals" />
            <!--begin:::Tab pane-->
            <div>
                <div class="card">
                    <div class="card-body">
                        @if ($project->external)
                            <div class="fs-5">
                                <strong>Total:</strong>
                                &nbsp;
                                <x-utils.currency />{{ number_format($project->external->total) }}
                            </div>
                            <div class="fs-5 pb-2 border-bottom border-gray-500">
                                ASF {{ $project->external->asf }}%:
                                &nbsp;
                                <x-utils.currency />{{ number_format($project->external->asfTotal()) }}
                            </div>
                            <div class="fs-5">
                                <strong>Sub Total:</strong>
                                &nbsp;
                                <x-utils.currency />{{ number_format($project->external->asfSubTotal()) }}
                            </div>
                            <div class="fs-5 border-bottom border-gray-500">
                                VAT {{ $project->external->vat }}%:
                                &nbsp;
                                <x-utils.currency />{{ number_format($project->external->vatTotal()) }}
                            </div>
                            <div class="fs-5">
                                <strong>Grand Total:</strong>
                                &nbsp;
                                <x-utils.currency />{{ number_format($project->external->grandTotal()) }}
                            </div>
                        @else
                            <div class="alert alert-warning"> No estimate added to this project. </div>
                        @endif
                    </div>
                </div>
                {{-- Add/Edit/Delete/Download project external --}}
                <div class="d-flex gap-3">
                    <button type="button" class="btn btn-sm px-10 py-0 btn-primary my-2" data-bs-toggle="modal"
                        data-bs-target="#add_external_modal">
                        <x-utils.form-icon /> Add
                    </button>
                    <button type="button" class="btn btn-sm px-10 py-0 btn-success my-2" data-bs-toggle="modal"
                        data-bs-target="#import_external_modal">
                        <x-utils.upload /> Import
                    </button>
                    <form action="{{ route('projects.externals.export', $project) }}" class="my-2"
                        method="get">
                        @csrf
                        <button type="submit" class="btn btn-sm px-10 py-0 btn-danger">
                            <x-utils.download /> Export
                        </button>
                    </form>
                </div>
            </div>
            <!--end:::Tab content-->
        </div>
        <!--end::Content-->
    </div>

    <div class="modal fade" tabindex="-1" id="import_external_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload File</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('projects.externals.import', $project) }}" method="post"
                        class="my-2" enctype="multipart/form-data">
                        @csrf

                        <input type="file" class="form-control" name="external_file">

                        <button type="submit" class="btn btn-primary mt-2">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
