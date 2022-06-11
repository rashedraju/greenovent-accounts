<x-app-layout>
    <div class="p-1 mt-sm-1 mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4" aria-current="page">Accounts</li>
            </ol>
        </nav>
    </div>
    <div class="card mt-3">
        <div class="card-body py-4">
            <ul class="list-unstyled">
                @for ($i = now()->year; $i >= 2022; $i--)
                    <li class="p-5 bg-gray-300 m-3">
                        <a href="{{ route('accounts.show.year', $i) }}" class="w-100 d-block"> Year -
                            {{ $i }}</a>
                    </li>
                @endfor
            </ul>
        </div>
    </div>
</x-app-layout>
