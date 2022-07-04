<x-app-layout>
    <div class="p-1 pb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4 active">Accounts Manager</li>
            </ol>
        </nav>
    </div>

    <div class="d-flex bg-white p-1 justify-content-end">
        <button class="btn btn-sm btn-primary" id="add_accounts_manager_btn">
            <x-utils.add-icon /> Add New Accounts Manager
        </button>
    </div>

    @include('components.sales-table', ['action' => route('accounts-manager.index')])

    <x-drawer btnId="add_accounts_manager_btn" drawerId="add_accounts_manager_drawer" title="Add Accounts Manager">
        <form action="{{ route('accounts-manager.store') }}" method="post">
            @csrf

            <label class="form-label mt-5 mb-0">Select Employee
                <x-utils.required />
            </label>
            <select class="form-select" name="user_id">
                <option value="0" disabled selected>Select</option>
                @foreach ($data['employees'] as $employee)
                    <option value="{{ $employee->id }}">
                        {{ $employee->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="my-3 btn btn-primary w-100">Submit</button>
        </form>
    </x-drawer>
</x-app-layout>
