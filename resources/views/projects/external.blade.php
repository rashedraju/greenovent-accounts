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
        <x-project.navigation :project="$project" active="external" />
        <!--begin:::Tab pane-->
        <div>
            <div class="d-flex gap-3 my-2">
                @if ($project->external)
                    <div class="d-flex gap-3 justify-content-end">
                        <button type="button" class="btn px-10 py-2 btn-primary" id="edit_external_btn">
                            <x-utils.upload /> Edit
                        </button>

                        <a href="{{ asset("/public/uploads/{$project->external->file->file}") }}"
                            class="btn px-10 py-2 btn-danger">
                            <x-utils.download /> Export
                        </a>
                    </div>

                    <x-drawer btnId="edit_external_btn" drawerId="edit_external_drawer" title="Edit External">
                        <form action="{{ route('projects.external.update', [$project, $project->external]) }}"
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
                    </x-drawer>
                @else
                    <button type="button" class="btn px-10 py-2 btn-success" id="import_external_btn">
                        <x-utils.upload /> Add External
                    </button>
                @endif
            </div>

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

    <x-drawer btnId="import_external_btn" drawerId="import_external_drawer" title="Import External">
        <form action="{{ route('projects.external.store', $project) }}" method="post" class="my-2"
            enctype="multipart/form-data">
            @csrf

            <label class="form-label fs-6 fw-bolder text-dark">
                Total
                <x-utils.required />
            </label>
            <input class="form-control form-control" type="number" name="total" :value="old('total')" />

            <label class="form-label fs-6 fw-bolder text-dark mt-2">
                ASF(%)
                <x-utils.required />
            </label>
            <input class="form-control form-control" type="number" name="asf" :value="old('asf')" />

            <label class="form-label fs-6 fw-bolder text-dark mt-2">
                VAT(%)
                <x-utils.required />
            </label>
            <input class="form-control form-control" type="number" name="vat" :value="old('vat')" />

            <label class="form-label fs-6 fw-bolder text-dark mt-2">
                Extimate File (.xlsx)
                <x-utils.required />
            </label>
            <input type="file" class="form-control" name="file" :value="old('file')">

            <label class="form-label mt-2">Note</label>
            <textarea type="text" class="form-control" name="note" rows="1"> </textarea>

            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </x-drawer>
</x-app-layout>
