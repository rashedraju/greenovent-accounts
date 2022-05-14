<x-app-layout>
    <h1 class="text-center">Bills</h1>
    <div class="card">
        <div class="card-body">
            <h2 class="mb-5 text-center">{{ $client->company_name }}</h2>

            <div class="d-flex bg-light justify-content-between align-items-center px-3">
                <h4 class="text-center py-5">Project:
                    <a href="{{ route('projects.show', $bill->project) }}">{{ $bill->project->name }}</a>
                </h4>
                <h4 class="text-center py-5">Bill Month:
                    {{ $bill->billMonth() }} - {{ $bill->billYear() }}
                </h4>
            </div>

            <div class="d-flex justify-content-between flex-wrap mt-5">
                <div class="p-3 m-3 mb-5 d-flex flex-column gap-3">
                    <div> <strong>Bill Type:</strong> {{ $bill->project->billType->name }}
                    </div>
                    <div> <strong>Bill Status:</strong> {{ $bill->status->name }}
                    </div>
                    <div> <strong>Subject:</strong> {{ $bill->subject }}</div>
                    <div> <strong>Date:</strong> {{ $bill->date }} </div>
                </div>

                <div class="fs-5 d-flex">
                    <div class="d-flex flex-column gap-3 text-end">
                        <div class="px-5">
                            <strong>Total:</strong>
                        </div>
                        <div class="border-bottom border-gray-500 px-5">
                            ASF {{ $bill->asf }}%:
                        </div>
                        <div class="px-5">
                            <strong>Sub Total:</strong>
                        </div>
                        <div class="border-bottom border-gray-500 px-5">
                            VAT {{ $bill->vat }}%:
                        </div>
                        <div class="px-5">
                            <strong>Grand Total:</strong>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-3 text-end">
                        <div class="px-5">
                            {{ number_format($bill->total) }}
                        </div class="px-5">
                        <div class="border-bottom border-gray-500 px-5">
                            {{ number_format($bill->asfTotal()) }}
                        </div>
                        <div class="px-5">
                            {{ number_format($bill->asfSubTotal()) }}
                        </div>
                        <div class="border-bottom border-gray-500 px-5">
                            {{ number_format($bill->vatTotal()) }}
                        </div>
                        <div class="px-5">
                            {{ number_format($bill->grandTotal()) }}
                        </div>
                    </div>
                </div>

                <div>
                    <div class="border p-2 m-3">
                        <div>
                            <h5 class="py-3 mb-3">Bill File: </h5>
                            @if ($bill->file)
                                <div>
                                    <strong> {{ explode('/', $bill->file->file)[1] }}
                                    </strong>
                                    <a href="{{ asset("/public/uploads/{$bill->file?->file}") }}"
                                        class="btn btn-sm p-1 btn-secondary">
                                        Download
                                    </a>
                                </div>
                            @else
                                <div class="alert alert-warning fs-6" role="alert">
                                    No bill file added!
                                </div>
                            @endif
                        </div>
                        <div class="border-top border-gray-300 mt-2">
                            <h5 class="py-3 mb-5">Supporting File:
                            </h5>
                            @if ($bill->supporting)
                                <div>
                                    <strong> {{ explode('/', $bill->supporting->file)[1] }}
                                    </strong>
                                    <a href="{{ asset("/public/uploads/{$bill->supporting?->file}") }}"
                                        class="btn btn-sm p-1 btn-secondary">
                                        Download
                                    </a>
                                </div>
                            @else
                                <div class="alert alert-warning fs-6" role="alert">
                                    No supporting file added!
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
