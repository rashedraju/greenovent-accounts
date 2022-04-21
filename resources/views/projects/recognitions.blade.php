<x-app-layout>
    <div class="flex-lg-row-fluid ms-lg-15">
        <x-project.navigation :project="$project" active="recognitions" />
        <!--begin:::Tab pane-->
        <div>
            <x-validation-error />

            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-sm px-5 py-1 btn-success" data-bs-toggle="collapse"
                        data-bs-target="#addRecognitionCollapse" aria-expanded="false"
                        aria-controls="addRecognitionCollapse">
                        <x-utils.add-icon /> Add Recognition
                    </button>

                    <div class="collapse" id="addRecognitionCollapse">
                        <div class="card card-body border border-gray-300 mt-3">
                            <form action="{{ route('projects.recognitions.store', [$project]) }}" method="post"
                                class="my-2" enctype="multipart/form-data">
                                @csrf

                                <div class="fv-row mb-7">
                                    <label class="form-label fw-bolder text-dark fs-6" for="phone">Receive By
                                        <x-utils.required />
                                    </label>

                                    <select class="form-select form-select-solid select2-hidden-accessible"
                                        data-control="select2" data-hide-search="true" tabindex="-1" aria-hidden="true"
                                        name="user_id">
                                        @foreach ($users as $userId => $userName)
                                            <option value="{{ $userId }}">
                                                {{ $userName }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="fv-row mb-7">
                                    <label class="form-label fw-bolder text-dark fs-6" for="phone">Checked By
                                        <x-utils.required />
                                    </label>

                                    <select class="form-select form-select-solid select2-hidden-accessible"
                                        data-control="select2" data-hide-search="true" tabindex="-1" aria-hidden="true"
                                        name="checked_by">
                                        @foreach ($users as $userId => $userName)
                                            <option value="{{ $userId }}">
                                                {{ $userName }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="my-3">
                                    <h3>
                                        Add Items
                                    </h3>
                                </div>
                                <div id="recognition_items">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <div data-repeater-list="recognition_items">
                                            <div data-repeater-item>
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Purpose</label>
                                                        <input type="text" name="purpose"
                                                            class="form-control mb-2 mb-md-0" />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Rate</label>
                                                        <input type="number" name="rate"
                                                            class="form-control mb-2 mb-md-0" />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Total Amount</label>
                                                        <input type="number" name="total_amount"
                                                            class="form-control mb-2 mb-md-0" />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a href="javascript:;" data-repeater-delete
                                                            class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                            <x-utils.delete-icon /> Delete
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Form group-->

                                    <!--begin::Form group-->
                                    <div class="form-group mt-5">
                                        <a href="javascript:;" data-repeater-create
                                            class="btn btn-light-primary px-3 py-1">
                                            <x-utils.add-icon />Add
                                        </a>
                                    </div>
                                    <!--end::Form group-->
                                </div>
                                <!--end::Repeater-->

                                <button type="submit" class="btn btn-primary mt-2 w-100">Save Recognition</button>
                            </form>
                        </div>
                    </div>

                    @foreach ($project->recognitions as $recognition)
                        <div class="border mt-3 mb-3 p-5 border-gray-300">
                            <div class="mt-5 d-flex justify-content-between gap-3">
                                <h2 class="text-uppercase px-3 py-1 bg-gray-900 text-white rounded-3">Money Recognition
                                </h2>
                                <form action="" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Send Approve Request</button>
                                </form>
                            </div>
                            <div class="d-flex py-5 gap-3">
                                <div class="w-50 d-flex align-items-center gap-2"><strong> Name: </strong> <span
                                        class="w-100 flex-1 border-0 border-bottom-2 border-dotted">{{ $recognition->person->name }}</span>
                                </div>
                                <div class="w-50 d-flex align-items-center gap-2"><strong>Project:
                                    </strong> <span
                                        class="w-100 border-0 border-bottom-2 border-dotted">{{ $recognition->project->name }}</span>
                                </div>
                            </div>
                            <div class="d-flex py-5 gap-3">
                                <div class="w-50 d-flex align-items-center gap-2"><strong> Designation: </strong>
                                    <span
                                        class="w-100 border-0 border-bottom-2 border-dotted">{{ $recognition->person->designation() }}</span>
                                </div>
                                <div class="w-50 d-flex align-items-center gap-2"><strong>Date:
                                    </strong> <span
                                        class="w-100 border-0 border-bottom-2 border-dotted">{{ $recognition->date }}</span>
                                </div>
                                <div class="w-50 d-flex align-items-center gap-2"><strong>Contact:
                                    </strong> <span
                                        class="w-100 border-0 border-bottom-2 border-dotted">{{ $recognition->person->phone }}</span>
                                </div>
                            </div>

                            <div class="table-responsive py-5">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="fw-bolder fs-6 bg-gray-300 text-dark border border-dark">
                                            <th class="px-2">SL</th>
                                            <th class="px-2">Purpose</th>
                                            <th class="px-2">Rate</th>
                                            <th class="px-2">Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border border-dark">
                                        @foreach ($recognition->items as $recognitionItem)
                                            <tr class="border border-dark fw-bold">
                                                <td class="p-2">{{ $loop->iteration }}</td>
                                                <td class="p-2">{{ $recognitionItem->purpose }}</td>
                                                <td class="p-2">{{ $recognitionItem->rate }}</td>
                                                <td class="p-2">{{ $recognitionItem->total_amount }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-5 d-flex justify-content-between">
                                <div>
                                    <div class="text-center">
                                        {{ $recognition->person->name }}
                                    </div>
                                    <div class="border-top border-top-1 border-gray-500">
                                        <strong>
                                            Received By
                                        </strong>
                                    </div>
                                </div>

                                <div>
                                    <div class="text-center">
                                        {{ $recognition->checkedBy?->name }}&nbsp;
                                    </div>
                                    <div class="border-top border-top-1 border-gray-500">
                                        <strong>
                                            Checked By
                                        </strong>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-center">
                                        {{ $recognition->approveBy?->name }}&nbsp;
                                    </div>
                                    <div class="border-top border-top-1 border-gray-500">
                                        <strong>
                                            Approve By
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!--end:::Tab content-->
    </div>

    <x-slot name="script">
        <script>
            $('#recognition_items').repeater({
                initEmpty: false,

                show: function() {
                    $(this).slideDown();
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });
        </script>
    </x-slot>
</x-app-layout>
