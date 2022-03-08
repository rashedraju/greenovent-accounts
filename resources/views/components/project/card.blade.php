@props(['project'])

<div class="col-md-6 col-xl-4">
    <!--begin::Card-->
    <div href="{{ route('projects.show', $project) }}" class="card border-hover-primary">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-9">
            <!--begin::Card Title-->
            <div class="card-title m-0">
                <!--begin::Avatar-->
                <x-project.icon />
                <span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">{{ $project->status->name }}</span>
                <!--end::Avatar-->
            </div>
            <!--end::Car Title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <a href="{{ route('projects.show', $project) }}"
                    class="btn btn-success btn-sm fw-bolder me-auto px-4 py-3">Show Dashboard</a>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end:: Card header-->
        <!--begin:: Card body-->
        <div class="card-body p-9">
            <!--begin::Name-->
            <div class="fs-3 fw-bolder text-dark">{{ $project->name }}</div>
            <!--end::Name-->
            <!--begin::Description-->
            <p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">{{ $project->type->name }}</p>
            <!--end::Description-->
            <!--begin::Info-->
            <div class="d-flex flex-wrap mb-5">
                <!--begin::Project date-->
                <div class="border border-gray-300 border-dashed rounded p-2 mb-3 mx-1">
                    <div class="fs-6 text-gray-800 fw-bolder">{{ $project->start_date }}
                    </div>
                    <div class="fw-bold text-gray-400">Start Date</div>
                </div>
                <div class="border border-gray-300 border-dashed rounded p-2 mb-3 mx-1">
                    <div class="fs-6 text-gray-800 fw-bolder">{{ $project->closing_date }}
                    </div>
                    <div class="fw-bold text-gray-400">End Date</div>
                </div>
                <!--end::Budget-->
            </div>
            <div class="d-flex flex-wrap mb-5">
                <!--begin::Project date-->
                <div class="border border-gray-300 border-dashed rounded p-2 mb-3 mx-1">
                    <div class="fs-6 text-gray-800 fw-bolder">{{ number_format($project->external) }}
                    </div>
                    <div class="fw-bold text-gray-400">External</div>
                </div>
                <div class="border border-gray-300 border-dashed rounded p-2 mb-3 mx-1">
                    <div class="fs-6 text-gray-800 fw-bolder">{{ number_format($project->internal) }}
                    </div>
                    <div class="fw-bold text-gray-400">Internal</div>
                </div>
                <!--end::Budget-->
            </div>
            <!--end::Info-->
            <!--begin::Progress-->
            <div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title=""
                data-bs-original-title="This project 50% completed">
                <div class="bg-primary rounded h-4px" role="progressbar" style="width: 50%" aria-valuenow="50"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <!--end::Progress-->
            <!--begin::Users-->
            <div class="symbol-group symbol-hover">
                <!--begin::User-->
                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title=""
                    data-bs-original-title="{{ $project->manager->name }}">
                    <div class="symbol-label fs-3 bg-light-danger text-danger">
                        {{ $project->manager->firstChar }} </div>
                </div>
            </div>
            <!--end::Users-->
        </div>
        <!--end:: Card body-->
    </div>
    <!--end::Card-->
</div>
