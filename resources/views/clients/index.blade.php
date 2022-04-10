<x-app-layout>
    @foreach ($clients as $client)
        <div class="col-3">
            <div class="card border-hover-primary">
                <div class="card-body p-5">
                    <div class="d-flex justify-content-center flex-column align-items-center gap-2">
                        <div class="fs-2x fw-bolder mt-3">{{ $client->company_name }}</div>
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
                    <div class="separator separator-dashed"></div>
                    <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5 mt-3">
                        <!--begin::Label-->
                        @php
                            $projectStatuses = App\Models\ProjectStatus::all();

                        @endphp
                        @foreach ($projectStatuses as $projectStatus)
                            <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                <div class="bullet bg-primary me-3"></div>
                                <div class="text-gray-400">{{ $projectStatus->name }}</div>
                                <div class="ms-auto fw-bolder text-gray-700">
                                    {{ $projectStatus->projects()->where('client_id', $client->id)->count() }}
                                </div>
                            </div>
                        @endforeach
                        <div class="separator separator-dashed"></div>
                        <div class="d-flex fs-6 fw-bold align-items-center mb-3 mt-2">
                            <div class="bullet bg-primary me-3"></div>
                            <div>Total Projects</div>
                            <div class="ms-auto fw-bolder text-gray-700">
                                {{ $client->projects->count() }}
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('clients.show', $client) }}" class="btn btn-primary mb-5">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
