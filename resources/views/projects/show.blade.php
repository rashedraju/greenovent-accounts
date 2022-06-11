<x-app-layout>
    <div class="card card-body p-5 m-sm-1 m-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4 active"><a href="{{ route('accounts-manager.index') }}">Accounts
                        Manager</a></li>
                <li class="breadcrumb-item fs-4"><a
                        href="{{ route('accounts-manager.show', $project->accountsManager->id) }}">{{ $project->accountsManager->name }}</a>
                </li>
                <li class="breadcrumb-item fs-4"><a
                        href="{{ route('accounts-manager.client', ['user' => $project->accountsManager->id, 'client' => $project->client->id]) }}">{{ $project->client->company_name }}</a>
                </li>
                <li class="breadcrumb-item fs-4">{{ $project->name }}</li>
            </ol>
        </nav>
    </div>

    <div class="flex-lg-row-fluid">
        <x-project.navigation :project="$project" active="overview" />

        <div class="card my-2">
            <div class="card-header">
                <h3 class="card-title">{{ $project->name }}</h3>
            </div>
            <div class="row justify-content-between">
                <div class="col-12 col-sm-4">
                    <table class="table table-secondary bs-table-bordered">
                        <tbody>
                            <tr class="border border-secondary">
                                <th class="px-2 py-5 fw-bolder fs-6">Project Goal</th>
                                <td>{{ number_format((float) $project->external?->grandTotal(), 2, '.', ',') }}</td>
                            </tr>
                            <tr class="border border-secondary">
                                <th class="px-2 py-5 fw-bolder fs-6">Sales</th>
                                <td>{{ number_format((float) $project->external?->total, 2, '.', ',') }}</td>
                            </tr>
                            <tr class="border border-secondary">
                                <th class="px-2 py-5 fw-bolder fs-6">ASF</th>
                                <td>{{ number_format((float) $project->external?->asfTotal(), 2, '.', ',') }}</td>
                            </tr>
                            <tr class="border border-secondary">
                                <th class="px-2 py-5 fw-bolder fs-6">Sub Total</th>
                                <td>{{ number_format((float) $project->external?->asfSubTotal(), 2, '.', ',') }}</td>
                            </tr>
                            <tr class="border border-secondary">
                                <th class="px-2 py-5 fw-bolder fs-6">Amount VAT</th>
                                <td>{{ number_format((float) $project->external?->vatTotal(), 2, '.', ',') }}</td>
                            </tr>
                            <tr class="border border-secondary">
                                <th class="px-2 py-5 fw-bolder fs-6">Client Advance </th>
                                <td>{{ number_format((float) $project->advance_paid, 2, '.', ',') }}</td>
                            </tr>
                            <tr class="border border-secondary">
                                <th class="px-2 py-5 fw-bolder fs-6">AIT </th>
                                <td>{{ number_format((float) $project->ait(), 2, '.', ',') }}</td>
                            </tr>
                            <tr class="border border-secondary">
                                <th class="px-2 py-5 fw-bolder fs-6"> Expence </th>
                                <td>{{ number_format((float) $project->internal?->total, 2, '.', ',') }}</td>
                            </tr>
                            <tr class="border border-secondary">
                                <th class="px-2 py-5 fw-bolder fs-6"> Total Expense </th>
                                <td>{{ number_format((float) $project->totalExpense(), 2, '.', ',') }}</td>
                            </tr>
                            <tr class="border border-secondary">
                                <th class="px-2 py-5 fw-bolder fs-6"> Due </th>
                                <td>{{ number_format((float) $project->due(), 2, '.', ',') }}</td>
                            </tr>
                            <tr class="border border-secondary">
                                <th class="px-2 py-5 fw-bolder fs-6"> Gross Profit </th>
                                <td>{{ number_format((float) $project->grossProfit(), 2, '.', ',') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 col-sm-4">
                    <table class="table table-secondary bs-table-bordered">
                        <tbody>
                            <tr class="border border-secondary">
                                <th class="px-2 py-5 fw-bolder fs-6">Project Type</th>
                                <td>{{ $project->type->name }}</td>
                            </tr>
                            <tr class="border border-secondary">
                                <th class="px-2 py-5 fw-bolder fs-6">PO Number </th>
                                <td>{{ $project->po_number }}</td>
                            </tr>
                            <tr class="border border-secondary">
                                <th class="px-2 py-5 fw-bolder fs-6">PO Value </th>
                                <td>{{ number_format((float) $project->po_value, 2, '.', ',') }}</td>
                            </tr>
                            <tr class="border border-secondary">
                                <th class="px-2 py-5 fw-bolder fs-6">Bill Type </th>
                                <td>{{ $project->billType->name }}</td>
                            </tr>
                            <tr class="border border-secondary">
                                <th class="px-2 py-5 fw-bolder fs-6">Bill Status </th>
                                <td>{{ $project->billStatus() }}</td>
                            </tr>
                            <tr class="border border-secondary">
                                <th class="px-2 py-5 fw-bolder fs-6">Project Status </th>
                                <td>{{ $project->status->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card my-2">
            <div class="card-body">
                <div class="mb-5 d-flex gap-3 align-items-center">
                    <h3 class="fw-bolder m-0">Contact Persons</h3>
                    <button type="button" class="btn btn-sm py-0 px-2 btn-light" data-bs-toggle="modal"
                        data-bs-target="#add_contact_modal">
                        <x-utils.add-icon /> Add
                    </button>
                </div>
                <div>
                    @foreach ($project->contactPersons as $contactPerson)
                        <div class="border p-2 my-2">
                            <h5>{{ $contactPerson->name }}</h5>
                            <div>{{ $contactPerson->designation }}</div>
                            <div>{{ $contactPerson->contact }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="add_contact_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add contact person</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('projects.contact.store', $project) }}" method="post"
                        class="my-2" enctype="multipart/form-data">
                        @csrf

                        <label class="form-label fs-6 fw-bolder text-dark">
                            Name
                        </label>
                        <input class="form-control form-control" type="text" name="name" />

                        <label class="form-label fs-6 fw-bolder text-dark">
                            Designation
                        </label>
                        <input class="form-control form-control" type="text" name="designation" />
                        <label class="form-label fs-6 fw-bolder text-dark">
                            Contact
                        </label>
                        <input class="form-control form-control" type="text" name="contact" />

                        <button type="submit" class="btn btn-primary mt-2">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
