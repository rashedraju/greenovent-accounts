<x-app-layout>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="w-lg-700px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form class="form w-100" novalidate="novalidate" action="{{ route('clients.store') }}"
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

                        <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2"
                            data-hide-search="true" tabindex="-1" aria-hidden="true" name="business_manager_id">
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

                        <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2"
                            data-hide-search="true" tabindex="-1" aria-hidden="true" name="client_id">
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

                        <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2"
                            data-hide-search="true" tabindex="-1" aria-hidden="true" name="type_id">
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
                        <input class="form-control form-control-lg form-control-solid" type="text" name="po_number"
                            :value="old('po_number')" />
                    </div>

                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">PO Value
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="po_value"
                            :value="old('po_value')" />
                    </div>

                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6" for="start_date">Start Date
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control-solid" id="project_start_date_picker"
                            name="start_date" />
                    </div>

                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6" for="closing_date">Closing Date
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control-solid" id="project_closing_date_picker"
                            name="closing_date" />
                    </div>

                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Estimate
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="external"
                            :value="old('external')" />
                    </div>

                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Internal
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="internal"
                            :value="old('internal')" />
                    </div>

                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Advance Paid</label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="advance_paid"
                            :value="old('advance_paid')" />
                    </div>

                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6" for="phone">Project Status</label>

                        <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2"
                            data-hide-search="true" tabindex="-1" aria-hidden="true" name="type_id">
                            @foreach ($projectStatuses as $projectStatus)
                                <option value="{{ $projectStatus->id }}">
                                    {{ $projectStatus->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center mb-2">
                        <h5 class="text-dark">Contact Persons</h5>
                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                    </div>

                    {{-- Contact persons --}}
                    <div id="client_contact_persons_input" class="my-2">
                        <!--begin::Form group-->
                        <div data-repeater-list="client_contact_persons_input">
                            <div data-repeater-item>
                                <label class="form-label">Name
                                    <x-utils.required />
                                </label>
                                <input type="text" class="form-control mb-2" name="name" value="{{ old('name') }}" />

                                <label class="form-label">Designation</label>
                                <input type="text" class="form-control mb-2" name="designation"
                                    value="{{ old('designation') }}" />

                                <label class="form-label">Dpartment</label>
                                <input type="text" class="form-control mb-2" name="dpartment"
                                    value="{{ old('dpartment') }}" />

                                <label class="form-label">Email</label>
                                <input type="text" class="form-control mb-2" name="email"
                                    value="{{ old('email') }}" />

                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control mb-2" name="phone"
                                    value="{{ old('phone') }}" />

                                <div class="d-flex my-2 gap-3">
                                    <a href="javascript:;" data-repeater-delete class="btn btn-light-danger">
                                        Delete
                                    </a>
                                    <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                        </i>Add
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--end::Form group-->
                    </div>

                    <div class="d-flex align-items-center mb-10">
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                            Add Client
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
