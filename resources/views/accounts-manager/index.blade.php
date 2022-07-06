<x-app-layout>
    <div class="p-1 pb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4 active">Accounts Manager</li>
            </ol>
        </nav>
    </div>

    <div class="card mt-3 py-10">
        <div class="row">
            <div class="d-flex justify-content-between">
                <h3 class="text-center mb-5 flex-grow-1">Accounts Manager</h3>
                <button class="btn btn-sm btn-primary mx-2" id="add_accounts_manager_btn">
                    <x-utils.add-icon /> Add New Accounts Manager
                </button>
            </div>

            <x-validation-error />

            <div class="col-12 col-sm-6 mx-auto">
                @foreach ($data['accountsManagers'] as $accountsManagerId => $accountsManagerName)
                    <div class="d-flex justify-content-between align-item-center my-2 border border-secondary ">
                        <a href="{{ route('accounts-manager.show', ['user' => $accountsManagerId, 'accounts_manager' => $accountsManagerId]) }}"
                            class="bg-hover-secondary align-self-center flex-grow-1 p-3"
                            style="margin-left: 0; margin-right: 0">
                            {{ $accountsManagerName }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
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
