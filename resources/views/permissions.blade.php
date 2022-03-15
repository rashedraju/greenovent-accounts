<x-app-layout>
    <div class="p-2 py-5">
        <h1 class="text-center">Access Permissions</h1>
    </div>
    <div class="card">
        <div class="card-body py-4">
            <div class="my-2 border border-y">
                @foreach ($permissions as $permission)
                    <button class="btn btn-light w-100 text-start" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseExample{{ $loop->iteration }}" aria-expanded="false"
                        aria-controls="collapseExample" style="border-radius: 0!important">
                        {{ ucfirst($permission) }}
                        <x-utils.down-arrow />
                    </button>
                    <div class="collapse" id="collapseExample{{ $loop->iteration }}">
                        <div class="card card-body">
                            <ul>
                                @foreach ($rules as $rule)
                                    <li> {{ $rule }} </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
