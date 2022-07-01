<x-app-layout>
    <div class="p-1 mt-sm-1 mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4 active"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                <li class="breadcrumb-item fs-4 active"><a
                        href="{{ route('accounts.show.year', $year) }}">{{ $year }}</a></li>
                <li class="breadcrumb-item fs-4 active"><a
                        href="{{ route('accounts.show.year.month', ['year' => $year, 'month' => $month]) }}">{{ now()->month($month)->format('F') }}</a>
                </li>
                <li class="breadcrumb-item fs-4">Requisitions</li>
            </ol>
        </nav>
    </div>

    <x-accounts-navigation :year="$year" :month="$month" />

    <div class="card mt-3">
        <div class="card-body py-4">
            <h3 class="pb-3">Requisitions</h3>
            <div class="table-responsive">
                <table class="table table-secondary table-striped">
                    <thead>
                        <tr class="fw-bolder fs-6">
                            <th class="px-2 py-5">Porject Name</th>
                            <th class="px-2 py-5">Client</th>
                            <th class="px-2 py-5">Account Manager</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr class="fw-bold cursor-pointer"
                                onclick="window.location='{{ route('accounts.requisitions.show', ['year' => $year, 'month' => $month, 'project' => $project]) }}'">
                                <td class="px-2 py-5">{{ $project->name }}</td>
                                <td class="px-2 py-5">{{ $project->client->company_name }}</td>
                                <td class="px-2 py-5">{{ $project->manager->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
