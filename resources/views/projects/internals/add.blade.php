<x-app-layout>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="w-lg-700px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form class="form w-100" novalidate="novalidate"
                    action="{{ route('projects.internals.store', $project) }}" method="post">
                    @csrf

                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">Add Project Internal Cost</h1>
                    </div>
                    <div class="d-flex align-items-center mb-10">
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Title
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="title"
                            :value="old('title')" />
                    </div>

                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Quantity
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control-lg form-control-solid" type="number" name="quantity"
                            :value="old('quantity')" />
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Rate
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control-lg form-control-solid" type="number" name="rate"
                            :value="old('rate')" />
                    </div>

                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Costs
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control-lg form-control-solid" type="number" name="costs"
                            :value="old('costs')" />
                    </div>

                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6" for="start_date">Date
                            <x-utils.required />
                        </label>
                        <input class="form-control form-control-solid" id="add_internal_date_picker" name="created_at"
                            value="{{ now() }}" />
                    </div>

                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Description</label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="description"
                            :value="old('description')" />
                    </div>

                    <div class="d-flex align-items-center mb-10">
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                        <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                            Add Internal Cost
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
