<x-app-layout>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1>Add New Client</h1>
        </div>
        <div class="card-body row">
            <div class="col-12 col-lg-8">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form class="form w-100" novalidate="novalidate" action="{{ route('clients.store') }}"
                    method="post">
                    @csrf

                    <div class="d-flex align-items-center mb-10">
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Company Name <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="company_name"
                            :value="old('company_name')" required />
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
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Office Address <span class="text-danger">
                                * </span></label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="office_address"
                            :value="old('office_address')" />
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

            <div class="col-12 col-lg-4 border p-3 fs-5">
                After adding new client approval request will go to:
                <ul>
                    <li>Executive Director</li>
                    <li>COO</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
