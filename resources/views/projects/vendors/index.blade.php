<x-app-layout>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
                <x-project.aside :project="$project" />
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-15">
                    <x-project.navigation :project="$project" active="vendors" />
                    <!--begin:::Tab pane-->
                    <div>
                        {{-- Import and Export vendor costs as excel file --}}
                        <div class="d-flex gap-3">
                            <button type="button" class="btn btn-sm px-10 py-0 btn-primary my-2" data-bs-toggle="modal"
                                data-bs-target="#add_vendor_modal">
                                <x-utils.upload /> Add
                            </button>
                            <button type="button" class="btn btn-sm px-10 py-0 btn-success my-2" data-bs-toggle="modal"
                                data-bs-target="#import_vendor_modal">
                                <x-utils.upload /> Import
                            </button>
                            <form action="{{ route('projects.vendors.export', $project) }}" class="my-2"
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
                                        <th>Vendor Name</th>
                                        <th>Advance</th>
                                        <th>Due</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($project->vendorCosts as $vendorCost)
                                        <tr class="border-bottom border-gray-500">
                                            <td>{{ $vendorCost->id }}</td>
                                            <td>{{ $vendorCost->title }}</td>
                                            <td>{{ $vendorCost->name }}</td>
                                            <td>{{ number_format($vendorCost->advance) }}</td>
                                            <td>{{ number_format($vendorCost->due) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($vendorCost->created_at)) }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-light-dark"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#edit_vendor_modal_{{ $vendorCost->id }}">Edit</button>
                                                <div class="modal fade" tabindex="-1"
                                                    id="edit_vendor_modal_{{ $vendorCost->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit:
                                                                    #{{ $vendorCost->id }}
                                                                    {{ $vendorCost->title }}</h5>

                                                                <!--begin::Close-->
                                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <span class="svg-icon svg-icon-2x"></span>
                                                                </div>
                                                                <!--end::Close-->
                                                            </div>

                                                            <div class="modal-body">
                                                                <form class="form w-100"
                                                                    action="{{ route('projects.vendors.update', [$project, $vendorCost]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('put')

                                                                    <div class="fv-row mb-10">
                                                                        <label
                                                                            class="form-label fs-6 fw-bolder text-dark">Title</label>
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid"
                                                                            type="text" name="title"
                                                                            value="{{ $vendorCost->title }}" />
                                                                    </div>

                                                                    <div class="fv-row mb-10">
                                                                        <label
                                                                            class="form-label fs-6 fw-bolder text-dark">Vendor
                                                                            Name</label>
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid"
                                                                            type="text" name="name"
                                                                            value="{{ $vendorCost->name }}" />
                                                                    </div>

                                                                    <div class="fv-row mb-10">
                                                                        <label
                                                                            class="form-label fs-6 fw-bolder text-dark">Advance</label>
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid"
                                                                            type="number" name="advance"
                                                                            value="{{ $vendorCost->advance }}" />
                                                                    </div>

                                                                    <div class="fv-row mb-10">
                                                                        <label
                                                                            class="form-label fs-6 fw-bolder text-dark">Due</label>
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid"
                                                                            type="number" name="due"
                                                                            value="{{ $vendorCost->due }}" />
                                                                    </div>

                                                                    <div class="fv-row mb-7">
                                                                        <label
                                                                            class="form-label fw-bolder text-dark fs-6"
                                                                            for="start_date">Date</label>
                                                                        <input class="form-control form-control-solid"
                                                                            id="edit_vendorcost_date_picker"
                                                                            name="created_at"
                                                                            value="{{ $vendorCost->created_at }}" />
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
                                                    action="{{ route('projects.vendors.delete', [$project, $vendorCost]) }}"
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
                                    Total Advance: <strong>
                                        <x-utils.currency />{{ number_format($project->totalVendorAdvance()) }}
                                    </strong><br />
                                    Total Due: <strong>
                                        <x-utils.currency />{{ number_format($project->totalVendorDue()) }}
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

    <x-slot name="script">
        <script>
            // Date Picker
            $("#add_vendorcost_date_picker").flatpickr();
            $("#edit_vendorcost_date_picker").flatpickr();
        </script>
    </x-slot>

    <div class="modal fade" tabindex="-1" id="import_vendor_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload File</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('projects.vendors.import', $project) }}" method="post"
                        class="my-2" enctype="multipart/form-data">
                        @csrf

                        <input type="file" class="form-control" name="vendor_file">

                        <button type="submit" class="btn btn-primary mt-2">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="add_vendor_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Vendor</h5>
                </div>
                <div class="modal-body">
                    <form class="form w-100" action="{{ route('projects.vendors.store', $project) }}"
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

                        <label class="form-label fs-6 fw-bolder text-dark">Vendor Name
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control" type="text" name="name" :value="old('name')" />

                        <label class="form-label fs-6 fw-bolder text-dark">Advance
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control" type="number" name="advance" :value="old('advance')" />

                        <label class="form-label fs-6 fw-bolder text-dark">Due
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control" type="number" name="due" :value="old('due')" />

                        <label class="form-label fw-bolder text-dark fs-6" for="start_date">Date
                            <x-utils.required />
                        </label>
                        <input class="form-control" id="add_vendorcost_date_picker" name="created_at"
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
