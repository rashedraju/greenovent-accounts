@props(['project'])

<!--begin::Sidebar-->
<div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
    <!--begin::Card-->
    <div class="card mb-5 mb-xl-8">
        <!--begin::Card body-->
        <div class="card-text text-end pt-3">
            <a href="{{ route('projects.edit', $project) }}" style="margin-right: 2rem">
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
                            <span class="w-75px">
                                <x-utils.currency />{{ number_format($project->po_value) }}
                            </span>
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
        <div class="card-header border-0 d-flex justify-between pt-3">
            <h3 class="fw-bolder m-0">Project Info</h3>
            <a href="{{ route('projects.edit', $project) }}">
                <x-utils.edit-icon />
            </a>
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
        <div class="card-header border-0 d-flex justify-between pt-3">
            <h3 class="fw-bolder m-0">Contact Persons</h3>
            <a href="{{ route('clients.contact.create', $project->client) }}">
                <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen041.svg-->
                <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                        <rect x="10.8891" y="17.8033" width="12" height="2" rx="1"
                            transform="rotate(-90 10.8891 17.8033)" fill="black" />
                        <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
                    </svg></span>
                <!--end::Svg Icon-->
            </a>
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
