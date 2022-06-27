<x-app-layout>
    <style>
        table th,
        table td {
            white-space: nowrap;
        }
    </style>
    <div class="p-1 mt-sm-1 mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4 active"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                <li class="breadcrumb-item fs-4 active"><a
                        href="{{ route('accounts.show.year', $data['year']) }}">{{ $data['year'] }}</a></li>
                <li class="breadcrumb-item fs-4"><a
                        href="{{ route('accounts.show.year.month', ['year' => $data['year'], 'month' => $data['year']]) }}">{{ now()->month($data['month'])->format('F') }}</a>
                </li>
                <li class="breadcrumb-item fs-4">Sales</li>
            </ol>
        </nav>
    </div>

    <x-accounts-navigation :year="$data['year']" :month="$data['month']" />
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-wrap gap-3">
                <div class="bg-light p-5 border border-gray-300 flex-grow-1">
                    <p class="text-gray-700">Total Sales</p>
                    <h1 class="text-black">
                        <x-utils.currency />{{ number_format($data['salesThisMonth']) }}
                    </h1>
                </div>

                <div class="bg-light p-5 border border-gray-300 flex-grow-1">
                    <p class="text-gray-700">Total Expense</p>
                    <h1 class="text-black">
                        <x-utils.currency />{{ number_format($data['totalExpense']) }}
                    </h1>
                </div>

                <div class="bg-light p-5 border border-gray-300 flex-grow-1">
                    <p class="text-gray-700">Gross Profit</p>
                    <h1 class="text-black">
                        <x-utils.currency />{{ number_format($data['grossProfit']) }}
                    </h1>
                </div>

            </div>
        </div>
    </div>

    <div class="card my-3">
        <div class="table-responsive">
            <table class="table table-secondary table-hover bs-table-bordered">
                <thead>
                    <tr class="border border-dark">
                        <td class="px-2 py-5 fw-bolder fs-6">Date</td>
                        <td class="px-2 py-5 fw-bolder fs-6">Accounts Manager</td>
                        <td class="px-2 py-5 fw-bolder fs-6">Client Name</td>
                        <td class="px-2 py-5 fw-bolder fs-6">Description</td>
                        <td class="px-2 py-5 fw-bolder fs-6">Project Goal</td>
                        <td class="px-2 py-5 fw-bolder fs-6">Sales</td>
                        <td class="px-2 py-5 fw-bolder fs-6">ASF</td>
                        <td class="px-2 py-5 fw-bolder fs-6">Sub Total</td>
                        <td class="px-2 py-5 fw-bolder fs-6">Amount VAT</td>
                        <td class="px-2 py-5 fw-bolder fs-6">Client Advance</td>
                        <td class="px-2 py-5 fw-bolder fs-6">BP</td>
                        <td class="px-2 py-5 fw-bolder fs-6">AIT </td>
                        <td class="px-2 py-5 fw-bolder fs-6"> Expence </td>
                        <td class="px-2 py-5 fw-bolder fs-6"> Total Expense </td>
                        <td class="px-2 py-5 fw-bolder fs-6"> Due </td>
                        <td class="px-2 py-5 fw-bolder fs-6"> Gross Profit </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['projects'] as $project)
                        <tr class="border border-dark cursor-pointer {{ $project->due() == 0 ? '' : 'table-danger' }}"
                            onclick="window.location='{{ route('projects.show', $project->id) }}'">
                            <td class="px-2 py-5">{{ $project->start_date }}</td>
                            <td class="px-2 py-5">{{ $project->manager->name }}</td>
                            <td class="px-2 py-5">{{ $project->client->company_name }}</td>
                            <td class="px-2 py-5">{{ $project->name }}</td>
                            <td class="px-2 py-5">
                                {{ number_format((float) $project->external?->grandTotal(), 2, '.', ',') }}
                            </td>
                            <td class="px-2 py-5">
                                {{ number_format((float) $project->external?->total, 2, '.', ',') }}</td>
                            <td class="px-2 py-5">
                                {{ number_format((float) $project->external?->asfTotal(), 2, '.', ',') }}
                            </td>
                            <td class="px-2 py-5">
                                {{ number_format((float) $project->external?->asfSubTotal(), 2, '.', ',') }}
                            </td>
                            <td class="px-2 py-5">
                                {{ number_format((float) $project->external?->vatTotal(), 2, '.', ',') }}
                            </td>
                            <td class="px-2 py-5">
                                {{ number_format((float) $project->advance_paid, 2, '.', ',') }}</td>
                            <td class="px-2 py-5">
                                {{ number_format((float) $project->bp, 2, '.', ',') }}</td>
                            <td class="px-2 py-5">
                                {{ number_format((float) $project->ait(), 2, '.', ',') }}</td>
                            <td class="px-2 py-5">
                                {{ number_format((float) $project->internal?->total, 2, '.', ',') }}</td>
                            <td class="px-2 py-5">
                                {{ number_format((float) $project->totalExpense(), 2, '.', ',') }}</td>
                            <td class="px-2 py-5">
                                {{ number_format((float) $project->due(), 2, '.', ',') }}</td>
                            <td class="px-2 py-5">
                                {{ number_format((float) $project->grossProfit(), 2, '.', ',') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
