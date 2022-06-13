<x-app-layout>
    <div class="p-1 mt-sm-1 mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4 active"><a href="{{ route('accounts-manager.index') }}">Accounts
                        Manager</a></li>
                <li class="breadcrumb-item fs-4"><a
                        href="{{ route('accounts-manager.show', $data['accountsManager']->id) }}">{{ $data['accountsManager']->name }}</a>
                </li>
                <li class="breadcrumb-item fs-4">{{ $data['client']->company_name }}</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-wrap gap-3">
                <div class="bg-light p-5 border border-gray-300 flex-grow-1">
                    <p class="text-gray-700">Sales this year</p>
                    <h1 class="text-black">
                        <x-utils.currency />{{ number_format($data['salesThisYear']) }}
                    </h1>
                </div>

                <div class="bg-light p-5 border border-gray-300 flex-grow-1">
                    <p class="text-gray-700">Sales this month</p>
                    <h1 class="text-black">
                        <x-utils.currency />{{ number_format($data['salesThisMonth']) }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="card my-3 py-10">
        <div class="d-flex justify-content-between my-3">
            <h3 class="text-center flex-grow-1">Project/Event</h3>
            <button class="btn btn-sm btn-primary mx-2" id="add_project_btn">
                <x-utils.add-icon /> Add New Project/Event
            </button>
        </div>

        <x-validation-error />

        <div class="table-responsive">
            <table class="table table-secondary table-striped">
                <thead>
                    <tr class="fw-bolder fs-6">
                        <th class="px-2 py-5">SI</th>
                        <th class="px-2 py-5">Porject Name</th>
                        <th class="px-2 py-5">Project Type</th>
                        <th class="px-2 py-5">Po Value</th>
                        <th class="px-2 py-5">Bill Status</th>
                        <th class="px-2 py-5">Starting Date</th>
                        <th class="px-2 py-5">Closing Date</th>
                        <th class="px-2 py-5">Project Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['projects'] as $project)
                        <tr class="fw-bold cursor-pointer {{ $project->isBillSendToClient() ? '' : 'table-danger' }}"
                            onclick="window.location='{{ route('projects.show', $project->id) }}'">
                            <td class="px-2 py-5">
                                {{ $loop->iteration }}</td>
                            <td class="px-2 py-5">{{ $project->name }}</td>
                            <td class="px-2 py-5">{{ $project->type->name }}</td>
                            <td class="px-2 py-5">{{ number_format($project->po_value) }}</td>
                            <td class="px-2 py-5"><span
                                    class="badge badge-primary">{{ $project->billStatus() }}</span></td>
                            <td class="px-2 py-5">{{ $project->start_date }}</td>
                            <td class="px-2 py-5">{{ $project->closing_date }}</td>
                            <td class="px-2 py-5">
                                <span class="text-white px-3 py-1 rounded"
                                    style="background: {{ $project->status->color }}">
                                    {{ $project->status->name }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-5 p-3">
        <div class="d-flex gap-3 align-items-center mb-5">
            <div class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-1">
                {{ $data['client']->company_name }}
            </div>
            <button class="btn btn-sm btn-light-primary" id="edit_client_btn">Edit</button>
        </div>
        <div>
            <div class="py-5 fs-6">
                <div class="fw-bolder mt-5">Office Address</div>
                <div class="text-gray-600">
                    <div class="text-gray-600 text-hover-primary">{{ $data['client']->office_address }}
                    </div>
                </div>
                <div class="fw-bolder mt-5">Business Manager</div>
                <div class="text-gray-600">
                    <div class="text-gray-600 text-hover-primary">
                        {{ $data['client']->businessManager->name }}</div>
                </div>
                <hr />
                <div class="mt-3">
                    {{ $data['client']->company_name }} working with Greenovent since
                    {{ $data['client']->created_at }}
                </div>
            </div>
        </div>
    </div>

    <x-drawer btnId="edit_client_btn" drawerId="edit_client_drawer" title="Edit client info">
        <form class="form w-100" novalidate="novalidate" action="{{ route('clients.update', $data['client']) }}"
            method="post">
            @csrf
            @method('put')

            <div class="fv-row mb-10">
                <label class="form-label fs-6 fw-bolder text-dark">Company Name</label>
                <input class="form-control form-control-lg form-control-solid" type="text" name="company_name"
                    value="{{ $data['client']->company_name }}" />
            </div>

            <div class="fv-row mb-10">
                <label class="form-label fs-6 fw-bolder text-dark">Office Address</label>
                <input class="form-control form-control-lg form-control-solid" type="text" name="office_address"
                    value="{{ $data['client']->office_address }}" />
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
    </x-drawer>

    <x-drawer btnId="add_project_btn" drawerId="add_project_drawer" title="Add new project/event">
        <form class="form w-100" novalidate="novalidate" action="{{ route('projects.store') }}" method="post">
            @csrf

            <div class="text-center mb-10">
                <h1 class="text-dark mb-3">Add New Project/Event</h1>
            </div>
            <div class="d-flex align-items-center mb-10">
                <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                <div class="border-bottom border-gray-300 mw-50 w-100"></div>
            </div>
            <div class="fv-row mb-10">
                <label class="form-label fs-6 fw-bolder text-dark">Project/Event Name
                    <x-utils.required />
                </label>
                <input class="form-control form-control-lg form-control-solid" type="text" name="name"
                    :value="old('name')" />
            </div>

            <input type="hidden" name="business_manager_id" value="{{ $data['accountsManager']->id }}">

            <input type="hidden" name="client_id" value="{{ $data['client']->id }}">

            <div class="fv-row mb-7">
                <label class="form-label fw-bolder text-dark fs-6" for="phone">Project Type
                    <x-utils.required />
                </label>

                <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2"
                    data-hide-search="true" tabindex="-1" aria-hidden="true" name="type_id">
                    @foreach ($data['projectTypes'] as $projectType)
                        <option value="{{ $projectType->id }}">
                            {{ $projectType->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="fv-row mb-10">
                <label class="form-label fs-6 fw-bolder text-dark">PO Number
                    <x-utils.required />
                </label>
                <input class="form-control form-control-lg form-control-solid" type="text" name="po_number" />
            </div>

            <div class="fv-row mb-10">
                <label class="form-label fs-6 fw-bolder text-dark">PO Value
                    <x-utils.required />
                </label>
                <input class="form-control form-control-lg form-control-solid" type="number" name="po_value"
                    :value="old('po_value')" />
            </div>
            <div class="fv-row mb-10">
                <label class="form-label fs-6 fw-bolder text-dark">Advance Paid</label>
                <input class="form-control form-control-lg form-control-solid" type="number" name="advance_paid"
                    :value="old('advance_paid')" />
            </div>

            <div class="fv-row mb-10">
                <label class="form-label fs-6 fw-bolder text-dark">BP</label>
                <input class="form-control form-control-lg form-control-solid" type="number" name="bp"
                    :value="old('bp')" />
            </div>

            <div class="fv-row mb-7">
                <label class="form-label fw-bolder text-dark fs-6" for="phone">Bill Type
                    <x-utils.required />
                </label>

                <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2"
                    data-hide-search="true" tabindex="-1" aria-hidden="true" name="bill_type">
                    @foreach ($data['billTypes'] as $billType)
                        <option value="{{ $billType->id }}">
                            {{ $billType->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="fv-row mb-7">
                <label class="form-label fw-bolder text-dark fs-6" for="start_date">Start Date
                    <x-utils.required />
                </label>
                <input class="form-control form-control-solid" id="project_start_date_picker" name="start_date"
                    placeholder="YYYY-MM-DD" />
            </div>

            <div class="fv-row mb-7">
                <label class="form-label fw-bolder text-dark fs-6" for="closing_date">Closing Date
                    <x-utils.required />
                </label>
                <input class="form-control form-control-solid" id="project_closing_date_picker" name="closing_date"
                    placeholder="YYYY-MM-DD" />
            </div>

            <div class="fv-row mb-7">
                <label class="form-label fw-bolder text-dark fs-6" for="type_id">Project Status</label>

                <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2"
                    data-hide-search="true" tabindex="-1" aria-hidden="true" name="type_id">
                    @foreach ($data['projectStatuses'] as $projectStatus)
                        <option value="{{ $projectStatus->id }}">
                            {{ $projectStatus->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex align-items-center mb-10">
                <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                <div class="border-bottom border-gray-300 mw-50 w-100"></div>
            </div>
            <div class="d-flex gap-3">

                <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                    Add Project
                </button>
            </div>
        </form>
    </x-drawer>
</x-app-layout>
