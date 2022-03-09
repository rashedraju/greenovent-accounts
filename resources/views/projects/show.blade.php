<x-app-layout>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
                <x-project.aside :project="$project" />
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-15">
                    <x-project.navigation :project="$project" active="overview" />
                    <x-project.costs :project="$project" />
                </div>
                <!--end::Content-->
            </div>
        </div>
        <!--end::Container-->
    </div>
</x-app-layout>
