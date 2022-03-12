<x-app-layout>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
                <x-project.aside :project="$project" />
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-15">
                    <x-project.navigation :project="$project" active="externals" />
                    <!--begin:::Tab pane-->
                    <div>
                        {{-- Import and Export excel file --}}
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

                        <div class="table-responsive">
                            <table class="table table-striped gs-7">
                                <thead>
                                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-500">
                                        <th>SL.</th>
                                        <th>Head</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th>Cost</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($project->externalCosts as $external)
                                        <tr class="border-bottom border-gray-500">
                                            <td>{{ $external->id }}</td>
                                            <td>{{ $external->title }}</td>
                                            <td>{{ number_format($external->quantity) }}</td>
                                            <td>{{ number_format($external->rate) }}</td>
                                            <td>{{ number_format($external->costs) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($external->created_at)) }}</td>
                                            <td>{{ $external->description }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-light-dark"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#edit_external_modal_{{ $external->id }}">Edit</button>
                                                <div class="modal fade" tabindex="-1"
                                                    id="edit_external_modal_{{ $external->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit: #{{ $external->id }}
                                                                    {{ $external->title }}</h5>

                                                                <!--begin::Close-->
                                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <span class="svg-icon svg-icon-2x"></span>
                                                                </div>
                                                                <!--end::Close-->
                                                            </div>

                                                            <div class="modal-body">
                                                                <form class="form w-100"
                                                                    action="{{ route('projects.externals.update', [$project, $external]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('put')

                                                                    <div class="fv-row mb-10">
                                                                        <label
                                                                            class="form-label fs-6 fw-bolder text-dark">Title</label>
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid"
                                                                            type="text" name="title"
                                                                            value="{{ $external->title }}" />
                                                                    </div>

                                                                    <div class="fv-row mb-10">
                                                                        <label
                                                                            class="form-label fs-6 fw-bolder text-dark">Quantity</label>
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid"
                                                                            type="number" name="quantity"
                                                                            value="{{ $external->quantity }}" />
                                                                    </div>

                                                                    <div class="fv-row mb-10">
                                                                        <label
                                                                            class="form-label fs-6 fw-bolder text-dark">Rate</label>
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid"
                                                                            type="number" name="rate"
                                                                            value="{{ $external->rate }}" />
                                                                    </div>

                                                                    <div class="fv-row mb-10">
                                                                        <label
                                                                            class="form-label fs-6 fw-bolder text-dark">Costs</label>
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid"
                                                                            type="number" name="costs"
                                                                            value="{{ $external->costs }}" />
                                                                    </div>

                                                                    <div class="fv-row mb-7">
                                                                        <label
                                                                            class="form-label fw-bolder text-dark fs-6"
                                                                            for="start_date">Date</label>
                                                                        <input class="form-control form-control-solid"
                                                                            id="edit_externals_date_picker"
                                                                            name="created_at"
                                                                            value="{{ $external->created_at }}" />
                                                                    </div>

                                                                    <div class="fv-row mb-10">
                                                                        <label
                                                                            class="form-label fs-6 fw-bolder text-dark">Description</label>
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid"
                                                                            type="text" name="description"
                                                                            value="{{ $external->description }}" />
                                                                    </div>
                                                                    <div class="text-center">
                                                                        <button type="submit"
                                                                            class="btn btn-lg btn-primary w-100 mb-5">
                                                                            Save Changes
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <form
                                                    action="{{ route('projects.externals.delete', [$project, $external]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-light-danger"
                                                        data-kt-users-table-filter="delete_row">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="border-top border-gray-500 p-3">
                                <div class="fs-4">
                                    Total Externals:<strong>
                                        <x-utils.currency />{{ number_format($project->totalExternals()) }}
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end:::Tab content-->
                </div>
                <!--end::Content-->
            </div>
        </div>
        <!--end::Container-->
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

    <div class="modal fade" tabindex="-1" id="add_external_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add External</h5>
                </div>
                <div class="modal-body">
                    <x-validation-error />
                    {{-- Add External cost form --}}
                    <form class="form w-100" action="{{ route('projects.externals.store', $project) }}"
                        method="post">
                        @csrf

                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <label class="form-label fs-6 fw-bolder text-dark">Head
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control" type="text" name="title" :value="old('title')"
                            list="external_heads" />
                        <datalist id="external_heads">
                            @foreach ($project->externalCosts as $externalCost)
                                <option value="{{ $externalCost->title }}">{{ $externalCost->title }}
                                </option>
                            @endforeach
                        </datalist>

                        <label class="form-label fs-6 fw-bolder text-dark">Description
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control" type="text" name="description"
                            :value="old('description')" />

                        <label class="form-label fs-6 fw-bolder text-dark">Quantity
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control" type="number" name="quantity"
                            :value="old('quantity')" />

                        <label class="form-label fs-6 fw-bolder text-dark">Rate
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control" type="number" name="rate" :value="old('rate')" />

                        <label class="form-label fs-6 fw-bolder text-dark">Costs
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control" type="number" name="costs" :value="old('costs')" />

                        <label class="form-label fw-bolder text-dark fs-6" for="start_date">Date
                            <x-utils.required />
                        </label>
                        <input class="form-control" id="add_external_date_picker" name="created_at"
                            value="{{ now() }}" />

                        <button type="submit" class="btn btn-primary mt-1">
                            <i class="fas fa-plus"></i>Add
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
