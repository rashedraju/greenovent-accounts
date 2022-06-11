<x-app-layout>
    <div class="card card-body p-5 m-sm-1 m-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4 active"><a href="{{ route('accounts-manager.index') }}">Accounts
                        Manager</a></li>
                <li class="breadcrumb-item fs-4"><a
                        href="{{ route('accounts-manager.show', $project->accountsManager->id) }}">{{ $project->accountsManager->name }}</a>
                </li>
                <li class="breadcrumb-item fs-4"><a
                        href="{{ route('accounts-manager.client', ['user' => $project->accountsManager->id, 'client' => $project->client->id]) }}">{{ $project->client->company_name }}</a>
                </li>
                <li class="breadcrumb-item fs-4">{{ $project->name }}</li>
            </ol>
        </nav>
    </div>

    <div class="flex-lg-row-fluid">
        <x-project.navigation :project="$project" active="internal" />
        <!--begin:::Tab pane-->
        <div>
            <x-validation-error />

            <div class="card">
                <div class="card-body">
                    @if ($project->internal)
                        <div class="d-flex justify-content-between">
                            <div class="fs-5 d-flex">
                                <div class="d-flex flex-column gap-3 text-end">
                                    <div class="border-bottom border-gray-500 px-5">
                                        <strong>Total:</strong>
                                    </div>
                                </div>
                                <div class="d-flex flex-column gap-3 text-end">
                                    <div class="border-bottom border-gray-500 px-5">
                                        {{ number_format($project->internal->total) }}
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 d-flex flex-column gap-3" style="border-left: 2px solid #ddd">
                                <div>Estimate:
                                    <strong>{{ number_format($project->external?->grandTotal()) }}</strong>
                                </div>
                                <div>Added: <strong>{{ $project->internal->created_at }}</strong></div>
                                <div>Last Edited: <strong>{{ $project->internal->updated_at }}</strong></div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning"> No internal added to this project. </div>
                    @endif
                </div>
            </div>

            <div class="d-flex gap-3 mt-2">
                @if ($project->internal)
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-sm px-10 py-0 btn-success" data-bs-toggle="modal"
                            data-bs-target="#edit_internal_modal">
                            <x-utils.upload /> Edit
                        </button>
                        <a href="{{ asset("/public/uploads/{$project->internal->file->file}") }}"
                            class="btn btn-sm px-10 py-0 btn-danger">
                            <x-utils.download /> Export
                        </a>
                    </div>

                    <div class="modal fade" tabindex="-1" id="edit_internal_modal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div>
                                        <h5 class="modal-title">Edit internal</h5>
                                        {{-- <small class="text-danger">After edit the internal a
                                                request send to
                                                the business manager for
                                                approval.</small> --}}
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
                @else
                    <button type="button" class="btn btn-sm px-10 py-0 btn-success" data-bs-toggle="modal"
                        data-bs-target="#import_internal_modal">
                        <x-utils.upload /> Add
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
                    <h5 class="modal-title">Add internal</h5>
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
