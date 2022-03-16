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
                        {{ ucfirst($permission->name) }}
                        <x-utils.down-arrow />
                    </button>
                    <div class="collapse" id="collapseExample{{ $loop->iteration }}">
                        <div class="card card-body">
                            <form action="{{ route('permissions.update', $permission) }}" method="post">
                                @csrf
                                @method('put')
                                @foreach ($roles as $role)
                                    <div class="form-check form-switch py-2">
                                        <input type="checkbox" name="{{ $role->name }}"
                                            id="{{ $role->name . $loop->iteration }}"
                                            {{ $role->hasPermissionTo($permission) ? 'checked' : '' }}
                                            class="form-check-input" />

                                        <label class="form-check-label" for="{{ $role->name . $loop->iteration }}">
                                            {{ $role->name }}</label>

                                    </div>
                                @endforeach

                                <button type="submit" class="btn btn-sm btn-primary mt-5">Save Permissions</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
