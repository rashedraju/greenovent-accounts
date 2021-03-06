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
    <!--begin::Content-->
    <div class="flex-lg-row-fluid">
        <x-project.navigation :project="$project" active="vendor" />
        <!--begin:::Tab pane-->
        <div>
            <x-validation-error />

            <div class="d-flex gap-3 my-2">
                @if ($project->vendor)
                    <div class="d-flex gap-3 justify-content-end">
                        <button type="button" class="btn btn-sm px-10 py-2 btn-primary" id="edit_vendor_btn">
                            <x-utils.upload /> Edit
                        </button>

                        <a href="{{ asset("/public/uploads/{$project->vendor->file->file}") }}"
                            class="btn btn-sm px-10 py-2 btn-danger">
                            <x-utils.download /> Export
                        </a>
                    </div>

                    <x-drawer btnId="edit_vendor_btn" drawerId="edit_vendor_drawer" title="Edit Vendor Costing">
                        <form action="{{ route('projects.vendor.update', [$project, $project->vendor]) }}"
                            method="post" class="my-2" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <label class="form-label fs-6 fw-bolder text-dark">
                                Total
                            </label>

                            <input class="form-control form-control" type="number" step="0.01" name="total"
                                value="{{ $project->vendor->total }}" />

                            <label class="form-label fs-6 fw-bolder text-dark">
                                Due
                            </label>

                            <input class="form-control form-control" type="number" step="0.01" name="due"
                                value="{{ $project->vendor->due }}" />

                            <label class="form-label fs-6 fw-bolder text-dark mt-2">
                                Vendor File (.xlsx)
                            </label>
                            <input type="file" class="form-control" name="file">

                            <label class="form-label mt-2">Note</label>
                            <textarea type="text" class="form-control" name="note" rows="1"> {{ $project->vendor->note }} </textarea>

                            <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
                        </form>
                    </x-drawer>
                @else
                    <button type="button" class="btn btn-sm px-10 py-2 btn-success" id="add_vendor_btn">
                        <x-utils.upload /> Add
                    </button>
                @endif
            </div>

            <div class="card">
                <div class="card-body">
                    @if ($project->vendor)
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="fs-5 d-flex">
                                    <div class="d-flex flex-column gap-3 text-end">
                                        <div class="px-5">
                                            <strong>Total:</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-3 text-end">
                                        <div class="px-5">
                                            {{ number_format($project->vendor->total, 2) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="fs-5 d-flex">
                                    <div class="d-flex flex-column gap-3 text-end">
                                        <div class="border-bottom border-gray-500 px-5">
                                            <strong>Due:</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-3 text-end">
                                        <div class="border-bottom border-gray-500 px-5">
                                            {{ number_format($project->vendor->due, 2) }}
                                        </div>
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
    <x-drawer btnId="add_vendor_btn" drawerId="add_vendor_drawer" title="Add Vendor Costing">
        <form action="{{ route('projects.vendor.store', $project) }}" method="post" class="my-2"
            enctype="multipart/form-data">
            @csrf

            <label class="form-label fs-6 fw-bolder text-dark">
                Total
                <x-utils.required />
            </label>
            <input class="form-control form-control" type="number" step="0.01" name="total" />

            <label class="form-label fs-6 fw-bolder text-dark">
                Due
            </label>
            <input class="form-control form-control" type="number" step="0.01" name="due" />

            <label class="form-label fs-6 fw-bolder text-dark mt-2">
                Vendor File (.xlsx)
            </label>
            <input type="file" class="form-control" name="file">

            <label class="form-label mt-2">Note</label>
            <textarea type="text" class="form-control" name="note" rows="1"> </textarea>

            <button type="submit" class="btn btn-primary mt-2">Add</button>
        </form>
    </x-drawer>
</x-app-layout>
