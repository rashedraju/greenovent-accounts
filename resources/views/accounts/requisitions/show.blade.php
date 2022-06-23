<x-app-layout>
    <div class="p-2 py-5">
        <h1 class="text-center">Accounts</h1>
    </div>
    <x-accounts-navigation :year="$year" :month="$month" />
    <div class="card">
        <div class="card-body py-4">
            <h3 class="pb-3">Requisitions</h3>
            <div class="flex-lg-row-fluid">
                @foreach ($requisitions as $requisition)
                    <div class="card card-body my-3 border border-secondary">
                        <div class="border mt-3 mb-3 p-5 border-gray-300">
                            <div class="mt-5 d-flex justify-content-between gap-3">
                                <h2 class="text-uppercase px-3 py-1 bg-gray-900 text-white rounded-3">Money Requisition
                                </h2>
                                <div class="fs-5 d-flex">
                                    <div class="d-flex flex-column gap-3 text-end">
                                        <div class="border-bottom border-gray-500 px-5">
                                            <strong>Total Amount:</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-3 text-end">
                                        <div class="border-bottom border-gray-500 px-5">
                                            {{ number_format($requisition['total'], 2) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @isset($requisition['sheet'])
                                {!! $requisition['sheet'][0] !!}
                                {!! $requisition['sheet'][1] !!}
                                {!! $requisition['sheet'][2] !!}
                            @endisset
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
