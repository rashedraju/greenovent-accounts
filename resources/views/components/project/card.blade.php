@props(['project'])

<div class="col-md-6 col-xl-4">
    <!--begin::Card-->
    <a href="project.html" class="card border-hover-primary">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-9">
            <!--begin::Card Title-->
            <div class="card-title m-0">
                <!--begin::Avatar-->
                <div class="symbol symbol-50px w-50px bg-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M4.05424 15.1982C8.34524 7.76818 13.5782 3.26318 20.9282 2.01418C21.0729 1.98837 21.2216 1.99789 21.3618 2.04193C21.502 2.08597 21.6294 2.16323 21.7333 2.26712C21.8372 2.37101 21.9144 2.49846 21.9585 2.63863C22.0025 2.7788 22.012 2.92754 21.9862 3.07218C20.7372 10.4222 16.2322 15.6552 8.80224 19.9462L4.05424 15.1982ZM3.81924 17.3372L2.63324 20.4482C2.58427 20.5765 2.5735 20.7163 2.6022 20.8507C2.63091 20.9851 2.69788 21.1082 2.79503 21.2054C2.89218 21.3025 3.01536 21.3695 3.14972 21.3982C3.28408 21.4269 3.42387 21.4161 3.55224 21.3672L6.66524 20.1802L3.81924 17.3372ZM16.5002 5.99818C16.2036 5.99818 15.9136 6.08615 15.6669 6.25097C15.4202 6.41579 15.228 6.65006 15.1144 6.92415C15.0009 7.19824 14.9712 7.49984 15.0291 7.79081C15.0869 8.08178 15.2298 8.34906 15.4396 8.55884C15.6494 8.76862 15.9166 8.91148 16.2076 8.96935C16.4986 9.02723 16.8002 8.99753 17.0743 8.884C17.3484 8.77046 17.5826 8.5782 17.7474 8.33153C17.9123 8.08486 18.0002 7.79485 18.0002 7.49818C18.0002 7.10035 17.8422 6.71882 17.5609 6.43752C17.2796 6.15621 16.8981 5.99818 16.5002 5.99818Z"
                            fill="#009ef7"></path>
                        <path
                            d="M4.05423 15.1982L2.24723 13.3912C2.15505 13.299 2.08547 13.1867 2.04395 13.0632C2.00243 12.9396 1.9901 12.8081 2.00793 12.679C2.02575 12.5498 2.07325 12.4266 2.14669 12.3189C2.22013 12.2112 2.31752 12.1219 2.43123 12.0582L9.15323 8.28918C7.17353 10.3717 5.4607 12.6926 4.05423 15.1982ZM8.80023 19.9442L10.6072 21.7512C10.6994 21.8434 10.8117 21.9129 10.9352 21.9545C11.0588 21.996 11.1903 22.0083 11.3195 21.9905C11.4486 21.9727 11.5718 21.9252 11.6795 21.8517C11.7872 21.7783 11.8765 21.6809 11.9402 21.5672L15.7092 14.8442C13.6269 16.8245 11.3061 18.5377 8.80023 19.9442ZM7.04023 18.1832L12.5832 12.6402C12.7381 12.4759 12.8228 12.2577 12.8195 12.032C12.8161 11.8063 12.725 11.5907 12.5653 11.4311C12.4057 11.2714 12.1901 11.1803 11.9644 11.1769C11.7387 11.1736 11.5205 11.2583 11.3562 11.4132L5.81323 16.9562L7.04023 18.1832Z"
                            fill="#494b74"></path>
                    </svg>
                </div>
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
                    <div class="fs-6 text-gray-800 fw-bolder">{{ date('M d, Y', strtotime($project->start_date)) }}
                    </div>
                    <div class="fw-bold text-gray-400">Start Date</div>
                </div>
                <div class="border border-gray-300 border-dashed rounded p-2 mb-3 mx-1">
                    <div class="fs-6 text-gray-800 fw-bolder">{{ date('M d, Y', strtotime($project->end_date)) }}
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
