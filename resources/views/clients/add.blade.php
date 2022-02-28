<x-app-layout>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form class="form w-100" novalidate="novalidate" action="{{ route('clients.store') }}"
                    method="post">
                    @csrf

                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">Add New Client</h1>
                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Company Name <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="company_name" :value="old('company_name')" required />
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="email" :value="old('email')" />
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Phone</label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="phone" :value="old('phone')" />
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Billing Cycle</label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="billing_cycle" :value="old('billing_cycle')" />
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Office Address</label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="office_address" :value="old('office_address')" />
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
