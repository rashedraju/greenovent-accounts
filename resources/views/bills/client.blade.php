<x-app-layout>
    <h1 class="text-center">Bills</h1>
    <div class="card">
        <div class="card-body">
            <h2 class="my-5 text-center">{{ $client->company_name }}</h2>
            <div class="table-responsive">
                <table class="table table-secondary table-striped table-hover">
                    <thead>
                        <tr class="fw-bolder fs-6">
                            <th class="px-2 py-5">Bill No.</th>
                            <th class="px-2 py-5">Porject Name</th>
                            <th class="px-2 py-5">Client Name</th>
                            <th class="px-2 py-5">Subject</th>
                            <th class="px-2 py-5">Bill Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bills as $bill)
                            <tr class="fw-bold cursor-pointer"
                                onClick="window.location='{{ route('bills.show', [$client, $bill]) }}'">
                                <td class="px-2 py-5">{{ $bill->bill_no }}</td>
                                <td class="px-2 py-5">{{ $bill->project->name }}</td>
                                <td class="px-2 py-5">{{ $bill->project->client->company_name }}</td>
                                <td class="px-2 py-5">{{ $bill->subject }}</td>
                                <td class="px-2 py-5">
                                    <span class="badge badge-primary">{{ $bill->status->name }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
