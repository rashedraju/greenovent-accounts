<x-app-layout>
    <div class="p-1 mt-sm-1 mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4 active"><a href="{{ route('accounts-manager.index') }}">Accounts
                        Manager</a></li>
                <li class="breadcrumb-item fs-4"><a
                        href="{{ route('accounts-manager.show', $data['accountsManager']->id) }}">{{ $data['accountsManager']->name }}</a>
                </li>
                <li class="breadcrumb-item fs-4">{{ $data['client']->company_name }}</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-wrap gap-3">
                <div class="bg-light p-5 border border-gray-300 flex-grow-1">
                    <p class="text-gray-700">Sales this year</p>
                    <h1 class="text-black">
                        <x-utils.currency />{{ number_format($data['salesThisYear']) }}
                    </h1>
                </div>

                <div class="bg-light p-5 border border-gray-300 flex-grow-1">
                    <p class="text-gray-700">Sales this month</p>
                    <h1 class="text-black">
                        <x-utils.currency />{{ number_format($data['salesThisMonth']) }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3 py-10">
        <div class="table-responsive">
            <table class="table table-secondary table-striped">
                <thead>
                    <tr class="fw-bolder fs-6">
                        <th class="px-2 py-5">SI</th>
                        <th class="px-2 py-5">Porject Name</th>
                        <th class="px-2 py-5">Project Type</th>
                        <th class="px-2 py-5">Po Value</th>
                        <th class="px-2 py-5">Bill Status</th>
                        <th class="px-2 py-5">Starting Date</th>
                        <th class="px-2 py-5">Closing Date</th>
                        <th class="px-2 py-5">Project Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['client']->projects as $project)
                        <tr class="fw-bold cursor-pointer"
                            onclick="window.location='{{ route('projects.show', $project->id) }}'">
                            <td class="px-2 py-5">{{ $loop->iteration }}</td>
                            <td class="px-2 py-5">{{ $project->name }}</td>
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
