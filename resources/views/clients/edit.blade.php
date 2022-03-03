<x-app-layout>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="w-lg-700px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form class="form w-100" novalidate="novalidate" action="{{ route('clients.update', $client) }}"
                    method="post">
                    @csrf
                    @method('put')

                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">Update Client Details</h1>
                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Company Name</label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="company_name"
                            value="{{ $client->company_name }}" />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6" for="phone">Bussiness Manager</label>

                        <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2"
                            data-hide-search="true" tabindex="-1" aria-hidden="true" name="business_manager_id">
                            @foreach ($bussinessManagers as $bussinessManager)
                                <option value="{{ $bussinessManager->id }}"
                                    {{ $client->businessManager->id == $bussinessManager->id ? 'selected' : '' }}>
                                    {{ $bussinessManager->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Office Address</label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="office_address"
                            value="{{ $client->office_address }}" />
                    </div>
                    <div class="text-center mb-2">
                        <h5 class="text-dark">Contact Persons</h5>
                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                    </div>

                    <div class="d-flex gap-3 flex-wrap pt-5">
                        @foreach ($client->contactPersons as $contactPerson)
                            <div class="border p-2 my-2">
                                <h5>{{ $contactPerson->name }}</h5>
                                <div>{{ $contactPerson->designation }}</div>
                                <div>{{ $contactPerson->department }}</div>
                                <div>{{ $contactPerson->email }}</div>
                                <div>{{ $contactPerson->phone }}</div>
                                <a href="{{ route('clients.contact.edit', [$client, $contactPerson]) }}"
                                    class="btn btn-sm btn-light-primary text-center d-block m-2">Edit
                                </a>
                            </div>
                        @endforeach
                    </div>

                    {{-- Add new contact person --}}
                    <div class="d-flex my-2 gap-3">
                        <a href="{{ route('clients.contact.create', $client) }}" class="btn btn-light-primary">Add
                            new contact persons
                        </a>
                    </div>

                    <div class="d-flex align-items-center mb-10">
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
