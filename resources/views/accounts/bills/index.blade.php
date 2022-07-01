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
                <li class="breadcrumb-item fs-4">Bills</li>
            </ol>
        </nav>
    </div>

    <x-accounts-navigation :year="$year" :month="$month" />

    <div class="card mt-3">
        <div class="card-body py-4">
            <h3 class="border-bottom border-dark pb-5 text-center">Bills</h3>

            <ul class="list-unstyled">
                @foreach ($clients as $client)
                    <li class="p-3 bg-gray-300 m-3">
                        <a
                            href="{{ route('accounts.bills.show', ['year' => $year, 'month' => $month, 'client' => $client]) }}">
                            {{ $client->company_name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
