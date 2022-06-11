@props(['project', 'active'])
<ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold my-8">
    <!--begin:::Tab item-->
    <li class="nav-item">
        <a class="nav-link pb-4 {{ $active == 'overview' ? 'text-active-primary active' : '' }}"
            href="{{ route('projects.show', $project) }}">Overview</a>
    </li>
    <li class="nav-item">
        <a class="nav-link pb-4 {{ $active == 'external' ? 'text-active-primary active' : '' }}"
            href="{{ route('projects.external.index', $project) }}">External</a>
    </li>
    <li class="nav-item">
        <a class="nav-link pb-4 {{ $active == 'internal' ? 'text-active-primary active' : '' }}"
            href="{{ route('projects.internal.index', $project) }}">Internal</a>
    </li>

    <li class="nav-item">
        <a class="nav-link pb-4 {{ $active == 'requisitions' ? 'text-active-primary active' : '' }}"
            href="{{ route('projects.requisitions.index', $project) }}">Requisition</a>
    </li>

    <li class="nav-item">
        <a class="nav-link pb-4 {{ $active == 'vendor' ? 'text-active-primary active' : '' }}"
            href="{{ route('projects.vendor.index', $project) }}">Vendor</a>
    </li>
    <li class="nav-item">
        <a class="nav-link pb-4 {{ $active == 'bill' ? 'text-active-primary active' : '' }}"
            href="{{ route('projects.bill.index', $project) }}">Bill</a>
    </li>
    <!--end:::Tab item-->
    <!--begin:::Tab item-->
    <li class="nav-item ms-auto">
        <!--begin::Action menu-->
        <a href="#" class="btn btn-primary ps-7" data-kt-menu-trigger="click" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end">Actions
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
            <span class="svg-icon svg-icon-2 me-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                        fill="black"></path>
                </svg>
            </span>
            <!--end::Svg Icon-->
        </a>
        <!--begin::Menu-->
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold py-4 w-250px fs-6"
            data-kt-menu="true" style="">
            <div class="menu-item px-3">
                <a href="{{ route('projects.edit', $project) }}" class="menu-link px-5">Edit
                    Project Info</a>
            </div>
        </div>
    </li>
</ul>

{{-- delete project confirmation modal --}}
<div class="modal fade" tabindex="-1" id="project_delete_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Are you sure?</h5>
            </div>

            <div class="modal-body">
                <form action="{{ route('projects.delete', $project) }}" method="post">
                    @csrf
                    @method('delete')

                    <p>Are you sure you want to delete this project? After deletion, you can not
                        access the project but it would not be deleted permanently.</p>
                    <p class="text-warning"> Project deletion request will go to authorities for confirmation. </p>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete Project</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
