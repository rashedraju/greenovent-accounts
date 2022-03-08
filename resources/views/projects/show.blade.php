<x-app-layout>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
                    <!--begin::Card-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Card body-->
                        <div class="card-title text-end p-2">
                            <a href="{{ route('projects.edit', $project) }}">
                                <x-utils.edit-icon />
                            </a>
                        </div>
                        <div class="card-body pt-15">
                            <!--begin::Summary-->
                            <div class="d-flex flex-center flex-column mb-5">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-100px symbol-circle mb-7">
                                    <x-project.icon />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Name-->
                                <div class="fs-3 text-primary text-hover-primary fw-bolder mb-1">
                                    {{ $project->name }}
                                </div>
                                <!--end::Name-->

                                <!--begin::Info-->
                                <div class="d-flex gap-2 mt-6">
                                    <!--begin::Stats-->
                                    <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                        <div class="fs-4 fw-bolder text-gray-700 text-center">
                                            <span class="w-75px">{{ $project->po_number }}</span>
                                        </div>
                                        <div class="fw-bold text-muted">PO Number</div>
                                    </div>
                                    <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                        <div class="fs-4 fw-bolder text-gray-700 text-center">
                                            <span
                                                class="w-75px">{{ number_format($project->po_value) }}</span>
                                        </div>
                                        <div class="fw-bold text-muted">PO Value</div>
                                    </div>
                                </div>
                                <!--end::Info-->
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
                                <h3 class="fw-bolder m-0">Project Info</h3>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-2">
                            <div>Business Manager: <strong> {{ $project->manager->name }} </strong></div>
                            <div>PO Number: <strong> {{ $project->po_number }} </strong></div>
                            <div>PO Value: <strong>
                                    <x-utils.currency />{{ number_format($project->po_value) }}
                                </strong></div>
                        </div>
                    </div>

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
                            @foreach ($project->client->contactPersons as $contactPerson)
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

                    <div class="card mb-5 mb-xl-8">
                        <div class="card-header border-0">
                            <div class="card-title">
                                <h3 class="fw-bolder m-0">Client Info</h3>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <a href="{{ route('clients.show', $project->client) }}">
                                <h5 class="text-primary">{{ $project->client->company_name }}</h5>
                            </a>
                            <div>{{ $project->client->office_address }}</div>
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
                                href="#overview">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pb-4" data-bs-toggle="tab" href="#internal_costs">Internal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pb-4" data-bs-toggle="tab" href="#external_costs">External</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        <li class="nav-item ms-auto">
                            <!--begin::Action menu-->
                            <a href="#" class="btn btn-primary ps-7" data-kt-menu-trigger="click"
                                data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">Actions
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
                                data-kt-menu="true" style="">
                                <div class="menu-item px-3">
                                    <a href="{{ route('projects.edit', $project) }}" class="menu-link px-5">Edit
                                        Project Info</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="{{ route('projects.internals.add', $project) }}"
                                        class="menu-link px-5">Add Internal Cost</a>
                                </div>
                                <div class="menu-item px-3">
                                    <form method="post" action="{{ route('projects.delete', $project) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="bg-transparent border-0  menu-link text-danger px-5">Delete Project
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!--end:::Tabs-->
                    <!--begin:::Tab content-->
                    <div class="tab-content" id="myTabContent">
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade active show" id="overview" role="tabpanel">
                            <div class="table-responsive">
                                // overview
                            </div>
                        </div>
                        <div class="tab-pane fade border p-2" id="internal_costs" role="tabpanel">
                            {{-- Add internal cost form --}}
                            <form class="form w-100" action="{{ route('projects.internals.store', $project) }}"
                                method="post">
                                @csrf

                                <input type="hidden" name="project_id" value="{{ $project->id }}">
                                <div class="form-group row">
                                    <div class="col-3">
                                        <label class="form-label fs-6 fw-bolder text-dark">Title
                                            <x-utils.required />
                                        </label>
                                        <input class="form-control form-control" type="text" name="title"
                                            :value="old('title')" />
                                    </div>

                                    <div class="col-3">
                                        <label class="form-label fs-6 fw-bolder text-dark">Costs
                                            <x-utils.required />
                                        </label>
                                        <input class="form-control form-control" type="number" name="costs"
                                            :value="old('costs')" />
                                    </div>

                                    <div class="col-3">
                                        <label class="form-label fw-bolder text-dark fs-6" for="start_date">Date
                                            <x-utils.required />
                                        </label>
                                        <input class="form-control" id="date_picker" name="created_at"
                                            value="{{ now() }}" />
                                    </div>

                                    <div class="col-3">
                                        <label class="form-label fs-6 fw-bolder text-dark">Description</label>
                                        <input class="form-control form-control" type="text" name="description"
                                            :value="old('description')" />
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-light-primary mt-1">
                                    <i class="fas fa-plus"></i>Add
                                </button>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped table-row-bordered">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800">
                                            <th>SL.</th>
                                            <th>Head</th>
                                            <th>Cost</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($project->intenalCosts->reverse() as $internal)
                                            <tr>
                                                <td>{{ $internal->id }}</td>
                                                <td>{{ $internal->title }}</td>
                                                <td>{{ number_format($internal->costs) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($internal->created_at)) }}</td>
                                                <td>{{ $internal->description }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="external_costs" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-striped gy-7 gs-7">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800">
                                            <th>SL.</th>
                                            <th>Head</th>
                                            <th>Cost</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($project->externalCosts->reverse() as $external)
                                            <tr>
                                                <td>{{ $external->id }}</td>
                                                <td>{{ $external->title }}</td>
                                                <td>{{ number_format($external->costs) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($external->created_at)) }}</td>
                                                <td>{{ $external->description }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--end:::Tab content-->
                </div>
                <!--end::Content-->
            </div>
        </div>
        <!--end::Container-->
    </div>
</x-app-layout>
