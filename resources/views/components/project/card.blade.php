@props(['project'])

<div class="col-md-6 col-xl-4">
    <!--begin::Card-->
    <a href="project.html" class="card border-hover-primary">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-9">
            <!--begin::Card Title-->
            <div class="card-title m-0">
                <!--begin::Avatar-->
                <x-project.icon />
                <!--end::Avatar-->
            </div>
            <!--end::Car Title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">{{ $project->status->name }}</span>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end:: Card header-->
        <!--begin:: Card body-->
        <div class="card-body p-9">
            <!--begin::Name-->
            <div class="fs-3 fw-bolder text-dark">{{ $project->title }}</div>
            <!--end::Name-->
            <!--begin::Description-->
            <p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">{{ $project->short_description }}</p>
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
                    <div class="fs-6 text-gray-800 fw-bolder">{{ $project->end_date }}
                    </div>
                    <div class="fw-bold text-gray-400">End Date</div>
                </div>
                <div class="border border-gray-300 border-dashed rounded p-2 mb-3 mx-1">
                    <div class="fs-6 text-gray-800 fw-bolder">&#2547;{{ number_format($project->budget) }}</div>
                    <div class="fw-bold text-gray-400">Budget</div>
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
                    data-bs-original-title="{{ $project->manager->fullName }}">
                    <div class="symbol-label fs-3 bg-light-danger text-danger">
                        {{ $project->manager->firstChar }} </div>
                </div>
            </div>
            <!--end::Users-->
        </div>
        <!--end:: Card body-->
    </a>
    <!--end::Card-->
</div>
