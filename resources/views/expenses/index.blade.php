<x-app-layout>
    <style>
        table {
            border-collapse: collapse;
        }

        tr:nth-child(3) {
            border: solid thin;
        }

    </style>

    <div class="card mt-3">
        <div class="card-body py-4">
            <h3 class="border-bottom border-dark pb-5 text-center">Expense Records of This Year - {{ $data['year'] }}
            </h3>
            <div class="d-flex overflow-scroll px-3 py-5">
                <div class="bg-primary p-5 record_card" style="border-radius: 2rem 0 0 0">
                    <p class="text-white">Total</p>
                    <h1 class="text-white">
                        <x-utils.currency />{{ number_format($data['total']) }}
                    </h1>
                </div>
                @foreach ($data['expenses'] as $expensesByType)
                    <div class="bg-light p-5 text-white border border-gray-300">
                        <p class="text-gray-700">{{ $expensesByType['name'] }}</p>
                        <h1 class="text-gray-700">
                            <x-utils.currency />{{ $expensesByType['amount'] }}
                        </h1>
                    </div>
                @endforeach

            </div>

            <ul class="list-unstyled">
                @for ($i = 1; $i <= now()->month; $i++  )
                    <li class="p-3 bg-gray-300 m-3">
                        <a href="{{ route('expenses.show', [$data['year'], $i]) }}"> Expense
                            Record Month
                            of {{ now()->month($i)->format('F') }} -
                            {{ $data['year'] }}</a>
                    </li>
                @endfor
            </ul>
        </div>
    </div>
</x-app-layout>
