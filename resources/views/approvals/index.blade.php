<x-app-layout>
    <div class="p-2 py-5">
        <h1 class="text-center">Approvals</h1>
    </div>
    <div class="card">
        <div class="card-body py-4">
            <h3 class="pb-3">Approval Requests</h3>
            <div class="d-flex">
                <div class="w-25">
                    <div class="list-group">
                        @foreach ($approvals as $approval)
                            <a href="{{ route('approvals.show', $approval) }}"
                                class="list-group-item py-5 list-group-item-action">
                                <div class="d-flex justify-content-between">
                                    <h5 class="fw-bolder">{{ $approval->title }}</h5>
                                    <small>{{ $approval->created_at->diffForHumans() }}</small>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <small>By {{ $approval->requestBy->name }}</small>
                                    <span class="badge badge-secondary">{{ $approval->status->name }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-5">
                        {{ $approvals->links() }}
                    </div>
                </div>
                <div class="w-75 d-flex justify-content-center align-items-center">
                    <h1 class="text-muted">
                        Click Approval Request Lists to Preview
                    </h1>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
