<x-app-layout>
    <div class="card mb-3">
        <div class="card-body">
            <div id="clients_chart" style="height: 300px;"></div>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1>Clients</h1>
            <div>
                <a href="{{ route('clients.create') }}" type="button" class="btn btn-sm btn-primary ml-2">
                    <x-utils.add-icon /> Add New Client
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive py-5">
                <table class="table table-secondary table-striped">
                    <thead>
                        <tr class="fw-bolder fs-6 bg-gray-300">
                            <th scope="col" class="px-2 py-5">SL</th>
                            <th scope="col" class="px-2 py-5">Client Name</th>
                            <th scope="col" class="px-2 py-5">Total Projects</th>
                            <th scope="col" class="px-2 py-5">Ongoing Projects</th>
                            <th scope="col" class="px-2 py-5">Completed Projects</th>
                            <th scope="col" class="px-2 py-5">Pending Projects</th>
                            <th scope="col" class="px-2 py-5">Total Sales</th>
                            <th scope="col" class="px-2 py-5">Sales this Year</th>
                            <th scope="col" class="px-2 py-5">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr class="fw-bold">
                                <th scope="row" class="px-2 py-5">{{ $loop->iteration }}</th>
                                <td class="px-2 py-5"><a href="{{ route('clients.show', $client) }}">
                                        {{ $client->company_name }}
                                    </a></td>
                                <td class="px-2 py-5">{{ $client->projects->count() }}</td>
                                <td class="px-2 py-5"> {{ $client->inProgressProjects()->count() }} </td>
                                <td class="px-2 py-5"> {{ $client->completedProjects()->count() }} </td>
                                <td class="px-2 py-5"> {{ $client->pendingProjects()->count() }} </td>
                                <td class="px-2 py-5"> {{ number_format($client->totalSales()) }} </td>
                                <td class="px-2 py-5"> {{ number_format($client->salesByYear(now()->year)) }}
                                </td>
                                <td class="px-2 py-5">
                                    <a href="{{ route('clients.show', $client) }}">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
        <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
        <script>
            var date = new Date();
            const chart = new Chartisan({
                el: '#clients_chart',
                url: "@chart('clients_chart')",
                hooks: new ChartisanHooks()
                    .legend()
                    .colors()
                    .tooltip()
                    .title('Sales Statestics Year of - ' + date.getFullYear())
            });
        </script>
    </x-slot>
</x-app-layout>
