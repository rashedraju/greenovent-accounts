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
                        @foreach ($requisitions as $requisitionItem)
                            <a href="{{ route('accounts.requisitions.show', $requisitionItem) }}"
                                class="list-group-item py-5 list-group-item-action {{ $requisitionItem->id == $requisition->id ? 'active' : '' }}">
                                <div class="d-flex justify-content-between">
                                    <h5 class="fw-bolder">{{ $requisitionItem->project->name }}</h5>
                                    <small>{{ $requisitionItem->date }}</small>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <small>By {{ $requisitionItem->person->name }}</small>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-5">
                        {{ $requisitions->links() }}
                    </div>
                </div>
                <div class="w-75 border">
                    <div class="m-3 p-3 border">
                        <div class="border mt-3 mb-3 p-5 border-gray-300">
                            <div class="mt-5 d-flex justify-content-between gap-3">
                                <h2 class="text-uppercase px-3 py-1 bg-gray-900 text-white rounded-3">Money Requisition
                                </h2>
                            </div>
                            <div class="d-flex py-5 gap-3">
                                <div class="w-50 d-flex align-items-center gap-2"><strong> Name: </strong> <span
                                        class="w-100 flex-1 border-0 border-bottom-2 border-dotted">{{ $requisition->person->name }}</span>
                                </div>
                                <div class="w-50 d-flex align-items-center gap-2"><strong>Project:
                                    </strong> <span
                                        class="w-100 border-0 border-bottom-2 border-dotted">{{ $requisition->project->name }}</span>
                                </div>
                            </div>
                            <div class="d-flex py-5 gap-3">
                                <div class="w-50 d-flex align-items-center gap-2"><strong> Designation: </strong>
                                    <span
                                        class="w-100 border-0 border-bottom-2 border-dotted">{{ $requisition->person->designation() }}</span>
                                </div>
                                <div class="w-50 d-flex align-items-center gap-2"><strong>Date:
                                    </strong> <span
                                        class="w-100 border-0 border-bottom-2 border-dotted">{{ $requisition->date }}</span>
                                </div>
                                <div class="w-50 d-flex align-items-center gap-2"><strong>Contact:
                                    </strong> <span
                                        class="w-100 border-0 border-bottom-2 border-dotted">{{ $requisition->person->phone }}</span>
                                </div>
                            </div>

                            <div class="table-responsive py-5">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="fw-bolder fs-6 bg-gray-300 text-dark border border-dark">
                                            <th class="px-2">SL</th>
                                            <th class="px-2">Purpose</th>
                                            <th class="px-2">Rate</th>
                                            <th class="px-2">Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border border-dark">
                                        @foreach ($requisition->items as $requisitionItem)
                                            <tr class="border border-dark fw-bold">
                                                <td class="p-2">{{ $loop->iteration }}</td>
                                                <td class="p-2">{{ $requisitionItem->purpose }}</td>
                                                <td class="p-2">{{ $requisitionItem->rate }}</td>
                                                <td class="p-2">{{ $requisitionItem->total_amount }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-5 d-flex justify-content-between">
                                <div>
                                    <div class="text-center">
                                        {{ $requisition->person->name }}
                                    </div>
                                    <div class="border-top border-top-1 border-gray-500">
                                        <strong>
                                            Received By
                                        </strong>
                                    </div>
                                </div>

                                <div>
                                    <div class="text-center">
                                        {{ $requisition->checkedBy?->name }}&nbsp;
                                    </div>
                                    <div class="border-top border-top-1 border-gray-500">
                                        <strong>
                                            Checked By
                                        </strong>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-center">
                                        &nbsp;
                                    </div>
                                    <div class="border-top border-top-1 border-gray-500">
                                        <strong>
                                            Approve By
                                        </strong>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-secondary mt-5 d-inline-block" role="alert">
                                <div><strong> Approval Status: </strong> <span class="text-white px-2 py-1 rounded-3"
                                        style="background-color: {{ $requisition->approval()->status->color }}">
                                        {{ $requisition->approval()->status->name }} </span></div>
                                <div class="mt-4">
                                    <strong>Approval Message:</strong> {{ $requisition->approval()->note }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
