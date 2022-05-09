<x-app-layout>
    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                href="#kt_customer_view_overview_tab">Overview</a>
        </li>
        <li class="nav-item ms-auto">
            <a href="#" class="btn btn-primary ps-7" data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                data-kt-menu-placement="bottom-end">Actions
                <span class="svg-icon svg-icon-2 me-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                            fill="black"></path>
                    </svg>
                </span>
            </a>
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold py-4 w-250px fs-6"
                data-kt-menu="true">
                <div class="menu-item px-3">
                    <a href="{{ route('clients.edit', $client) }}" class="menu-link px-5">Edit Client
                        Info</a>
                </div>
                <div class="menu-item px-3">
                    <form method="post" action="{{ route('clients.destroy', $client) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="bg-transparent border-0  menu-link text-danger px-5">Remove
                            Client</a>
                    </form>
                </div>
            </div>
        </li>
    </ul>
    <div class="card mb-5 mb-xl-8">
        <div class="card-body pt-15">
            @if ($client->isApprovedByEveryone())
                <div class="alert alert-success" role="alert"> Approved</div>
            @else
                <div class="alert alert-danger" role="alert">
                    <h4>Approvals:</h4>
                    @foreach ($client->approvals as $approval)
                        <div class="d-inline-flex flex-column border p-1">
                            <div> {{ $approval->approver->name }} <br /> <small>
                                    {{ $approval->approver->designation() }}
                                </small> </div>
                            <div>
                                <span class="badge badge-secondary">{{ $approval->status->name }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-column mb-5">
                    <div class="symbol symbol-100px symbol-circle mb-7">
                        <x-first-char title="{{ $client->company_name }}" firstChar="{{ $client->firstChar }}" />
                    </div>
                    <div class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-1">
                        {{ $client->company_name }}
                    </div>

                    <div class="d-flex gap-2 mt-6">
                        <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                            <div class="fs-4 fw-bolder text-gray-700 text-center">
                                <span class="w-75px">{{ number_format($client->totalSales()) }}</span>
                            </div>
                            <div class="fw-bold text-muted">Sales</div>
                        </div>
                        <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                            <div class="fs-4 fw-bolder text-gray-700 text-center">
                                <span
                                    class="w-75px">{{ number_format($client->salesByYear(now()->year)) }}</span>
                            </div>
                            <div class="fw-bold text-muted">Sales this Year</div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex flex-stack fs-4 py-3">
                        <div class="">Details</div>
                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-light-primary">Edit</a>
                    </div>

                    <div class="py-5 fs-6">
                        <div class="fw-bolder mt-5">Office Address</div>
                        <div class="text-gray-600">
                            <div class="text-gray-600 text-hover-primary">{{ $client->office_address }}
                            </div>
                        </div>
                        <div class="fw-bolder mt-5">Business Manager</div>
                        <div class="text-gray-600">
                            <div class="text-gray-600 text-hover-primary">
                                {{ $client->businessManager->name }}</div>
                        </div>
                        <hr />
                        <div class="mt-3">
                            {{ $client->company_name }} working with Greenovent since {{ $client->created_at }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade active show" id="kt_customer_view_overview_tab" role="tabpanel">
            <div class="card pt-4 mb-6 mb-xl-9">
                <div class="card-header border-0">
                    <div class="card-title">
                        <h2 class="text-primary">Projects</h2>
                    </div>
                </div>
                <div class="card-body pt-0 pb-5">
                    <div class="table-responsive py-5">
                        <table class="table table-secondary table-striped">
                            <thead>
                                <tr class="fw-bolder fs-6 bg-gray-300">
                                    <th scope="col" class="px-2 py-5">SL</th>
                                    <th scope="col" class="px-2 py-5">Project Name</th>
                                    <th scope="col" class="px-2 py-5">Project Type</th>
                                    <th scope="col" class="px-2 py-5">Starting Date</th>
                                    <th scope="col" class="px-2 py-5">Closing Date</th>
                                    <th scope="col" class="px-2 py-5">PO No</th>
                                    <th scope="col" class="px-2 py-5">PO Value(&#2547;)</th>
                                    <th scope="col" class="px-2 py-5">Profit(&#2547;)</th>
                                    <th scope="col" class="px-2 py-5">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($client->projects as $project)
                                    <tr class="fw-bold">
                                        <th scope="row" class="px-2 py-5">{{ $loop->iteration }}</th>
                                        <td class="px-2 py-5">
                                            <a
                                                href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
                                        </td>
                                        <td class="px-2 py-5">{{ $project->type->name }}</td>
                                        <td class="px-2 py-5"> {{ $project->start_date }} </td>
                                        <td class="px-2 py-5"> {{ $project->closing_date }} </td>
                                        <td class="px-2 py-5">{{ $project->po_number }}</td>
                                        <td class="px-2 py-5">{{ $project->po_value }}</td>
                                        <td class="px-2">{{ $project->grossProfit() }}</td>
                                        <td class="px-2">
                                            <a href="{{ route('projects.show', $project) }}"
                                                class="btn btn-sm btn-light-primary text-center d-block">View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0">
            <div class="card-title">
                <h3 class="fw-bolder text-primary">Contact Persons</h3>
                <a href="{{ route('clients.contact.create', $client) }}" class="mx-3">
                    <x-utils.add-icon /> Add
                </a>
            </div>
        </div>
        <div class="card-body pt-2">
            <div class="table-responsive py-5">
                <table class="table table-secondary table-striped">
                    <thead>
                        <tr class="fw-bolder fs-6 bg-gray-300">
                            <th scope="col" class="px-2 py-5">SL</th>
                            <th scope="col" class="px-2 py-5">Name</th>
                            <th scope="col" class="px-2 py-5">Designation</th>
                            <th scope="col" class="px-2 py-5">Department</th>
                            <th scope="col" class="px-2 py-5">Email</th>
                            <th scope="col" class="px-2 py-5">Phone</th>
                            <th scope="col" class="px-2 py-5">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($client->contactPersons as $contactPerson)
                            <tr class="fw-bold">
                                <th scope="row" class="px-2 py-5">{{ $loop->iteration }}</th>
                                <td class="px-2 py-5">{{ $contactPerson->name }}</td>
                                <td class="px-2 py-5">{{ $contactPerson->designation }}</td>
                                <td class="px-2 py-5"> {{ $contactPerson->department }} </td>
                                <td class="px-2 py-5"> {{ $contactPerson->email }} </td>
                                <td class="px-2 py-5"> {{ $contactPerson->phone }} </td>
                                <td class="px-2">
                                    <a href="{{ route('clients.contact.edit', [$client, $contactPerson]) }}"
                                        class="btn btn-sm btn-light-primary text-center d-block">Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
