<x-app-layout>
    <div class="p-1 mt-sm-1 mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4 active"><a href="{{ route('accounts-manager.index') }}">Accounts
                        Manager</a></li>
                <li class="breadcrumb-item fs-4">{{ $data['accountsManager']->name }}</li>
            </ol>
        </nav>
    </div>

    <div class="card mt-3">
        <div class="card-body py-4">
            <div class="d-flex flex-wrap gap-3">
                <div class="bg-light p-5 border border-gray-300 flex-grow-1">
                    <p class="text-gray-700">Sales Goal this month</p>
                    <h1 class="text-black">
                        <x-utils.currency />{{ number_format($data['accountsManager']->sales_goal) }}
                    </h1>
                </div>

                <div class="bg-light p-5 border border-gray-300 flex-grow-1">
                    <p class="text-gray-700">Sales this month</p>
                    <h1 class="text-black">
                        <x-utils.currency />{{ number_format(0) }}
                    </h1>
                </div>
            </div>

        </div>
    </div>

    <div class="card mt-3 py-10">
        <div class="row">
            <h3 class="text-center mb-5">Clients</h3>
            <div class="col-12 col-sm-6 mx-auto">
                @foreach ($data['clients'] as $client)
                    <a href="{{ route('accounts-manager.client', ['user' => $data['accountsManager']->id, 'client' => $client->id]) }}"
                        class="row bg-hover-secondary" style="margin-left: 0; margin-right: 0">
                        <div class="col-2 px-2 py-5 border border-secondary flex-grow-1">{{ $client->company_name }}
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
