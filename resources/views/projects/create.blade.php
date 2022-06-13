<x-app-layout>
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form class="form w-100" novalidate="novalidate" action="{{ route('projects.store') }}"
                        method="post">
                        @csrf

                        <div class="text-center mb-10">
                            <h1 class="text-dark mb-3">Add New Project</h1>
                        </div>
                        <div class="d-flex align-items-center mb-10">
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                            <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">Project Name
                                <x-utils.required />
                            </label>
                            <input class="form-control form-control-lg form-control-solid" type="text" name="name"
                                :value="old('name')" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="phone">Bussiness Manager <span
                                    class="text-danger"> * </span></label>

                            <select class="form-select form-select-solid select2-hidden-accessible"
                                data-control="select2" data-hide-search="true" tabindex="-1" aria-hidden="true"
                                name="business_manager_id">
                                @foreach ($bussinessManagers as $bussinessManager)
                                    <option value="{{ $bussinessManager->id }}">
                                        {{ $bussinessManager->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="phone">Client
                                <x-utils.required />
                            </label>

                            <select class="form-select form-select-solid select2-hidden-accessible"
                                data-control="select2" data-hide-search="true" tabindex="-1" aria-hidden="true"
                                name="client_id">
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">
                                        {{ $client->company_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="phone">Project Type
                                <x-utils.required />
                            </label>

                            <select class="form-select form-select-solid select2-hidden-accessible"
                                data-control="select2" data-hide-search="true" tabindex="-1" aria-hidden="true"
                                name="type_id">
                                @foreach ($projectTypes as $projectType)
                                    <option value="{{ $projectType->id }}">
                                        {{ $projectType->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">PO Number
                                <x-utils.required />
                            </label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="po_number" />
                        </div>

                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">PO Value
                                <x-utils.required />
                            </label>
                            <input class="form-control form-control-lg form-control-solid" type="number" name="po_value"
                                :value="old('po_value')" />
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">Advance Paid</label>
                            <input class="form-control form-control-lg form-control-solid" type="number"
                                name="advance_paid" :value="old('advance_paid')" />
                        </div>

                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">BP</label>
                            <input class="form-control form-control-lg form-control-solid" type="number"
                                name="bp" :value="old('bp')" />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="phone">Bill Type
                                <x-utils.required />
                            </label>

                            <select class="form-select form-select-solid select2-hidden-accessible"
                                data-control="select2" data-hide-search="true" tabindex="-1" aria-hidden="true"
                                name="bill_type">
                                @foreach ($billTypes as $billType)
                                    <option value="{{ $billType->id }}">
                                        {{ $billType->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="start_date">Start Date
                                <x-utils.required />
                            </label>
                            <input class="form-control form-control-solid" id="project_start_date_picker"
                                name="start_date" placeholder="YYYY-MM-DD" />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="closing_date">Closing Date
                                <x-utils.required />
                            </label>
                            <input class="form-control form-control-solid" id="project_closing_date_picker"
                                name="closing_date" placeholder="YYYY-MM-DD" />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="type_id">Project Status</label>

                            <select class="form-select form-select-solid select2-hidden-accessible"
                                data-control="select2" data-hide-search="true" tabindex="-1" aria-hidden="true"
                                name="type_id">
                                @foreach ($projectStatuses as $projectStatus)
                                    <option value="{{ $projectStatus->id }}">
                                        {{ $projectStatus->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex align-items-center mb-10">
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                            <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        </div>
                        <div class="d-flex gap-3">
                            <a href="{{ route('projects.index') }}" class="btn btn-lg btn-secondary w-100 mb-5">Go
                                Back</a>
                            <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                                Add Project
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
