<x-app-layout>
    <div class="p-2 py-5">
        <h1 class="text-center">Revenue</h1>
    </div>

    <div class="card mt-3">
        <div class="card-body py-4 bg-secondary">
            <h3 class="pb-5 text-center">Revenue Records Month of {{ now()->year($year)->month($month)->format('F') }}
                - {{ $year }} </h3>
            @foreach ($projects as $project)
                <div class="card card-body my-2">
                    <div class="d-flex gap-2 p-2 justify-content-between">
                        <div>
                            <h2><a href="{{ route('projects.show', $project) }}"> {{ $project->name }} </a></h2>
                            <div class="py-1">Client Name:
                                <strong>{{ $project->client->company_name }}</strong>
                            </div>
                            <div class="py-1">Business Manager:
                                <strong>{{ $project->manager->name }}</strong>
                            </div>
                            <div class="py-1">Type: <strong>{{ $project->type->name }}</strong></div>
                            <div class="py-1">Start Date: <strong>{{ $project->start_date }}</strong></div>
                            <div class="py-1">Closing Date: <strong>{{ $project->closing_date }}</strong>
                            </div>
                        </div>
                        <div>
                            <h5 class="text-center">Bill Amount</h5>
                            <div class="py-1">Sales(Total of External): <strong>
                                    {{ $project->external?->total }} </strong> </div>
                            <div class="py-1">ASF(10%): <strong> {{ $project->external?->asfTotal() }}
                                </strong> </div>
                            <div class="py-1">Sub Total: <strong> {{ $project->external?->asfSubTotal() }}
                                </strong> </div>
                            <div class="py-1">VAT : <strong> {{ $project->external?->vatTotal() }}
                                </strong>
                            </div>
                            <div class="py-1">Grand Total : <strong>
                                    {{ $project->external?->grandTotal() }}
                                </strong> </div>
                        </div>
                        <div>
                            <h5 class="text-center">Expenses</h5>
                            <div class="py-1">Expenses(Total of Internal): <strong>
                                    {{ $project->internal?->total }} </strong> </div>
                            <div class="py-1">AIT(2%): <strong>
                                    {{ $project->ait() }} </strong> </div>
                            <div class="py-1">Total Expenses: <strong>
                                    {{ $project->totalExpense() }} </strong> </div>
                        </div>
                        <div>
                            <div class="py-1">Advance paid: <strong>
                                    {{ $project->advance_paid }} </strong> </div>
                            <div class="py-1">Due: <strong>
                                    {{ $project->due() }} </strong> </div>
                            <div class="py-1">Gross Profit: <strong>
                                    {{ $project->grossProfit() }} </strong> </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
