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
        <h1 class="text-center">Revenue</h1>
    </div>

    <div class="card mt-3">
        <div class="card-body py-4">
            <h3 class="border-bottom border-dark pb-5 text-center">Revenue of This Year - {{ now()->year }}
            </h3>

            <ul class="list-unstyled">
                @for ($i = now()->month; $i >= 1; $i--)
                    <li class="p-3 bg-gray-300 m-3">
                        <a href="{{ route('revenue.show', [now()->year, $i]) }}"> Revenue
                            Record Month
                            of {{ now()->month($i)->format('F') }} -
                            {{ now()->year }}</a>
                    </li>
                @endfor
            </ul>
        </div>
    </div>
</x-app-layout>
