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
                        <x-recognition :recognition="$recognition" />
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