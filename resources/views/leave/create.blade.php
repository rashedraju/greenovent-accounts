<x-app-layout>

    <div class="row">
        <div class="col-12 col-sm-4 mx-auto">
            <div class="card">
                <div class="card-body">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form class="form w-100" novalidate="novalidate" action="{{ route('leave.store') }}"
                        method="post">
                        @csrf

                        <div class="text-center mb-10">
                            <h1 class="text-dark mb-3">Leave Register</h1>
                        </div>
                        <div class="d-flex align-items-center mb-10">
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                            <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        </div>

                        <label class="form-label mt-2 mb-0">Subject</label>
                        <input type="text" class="form-control" name="subject">

                        <label class="form-label mt-2 mb-0">Details</label>
                        <textarea type="text" class="form-control" name="details" rows="5"> </textarea>

                        <div class="d-flex align-items-center mb-10">
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                            <span class="fw-bold text-gray-400 fs-7 mx-2"></span>
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
