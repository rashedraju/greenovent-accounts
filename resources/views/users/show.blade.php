<x-app-layout>
    <div class="p-2 py-5">
        <h1 class="text-center">Employees Profile</h1>
    </div>
    <div class="row">
        <div class="col-12 col-md-3">
            <div class="card my-3">
                <div class="card-body">
                    <div class="d-flex gap-3 align-items-center justify-content-between">
                        <h3 class="mb-0">Employee Details</h3>
                        <a href="{{ route('employees.edit', $user) }}" class="btn btn-success btn-sm">Edit</a>
                    </div>
                    <div class="border p-3 mt-5">
                        <img src="{{ asset("/public/uploads/{$user->profile_image}") }}" alt="" srcset=""
                            style="width: 200px; height: 200px;">
                        <div class="py-3">Name: <br/><strong>{{ $user->name }} </strong></div>
                        <div class="py-3">Designation: <strong>{{ $user->designation->name }}</strong></div>
                        <div class="py-3">Email: <strong>{{ $user->email }}</strong></div>
                        <div class="py-3">Phone: <strong>{{ $user->phone }}</strong></div>
                        <div class="py-3">Joining Date: <strong>{{ $user->joining_date }}</strong></div>
                        <div class="py-3">Current Address: <strong>{{ $user->current_address }}</strong>
                        </div>
                        <div class="py-3">Permanent Address: <strong>{{ $user->permanent_address }}</strong>
                        </div>
                        <div class="py-3">Emergency Contact Name:
                            <strong>{{ $user->emergency_contact_name }}</strong>
                        </div>
                        <div class="py-3">Emergency Contact Phone:
                            <strong>{{ $user->emergency_contact_no }}</strong>
                        </div>
                        <div class="py-3">Emergency Contact Relation:
                            <strong>{{ $user->emergency_contact_relation }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-9">
            <div class="card my-3">
                <div class="card-body">
                    <div class="d-flex gap-3 align-items-center justify-content-between">
                        <h3 class="mb-0">Sales Statistics</h3>
                    </div>

                    <div class="p-3 mt-5 d-flex gap-2">
                        <div class="border p-3 m-3">
                            <h1 class="text-center">{{ $user->completedProjects()->count() }}</h1>
                            <h5 class="text-center">Completed Projects</h5>
                            <hr>
                            <ul>
                                @foreach ($user->completedProjects() as $project)
                                    <li>
                                        <a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="border p-3 m-3">
                            <h1 class="text-center">{{ $user->inProgressProjects()->count() }}</h1>
                            <h5 class="text-center"> In Progress Projects</h5>
                            <hr>
                            <ul>
                                @foreach ($user->inProgressProjects() as $project)
                                    <li>
                                        <a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="border p-3 m-3">
                            <h1 class="text-center">{{ $user->pendingProjects()->count() }}</h1>
                            <h5 class="text-center">Pending Projects</h5>
                            <hr>
                            <ul>
                                @foreach ($user->pendingProjects() as $project)
                                    <li>
                                        <a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="border p-3 mt-5">
                        <div class="table-responsive">
                            <table class="table table-striped gy-7 gs-7">
                                <thead>
                                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Client</th>
                                        <th>Type</th>
                                        <th>PO Number</th>
                                        <th>PO Value</th>
                                        <th>Start Date</th>
                                        <th>Closing Date</th>
                                        <th>Advance Paid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->projects as $project)
                                        <tr>
                                            <td> <a href="{{ route('projects.show', $project) }}">
                                                    {{ $project->name }} </a></td>
                                            <td> <span
                                                    class="badge badge-primary">{{ $project->status->name }}</span>
                                            </td>
                                            <td><a
                                                    href="{{ route('clients', $project->client) }}">{{ $project->client->company_name }}</a>
                                            </td>
                                            <td>{{ $project->type->name }}</td>
                                            <td>{{ $project->po_number }}</td>
                                            <td>{{ number_format($project->po_value) }}</td>
                                            <td>{{ $project->start_date }}</td>
                                            <td>{{ $project->closing_date }}</td>
                                            <td>{{ $project->advance_paid }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card my-3">
                <div class="card-body">
                    <div class="d-flex gap-3 align-items-center justify-content-between">
                        <h3 class="mb-0">Contributing Projects <span
                                class="text-primary">({{ $user->projects->count() }})</span></h3>
                    </div>

                    <div class="p-3 mt-5 d-flex gap-2">
                        <div class="border p-3 m-3">
                            <h1 class="text-center">{{ $user->completedProjects()->count() }}</h1>
                            <h5 class="text-center">Completed Projects</h5>
                            <hr>
                            <ul>
                                @foreach ($user->completedProjects() as $project)
                                    <li>
                                        <a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="border p-3 m-3">
                            <h1 class="text-center">{{ $user->inProgressProjects()->count() }}</h1>
                            <h5 class="text-center"> In Progress Projects</h5>
                            <hr>
                            <ul>
                                @foreach ($user->inProgressProjects() as $project)
                                    <li>
                                        <a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="border p-3 m-3">
                            <h1 class="text-center">{{ $user->pendingProjects()->count() }}</h1>
                            <h5 class="text-center">Pending Projects</h5>
                            <hr>
                            <ul>
                                @foreach ($user->pendingProjects() as $project)
                                    <li>
                                        <a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="border p-3 mt-5">
                        <div class="table-responsive">
                            <table class="table table-striped gy-7 gs-7">
                                <thead>
                                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Client</th>
                                        <th>Type</th>
                                        <th>PO Number</th>
                                        <th>PO Value</th>
                                        <th>Start Date</th>
                                        <th>Closing Date</th>
                                        <th>Advance Paid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->projects as $project)
                                        <tr>
                                            <td> <a href="{{ route('projects.show', $project) }}">
                                                    {{ $project->name }} </a></td>
                                            <td> <span
                                                    class="badge badge-primary">{{ $project->status->name }}</span>
                                            </td>
                                            <td><a
                                                    href="{{ route('clients', $project->client) }}">{{ $project->client->company_name }}</a>
                                            </td>
                                            <td>{{ $project->type->name }}</td>
                                            <td>{{ $project->po_number }}</td>
                                            <td>{{ number_format($project->po_value) }}</td>
                                            <td>{{ $project->start_date }}</td>
                                            <td>{{ $project->closing_date }}</td>
                                            <td>{{ $project->advance_paid }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
