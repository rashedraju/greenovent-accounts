<x-app-layout>
    <div class="p-1 mt-sm-1 mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4 active"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                <li class="breadcrumb-item fs-4 active"><a
                        href="{{ route('accounts.show.year', $data['year']) }}">{{ $data['year'] }}</a></li>
                <li class="breadcrumb-item fs-4">{{ now()->month($data['month'])->format('F') }}</li>
            </ol>
        </nav>
    </div>

    <x-accounts-navigation :year="$data['year']" :month="$data['month']" />

    <div class="card mt-3">
        <div class="card-body py-4">
            <div class="d-flex flex-wrap gap-3">
                <div class="bg-light p-2 border border-gray-300 flex-grow-1">
                    <p class="text-gray-700">Sales</p>
                    <h1 class="text-black">
                        <x-utils.currency />{{ number_format($data['sales']) }}
                    </h1>
                </div>

                <div class="bg-light p-2 border border-gray-300 flex-grow-1">
                    <p class="text-gray-700">Expense</p>
                    <h1 class="text-black">
                        <x-utils.currency />{{ number_format($data['expense']) }}
                    </h1>
                </div>
                <div class="bg-light p-2 border border-gray-300 flex-grow-1">
                    <p class="text-gray-700">Net Profit</p>
                    <h1 class="text-black">
                        <x-utils.currency />{{ number_format($data['net_profit']) }}
                    </h1>
                </div>

                <div class="bg-light p-2 border border-gray-300 flex-grow-1">
                    <p class="text-gray-700">Bank</p>
                    <h1 class="text-black">
                        <x-utils.currency />{{ number_format($data['bank_amount']) }}
                    </h1>
                </div>

                <div class="bg-light p-2 border border-gray-300 flex-grow-1">
                    <p class="text-gray-700">Cash</p>
                    <h1 class="text-black">
                        <x-utils.currency />{{ number_format($data['cash_amount']) }}
                    </h1>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
