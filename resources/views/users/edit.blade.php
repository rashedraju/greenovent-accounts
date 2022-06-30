<x-app-layout>
    <div class="d-flex flex-column flex-root">
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" method="post"
                        action="{{ route('employees.update', $user) }}">
                        @csrf
                        @method('put')

                        <div class="mb-10 text-center">
                            <h1 class="text-dark mb-3">Update Employee Profile</h1>
                        </div>
                        <div class="d-flex align-items-center mb-10">
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                            <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6"
                                for="emergency_contact_relation">Image</label>
                            <input class="form-control form-control-lg form-control-solid" type="file"
                                name="profile_image" />
                            <div class="text-muted"> use jpg/jpeg/png image with max 5MB file size.</div>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="name">Name</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" name="name"
                                value="{{ $user->name }}" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="email">Email</label>
                            <input class="form-control form-control-lg form-control-solid" type="email" name="email"
                                value="{{ $user->email }}" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="phone">Phone</label>
                            <input class="form-control form-control-lg form-control-solid" type="phone" name="phone"
                                value="{{ $user->phone }}" />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="phone">Designation</label>

                            <select class="form-select form-select-solid select2-hidden-accessible"
                                data-control="select2" data-placeholder="Select Designation" data-hide-search="true"
                                tabindex="-1" aria-hidden="true" name="designation">
                                @foreach ($designations as $designation)
                                    <option value="{{ $designation }}"
                                        {{ $designation == $user->designation() ? 'selected' : '' }}>
                                        {{ $designation }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="joining_date">Joining Date</label>

                            <input type="date" pattern="\d{4}-\d{2}-\d{2}" class="form-control" name="joining_date"
                                value="{{ $user->joining_date }}" placeholder="DD-MM-YYYY">
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="current_address">Current
                                Address</label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="current_address" value="{{ $user->current_address }}" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="permanent_address">Permanent
                                Address</label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="permanent_address" value="{{ $user->permanent_address }}" />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="emergency_contact_name">Name of
                                Emergency Contact</label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="emergency_contact_name" value="{{ $user->emergency_contact_name }}" />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="emergency_contact_no">Emergency
                                Contact No.</label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="emergency_contact_no" value="{{ $user->emergency_contact_no }}" />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6"
                                for="emergency_contact_relation">Relationship with Emergency Contact</label>
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                name="emergency_contact_relation" value="{{ $user->emergency_contact_relation }}" />
                        </div>

                        <div class="fv-row mb-5">
                            <label class="form-label fw-bolder text-dark fs-6" for="password">Password</label>
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                name="password" />
                            <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp;
                                symbols.</div>
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label fw-bolder text-dark fs-6" for="password_confirmation">Confirm
                                Password</label>
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                name="password_confirmation" />
                        </div>
                        <div class="text-center">
                            <button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
                                <span class="indicator-label">Save Changes</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
