@extends('accounts.expenses.layout')
@section('content')
    <div class="col-12 col-sm-9">
        <h2 class="py-5 pr-5">Show expenses by day</h2>
        <div class="dropdown my-3">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Select Day
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="height: 20rem; overflow:scroll">
                @php
                    $daysInMonth = now()
                        ->year($data['year'])
                        ->month($data['month'])->daysInMonth;
                @endphp
                @for ($i = 1; $i <= $daysInMonth; $i++)
                    <a class="dropdown-item"
                        href="{{ route('accounts.expenses.index', ['year' => $data['year'], 'month' => $data['month'], 'day' => $i]) }}">{{ $i }}</a>
                @endfor
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-secondary table-striped">
                <thead>
                    <tr class="fw-bolder fs-6">
                        <th class="px-2 py-5">SL</th>
                        <th class="px-2 py-5">Date</th>
                        <th class="px-2 py-5">Category</th>
                        <th class="px-2 py-5">Item</th>
                        <th class="px-2 py-5">Description</th>
                        <th class="px-2 py-5">Amount</th>
                        <th class="px-2 py-5">Transaction Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['expensesByDay'] as $expense)
                        <tr class="fw-bold">
                            <td class="px-2 py-5">{{ $loop->iteration }}</td>
                            <td class="px-2 py-5">{{ date('d-m-Y', strtotime($expense->date)) }}</a>
                            </td>
                            <td class="px-2 py-5">{{ $expense->type->name }}</a> </td>
                            <td class="px-2 py-5">{{ $expense->item }}</a> </td>
                            <td class="px-2 py-5">{{ $expense->description }}</a> </td>
                            <td class="px-2 py-5">{{ number_format($expense->amount) }}</a> </td>
                            <td class="px-2 py-5">{{ $expense->transactionType->name }}</a> </td>
                        </tr>
                    @endforeach
                    <tr class="fw-bold border border-secondary">
                        <td class="px-2 py-5 fs-2" colspan="4">Total Amount</td>
                        <td class="px-2 py-5 fs-2" colspan="6">
                            {{ number_format($data['expensesByDayAmount'], 2, '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
