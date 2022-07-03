<x-app-layout>
    <style>
        table th,
        table td {
            white-space: nowrap;
        }
    </style>
    <div class="p-1 mt-sm-1 mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4 active"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                <li class="breadcrumb-item fs-4 active"><a
                        href="{{ route('accounts.show.year', $data['year']) }}">{{ $data['year'] }}</a></li>
                <li class="breadcrumb-item fs-4"><a
                        href="{{ route('accounts.show.year.month', ['year' => $data['year'], 'month' => $data['year']]) }}">{{ now()->month($data['month'])->format('F') }}</a>
                </li>
                <li class="breadcrumb-item fs-4">Sales</li>
            </ol>
        </nav>
    </div>

    <x-accounts-navigation :year="$data['year']" :month="$data['month']" />

    @include('components.sales-table')
</x-app-layout>
