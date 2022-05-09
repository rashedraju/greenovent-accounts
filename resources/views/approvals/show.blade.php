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
                        @foreach ($approvals as $approvalItem)
                            <a href="{{ route('approvals.show', $approvalItem) }}"
                                class="list-group-item py-5 list-group-item-action {{ $approvalItem->id == $approval->id ? 'active' : '' }}">
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
                <div class="w-75 border">
                    <div class="m-3 p-3 border">
                        <form action="{{ route('approvals.update', $approval) }}" method="post">
                            @csrf
                            @method('put')

                            <textarea type="text" class="form-control my-3" name="note" rows="3" placeholder="Message..."></textarea>
                            <div class="d-flex gap-3 my-3">
                                @foreach ($approvalStatuses as $approvalStatus)
                                    <button type="submit" name="approval_status_id" value="{{ $approvalStatus->id }}"
                                        class="btn btn-sm text-white text-capitalize"
                                        style="background: {{ $approvalStatus->color }}">{{ $approvalStatus->name }}</button>
                                @endforeach
                            </div>
                        </form>
                    </div>
                    {!! $preview !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
