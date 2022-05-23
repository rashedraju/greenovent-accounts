@props(['startDate', 'endDate', 'expense', 'employees', 'transactionTypes'])
<form action="{{ route('accounts.expenses.loan.update', $expense) }}" method="post">
    @csrf
    @method('put')

    <label class="form-label mt-2 mb-0">Date</label>
    <input type="date" pattern="\d{4}-\d{2}-\d{2}" class="form-control" name="date" placeholder="DD-MM-YYYY"
        value="{{ $expense->date }}">

    <label class="form-label mt-2 mb-0">Received by</label>
    <input type="text" class="form-control" name="received_person" value="{{ $expense->received_person }}">


    <label class="form-label mt-2 mb-0">Amount</label>
    <input type="number" class="form-control" name="amount" value="{{ $expense->amount }}">

    <label class="form-label mt-2 mb-0">Transaction Types</label>
    <select class="form-select" name="transaction_type_id">
        <option value="0" disabled selected>Select</option>
        @foreach ($transactionTypes as $transactionType)
            <option value="{{ $transactionType->id }}"
                {{ $expense->transactionType->id == $transactionType->id ? 'selected' : '' }}>
                {{ $transactionType->name }}</option>
        @endforeach
    </select>

    <button type="submit" class="my-3 btn btn-primary w-100">Save Changes</button>
</form>
