<x-app-layout>
    <div class="d-flex flex-column flex-root">
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" method="post"
                        action="{{ route('employees.edit', $user) }}">
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
                        <div class="row fv-row mb-7">
                            <div class="col-xl-6">
                                <label class="form-label fw-bolder text-dark fs-6" for="first_name">First Name</label>
                                <input class="form-control form-control-lg form-control-solid" type="text"
                                    placeholder="" name="first_name" autocomplete="off"
                                    value="{{ $user->first_name }}" />
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label fw-bolder text-dark fs-6" for="last_name">Last Name</label>
                                <input class="form-control form-control-lg form-control-solid" type="text"
                                    placeholder="" name="last_name" autocomplete="off"
                                    value="{{ $user->last_name }}" />
                            </div>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="email">Email</label>
                            <input class="form-control form-control-lg form-control-solid" type="email" placeholder=""
                                name="email" autocomplete="off" value="{{ $user->email }}" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="phone">Phone</label>
                            <input class="form-control form-control-lg form-control-solid" type="phone" placeholder=""
                                name="phone" autocomplete="off" value="{{ $user->phone }}" />
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="phone">Designation</label>

                            <select class="form-select form-select-solid select2-hidden-accessible"
                                data-control="select2" data-placeholder="Select Designation" data-hide-search="true"
                                tabindex="-1" aria-hidden="true" name="designation_id">
                                @foreach ($designations as $designation)
                                    <option value="{{ $designation->id }}"
                                        {{ $designation->id == $user->designation->id ? 'selected' : '' }}>
                                        {{ $designation->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="phone">Account Status</label>

                            <select class="form-select form-select-solid select2-hidden-accessible"
                                data-control="select2" data-placeholder="Select Designation" data-hide-search="true"
                                tabindex="-1" aria-hidden="true" name="status_id">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}"
                                        {{ $user->status->id == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="fv-row mb-5">
                            <label class="form-label fw-bolder text-dark fs-6" for="password">Password</label>
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                placeholder="" name="password" autocomplete="off" value="" />
                            <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp;
                                symbols.</div>
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label fw-bolder text-dark fs-6" for="password_confirmation">Confirm
                                Password</label>
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                placeholder="" name="password_confirmation" autocomplete="off" value="" />
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
