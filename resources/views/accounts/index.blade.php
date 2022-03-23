<x-app-layout>
    <div class="p-2 py-5">
        <h1 class="text-center">Accounts</h1>
    </div>
    <x-accounts-navigation />
    <div class="card mt-3">
        <div class="card-body py-4">
            <div class="row">
                <div class="col-12">
                    <ul class="list-unstyled">
                        <li class="p-3 bg-gray-300 m-3">
                            <a href="{{ route('accounts.finances.show', [now()->year]) }}"> Finance
                                Records Year of {{ now()->year }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
