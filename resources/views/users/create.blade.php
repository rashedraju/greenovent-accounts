<x-app-layout>
    <div class="row">
        <div class="col-12 col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" method="post"
                        action="{{ route('employees.store') }}" enctype="multipart/form-data">
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
                            <label class="form-label fw-bolder text-dark fs-6" for="emergency_contact_relation">Profile
                                Image</label>
                            <input class="form-control form-control-lg form-control-solid" type="file"
                                name="profile_image" value="{{ old('profile_image') }}" />
                            <div class="text-muted"> use jpg/jpeg/png image with max 5MB file size.</div>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="name">Name
                                <x-utils.required />
                            </label>
                            <input class="form-control form-control-lg form-control-solid" type="text" name="name"
                                value="{{ old('name') }}" placeholder="Ex. John Doe" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="email">Email
                                <x-utils.required />
                            </label>
                            <input class="form-control form-control-lg form-control-solid" type="email" name="email"
                                value="{{ old('email') }}" placeholder="Ex. john@exmaple.com" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="phone">Phone
                                <x-utils.required />
                            </label>
                            <input class="form-control form-control-lg form-control-solid" type="text" name="phone"
                                value="{{ old('phone') }}" placeholder="Ex. 01xxxxxxxxx" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="phone">Designation
                                <x-utils.required />
                            </label>

                            <select class="form-select form-select-solid select2-hidden-accessible"
                                data-control="select2" data-hide-search="true" tabindex="-1" aria-hidden="true"
                                name="designation" value="{{ old('designation') }}">
                                @foreach ($designations as $designation)
                                    <option value="{{ $designation }}">
                                        {{ $designation }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="joining_date">Joining Date</label>
                            <input class="form-control form-control-solid" id="user_add_joining_date_picker"
                                name="joining_date" value="{{ old('joining_date') }}"
                                placeholder="Select joining date" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="current_address">Current
                                Address</label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="current_address" value="{{ old('current_address') }}"
                                placeholder="Ex. Dhanmondi, Dhaka-1209" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="permanent_address">Permanent
                                Address</label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="permanent_address" value="{{ old('permanent_address') }}"
                                placeholder="Ex. Dhanmondi, Dhaka-1209" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="emergency_contact_name">Name of
                                Emergency Contact</label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="emergency_contact_name" value="{{ old('emergency_contact_name') }}"
                                placeholder="Ex. John Doe" />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="emergency_contact_no">Emergency
                                Contact No.</label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="emergency_contact_no" value="{{ old('emergency_contact_no') }}"
                                placeholder="Ex. 01xxxxxxxxx" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6"
                                for="emergency_contact_relation">Relationship with Emergency Contact</label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="emergency_contact_relation" value="{{ old('emergency_contact_relation') }}"
                                placeholder="Ex. Brother" />
                        </div>

                        <div class="fv-row mb-5">
                            <label class="form-label fw-bolder text-dark fs-6" for="password">Password
                                <x-utils.required />
                            </label>
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                name="password" value="{{ old('password') }}" />
                            <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp;
                                symbols.</div>
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label fw-bolder text-dark fs-6" for="password_confirmation">Confirm
                                Password
                                <x-utils.required />
                            </label>
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
