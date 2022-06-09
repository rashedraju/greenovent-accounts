<x-app-layout>
    <div class="p-1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4 active"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                <li class="breadcrumb-item fs-4 active"><a
                        href="{{ route('accounts.show.year', $data['year']) }}">{{ $data['year'] }}</a></li>
                <li class="breadcrumb-item fs-4">{{ now()->month($data['month'])->format('F') }}</li>
            </ol>
        </nav>
    </div>
    <div class="card mt-3">
        <div class="card-body py-4">
            <h3 class="pb-5 text-center">
                {{ now()->month($data['month'])->format('F') }} - {{ $data['year'] }}
            </h3>

            <x-accounts-navigation :year="$data['year']" :month="$data['month']" />
        </div>
    </div>
</x-app-layout>
