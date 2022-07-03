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
    <li class="nav-item ms-auto">
        <a href="{{ route('projects.edit', $project) }}" class="av-link pb-4">Edit
            Project Info</a>
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
