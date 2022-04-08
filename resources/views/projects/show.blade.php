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
                    <h3 class="fw-bolder m-0">Contact Persons</h3>
                    <div class="mb-5 border-bottom border-gray-500">
                        <a href="{{ route('projects.contact.create', $project) }}">Add</a>
                    </div>
                    <div>
                        @foreach ($project->contactPersons as $contactPerson)
                            <div class="border p-2 my-2">
                                <h5>{{ $contactPerson->name }}</h5>
                                <div>{{ $contactPerson->designation }}</div>
                                <div>{{ $contactPerson->department }}</div>
                                <div>{{ $contactPerson->email }}</div>
                                <div>{{ $contactPerson->phone }}</div>
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
                        <div class="row">
                            <div class="col-6">
                                <div class="my-1">
                                    External: <strong>
                                        {{-- <x-utils.currency />{{ number_format($project->external) }} --}}
                                    </strong>
                                </div>
                                <div class="my-1">
                                    Total Internal: <strong>
                                        {{-- <x-utils.currency />{{ number_format($project->totalInternals()) }} --}}
                                    </strong>
                                </div>

                                <div class="my-1">
                                    Profit: <strong>
                                        {{-- <x-utils.currency />{{ number_format($project->profit()) }} --}}
                                    </strong>
                                </div>
                                <hr>
                                <div class="my-1">
                                    Total Advance: <strong>
                                        {{-- <x-utils.currency />{{ number_format($project->totalVendorAdvance()) }} --}}
                                    </strong>
                                </div>
                                <div class="my-1">
                                    Total Due: <strong>
                                        {{-- <x-utils.currency />{{ number_format($project->totalVendorDue()) }} --}}
                                    </strong>
                                </div>
                            </div>
                            <div class="col-6">
                                <canvas id="project_overview_chart" width="100" height="100"
                                    style="display: block; box-sizing: border-box; height: 100px; width: 100px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
