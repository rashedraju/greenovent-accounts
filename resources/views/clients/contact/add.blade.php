<x-app-layout>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="w-lg-700px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form class="form w-100" novalidate="novalidate"
                    action="{{ route('clients.contact.add', $client) }}" method="post">
                    @csrf

                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">Add New Contact Person</h1>
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
                                <input type="text" class="form-control mb-2" name="name" :value="old('client_contact_persons_input.[0].name')" />

                                <label class="form-label">Designation</label>
                                <input type="text" class="form-control mb-2" name="designation"
                                    :value="old('designation')" />

                                <label class="form-label">Dpartment</label>
                                <input type="text" class="form-control mb-2" name="dpartment"
                                    :value="old('dpartment')" />

                                <label class="form-label">Email</label>
                                <input type="text" class="form-control mb-2" name="email" :value="old('email')" />

                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control mb-2" name="phone" :value="old('phone')" />

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
                    <div class="d-flex gap-3">
                        @if (request()->skipable)
                            <a href="{{ request()->skipto }}" class="btn btn-lg btn-secondary w-100 mb-5">Skip</a>
                        @endif
                        <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                            Add Contact Person
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
