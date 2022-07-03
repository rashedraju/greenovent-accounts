<x-app-layout>
    <div class="p-1 mt-sm-1 mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4 active"><a href="{{ route('accounts-manager.index') }}">Accounts
                        Manager</a></li>
                <li class="breadcrumb-item fs-4">{{ $data['accountsManager']->name }}</li>
            </ol>
        </nav>
    </div>

    <div class="card mt-3 py-10">
        <div class="row">
            <div class="d-flex justify-content-between">
                <h3 class="text-center mb-5 flex-grow-1">Clients</h3>
                <button class="btn btn-sm btn-primary mx-2" id="add_client_btn">
                    <x-utils.add-icon /> Add New Client
                </button>
            </div>

            <x-validation-error />

            <div class="col-12 col-sm-6 mx-auto">
                @foreach ($data['clients'] as $clientId => $clientName)
                    <div class="d-flex justify-content-between align-item-center my-2 border border-secondary ">
                        <a href="{{ route('accounts-manager.client', ['user' => $data['accountsManager']->id, 'client' => $clientId]) }}"
                            class="bg-hover-secondary align-self-center flex-grow-1 p-3"
                            style="margin-left: 0; margin-right: 0">
                            {{ $clientName }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('components.sales-table')

    <x-drawer btnId="add_client_btn" drawerId="add_client" title="Add new client">
        <form class="form w-100" novalidate="novalidate" action="{{ route('clients.store') }}" method="post">
            @csrf

            <div class="fv-row mb-10">
                <label class="form-label fs-6 fw-bolder text-dark">Company Name <span
                        class="text-danger">*</span></label>
                <input class="form-control form-control-lg form-control-solid" type="text" name="company_name"
                    :value="old('company_name')" required />
            </div>

            <input type="hidden" name="business_manager_id" value="{{ $data['accountsManager']->id }}">

            <div class="fv-row mb-10">
                <label class="form-label fs-6 fw-bolder text-dark">Office Address <span class="text-danger">
                        * </span></label>
                <input class="form-control form-control-lg form-control-solid" type="text" name="office_address"
                    :value="old('office_address')" />
            </div>
            <div class="text-center mb-2">
                <h5 class="text-dark">Contact Persons</h5>
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
                        <input type="text" class="form-control mb-2" name="name" value="{{ old('name') }}" />

                        <label class="form-label">Designation</label>
                        <input type="text" class="form-control mb-2" name="designation"
                            value="{{ old('designation') }}" />

                        <label class="form-label">Dpartment</label>
                        <input type="text" class="form-control mb-2" name="department"
                            value="{{ old('department') }}" />

                        <label class="form-label">Email</label>
                        <input type="text" class="form-control mb-2" name="email" value="{{ old('email') }}" />

                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control mb-2" name="phone" value="{{ old('phone') }}" />

                        <div class="d-flex justify-content-end my-2 gap-3">
                            <a href="javascript:;" data-repeater-delete class="btn btn-secondary">
                                Delete contact person
                            </a>
                            <a href="javascript:;" data-repeater-create class="btn btn-secondary">
                                </i>Add more contact person
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
            <div class="text-center">
                <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                    Add Client
                </button>
            </div>
        </form>
    </x-drawer>


</x-app-layout>
