<x-app-layout>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="w-lg-700px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form class="form w-100" novalidate="novalidate" action="{{ route('projects.update', $project) }}"
                    method="post">
                    @csrf
                    @method('put')

                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">Edit Project</h1>
                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Project Name
                        </label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="name"
                            value="{{ $project->name }}" />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6" for="phone">Bussiness Manager</label>

                        <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2"
                            data-hide-search="true" tabindex="-1" aria-hidden="true" name="business_manager_id">
                            @foreach ($bussinessManagers as $bussinessManager)
                                <option value="{{ $bussinessManager->id }}"
                                    {{ $project->manager->id == $bussinessManager->id ? 'selected' : '' }}>
                                    {{ $bussinessManager->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6" for="phone">Client</label>

                        <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2"
                            data-hide-search="true" tabindex="-1" aria-hidden="true" name="client_id">
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ $project->client->id == $client->id ? 'selected' : '' }}>
                                    {{ $client->company_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6" for="phone">Project Type</label>

                        <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2"
                            data-hide-search="true" tabindex="-1" aria-hidden="true" name="type_id">
                            @foreach ($projectTypes as $projectType)
                                <option value="{{ $projectType->id }}"
                                    {{ $project->type->id == $projectType->id ? 'selected' : '' }}>
                                    {{ $projectType->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">PO Number</label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="po_number"
                            value="{{ $project->po_number }}" />
                    </div>

                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">PO Value</label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="po_value"
                            value="{{ $project->po_value }}" />
                    </div>

                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6" for="start_date">Start Date</label>
                        <input class="form-control form-control-solid" id="project_start_date_picker" name="start_date"
                            value="{{ $project->start_date }}" />
                    </div>

                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6" for="closing_date">Closing Date</label>
                        <input class="form-control form-control-solid" id="project_closing_date_picker"
                            name="closing_date" value="{{ $project->closing_date }}" />
                    </div>

                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Advance Paid</label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="advance_paid"
                            value="{{ $project->advance_paid }}" />
                    </div>

                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6" for="phone">Project Status</label>

                        <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2"
                            data-hide-search="true" tabindex="-1" aria-hidden="true" name="status_id">
                            @foreach ($projectStatuses as $projectStatus)
                                <option value="{{ $projectStatus->id }}"
                                    {{ $project->status->id == $projectStatus->id ? 'selected' : '' }}>
                                    {{ $projectStatus->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex align-items-center mb-10">
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
