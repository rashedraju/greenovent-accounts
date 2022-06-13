<x-app-layout>
    <div class="p-1 mt-sm-1 mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4 active">Accounts Manager</li>
            </ol>
        </nav>
    </div>

    <div class="card mt-3 py-10">
        <div class="d-flex justify-content-between">
            <h3 class="text-center mb-5 flex-grow-1">Accounts Manager</h3>
            <button class="btn btn-sm btn-primary mx-2" id="add_accounts_manager_btn">
                <x-utils.add-icon /> Add New Accounts Manager
            </button>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 mx-auto">
                @foreach ($data['accountsManagers'] as $accountsManager)
                    <a href="{{ route('accounts-manager.show', $accountsManager->id) }}" class="row bg-hover-secondary"
                        style="margin-left: 0">
                        <div class="col-2 px-2 py-5 border border-secondary flex-grow-1">{{ $accountsManager->name }}
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

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
