<x-app-layout>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Stats-->
            <div class="row g-6 g-xl-9">
                <div class="col-lg-6 col-xxl-4">
                    <!--begin::Card-->
                    <div class="card h-100">
                        <!--begin::Card body-->
                        <div class="card-body p-9">
                            <!--begin::Heading-->
                            <div class="fs-2hx fw-bolder">{{ $projects->count() }}</div>
                            <div class="fs-4 fw-bold text-gray-400 mb-7">Current Projects</div>
                            <!--end::Heading-->
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-wrap">
                                <!--begin::Chart-->
                                <div class="d-flex flex-center h-100px w-100px me-9 mb-5">
                                    <canvas id="kt_project_list_chart" width="100" height="100"
                                        style="display: block; box-sizing: border-box; height: 100px; width: 100px;"></canvas>
                                </div>
                                <!--end::Chart-->
                                <!--begin::Labels-->
                                <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
                                    <!--begin::Label-->
                                    <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                        <div class="bullet bg-primary me-3"></div>
                                        <div class="text-gray-400">Active</div>
                                        <div class="ms-auto fw-bolder text-gray-700">30</div>
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Label-->
                                    <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                        <div class="bullet bg-success me-3"></div>
                                        <div class="text-gray-400">Completed</div>
                                        <div class="ms-auto fw-bolder text-gray-700">45</div>
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Label-->
                                    <div class="d-flex fs-6 fw-bold align-items-center">
                                        <div class="bullet bg-gray-300 me-3"></div>
                                        <div class="text-gray-400">Yet to start</div>
                                        <div class="ms-auto fw-bolder text-gray-700">25</div>
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Labels-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <div class="col-lg-6 col-xxl-4">
                    <!--begin::Budget-->
                    <div class="card h-100">
                        <div class="card-body p-9">
                            <div class="fs-2hx fw-bolder">$3,290.00</div>
                            <div class="fs-4 fw-bold text-gray-400 mb-7">Project Finance</div>
                            <div class="fs-6 d-flex justify-content-between mb-4">
                                <div class="fw-bold">Avg. Project Budget</div>
                                <div class="d-flex fw-bolder">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr007.svg-->
                                    <span class="svg-icon svg-icon-3 me-1 svg-icon-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M13.4 10L5.3 18.1C4.9 18.5 4.9 19.1 5.3 19.5C5.7 19.9 6.29999 19.9 6.69999 19.5L14.8 11.4L13.4 10Z"
                                                fill="black"></path>
                                            <path opacity="0.3" d="M19.8 16.3L8.5 5H18.8C19.4 5 19.8 5.4 19.8 6V16.3Z"
                                                fill="black"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->$6,570
                                </div>
                            </div>
                            <div class="separator separator-dashed"></div>
                            <div class="fs-6 d-flex justify-content-between my-4">
                                <div class="fw-bold">Lowest Project Check</div>
                                <div class="d-flex fw-bolder">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr006.svg-->
                                    <span class="svg-icon svg-icon-3 me-1 svg-icon-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M13.4 14.8L5.3 6.69999C4.9 6.29999 4.9 5.7 5.3 5.3C5.7 4.9 6.29999 4.9 6.69999 5.3L14.8 13.4L13.4 14.8Z"
                                                fill="black"></path>
                                            <path opacity="0.3"
                                                d="M19.8 8.5L8.5 19.8H18.8C19.4 19.8 19.8 19.4 19.8 18.8V8.5Z"
                                                fill="black"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->$408
                                </div>
                            </div>
                            <div class="separator separator-dashed"></div>
                            <div class="fs-6 d-flex justify-content-between mt-4">
                                <div class="fw-bold">Ambassador Page</div>
                                <div class="d-flex fw-bolder">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr007.svg-->
                                    <span class="svg-icon svg-icon-3 me-1 svg-icon-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M13.4 10L5.3 18.1C4.9 18.5 4.9 19.1 5.3 19.5C5.7 19.9 6.29999 19.9 6.69999 19.5L14.8 11.4L13.4 10Z"
                                                fill="black"></path>
                                            <path opacity="0.3" d="M19.8 16.3L8.5 5H18.8C19.4 5 19.8 5.4 19.8 6V16.3Z"
                                                fill="black"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->$920
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Budget-->
                </div>
                <div class="col-lg-6 col-xxl-4">
                    <!--begin::Clients-->
                    <div class="card h-100">
                        <div class="card-body p-9">
                            <!--begin::Heading-->
                            <div class="fs-2hx fw-bolder">49</div>
                            <div class="fs-4 fw-bold text-gray-400 mb-7">Our Clients</div>
                            <!--end::Heading-->
                            <!--begin::Users group-->
                            <div class="symbol-group symbol-hover mb-9">
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title=""
                                    data-bs-original-title="Alan Warden">
                                    <span class="symbol-label bg-warning text-inverse-warning fw-bolder">A</span>
                                </div>
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title=""
                                    data-bs-original-title="Michael Eberon">
                                    <img alt="Pic" src="../../assets/media/avatars/300-11.jpg">
                                </div>
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title=""
                                    data-bs-original-title="Michelle Swanston">
                                    <img alt="Pic" src="../../assets/media/avatars/300-7.jpg">
                                </div>
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title=""
                                    data-bs-original-title="Francis Mitcham">
                                    <img alt="Pic" src="../../assets/media/avatars/300-20.jpg">
                                </div>
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title=""
                                    data-bs-original-title="Susan Redwood">
                                    <span class="symbol-label bg-primary text-inverse-primary fw-bolder">S</span>
                                </div>
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title=""
                                    data-bs-original-title="Melody Macy">
                                    <img alt="Pic" src="../../assets/media/avatars/300-2.jpg">
                                </div>
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title=""
                                    data-bs-original-title="Perry Matthew">
                                    <span class="symbol-label bg-info text-inverse-info fw-bolder">P</span>
                                </div>
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title=""
                                    data-bs-original-title="Barry Walter">
                                    <img alt="Pic" src="../../assets/media/avatars/300-12.jpg">
                                </div>
                                <a href="#" class="symbol symbol-35px symbol-circle" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_view_users">
                                    <span class="symbol-label bg-dark text-gray-300 fs-8 fw-bolder">+42</span>
                                </a>
                            </div>
                            <!--end::Users group-->
                            <!--begin::Actions-->
                            <div class="d-flex">
                                <a href="#" class="btn btn-primary btn-sm me-3" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_view_users">All Clients</a>
                                <a href="#" class="btn btn-light btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_users_search">Invite New</a>
                            </div>
                            <!--end::Actions-->
                        </div>
                    </div>
                    <!--end::Clients-->
                </div>
            </div>
            <!--end::Stats-->
            <!--begin::Toolbar-->
            <div class="d-flex flex-wrap flex-stack my-5">
                <!--begin::Heading-->
                <h2 class="fs-2 fw-bold my-2">Projects
                    <span class="fs-6 text-gray-400 ms-1">by Status</span>
                </h2>
                <!--end::Heading-->
                <!--begin::Controls-->
                <div class="d-flex flex-wrap my-1">
                    <!--begin::Select wrapper-->
                    <div class="m-0">
                        <!--begin::Select-->
                        <select name="status" data-control="select2" data-hide-search="true"
                            class="form-select form-select-sm bg-body border-body fw-bolder w-125px select2-hidden-accessible"
                            data-select2-id="select2-data-10-d1fn" tabindex="-1" aria-hidden="true">
                            <option value="Active" selected="selected" data-select2-id="select2-data-12-rrsf">Active
                            </option>
                            <option value="Approved">In Progress</option>
                            <option value="Declined">To Do</option>
                            <option value="In Progress">Completed</option>
                        </select>
                        <!--end::Select-->
                    </div>
                    <!--end::Select wrapper-->
                </div>
            </div>
            <!--end::Toolbar-->
            <div class="row g-6 g-xl-9">
                <!-- View All Project by Status -->
                @foreach ($projects as $project)
                    <x-project.card :project="$project" />
                @endforeach
            </div>
        </div>
        <!--end::Container-->
    </div>
</x-app-layout>
