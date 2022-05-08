<x-guest-layout>
    <div class="d-flex flex-column flex-root">
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <div class="text-center">
                    <a href="{{ URL::to('/') }}">
                        <img alt="Logo" src="{{ asset('/public/assets/media/logos/greenovent.png') }}"
                            class="w-100 w-sm-25" />
                    </a>
                </div>
                <div class="bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!-- Validation Errors -->
                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3"> {{ $title }}</h1>
                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                    </div>

                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    {{ $slot }}
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
