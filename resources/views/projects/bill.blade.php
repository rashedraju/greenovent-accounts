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

    <div class="alert alert-danger mt-3"> Bill Status: {{ $project->billStatus() }}</div>
    <div class="flex-lg-row-fluid">
        <x-project.navigation :project="$project" active="bill" />
        <!--begin:::Tab pane-->
        <div>
            <x-validation-error />

            <div class="card">
                <div class="card-body">
                    @if ($project->bill_type == 1)
                        @unless($bills->count() > 0)
                            <button type="button" class="btn px-5 py-2 my-2 btn-success" id="add_bill_btn">
                                <x-utils.add-icon /> Add Bill
                            </button>
                        @endunless
                        <x-project.bills :project="$project" :billType="$project->billType->name" :billStatuses="$billStatuses" :bills="$bills"
                            :billSheets="$billSheets" />
                    @else
                        <button type="button" class="btn px-5 py-2 my-2 btn-success" id="add_bill_btn">
                            <x-utils.add-icon /> Add Bill
                        </button>
                        <x-project.bills :project="$project" :billType="$project->billType->name" :billStatuses="$billStatuses" :bills="$bills"
                            :billSheets="$billSheets" />
                    @endif
                </div>
            </div>
        </div>
        <!--end:::Tab content-->
    </div>

    {{-- Add new bill --}}
    <x-drawer btnId="add_bill_btn" drawerId="add_bill_drawer" title="Add Bill">
        <form action="{{ route('projects.bill.store', [$project]) }}" method="post" class="my-2"
            enctype="multipart/form-data">
            @csrf

            <label class="form-label mt-5">Date</label>

            <input type="date" pattern="\d{4}-\d{2}-\d{2}" class="form-control" name="date" placeholder="DD-MM-YYYY"
                :value="old('date')">

            <label class="form-label mt-5">Bill Status</label>
            <select class="form-select" name="bill_status_id">
                @foreach ($billStatuses as $billStatus)
                    <option value="{{ $billStatus->id }}">
                        {{ $billStatus->name }}</option>
                @endforeach
            </select>

            <label class="form-label fs-6 fw-bolder text-dark mt-5">
                Total
                <x-utils.required />
            </label>
            <input class="form-control" type="number" name="total" step="0.01" :value="old('total')" />

            <label class="form-label fs-6 fw-bolder text-dark mt-5">
                ASF(%)
                <x-utils.required />
            </label>
            <input class="form-control" type="number" step="0.01" name="asf" :value="old('asf')" />

            <label class="form-label fs-6 fw-bolder text-dark mt-5">
                VAT(%)
                <x-utils.required />
            </label>
            <input class="form-control" type="number" step="0.01" name="vat" :value="old('vat')" />

            <label class="form-label fs-6 fw-bolder text-dark mt-5">
                Bill File (xlsx)
            </label>
            <input type="file" class="form-control" name="file" :value="old('file')">

            <label class="form-label fs-6 fw-bolder text-dark mt-5">
                Supporting File (PDF/DOCX/JPG)
            </label>
            <input type="file" class="form-control" name="supporting_file" :value="old('supporting_file')">

            <button type="submit" class="btn btn-primary mt-5">Add Bill</button>
        </form>
    </x-drawer>
    <!--end::Content-->
</x-app-layout>
