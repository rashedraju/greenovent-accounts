<x-app-layout>
    @include('components.sales-table', ['action' => route('dashboard')])

    <div class="card mt-5">
        <div class="card-header d-flex align-items-center">
            <h3> Ongoing Projects</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="fw-bolder fs-6 bg-gray-100 text-dark border border-secondary">
                            <th class="px-2 py-5">Client Name</th>
                            <th class="px-2 py-5">Porject Name</th>
                            <th class="px-2 py-5">Accounts Manger</th>
                            <th class="px-2 py-5">Project Type</th>
                            <th class="px-2 py-5">Starting Date</th>
                            <th class="px-2 py-5">Closing Date</th>
                            <th class="px-2 py-5">Project Status</th>
                        </tr>
                    </thead>
                    <tbody class="border border-secondary">
                        @foreach ($data['onGoingProjects'] as $project)
                            <tr class="fw-bold">
                                <td class="px-2 py-5">
                                    <a
                                        href="{{ route('accounts-manager.client', ['user' => $project->client, 'client' => $project->client]) }}">
                                        {{ $project->client->company_name }}
                                    </a>
                                </td>
                                <td class="px-2 py-5"><a
                                        href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
                                </td>

                                <td class="px-2 py-5"><a
                                        href="{{ route('accounts-manager.show', $project->manager) }}">{{ $project->manager->name }}</a>
                                </td>
                                <td class="px-2 py-5">{{ $project->type->name }}</td>
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
            <h3> Last 5 Completed Projects</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="fw-bolder fs-6 bg-gray-100 text-dark border border-secondary">
                            <th class="px-2 py-5">Client Name</th>
                            <th class="px-2 py-5">Porject Name</th>
                            <th class="px-2 py-5">Accounts Manger</th>
                            <th class="px-2 py-5">Project Type</th>
                            <th class="px-2 py-5">Starting Date</th>
                            <th class="px-2 py-5">Closing Date</th>
                            <th class="px-2 py-5">Project Status</th>
                            <th class="px-2 py-5">PO Value</th>
                            <th class="px-2 py-5">Gross Profit</th>
                        </tr>
                    </thead>
                    <tbody class="border border-secondary">
                        @foreach ($data['completedProjects'] as $project)
                            <tr class="fw-bold">
                                <td class="px-2 py-5">
                                    <a
                                        href="{{ route('accounts-manager.client', ['user' => $project->client, 'client' => $project->client]) }}">
                                        {{ $project->client->company_name }}
                                    </a>
                                </td>
                                <td class="px-2 py-5"><a
                                        href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
                                </td>

                                <td class="px-2 py-5"><a
                                        href="{{ route('accounts-manager.show', $project->manager) }}">{{ $project->manager->name }}</a>
                                </td>
                                <td class="px-2 py-5">{{ $project->type->name }}</td>
                                <td class="px-2 py-5">{{ $project->start_date }}</td>
                                <td class="px-2 py-5">{{ $project->closing_date }}</td>
                                <td class="px-2 py-5">
                                    <span class="text-white px-3 py-1 rounded"
                                        style="background: {{ $project->status->color }}">
                                        {{ $project->status->name }}
                                    </span>
                                </td>
                                <td class="px-2 py-5">{{ number_format($project->po_value, 2, ',') }}</td>
                                <td class="px-2 py-5">{{ number_format($project->grossProfit(), 2, ',') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
