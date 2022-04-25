<x-app-layout>
    <div class="card card-body">
        <div class="d-flex justify-content-between">
            <div class="w-75">
                <h6 class="text-center mb-5">Finance Records of this year - {{ $year }}</h6>
                <div id="net_profit_chart" style="height: 300px;"></div>
            </div>
            <div class="w-25">
                <h6 class="text-center mb-5">Business Manager Contribution by Month</h6>
                <div id="business_manager_contribution_chart" style="height: 300px;"></div>
            </div>
        </div>

        <div class="d-flex overflow-scroll mt-5">
            <div class="bg-primary p-5" style="border-radius: 2rem 0 0 0">
                <p class="text-white">Total</p>
                <h1 class="text-white">
                    <x-utils.currency />{{ number_format($totalAmountByYear) }}
                </h1>
            </div>

            <div class="bg-light p-5 text-white border border-gray-300">
                <p class="text-gray-700">Bank</p>
                <h1 class="text-gray-700">
                    <x-utils.currency />{{ number_format($totalBankAmountByYear) }}
                </h1>
            </div>

            <div class="bg-light p-5 text-white border border-gray-300">
                <p class="text-gray-700">Cash</p>
                <h1 class="text-gray-700">
                    <x-utils.currency />{{ number_format($totalCashAmountByYear) }}
                </h1>
            </div>

            <div class="bg-light p-5 text-white border border-gray-300">
                <p class="text-gray-700">Loan</p>
                <h1 class="text-gray-700">
                    <x-utils.currency />{{ number_format($totalLoanAmountByYear) }}
                </h1>
            </div>

            <div class="bg-light p-5 text-white border border-gray-300">
                <p class="text-gray-700">Investment</p>
                <h1 class="text-gray-700">
                    <x-utils.currency />{{ number_format($totalInvestmentAmountByYear) }}
                </h1>
            </div>
            <div class="bg-info p-5">
                <p class="text-white">Revenue</p>
                <h1 class="text-white">
                    <x-utils.currency />{{ number_format($totalRevenueOfThisYear) }}
                </h1>
            </div>

            <div class="bg-light p-5">
                <p class="text-gray-700">Expense</p>
                <h1 class="text-gray-700">
                    <x-utils.currency />{{ number_format($totalExpenseByYear) }}
                </h1>
            </div>

            <div class="bg-success p-5 text-white" style="border-radius: 0 2rem 0 0">
                <p class="text-white">Net Profit</p>
                <h1 class="text-white">
                    <x-utils.currency />{{ number_format($netProfit) }}
                </h1>
            </div>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header d-flex align-items-center">
            <h3> Clients</h3>
        </div>
        <div class="card-body">
            <div id="clients_chart" style="height: 300px;"></div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <tr class="fw-bolder fs-6 bg-gray-300 text-dark border border-dark">
                            <th class="px-2 py-5">SI</th>
                            <th class="px-2 py-5">Client Name</th>
                            <th class="px-2 py-5">Sales this year</th>
                            <th class="px-2 py-5">Total Sales</th>
                            <th class="px-2 py-5">Total Project</th>
                            <th class="px-2 py-5">Completed Projects</th>
                            <th class="px-2 py-5">Ongoing Projects</th>
                        </tr>
                    </thead>
                    <tbody class="border border-dark">
                        @foreach ($clients as $client)
                            <tr class="border border-dark fw-bold {{ $loop->iteration <= 3 ? 'table-primary' : '' }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $client->company_name }}</td>
                                <td>{{ number_format($client->salesByYear(now()->year)) }}</td>
                                <td>{{ number_format($client->totalSales()) }}</td>
                                <td>{{ $client->projects->count() }}</td>
                                <td>{{ $client->completedProjects()->count() }}</td>
                                <td>{{ $client->inProgressProjects()->count() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header d-flex align-items-center">
            <h3> Projects</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="fw-bolder fs-6 bg-gray-300 text-dark border border-dark">
                            <th class="px-2 py-5">SI</th>
                            <th class="px-2 py-5">Porject Name</th>
                            <th class="px-2 py-5">Client Name</th>
                            <th class="px-2 py-5">Bussiness Manger</th>
                            <th class="px-2 py-5">Project Type</th>
                            <th class="px-2 py-5">Po Value</th>
                            <th class="px-2 py-5">Bill Status</th>
                            <th class="px-2 py-5">Starting Date</th>
                            <th class="px-2 py-5">Closing Date</th>
                            <th class="px-2 py-5">Project Status</th>
                        </tr>
                    </thead>
                    <tbody class="border border-dark">
                        @foreach ($projects as $project)
                            <tr class="border border-dark fw-bold">
                                <td class="px-2 py-5">{{ $loop->iteration }}</td>
                                <td class="px-2 py-5"><a
                                        href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
                                </td>
                                <td class="px-2 py-5">
                                    <a href="{{ route('clients.show', $project->client) }}">
                                        {{ $project->client->company_name }}
                                    </a>
                                </td>
                                <td class="px-2 py-5"><a
                                        href="{{ route('employees.show', $project->manager) }}">{{ $project->manager->name }}</a>
                                </td>
                                <td class="px-2 py-5">{{ $project->type->name }}</td>
                                <td class="px-2 py-5">{{ number_format($project->po_value) }}</td>
                                <td class="px-2 py-5"><span
                                        class="badge badge-primary">{{ $project->billStatus() }}</span></td>
                                <td class="px-2 py-5">{{ $project->start_date }}</td>
                                <td class="px-2 py-5">{{ $project->closing_date }}</td>
                                <td class="px-2 py-5">
                                    <span class="text-white px-3 py-1 rounded"
                                        style="background: {{ $project->status->color }}">
                                        {{ $project->status->name }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header d-flex align-items-center">
            <h3> Last 5 money disbursement by project </h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="fw-bolder fs-6 bg-gray-300 text-dark border border-dark">
                            <th class="px-2 py-5">SI</th>
                            <th class="px-2 py-5">Porject Name</th>
                            <th class="px-2 py-5">Project Status</th>
                            <th class="px-2 py-5">Recived By</th>
                            <th class="px-2 py-5">Amount</th>
                            <th class="px-2 py-5">Transaction Type</th>
                        </tr>
                    </thead>
                    <tbody class="border border-dark">
                        @foreach ($lastFiveCreditRecordsByProject as $creditRecord)
                            <tr class="border border-dark fw-bold">
                                <td class="px-2 py-5">{{ $loop->iteration }}</td>
                                <td class="px-2 py-5"><a
                                        href="{{ route('projects.show', $creditRecord->project) }}">{{ $creditRecord->project->name }}</a>
                                </td>
                                <td class="px-2 py-5">
                                    <span class="text-white px-3 py-1 rounded"
                                        style="background: {{ $creditRecord->project->status->color }}">
                                        {{ $creditRecord->project->status->name }}
                                    </span>
                                </td>
                                <td class="px-2 py-5">
                                    {{ $creditRecord->receivedPerson->name }}
                                </td>
                                <td class="px-2 py-5">
                                    {{ number_format($creditRecord->amount) }}
                                </td>
                                <td class="px-2 py-5">
                                    {{ $creditRecord->transactionType->name }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mt-5">
        <div class="card-header d-flex align-items-center">
            <h3> Snapshot of leave roster of this month</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-secondary table-striped">
                    <thead>
                        <tr class="fw-bolder fs-6">
                            <th class="px-2 py-5">SI</th>
                            <th class="px-2 py-5">Name</th>
                            <th class="px-2 py-5">Subject</th>
                            <th class="px-2 py-5">Date</th>
                            <th class="px-2 py-5">Approval Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaveRecordsOfThisMonth as $leaveRecord)
                            <tr>
                                <td class="px-2 py-5">{{ $loop->iteration }}</td>
                                <td class="px-2 py-5"><a
                                        href="{{ route('employees.show', $leaveRecord->user) }}">{{ $leaveRecord->user->name }}</a>
                                </td>
                                <td class="px-2 py-5">{{ $leaveRecord->subject }}</td>
                                <td class="px-2 py-5">
                                    {{ $leaveRecord->created_at }}
                                </td>
                                <td class="px-2 py-5">
                                    {{ $leaveRecord->apporval->name }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script>
            // net profit chart
            const netPorfitChart = new Chartisan({
                el: '#net_profit_chart',
                url: "@chart('net_profit_by_month_chart')",
                hooks: new ChartisanHooks()
                    .legend()
                    .colors()
                    .tooltip()
            });

            // bussiness manager contribution chart
            const businessManagerContributionChart = new Chartisan({
                el: '#business_manager_contribution_chart',
                url: "@chart('business_manager_contribution_chart')",
                hooks: new ChartisanHooks()
                    .legend()
                    .colors()
                    .tooltip()
                    .axis(false)
                    .datasets([{
                        type: 'pie'
                    }]),
            });

            // clients chart
            var date = new Date();
            const clientsChart = new Chartisan({
                el: '#clients_chart',
                url: "@chart('clients_chart')",
                hooks: new ChartisanHooks()
                    .legend()
                    .colors()
                    .tooltip()
            });
        </script>
    </x-slot>

</x-app-layout>
