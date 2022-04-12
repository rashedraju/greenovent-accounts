<x-app-layout>
    <div class="flex-lg-row-fluid ms-lg-15">
        <x-project.navigation :project="$project" active="bill" />
        <!--begin:::Tab pane-->
        <div>
            <x-validation-error />

            <div class="card">
                <div class="card-body">
                    @if ($project->bill_type == 1)
                        <x-project.bills :project="$project" :billType="$project->billType->name" :billStatuses="$billStatuses" :bills="$project->bills->take(1)" />
                    @else
                        <x-project.bills :project="$project" :billType="$project->billType->name" :billStatuses="$billStatuses" :bills="$project->bills" />
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
                        </label>
                        <input class="form-control form-control" type="text" name="date" placeholder="DD-MM-YYYY" />
                        <div class="pb-2">
                            <small class="text-danger">*</small><small> Please follow the date format.</small>
                        </div>

                        <label class="form-label fs-6 fw-bolder text-dark">
                            Bill NO
                        </label>
                        <input class="form-control form-control" type="text" name="bill_no" />

                        <label class="form-label fs-6 fw-bolder text-dark">
                            Subject
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
                        </label>
                        <input class="form-control form-control" type="number" name="total" />

                        <label class="form-label fs-6 fw-bolder text-dark">
                            ASF
                        </label>
                        <input class="form-control form-control" type="number" name="asf" />

                        <label class="form-label fs-6 fw-bolder text-dark">
                            VAT
                        </label>
                        <input class="form-control form-control" type="number" name="vat" />

                        <label class="form-label fs-6 fw-bolder text-dark mt-2">
                            Bill File (xlsx)
                        </label>
                        <input type="file" class="form-control" name="file">

                        <label class="form-label fs-6 fw-bolder text-dark mt-2">
                            Supporting File (pdf/docx)
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
