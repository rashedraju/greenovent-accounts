@props(['startDate', 'endDate', 'credit', 'employees', 'transactionTypes'])
<form action="{{ route('accounts.credits.loan.update', $credit) }}" method="post">
    @csrf
    @method('put')

    <label class="form-label mt-2 mb-0">Date</label>
    <input type="date" pattern="\d{4}-\d{2}-\d{2}" class="form-control" name="date" placeholder="DD-MM-YYYY"
        value="{{ $credit->date }}">

    <label class="form-label mt-2 mb-0">Loan Provider</label>
    <input type="text" class="form-control" name="loan_provider" value="{{ $credit->loan_provider }}">


    <label class="form-label mt-2 mb-0">Amount</label>
    <input type="number" class="form-control" name="amount" value="{{ $credit->amount }}">

    <label class="form-label mt-2 mb-0">Transaction Types</label>
    <select class="form-select" name="transaction_type_id">
        <option value="0" disabled selected>Select</option>
        @foreach ($transactionTypes as $transactionType)
            <option value="{{ $transactionType->id }}"
                {{ $credit->transactionType->id == $transactionType->id ? 'selected' : '' }}>
                {{ $transactionType->name }}</option>
        @endforeach
    </select>

    <button type="submit" class="my-3 btn btn-primary w-100">Save Changes</button>
</form>
