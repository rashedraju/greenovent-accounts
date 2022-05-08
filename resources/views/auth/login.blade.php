<x-guest-layout>
    <x-auth-card>
        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="{{ route('login') }}"
            method="post">
            @csrf

            <x-slot name="title">
                Sign In
            </x-slot>

            <div class="fv-row mb-10">
                <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                <input class="form-control form-control-lg form-control-solid" type="text" name="email"
                    autocomplete="off" value="{{ old('email') }}" required />
            </div>
            <div class="fv-row mb-10">
                <div class="d-flex flex-stack mb-2">
                    <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                    <a href="{{ route('password.request') }}" class="link-primary fs-6 fw-bolder">Forgot
                        Password ?</a>
                </div>
                <input class="form-control form-control-lg form-control-solid" type="password" name="password"
                    autocomplete="off" required />
            </div>

            <div class="form-check fv-row mb-10">
                <input class="form-check-input" id="remember_me" type="checkbox" name="remember">
                <label class="form-check-label" for="remember_me">
                    {{ __('Remember me') }}
                </label>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                    Login
                </button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
