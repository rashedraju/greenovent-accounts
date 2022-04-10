<x-app-layout>
    <div class="flex-lg-row-fluid ms-lg-15">
        <x-project.navigation :project="$project" active="overview" />

        <div class="card mb-5">
            <div class="card-header">
                <h3 class="card-title">Project Overview</h3>
            </div>
            <div class="card-body d-flex justify-content-between">
                <div class="d-flex flex-column mb-5">
                    <h1 class="fs-3 text-primary text-hover-primary fw-bolder mb-1">
                        {{ $project->name }}
                    </h1>

                    <div class="d-flex gap-2 my-6">
                        <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                            <div class="fs-4 fw-bolder text-gray-700 text-center">
                                <span class="w-75px">{{ $project->po_number }}</span>
                            </div>
                            <div class="fw-bold text-muted">PO Number</div>
                        </div>
                        <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                            <div class="fs-4 fw-bolder text-gray-700 text-center">
                                <span class="w-75px">
                                    <x-utils.currency />{{ number_format($project->po_value) }}
                                </span>
                            </div>
                            <div class="fw-bold text-muted">PO Value</div>
                        </div>
                    </div>
                    <div>Business Manager: <strong> {{ $project->manager->name }} </strong></div>
                </div>
                <div>
                    <h3 class="fw-bolder mb-3">Client Info</h3>
                    <a href="{{ route('clients.show', $project->client) }}">
                        <h5 class="text-primary">{{ $project->client->company_name }}</h5>
                    </a>
                    <div>{{ $project->client->office_address }}</div>
                </div>
                <div>
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

        <div class="card my-2">
            <div class="card-header">
                <h3 class="card-title">Latest Internal & External</h3>
            </div>
            <div class="card-body">
                <div class="card card-bordered">
                    <div class="card-body">
                        <div class="fs-5 d-flex">
                            <div class="d-flex flex-column gap-3 text-end">
                                <div class="px-5">
                                    <strong>External:</strong>
                                </div>
                                <div class="px-5">
                                    <strong>Internal:</strong>
                                </div>
                                <div class="px-5">
                                    <strong>Vendor: </strong>
                                </div>
                                <div class="px-5">
                                    <strong>Gross Profit: </strong>
                                </div>
                            </div>
                            <div class="d-flex flex-column gap-3 text-end">
                                <div class="px-5">
                                    {{ number_format($project->external?->total) }}
                                </div class="px-5">
                                <div class="px-5">
                                    {{ number_format($project->internal?->total) }}
                                </div>
                                <div class="px-5">
                                    {{ number_format($project->vendor?->total) }}
                                </div>
                                <div class="px-5">
                                    {{ number_format($project->grossProfit()) }}
                                </div>
                            </div>
                        </div>
                    </div>
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
