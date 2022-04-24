<x-app-layout>
    <div class="card mb-3">
        <div class="card-body">
            <div id="projects_chart" style="height: 300px;"></div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-secondary table-striped">
                    <thead>
                        <tr class="fw-bolder fs-6">
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
                            <th class="px-2 py-5">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr class="fw-bold">
                                <td class="px-2 py-5">{{ $loop->iteration }}</td>
                                <td class="px-2 py-5"><a
                                        href="{{ route('projects.show', $project) }}">{{ $project->name }}</a></td>
                                <td class="px-2 py-5">
                                    <a href="{{ route('clients.show', $project->client) }}">
                                        {{ $project->client->company_name }}
                                    </a>
                                </td>
                                <td class="px-2 py-5"><a
                                        href="{{ route('employees.show', $project->manager) }}">{{ $project->manager->name }}</a>
                                </td>
                                <td class="px-2 py-5">{{ $project->type->name }}</td>
                                <td class="px-2 py-5">{{ $project->po_value }}</td>
                                <td class="px-2 py-5"><span
                                        class="badge badge-primary">{{ $project->billStatus() }}</span></td>
                                <td class="px-2 py-5">{{ $project->start_date }}</td>
                                <td class="px-2 py-5">{{ $project->closing_date }}</td>
                                <td class="px-2 py-5">
                                    <span class="text-white px-3 py-1 rounded"
                                        style="background: {{ $project->status->color }}">
                                        {{ $project->status->name }}
                                </td>
                                </span>
                                <td class="px-2 py-5">
                                    <a href="{{ route('projects.edit', $project) }}">
                                        <x-utils.edit-icon />
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
                el: '#projects_chart',
                url: "@chart('projects_chart')",
                hooks: new ChartisanHooks()
                    .legend()
                    .colors()
                    .tooltip()
                    .title('Project Finance Year of - ' + date.getFullYear())
            });
        </script>
    </x-slot>

</x-app-layout>
