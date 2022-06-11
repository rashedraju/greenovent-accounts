<x-app-layout>
    <div class="p-1 mt-sm-1 mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fs-4 active">Accounts Manager</li>
            </ol>
        </nav>
    </div>

    <div class="card mt-3 py-10">
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
</x-app-layout>
