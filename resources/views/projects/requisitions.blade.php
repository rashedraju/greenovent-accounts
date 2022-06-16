<x-app-layout>
    <div class="card card-body p-5 m-sm-1 m-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4 active"><a href="{{ route('accounts-manager.index') }}">Accounts
                        Manager</a></li>
                <li class="breadcrumb-item fs-4"><a
                        href="{{ route('accounts-manager.show', $project->accountsManager->id) }}">{{ $project->accountsManager->name }}</a>
                </li>
                <li class="breadcrumb-item fs-4"><a
                        href="{{ route('accounts-manager.client', ['user' => $project->accountsManager->id, 'client' => $project->client->id]) }}">{{ $project->client->company_name }}</a>
                </li>
                <li class="breadcrumb-item fs-4">{{ $project->name }}</li>
            </ol>
        </nav>
    </div>

    <div class="flex-lg-row-fluid">
        <x-project.navigation :project="$project" active="requisitions" />
        <!--begin:::Tab pane-->
        <div>
            <x-validation-error />

            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-sm px-5 py-2 btn-success" id="add_requisition_btn">
                        <x-utils.add-icon /> Add Requisition
                    </button>
                </div>
            </div>
        </div>
        <!--end:::Tab content-->
    </div>
    <div class="flex-lg-row-fluid">
        @foreach ($requisitions as $requisition)
            <div class="card card-body my-3 border border-secondary">
                <div class="border mt-3 mb-3 p-5 border-gray-300">
                    <div class="mt-5 d-flex justify-content-between gap-3">
                        <h2 class="text-uppercase px-3 py-1 bg-gray-900 text-white rounded-3">Money Requisition
                        </h2>
                        <div class="fs-5 d-flex">
                            <div class="d-flex flex-column gap-3 text-end">
                                <div class="border-bottom border-gray-500 px-5">
                                    <strong>Total Amount:</strong>
                                </div>
                            </div>
                            <div class="d-flex flex-column gap-3 text-end">
                                <div class="border-bottom border-gray-500 px-5">
                                    {{ number_format($requisition['total'], 2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @isset($requisition['sheet'])
                        {!! $requisition['sheet'][0] !!}
                        {!! $requisition['sheet'][1] !!}
                        {!! $requisition['sheet'][2] !!}
                    @endisset
                </div>
            </div>
        @endforeach
    </div>

    <x-drawer btnId="add_requisition_btn" drawerId="import_requisition_drawer" title="Import Requisition">
        <form action="{{ route('projects.requisitions.store', $project) }}" method="post" class="my-2"
            enctype="multipart/form-data">
            @csrf

            <label class="form-label fs-6 fw-bolder text-dark mt-2">
                Total Amount
                <x-utils.required />
            </label>
            <input type="number" step="0.01" class="form-control" name="total" :value="old('total')">

            <label class="form-label fs-6 fw-bolder text-dark mt-2">
                Requisition File (.xlsx)
            </label>
            <input type="file" class="form-control" name="file" :value="old('file')">

            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </x-drawer>

</x-app-layout>
