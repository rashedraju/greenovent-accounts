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

            <div class="d-flex gap-3 my-2">
                @if ($project->internal)
                    <div class="d-flex gap-3 justify-content-end">
                        <button type="button" class="btn px-10 py-2 btn-primary" id="edit_internal_drawer_btn">
                            <x-utils.upload /> Edit
                        </button>
                        <a href="{{ asset("/public/uploads/{$project->internal->file->file}") }}"
                            class="btn px-10 py-2 btn-danger">
                            <x-utils.download /> Export
                        </a>
                    </div>

                    <x-drawer btnId="edit_internal_drawer_btn" drawerId="edit_internal_drawer" title="Edit Internal">
                        <form action="{{ route('projects.internal.update', [$project, $project->internal]) }}"
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
                    </x-drawer>
                @else
                    <button type="button" class="btn px-10 py-2 btn-success" id="import_internal_btn">
                        <x-utils.upload /> Add Internal
                    </button>
                @endif
            </div>

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

            <div class="overflow-scroll">
                <div style="width: 150vw">
                    {!! $sheetHeader !!}
                    {!! $sheetData !!}
                    {!! $sheetFooter !!}
                </div>
            </div>
        </div>
        <!--end:::Tab content-->
    </div>
    <!--end::Content-->

    <x-drawer btnId="import_internal_btn" drawerId="import_internal_drawer" title="Import Internal">
        <form action="{{ route('projects.internal.store', $project) }}" method="post" class="my-2"
            enctype="multipart/form-data">
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

            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </x-drawer>
</x-app-layout>
