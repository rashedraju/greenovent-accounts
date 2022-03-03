<x-app-layout>
    <div class="d-flex flex-column flex-root">
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" method="post"
                        action="{{ route('employees.store') }}">
                        @csrf

                        <div class="mb-10 text-center">
                            <h1 class="text-dark mb-3">Add an Employee</h1>
                        </div>
                        <div class="d-flex align-items-center mb-10">
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                            <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="name">Name <span
                                    class="text-danger"> * </span></label>
                            <input class="form-control form-control-lg form-control-solid" type="text" name="name"
                                :value="old('name')" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="email">Email <span
                                    class="text-danger"> * </span></label>
                            <input class="form-control form-control-lg form-control-solid" type="email" name="email"
                                :value="old('email')" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="phone">Phone <span
                                    class="text-danger"> * </span></label>
                            <input class="form-control form-control-lg form-control-solid" type="text" name="phone"
                                :value="old('phone')" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="phone">Designation <span
                                    class="text-danger"> * </span></label>

                            <select class="form-select form-select-solid select2-hidden-accessible"
                                data-control="select2" data-hide-search="true" tabindex="-1" aria-hidden="true"
                                name="designation_id">
                                @foreach ($designations as $designation)
                                    <option value="{{ $designation->id }}">
                                        {{ $designation->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="joining_date">Joining Date <span
                                    class="text-danger"> * </span></label>
                            <input class="form-control form-control-solid" id="user_add_joining_date_picker"
                                name="joining_date" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="current_address">Current
                                Address<span class="text-danger"> * </span> </label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="current_address" :value="old('current_address')" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="permanent_address">Permanent
                                Address <span class="text-danger"> * </span></label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="permanent_address" :value="old('permanent_address')" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="emergency_contact_name">Name of
                                Emergency Contact<span class="text-danger"> * </span></label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="emergency_contact_name" :value="old('emergency_contact_name')" />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="emergency_contact_no">Emergency
                                Contact No. <span class="text-danger"> * </span></label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="emergency_contact_no" :value="old('emergency_contact_no')" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6"
                                for="emergency_contact_relation">Relationship with Emergency Contact<span
                                    class="text-danger"> * </span></label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="emergency_contact_relation" :value="old('emergency_contact_relation')" />
                        </div>

                        <div class="fv-row mb-5">
                            <label class="form-label fw-bolder text-dark fs-6" for="password">Password<span
                                    class="text-danger"> * </span></label>
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                name="password" value="{{ old('password') }}" />
                            <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp;
                                symbols.</div>
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label fw-bolder text-dark fs-6" for="password_confirmation">Confirm
                                Password<span class="text-danger"> * </span></label>
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                name="password_confirmation" value="{{ old('password_confirmation') }}" />
                        </div>
                        <div class="text-center">
                            <button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
                                <span class="indicator-label">Add Employee</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
