<x-app-layout>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="w-lg-700px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form class="form w-100" novalidate="novalidate"
                    action="{{ route('clients.contact.update', [$client, $clientContactPerson]) }}" method="post">
                    @csrf
                    @method('put')

                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">Edit Client Contact Person</h1>
                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                    </div>

                    <label class="form-label">Name
                        <x-utils.required />
                    </label>
                    <input type="text" class="form-control mb-2" name="name"
                        value="{{ $clientContactPerson->name }}" />

                    <label class="form-label">Designation</label>
                    <input type="text" class="form-control mb-2" name="designation"
                        value="{{ $clientContactPerson->designation }}" />

                    <label class="form-label">Dpartment</label>
                    <input type="text" class="form-control mb-2" name="department"
                        value="{{ $clientContactPerson->department }}" />

                    <label class="form-label">Email</label>
                    <input type="text" class="form-control mb-2" name="email"
                        value="{{ $clientContactPerson->email }}" />

                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control mb-2" name="phone"
                        value="{{ $clientContactPerson->phone }}" />

                    <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                        Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>

</x-app-layout>
