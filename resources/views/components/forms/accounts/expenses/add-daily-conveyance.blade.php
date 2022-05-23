@props(['startDate', 'endDate', 'heads', 'employees', 'transactionTypes'])
<form action="{{ route('accounts.expenses.daily-conveyance.store') }}" method="post">
    @csrf

    <label class="form-label mt-2 mb-0">Date</label>
    <input type="date" min="{{ $startDate }}" max="{{ $endDate }}" class="form-control" name="date" placeholder="DD-MM-YYYY">

    <label class="form-label mt-2 mb-0">Head</label>
    <input type="text" class="form-control" name="head" list="heads">
    <datalist id="heads">
        @foreach ($heads as $head)
            <option value="{{ $head }}">
        @endforeach
    </datalist>

    <label class="form-label mt-2 mb-0">Description</label>
    <input type="text" class="form-control" name="description">

    <label class="form-label mt-2 mb-0">Received by</label>
    <select class="form-select" name="user_id">
        <option value="0" disabled selected>Select</option>
        @foreach ($employees as $employee)
            <option value="{{ $employee->id }}">
                {{ $employee->name }}</option>
        @endforeach
    </select>

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
