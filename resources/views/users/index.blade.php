<x-app-layout>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="">
            <div class="p-2 py-5">
                <h1 class="text-center">Employees</h1>
            </div>
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <a href="{{ route('employees.create') }}" type="button" class="btn btn-primary">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                            transform="rotate(-90 11.364 20.364)" fill="black"></rect>
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
                                    </svg>
                                </span>
                                Add Employee
                            </a>
                        </div>

                    </div>
                </div>
                <div class="card-body py-4">
                    <div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                id="kt_table_users">
                                <thead>
                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px sorting" tabindex="0" style="width: 314.844px;">Employe
                                        </th>
                                        <th class="min-w-125px sorting" tabindex="1" style="width: 314.844px;">
                                            Designation</th>
                                        <th class="min-w-125px sorting" tabindex="3" style="width: 314.844px;">Phone
                                        </th>
                                        <th class="min-w-125px sorting" tabindex="4" style="width: 314.844px;">Joining
                                            Date</th>
                                        <th class="min-w-125px sorting" tabindex="5" style="width: 314.844px;">Current
                                            Address</th>
                                        <th class="min-w-125px sorting" tabindex="6" style="width: 314.844px;">Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold">
                                    @foreach ($users as $user)
                                        <tr class="even">
                                            <td class="d-flex align-items-center">
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="{{ route('employees.show', $user) }}">
                                                        @if ($user->profile_image)
                                                            <img src="{{ asset("/public/uploads/{$user->profile_image}") }}"
                                                                style="width: 50px; height: 50px" />
                                                        @else
                                                            <div class="symbol-label fs-3 bg-light-danger text-danger">
                                                                {{ $user->firstChar }} </div>
                                                        @endif

                                                    </a>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <a href="{{ route('employees.show', $user) }}"
                                                        class="text-gray-800 text-hover-primary mb-1">{{ $user->name }}</a>
                                                    <span>{{ $user->email }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $user->designation->name }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->joining_date }}</td>
                                            <td>{{ $user->current_address }}</td>

                                            <td>
                                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                                    data-kt-menu-trigger="click"
                                                    data-kt-menu-placement="bottom-end">Actions
                                                    <span class="svg-icon svg-icon-5 m-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                                fill="black"></path>
                                                        </svg>
                                                    </span>
                                                </a>
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('employees.edit', $user->id) }}"
                                                            class="menu-link px-3">Edit</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <form action="{{ route('employees.delete', $user->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="menu-link px-3 border-0 w-100 bg-transparent"
                                                                data-kt-users-table-filter="delete_row">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
