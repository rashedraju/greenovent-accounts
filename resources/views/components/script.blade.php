<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('/public/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('/public/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->

{{-- multiple input field repeater --}}
<script src="{{ asset('/public/assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>

{{-- AlpineJs --}}
<script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>

{{-- Toast Notification Start --}}

@if (session()->has('success'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 101">
        <div id="success_notification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <div class="fs-4">Notification</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body text-success fs-5 bg-white">
                {{ session('success') }}
            </div>
        </div>
    </div>
    <script>
        var toastElement = document.getElementById('success_notification');
        var toast = bootstrap.Toast.getOrCreateInstance(toastElement);
        toast.show();
    </script>
@elseif (session()->has('failed'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 101">
        <div id="failed_notification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <div>Notification</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body text-danger bg-white">
                {{ session('failed') }}
            </div>
        </div>
    </div>

    <script>
        var toastElement = document.getElementById('failed_notification');
        var toast = bootstrap.Toast.getOrCreateInstance(toastElement);
        toast.show();
    </script>
@endif

{{-- Toast Notification End --}}

<script>
    // Date Picker
    $("#user_add_joining_date_picker").flatpickr();
    $("#user_edit_joining_date_picker").flatpickr();
    $("#project_start_date_picker").flatpickr();
    $("#project_closing_date_picker").flatpickr();
    $("#add_external_date_picker").flatpickr();
    $("#edit_externals_date_picker").flatpickr();
    $("#add_internal_date_picker").flatpickr();
    $("#edit_internal_date_picker").flatpickr();
    $("#employee_performance_datepicker").flatpickr();

    // Contact person input repeater
    $('#client_contact_persons_input').repeater({
        initEmpty: false,

        defaultValues: {
            'text-input': 'foo'
        },

        show: function() {
            $(this).slideDown();
        },

        hide: function(deleteElement) {
            $(this).slideUp(deleteElement);
        }

    });
</script>
