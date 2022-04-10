<x-app-layout>
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h3> Finance Records Year of this year - {{ $year }}</h3>
        </div>
        <div class="card-body">
            <div class="d-flex overflow-scroll">
                <div class="bg-primary p-5" style="border-radius: 2rem 0 0 0">
                    <p class="text-white">Total</p>
                    <h1 class="text-white">
                        <x-utils.currency />{{ number_format($totalAmountByYear) }}
                    </h1>
                </div>

                <div class="bg-success p-5 text-white">
                    <p class="text-white">Bank</p>
                    <h1 class="text-white">
                        <x-utils.currency />{{ number_format($totalBankAmountByYear) }}
                    </h1>
                </div>

                <div class="bg-info p-5 text-white">
                    <p class="text-white">Cash</p>
                    <h1 class="text-white">
                        <x-utils.currency />{{ number_format($totalCashAmountByYear) }}
                    </h1>
                </div>

                <div class="bg-light p-5 text-white border border-gray-300">
                    <p class="text-gray-700">Loan</p>
                    <h1 class="text-gray-700">
                        <x-utils.currency />{{ number_format($totalLoanAmountByYear) }}
                    </h1>
                </div>

                <div class="bg-light p-5 text-white border border-gray-300">
                    <p class="text-gray-700">Investment</p>
                    <h1 class="text-gray-700">
                        <x-utils.currency />{{ number_format($totalInvestmentAmountByYear) }}
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header d-flex align-items-center">
            <h3> Clients</h3>
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-3">
                @foreach ($clients as $client)
                    <div class="border d-inline-block p-5">
                        <div class="d-flex justify-content-center flex-column align-items-center gap-2">
                            <div class="fs-1 fw-bolder mt-3">
                                <a href="{{ route('clients.show', $client) }}">
                                    {{ $client->company_name }}
                                </a>
                            </div>
                        </div>
                        <div class="separator separator-dashed"></div>
                        <h2 class="mt-3">
                            &#2547; {{ number_format($client->salesThisYear()) }}</h2>
                        <div class="fs-4 fw-bold text-gray-400 mb-7">Sales this year</div>
                        <div class="fs-6 d-flex justify-content-between mb-4">
                            <div class="fw-bold">Total Sales</div>
                            <div class="d-flex fw-bolder">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr007.svg-->
                                <span class="svg-icon svg-icon-3 me-1 svg-icon-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M13.4 10L5.3 18.1C4.9 18.5 4.9 19.1 5.3 19.5C5.7 19.9 6.29999 19.9 6.69999 19.5L14.8 11.4L13.4 10Z"
                                            fill="black"></path>
                                        <path opacity="0.3" d="M19.8 16.3L8.5 5H18.8C19.4 5 19.8 5.4 19.8 6V16.3Z"
                                            fill="black">
                                        </path>
                                    </svg>
                                </span>
                                &#2547;{{ number_format($client->totalSales()) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header d-flex align-items-center">
            <h3> Projects</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="fw-bolder fs-6 bg-gray-300 text-dark border border-dark">
                            <th class="px-2 py-5">SI</th>
                            <th class="px-2 py-5">Porject Name</th>
                            <th class="px-2 py-5">Client Name</th>
                            <th class="px-2 py-5">Bussiness Manger</th>
                            <th class="px-2 py-5">Project Type</th>
                            <th class="px-2 py-5">Po Value</th>
                            <th class="px-2 py-5">Bill Status</th>
                            <th class="px-2 py-5">Starting Date</th>
                            <th class="px-2 py-5">Closing Date</th>
                            <th class="px-2 py-5">Project Status</th>
                        </tr>
                    </thead>
                    <tbody class="border border-dark">
                        @foreach ($projects as $project)
                            <tr class="border border-dark fw-bold">
                                <td class="px-2 py-5">{{ $loop->iteration }}</td>
                                <td class="px-2 py-5"><a
                                        href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
                                </td>
                                <td class="px-2 py-5">
                                    <a href="{{ route('clients.show', $project->client) }}">
                                        {{ $project->client->company_name }}
                                    </a>
                                </td>
                                <td class="px-2 py-5"><a
                                        href="{{ route('employees.show', $project->manager) }}">{{ $project->manager->name }}</a>
                                </td>
                                <td class="px-2 py-5">{{ $project->type->name }}</td>
                                <td class="px-2 py-5">{{ $project->po_value }}</td>
                                <td class="px-2 py-5"><span
                                        class="badge badge-primary">{{ $project->billStatus() }}</span></td>
                                <td class="px-2 py-5">{{ $project->start_date }}</td>
                                <td class="px-2 py-5">{{ $project->closing_date }}</td>
                                <td class="px-2 py-5">
                                    <span class="text-white px-3 py-1 rounded"
                                        style="background: {{ $project->status->color }}">
                                        {{ $project->status->name }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mt-5">
        <div class="card-header d-flex align-items-center">
            <h3> Employees</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_table_users">
                    <thead>
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px sorting" tabindex="0" style="width: 314.844px;">Employe
                            </th>
                            <th class="min-w-125px sorting" tabindex="1" style="width: 314.844px;">
                                Designation</th>
                            <th class="min-w-125px sorting" tabindex="3" style="width: 314.844px;">Phone
                            </th>
                            <th class="min-w-125px sorting" tabindex="4" style="width: 314.844px;">Joining
                                Date</th>
                            <th class="min-w-125px sorting" tabindex="5" style="width: 314.844px;">Current
                                Address</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold">
                        @foreach ($users as $user)
                            <tr class="even">
                                <td class="d-flex align-items-center">
                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                        <a href="{{ route('employees.show', $user) }}">
                                            @if ($user->profile_image)
                                                <img src="{{ asset("/public/uploads/{$user->profile_image}") }}"
                                                    style="width: 50px; height: 50px" />
                                            @else
                                                <div class="symbol-label fs-3 bg-light-danger text-danger">
                                                    {{ $user->firstChar }} </div>
                                            @endif

                                        </a>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="{{ route('employees.show', $user) }}"
                                            class="text-gray-800 text-hover-primary mb-1">{{ $user->name }}</a>
                                        <span>{{ $user->email }}</span>
                                    </div>
                                </td>
                                <td>{{ $user->designation() }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->joining_date }}</td>
                                <td>{{ $user->current_address }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
