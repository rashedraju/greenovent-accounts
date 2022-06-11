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
        <x-project.navigation :project="$project" active="bill" />
        <!--begin:::Tab pane-->
        <div>
            <x-validation-error />

            <div class="card">
                <div class="card-body">
                    @if ($project->bill_type == 1)
                        @unless($bills->count() > 0)
                            <button type="button" class="btn btn-sm px-5 py-1 btn-success" data-bs-toggle="modal"
                                data-bs-target="#add_bill_modal">
                                <x-utils.add-icon /> Add Bill
                            </button>
                        @endunless
                        <x-project.bills :project="$project" :billType="$project->billType->name" :billStatuses="$billStatuses" :bills="$bills" />
                    @else
                        <button type="button" class="btn btn-sm px-5 py-1 btn-success" data-bs-toggle="modal"
                            data-bs-target="#add_bill_modal">
                            <x-utils.add-icon /> Add Bill
                        </button>
                        <x-project.bills :project="$project" :billType="$project->billType->name" :billStatuses="$billStatuses" :bills="$bills" />
                    @endif
                </div>
            </div>
        </div>
        <!--end:::Tab content-->
    </div>

    {{-- Add new bill --}}
    <div class="modal fade" tabindex="-1" id="add_bill_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title">Add Bill</h5>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('projects.bill.store', [$project]) }}" method="post" class="my-2"
                        enctype="multipart/form-data">
                        @csrf

                        <label class="form-label fs-6 fw-bolder text-dark">
                            Date
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control" type="text" name="date" placeholder="DD-MM-YYYY" />
                        <div class="pb-2">
                            <small class="text-danger">*</small><small> Please follow the date format.</small>
                        </div>

                        <label class="form-label fs-6 fw-bolder text-dark">
                            Bill NO
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control" type="text" name="bill_no" />

                        <label class="form-label fs-6 fw-bolder text-dark">
                            Subject
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control" type="text" name="subject" />

                        <label class="form-label mt-2 mb-0">Bill Status</label>
                        <select class="form-select" name="bill_status_id">
                            @foreach ($billStatuses as $billStatus)
                                <option value="{{ $billStatus->id }}">
                                    {{ $billStatus->name }}</option>
                            @endforeach
                        </select>

                        <label class="form-label fs-6 fw-bolder text-dark">
                            Total
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control" type="number" name="total" />

                        <label class="form-label fs-6 fw-bolder text-dark">
                            ASF(%)
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control" type="number" name="asf" />

                        <label class="form-label fs-6 fw-bolder text-dark">
                            VAT(%)
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control" type="number" name="vat" />

                        <label class="form-label fs-6 fw-bolder text-dark mt-2">
                            Bill File (xlsx)
                            <x-utils.required />
                        </label>
                        <input type="file" class="form-control" name="file">

                        <label class="form-label fs-6 fw-bolder text-dark mt-2">
                            Supporting File (pdf/docx)
                            <x-utils.required />
                        </label>
                        <input type="file" class="form-control" name="supporting_file">

                        <button type="submit" class="btn btn-primary mt-2">Add Bill</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Content-->
</x-app-layout>
