<x-app-layout>
    <div class="d-flex flex-column flex-xl-row">
        <!--begin::Sidebar-->
        <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
            <!--begin::Card-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Card body-->
                <div class="card-body pt-15">
                    <!--begin::Summary-->
                    <div class="d-flex flex-center flex-column mb-5">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-100px symbol-circle mb-7">
                            <x-first-char title="{{ $client->company_name }}"
                                firstChar="{{ $client->firstChar }}" />
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <div class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-1">
                            {{ $client->company_name }}
                        </div>
                        <!--end::Name-->

                        <!--begin::Info-->
                        <div class="d-flex gap-2 mt-6">
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                <div class="fs-4 fw-bolder text-gray-700 text-center">
                                    <span class="w-75px">{{ number_format($client->totalSales()) }}</span>
                                </div>
                                <div class="fw-bold text-muted">Sales</div>
                            </div>
                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                <div class="fs-4 fw-bolder text-gray-700 text-center">
                                    <span class="w-75px">{{ number_format($client->salesByYear(now()->year)) }}</span>
                                </div>
                                <div class="fw-bold text-muted">Sales this Year</div>
                            </div>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Summary-->
                    <!--begin::Details toggle-->
                    <div class="d-flex flex-stack fs-4 py-3">
                        <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse"
                            href="#kt_customer_view_details" role="button" aria-expanded="false"
                            aria-controls="kt_customer_view_details">Details
                            <span class="ms-2 rotate-180">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <x-utils.down-arrow />
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <span data-bs-toggle="tooltip" data-bs-trigger="hover">
                            <a href="{{ route('clients.edit', $client) }}"
                                class="btn btn-sm btn-light-primary">Edit</a>
                        </span>
                    </div>
                    <!--end::Details toggle-->
                    <div class="separator separator-dashed my-3"></div>
                    <!--begin::Details content-->
                    <div id="kt_customer_view_details" class="collapse show">
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
                        </div>
                    </div>
                    <!--end::Details content-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Card header-->
                <div class="card-header border-0">
                    <div class="card-title">
                        <h3 class="fw-bolder m-0">Contact Persons</h3>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-2">
                    @foreach ($client->contactPersons as $contactPerson)
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
        <!--end::Sidebar-->
        <!--begin::Content-->
        <div class="flex-lg-row-fluid ms-lg-15">
            <!--begin:::Tabs-->
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                        href="#kt_customer_view_overview_tab">Overview</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item ms-auto">
                    <!--begin::Action menu-->
                    <a href="#" class="btn btn-primary ps-7" data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">Actions
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                        <span class="svg-icon svg-icon-2 me-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                    fill="black"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </a>
                    <!--begin::Menu-->
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
            <!--end:::Tabs-->
            <!--begin:::Tab content-->
            <div class="tab-content" id="myTabContent">
                <!--begin:::Tab pane-->
                <div class="tab-pane fade active show" id="kt_customer_view_overview_tab" role="tabpanel">
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Projects</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0 pb-5">
                            <!--begin::Table-->
                            <div id="kt_table_customers_payment_wrapper"
                                class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed gy-5 dataTable no-footer"
                                        id="kt_table_customers_payment">
                                        <!--begin::Table head-->
                                        <thead class="border-bottom border-gray-200 fs-7 fw-bolder">
                                            <!--begin::Table row-->
                                            <th> Project Name</th>
                                            <th> Project Type</th>
                                            <th> Starting Date</th>
                                            <th> Closing Date</th>
                                            <th> Bill Status</th>
                                            <th> Bill Amount(
                                                <x-utils.currency />)
                                            </th>
                                            <th> Project Cost(
                                                <x-utils.currency />)
                                            </th>
                                            <th> Project Cost incurred(%)</th>
                                            <th> Gross Profit(
                                                <x-utils.currency />)
                                            </th>
                                            <!--end::Table row-->
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody class="fs-6 fw-bold text-gray-600">
                                            @foreach ($client->projects as $project)
                                                <tr>
                                                    <td> <a
                                                            href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
                                                    </td>
                                                    <td>{{ $project->type->name }}</td>
                                                    <td>{{ $project->start_date }}</td>
                                                    <td>{{ $project->closing_date }}</td>
                                                    <td>{{ $project->billStatus() }}</td>
                                                    <td>{{ $project->external }}</td>
                                                    <td>{{ $project->internal }}</td>
                                                    <td>{{ number_format($project->costIncurred(), 2) }}</td>
                                                    <td>{{ $project->grossProfit() }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                </div>

                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                    <!--begin::Card-->

                </div>
                <!--end:::Tab pane-->
            </div>
            <!--end:::Tab content-->
        </div>
        <!--end::Content-->
    </div>
</x-app-layout>
