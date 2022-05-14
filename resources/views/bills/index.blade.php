<x-app-layout>
    <h1 class="text-center">Bills</h1>
    <div class="card">
        <div class="card-body">
            <h2 class="my-5 text-center">Clients</h2>
            <ul class="list-unstyled">
                @foreach ($clients as $client)
                    <li class="p-3 bg-gray-300 m-3">
                        <a href="{{ route('bills.client', $client) }}"> {{ $client->company_name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
