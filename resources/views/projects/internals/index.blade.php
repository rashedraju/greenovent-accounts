<x-app-layout>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
                <x-project.aside :project="$project" />
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-15">
                    <x-project.navigation :project="$project" active="internals" />
                    <!--begin:::Tab pane-->
                    <div>
                        {{-- Add internal cost form --}}
                        <form class="form w-100" action="{{ route('projects.internals.store', $project) }}"
                            method="post">
                            @csrf

                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            <div class="form-group row">
                                <div class="col-3">
                                    <label class="form-label fs-6 fw-bolder text-dark">Head
                                        <x-utils.required />
                                    </label>
                                    <input class="form-control form-control" type="text" name="title"
                                        :value="old('title')" list="internal_heads" />
                                    <datalist id="internal_heads">
                                        @foreach ($project->externalCosts as $externalCost)
                                            <option value="{{ $externalCost->title }}">{{ $externalCost->title }}
                                            </option>
                                        @endforeach
                                    </datalist>
                                </div>

                                <div class="col-3">
                                    <label class="form-label fs-6 fw-bolder text-dark">Description
                                        <x-utils.required />
                                    </label>
                                    <input class="form-control form-control" type="text" name="description"
                                        :value="old('description')" />
                                </div>

                                <div class="col-3">
                                    <label class="form-label fs-6 fw-bolder text-dark">Quantity
                                        <x-utils.required />
                                    </label>
                                    <input class="form-control form-control" type="number" name="quantity"
                                        :value="old('quantity')" />
                                </div>

                                <div class="col-3">
                                    <label class="form-label fs-6 fw-bolder text-dark">Rate
                                        <x-utils.required />
                                    </label>
                                    <input class="form-control form-control" type="number" name="rate"
                                        :value="old('rate')" />
                                </div>

                                <div class="col-3">
                                    <label class="form-label fs-6 fw-bolder text-dark">Costs
                                        <x-utils.required />
                                    </label>
                                    <input class="form-control form-control" type="number" name="costs"
                                        :value="old('costs')" />
                                </div>

                                <div class="col-3">
                                    <label class="form-label fw-bolder text-dark fs-6" for="start_date">Date
                                        <x-utils.required />
                                    </label>
                                    <input class="form-control" id="add_internal_date_picker" name="created_at"
                                        value="{{ now() }}" />
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-1">
                                <i class="fas fa-plus"></i>Add
                            </button>
                        </form>
                        <div class="table-responsive">
                            <table class="table">
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
                                    @foreach ($project->intenalCosts->reverse() as $internal)
                                        <tr class="border-bottom border-gray-500">
                                            <td>{{ $internal->id }}</td>
                                            <td>{{ $internal->title }}</td>
                                            <td>{{ $internal->quantity }}</td>
                                            <td>{{ number_format($internal->rate) }}</td>
                                            <td>{{ number_format($internal->costs) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($internal->created_at)) }}</td>
                                            <td>{{ $internal->description }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-light-dark"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#edit_internal_modal_{{ $internal->id }}">Edit</button>
                                                <div class="modal fade" tabindex="-1"
                                                    id="edit_internal_modal_{{ $internal->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit: #{{ $internal->id }}
                                                                    {{ $internal->title }}</h5>

                                                                <!--begin::Close-->
                                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <span class="svg-icon svg-icon-2x"></span>
                                                                </div>
                                                                <!--end::Close-->
                                                            </div>

                                                            <div class="modal-body">
                                                                <form class="form w-100"
                                                                    action="{{ route('projects.internals.update', [$project, $internal]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('put')

                                                                    <div class="fv-row mb-10">
                                                                        <label
                                                                            class="form-label fs-6 fw-bolder text-dark">Title</label>
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid"
                                                                            type="text" name="title"
                                                                            value="{{ $internal->title }}" />
                                                                    </div>

                                                                    <div class="fv-row mb-10">
                                                                        <label
                                                                            class="form-label fs-6 fw-bolder text-dark">Quantity</label>
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid"
                                                                            type="number" name="quantity"
                                                                            value="{{ $internal->quantity }}" />
                                                                    </div>

                                                                    <div class="fv-row mb-10">
                                                                        <label
                                                                            class="form-label fs-6 fw-bolder text-dark">Rate</label>
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid"
                                                                            type="number" name="rate"
                                                                            value="{{ $internal->rate }}" />
                                                                    </div>

                                                                    <div class="fv-row mb-10">
                                                                        <label
                                                                            class="form-label fs-6 fw-bolder text-dark">Costs</label>
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid"
                                                                            type="number" name="costs"
                                                                            value="{{ $internal->costs }}" />
                                                                    </div>

                                                                    <div class="fv-row mb-7">
                                                                        <label
                                                                            class="form-label fw-bolder text-dark fs-6"
                                                                            for="start_date">Date</label>
                                                                        <input class="form-control form-control-solid"
                                                                            id="edit_internal_date_picker"
                                                                            name="created_at"
                                                                            value="{{ $internal->created_at }}" />
                                                                    </div>

                                                                    <div class="fv-row mb-10">
                                                                        <label
                                                                            class="form-label fs-6 fw-bolder text-dark">Description</label>
                                                                        <input
                                                                            class="form-control form-control-lg form-control-solid"
                                                                            type="text" name="description"
                                                                            value="{{ $internal->description }}" />
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
                                                    action="{{ route('projects.internals.delete', [$project, $internal]) }}"
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
                                    Total Internals:<strong>
                                        <x-utils.currency />{{ number_format($project->totalInternals()) }}
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
</x-app-layout>
