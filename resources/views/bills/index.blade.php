<x-app-layout>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-secondary table-striped table-hover">
                    <thead>
                        <tr class="fw-bolder fs-6">
                            <th class="px-2 py-5">Bill No.</th>
                            <th class="px-2 py-5">Porject Name</th>
                            <th class="px-2 py-5">Client Name</th>
                            <th class="px-2 py-5">Subject</th>
                            <th class="px-2 py-5">Bill Status</th>
                            <th class="px-2 py-5">Total
                                (
                                <x-utils.currency />)
                            </th>
                            <th class="px-2 py-5">asf(%)</th>
                            <th class="px-2 py-5">vat(%)</th>
                            <th class="px-2 py-5">
                                Grand Total(
                                <x-utils.currency />)
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bills as $bill)
                            <tr class="fw-bold cursor-pointer"
                                onClick="window.location='{{ route('bills.show', $bill) }}'">
                                <td class="px-2 py-5">{{ $bill->bill_no }}</td>
                                <td class="px-2 py-5">{{ $bill->project->client->company_name }}</td>
                                <td class="px-2 py-5">{{ $bill->project->name }}</td>
                                <td class="px-2 py-5">{{ $bill->subject }}</td>
                                <td class="px-2 py-5">
                                    <span class="badge badge-primary">{{ $bill->status->name }}</span>
                                </td>
                                <td class="px-2 py-5">{{ number_format($bill->total) }}</td>
                                <td class="px-2 py-5">{{ $bill->asf }}</td>
                                <td class="px-2 py-5">{{ $bill->vat }}</td>
                                <td class="px-2 py-5">{{ $bill->grandTotal() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $bills->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
