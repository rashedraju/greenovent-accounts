<x-app-layout>
    <style>
        table {
            border-collapse: collapse;
        }

        tr:nth-child(3) {
            border: solid thin;
        }

    </style>
    <div class="p-2 py-5">
        <h1 class="text-center">Accounts</h1>
    </div>

    <x-accounts-navigation />

    <div class="card mt-3">
        <div class="card-body py-4">
            <h3 class="border-bottom border-dark pb-5 text-center">Credit Records of This Year - {{ now()->year }}
            </h3>

            <div class="d-flex px-3 py-5">
                <div class="bg-primary p-5 record_card" style="min-width: 132px; border-radius: 2rem 0 0 0">
                    <p class="text-white">Total</p>
                    <h1 class="text-white">
                        <x-utils.currency />{{ number_format($totalCreditOfByYear) }}
                    </h1>
                </div>
                @foreach ($creditCategories as $creditCategory)
                    <div class="bg-light p-5 text-white border border-gray-300" style="min-width: 132px">
                        <p class="text-gray-700">{{ $creditCategory->name }}</p>
                        <h1 class="text-gray-700">
                            @php
                                $sumValue = $creditCategory->credits->sum(fn($credit) => $credit->amount);
                            @endphp
                            <x-utils.currency />{{ number_format($sumValue) }}
                        </h1>
                    </div>
                @endforeach
            </div>

            <ul class="list-unstyled">
                @for ($i = now()->month; $i >= 1; $i--)
                    <li class="p-3 bg-gray-300 m-3">
                        <a href="{{ route('accounts.credits.show', [now()->year, $i]) }}"> Credit
                            Record Month
                            of {{ now()->month($i)->format('F') }} -
                            {{ now()->year }}</a>
                    </li>
                @endfor
            </ul>
        </div>
    </div>
</x-app-layout>
