@props(['startDate', 'endDate', 'employees', 'transactionTypes'])
<form action="{{ route('accounts.expenses.investment.store') }}" method="post">
    @csrf

    <label class="form-label mt-2 mb-0">Date</label>
    <input type="date" min="{{ $startDate }}" max="{{ $endDate }}" class="form-control" name="date"
        placeholder="DD-MM-YYYY">

    <label class="form-label mt-2 mb-0">Received by</label>
    <input type="text" class="form-control" name="received_person">

    <label class="form-label mt-2 mb-0">Company Name</label>
    <input type="text" class="form-control" name="company_name">

    <label class="form-label mt-2 mb-0">Amount</label>
    <input type="number" class="form-control" name="amount">

    <label class="form-label mt-2 mb-0">Transaction Types</label>
    <select class="form-select" name="transaction_type_id">
        <option value="0" disabled selected>Select</option>
        @foreach ($transactionTypes as $transactionType)
            <option value="{{ $transactionType->id }}">
                {{ $transactionType->name }}</option>
        @endforeach
    </select>

    <button type="submit" class="my-3 btn btn-primary w-100">Submit</button>
</form>
