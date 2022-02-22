<x-guest-layout>
    <div class="d-flex flex-column flex-root">
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <div class="text-center">
                    <a href="{{ url('/') }}">
                        <img alt="Logo" src="{{ asset('/public/assets/media/logos/greenovent.png') }}"
                            class="w-100 w-sm-25" />
                    </a>
                </div>
                <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" method="post"
                        action="{{ route('register') }}">
                        @csrf

                        <div class="mb-10 text-center">
                            <h1 class="text-dark mb-3">Create an Account</h1>
                            <div class="text-gray-400 fw-bold fs-4">Already have an account?
                                <a href="{{ route('login') }}" class="link-primary fw-bolder">Sign in here</a>
                            </div>
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
                                    placeholder="" name="first_name" autocomplete="off" :value="old('first_name')" />
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label fw-bolder text-dark fs-6" for="last_name">Last Name</label>
                                <input class="form-control form-control-lg form-control-solid" type="text"
                                    placeholder="" name="last_name" autocomplete="off" :value="old('last_name')" />
                            </div>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="email">Email</label>
                            <input class="form-control form-control-lg form-control-solid" type="email" placeholder=""
                                name="email" autocomplete="off" :value="old('email')" />
                        </div>
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6" for="phone">Phone</label>
                            <input class="form-control form-control-lg form-control-solid" type="phone" placeholder=""
                                name="phone" autocomplete="off" :value="old('phone')" />
                        </div>

                        <div class="fv-row mb-5">
                            <label class="form-label fw-bolder text-dark fs-6" for="password">Password</label>
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                placeholder="" name="password" autocomplete="off" :value="old('password')" />
                            <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp;
                                symbols.</div>
                        </div>
                        <div class="fv-row mb-5">
                            <label class="form-label fw-bolder text-dark fs-6" for="password_confirmation ">Confirm
                                Password</label>
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                placeholder="" name="password_confirmation " autocomplete="off"
                                :value="old('password_confirmation ')" />
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-check form-check-custom form-check-solid form-check-inline">
                                <input class="form-check-input" type="checkbox" name="toc" value="1" />
                                <span class="form-check-label fw-bold text-gray-700 fs-6">I Agree
                                    <a href="#" class="ms-1 link-primary">Terms and conditions</a>.</span>
                            </label>
                        </div>
                        <div class="text-center">
                            <button type="button" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
                                <span class="indicator-label">Register</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="d-flex flex-center flex-column-auto p-10">
                <div class="d-flex align-items-center fw-bold fs-6">
                    <a href="#" class="text-muted text-hover-primary px-2">About</a>
                    <a href="mailto:rashed.greenovent@gmail.com" class="text-muted text-hover-primary px-2">Contact</a>
                    <a href="#" class="text-muted text-hover-primary px-2">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
