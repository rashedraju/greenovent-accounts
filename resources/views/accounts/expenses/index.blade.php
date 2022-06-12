<x-app-layout>
    <div class="p-1 mt-sm-1 mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4 active"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                <li class="breadcrumb-item fs-4 active"><a
                        href="{{ route('accounts.show.year', $data['year']) }}">{{ $data['year'] }}</a></li>
                <li class="breadcrumb-item fs-4"><a
                        href="{{ route('accounts.show.year.month', ['year' => $data['year'], 'month' => $data['year']]) }}">{{ now()->month($data['month'])->format('F') }}</a>
                </li>
                <li class="breadcrumb-item fs-4">Expenses</li>
            </ol>
        </nav>
    </div>

    <x-accounts-navigation :year="$data['year']" :month="$data['month']" />

    <div class="card mt-3">
        <div class="row">
            <div class="col-12 col-sm-3">
                <div class="row style=" style="margin-left: 0">
                    <div class="col-2 px-2 py-5 border border-secondary flex-grow-1 fs-2">Descriptoin</div>
                    <div class="col-1 px-2 py-5 border border-secondary flex-grow-1 fs-2">Amount</div>
                </div>
                @foreach ($data['expenseTypes'] as $expenseType)
                    <a href="{{ route('accounts.expenses.show', ['year' => $data['year'], 'month' => $data['month'], 'accountsExpenseType' => $expenseType->id]) }}"
                        class="row bg-hover-secondary" style="margin-left: 0">
                        <div class="col-2 px-2 py-5 border border-secondary flex-grow-1">{{ $expenseType->name }}
                        </div>
                        <div class="col-1 px-2 py-5 border border-secondary flex-grow-1">
                            {{ number_format($expenseType->expenses->sum(fn($item) => $item->amount)) }}</div>
                    </a>
                @endforeach
                <div class="row style=" style="margin-left: 0">
                    <div class="col-2 px-2 py-5 border border-secondary flex-grow-1 fs-2">Total Expense</div>
                    <div class="col-1 px-2 py-5 border border-secondary flex-grow-1 fs-2">
                        {{ number_format($data['totalExpense']) }}</div>
                </div>
            </div>
            <div class="col-12 col-sm-9">

            </div>
        </div>
    </div>
</x-app-layout>
