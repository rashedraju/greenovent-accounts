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
                                            <span
                                                class="w-75px">{{ number_format($project->external) }}</span>
                                        </div>
                                        <div class="fw-bold text-muted">External</div>
                                    </div>
                                    <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                        <div class="fs-4 fw-bolder text-gray-700 text-center">
                                            <span
                                                class="w-75px">{{ number_format($project->internal) }}</span>
                                        </div>
                                        <div class="fw-bold text-muted">Internal</div>
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
                                href="#kt_customer_view_overview_tab">Overview</a>
                        </li>
                    </ul>
                    <!--end:::Tabs-->
                    <!--begin:::Tab content-->
                    <div class="tab-content" id="myTabContent">
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade active show" id="kt_customer_view_overview_tab" role="tabpanel">
                            Project Overview
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
