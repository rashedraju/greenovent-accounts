<x-app-layout>
    <div class="p-2 py-5">
        <h1 class="text-center">Accounts</h1>
    </div>

    <x-accounts-navigation />

    <div class="card mt-3">
        <div class="card-body py-4">
            <h3 class="border-bottom border-dark pb-5 text-center">Expense Records</h3>

            <ul class="list-unstyled">
                @for ($i = now()->year; $i >= 2021; $i--)
                    <li class="p-3 bg-gray-300 m-3">
                        <a href="{{ route('accounts.expenses.show.year', $i) }}"> Expense
                            Record Year
                            of {{ $i }}</a>
                    </li>
                @endfor
            </ul>
        </div>
    </div>
</x-app-layout>
