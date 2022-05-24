<x-app-layout>
    <div class="p-2 py-5">
        <h1 class="text-center">Accounts</h1>
    </div>

    <x-accounts-navigation />

    <div class="card mt-3">
        <div class="card-body py-4">
            <h3 class="border-bottom border-dark pb-5 text-center">Bills</h3>

            <ul class="list-unstyled">
                @foreach ($clients as $client)
                    <li class="p-3 bg-gray-300 m-3">
                        <a href="{{ route('accounts.bills.show', $client) }}"> Bills of
                            {{ $client->company_name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
