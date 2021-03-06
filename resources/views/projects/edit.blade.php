<x-app-layout>
    <div class="flex-lg-row-fluid ms-lg-15">
        <x-project.navigation :project="$project" active="" />

        <div class="col-12 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header justify-content-center">
                    <h3 class="mt-5">Edit Project</h3>
                </div>
                <!-- Validation Errors -->
                <div class="card-body">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form class="form w-100" novalidate="novalidate" action="{{ route('projects.update', $project) }}"
                        method="post">
                        @csrf
                        @method('put')

                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">Project Name
                            </label>
                            <input class="form-control form-control-lg form-control-solid" type="text" name="name"
                                value="{{ $project->name }}" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="phone">Accounts Manager</label>

                            <select class="form-select form-select-solid select2-hidden-accessible"
                                data-control="select2" data-hide-search="true" tabindex="-1" aria-hidden="true"
                                name="business_manager_id">
                                @foreach ($bussinessManagers as $bussinessManager)
                                    <option value="{{ $bussinessManager->id }}"
                                        {{ $project->manager->id == $bussinessManager->id ? 'selected' : '' }}>
                                        {{ $bussinessManager->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="phone">Client</label>

                            <select class="form-select form-select-solid select2-hidden-accessible"
                                data-control="select2" data-hide-search="true" tabindex="-1" aria-hidden="true"
                                name="client_id">
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}"
                                        {{ $project->client->id == $client->id ? 'selected' : '' }}>
                                        {{ $client->company_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="phone">Project Type</label>

                            <select class="form-select form-select-solid select2-hidden-accessible"
                                data-control="select2" data-hide-search="true" tabindex="-1" aria-hidden="true"
                                name="type_id">
                                @foreach ($projectTypes as $projectType)
                                    <option value="{{ $projectType->id }}"
                                        {{ $project->type->id == $projectType->id ? 'selected' : '' }}>
                                        {{ $projectType->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">PO Number</label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="po_number" value="{{ $project->po_number }}" />
                        </div>

                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">PO Value</label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="po_value" value="{{ $project->po_value }}" />
                        </div>

                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">Advance Paid</label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="advance_paid" value="{{ $project->advance_paid }}" />
                        </div>

                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">BP</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" name="bp"
                                value="{{ $project->bp }}" />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="phone">Bill Type
                                <x-utils.required />
                            </label>
                            <select class="form-select form-select-solid select2-hidden-accessible"
                                data-control="select2" data-hide-search="true" tabindex="-1" aria-hidden="true"
                                name="bill_type">

                                @foreach ($billTypes as $billType)
                                    <option value="{{ $billType->id }}"
                                        {{ $project->billType->id == $billType->id ? 'selected' : '' }}>
                                        {{ $billType->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <x-input.date label="Start Date" name="start_date" value="{{ $project->start_date }}" />
                        <x-input.date label="Closing Date" name="closing_date"
                            value="{{ $project->closing_date }}" />

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="phone">Project Status</label>

                            <select class="form-select form-select-solid select2-hidden-accessible"
                                data-control="select2" data-hide-search="true" tabindex="-1" aria-hidden="true"
                                name="status_id">
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
    </div>
</x-app-layout>
