<x-app-layout>
    <div class="p-2 py-5">
        <h1 class="text-center">Accounts</h1>
    </div>
    <x-accounts-navigation />
    <div class="card">
        <div class="card-body py-4">
            <h3 class="pb-3">Requisitions</h3>
            <div class="d-flex">
                <div class="w-25">
                    <div class="list-group">
                        @foreach ($requisitions as $requisition)
                            <a href="{{ route('accounts.requisitions.show', $requisition) }}"
                                class="list-group-item py-5 list-group-item-action">
                                <div class="d-flex justify-content-between">
                                    <h5 class="fw-bolder">{{ $requisition->project->name }}</h5>
                                    <small>{{ $requisition->date }}</small>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <small>By {{ $requisition->person->name }}</small>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-5">
                        {{ $requisitions->links() }}
                    </div>
                </div>
                <div class="w-75 d-flex justify-content-center align-items-center">
                    <h1 class="text-muted">
                        Click to see detail view
                    </h1>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
