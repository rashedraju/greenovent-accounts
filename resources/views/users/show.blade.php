<x-app-layout>
    <div class="p-2 py-5">
        <h1 class="text-center">Employee Profile</h1>
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
                        <div class="py-3">Name: <br /><strong>{{ $user->name }} </strong></div>
                        <div class="py-3">Designation:<br /> <strong>{{ $user->designation() }}</strong>
                        </div>
                        <div class="py-3">Email:<br /> <strong>{{ $user->email }}</strong></div>
                        <div class="py-3">Phone: <br /><strong>{{ $user->phone }}</strong></div>
                        <div class="py-3">Joining Date: <br /><strong>{{ $user->joining_date }}</strong>
                        </div>
                        <div class="py-3">Current Address:
                            <br /><strong>{{ $user->current_address }}</strong>
                        </div>
                        <div class="py-3">Permanent Address:<br />
                            <strong>{{ $user->permanent_address }}</strong>
                        </div>
                        <div class="py-3">Emergency Contact Name:<br />
                            <strong>{{ $user->emergency_contact_name }}</strong>
                        </div>
                        <div class="py-3">Emergency Contact Phone:<br />
                            <strong>{{ $user->emergency_contact_no }}</strong>
                        </div>
                        <div class="py-3">Emergency Contact Relation:<br />
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
                        <h3 class="mb-0">Project Finance</h3>
                    </div>
                    <div class="border p-3 mt-5">
                        <div class="table-responsive">
                            <table class="table table-striped gy-7 gs-7">
                                <thead>
                                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>PO Number</th>
                                        <th>PO Value</th>
                                        <th>Advance Paid</th>
                                        <th>Revenue</th>
                                        <th>Net Profit</th>
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
                                            <td>{{ $project->po_number }}</td>
                                            <td>{{ number_format($project->po_value) }}</td>
                                            <td>{{ $project->advance_paid }}</td>
                                            <td> <span class="bg-danger text-white py-2 px-3 rounded">
                                                    <x-utils.currency />
                                                    {{ number_format($project->totalExternals()) }}
                                                </span></td>
                                            <td><span class="bg-success text-white py-2 px-3 rounded">
                                                    <x-utils.currency /> {{ number_format($project->profit()) }}
                                                </span>
                                            </td>
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
                        <h3 class="mb-0">In Progress Projects <span
                                class="text-primary">({{ $user->inProgressProjects()->count() }})</span></h3>
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
                                    @foreach ($user->inProgressProjects() as $project)
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
                        <h3 class="mb-0">Completed Projects <span
                                class="text-primary">({{ $user->completedProjects()->count() }})</span></h3>
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
                                    @foreach ($user->completedProjects() as $project)
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
                        <h3 class="mb-0">Pending Projects<span
                                class="text-primary">({{ $user->pendingProjects()->count() }})</span></h3>
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
                                    @foreach ($user->pendingProjects() as $project)
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
                        <h3 class="mb-0">Work Calender</h3>
                    </div>
                    <div class="border p-3 mt-5">
                        <div id="employee_work_calender"></div>
                    </div>
                </div>
            </div>
            <div class="card my-3">
                <div class="card-body">
                    <div class="d-flex gap-3 align-items-center justify-content-between">
                        <h3 class="mb-0">Office Attendance</h3>
                    </div>
                    <div class="border p-3 mt-5">
                        <div class="table-responsive">
                            <table class="table table-striped gy-7 gs-7">
                                <thead>
                                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                        <th>Date</th>
                                        <th>Day</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                        <th>Total Hour</th>
                                        <th> Status </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>12-03-2022</td>
                                        <td>Saturday</td>
                                        <td>10:05 AM</td>
                                        <td>8:05 PM</td>
                                        <td>10 Hours And 0 Minutes</td>
                                        <td><span class="badge badge-success">Present</span></td>
                                    </tr>
                                    <tr>
                                        <td>13-03-2022</td>
                                        <td>Sunday</td>
                                        <td>10:15 AM</td>
                                        <td>8:00 PM</td>
                                        <td>09 Hours And 45 Minutes</td>
                                        <td><span class="badge badge-success">Present</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card my-3">
                <div class="card-body">
                    <div class="d-flex gap-3 align-items-between justify-content-between">
                        <h3 class="mb-0">Performances</h3>
                        <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                            data-bs-target="#add_performance_modal">Add performance</button>
                    </div>
                    <div class="border p-3 mt-5">
                        @foreach ($user->performancesByGroup() as $month => $monthlyPerformances)
                            <h5 class="text-center py-2 bg-light">
                                {{ $month }}
                            </h5>
                            <table class="table">
                                <thead>
                                    <tr class="fw-bold fs-6 text-gray-800 ">
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($monthlyPerformances as $performance)
                                        <tr class="border-bottom">
                                            <td> {{ ucfirst($performance->performanceName->name) }}</td>
                                            <td>{{ $performance->performanceStatus->name }} </td>
                                            <td>{{ $performance->performanceStatus->value }} </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @php
                                $avgScore = $monthlyPerformances->average(fn($p) => $p->performanceStatus->value);
                            @endphp
                            <div><strong> Average Score:
                                    {{ number_format((float) $avgScore, 2, '.', '') }}</strong>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" tabindex="-1" id="add_performance_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Performance</h5>
                </div>

                <div class="modal-body">
                    <form action="{{ route('employees.performances.store', $user) }}" method="post">
                        @csrf
                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">Month</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" name="created_at"
                                autocomplete="off" value="{{ old('created_at') }}"
                                id="employee_performance_datepicker" placeholder="Select Month" />
                        </div>

                        @php
                            $performancesNames = \App\Models\EmployeePerformanceName::all();
                            $performancesStatuses = \App\Models\EmployeePerformanceStatus::all();
                        @endphp
                        @foreach ($performancesNames as $performancesName)
                            <div class="fv-row mb-10">
                                <label
                                    class="form-label fs-6 fw-bolder text-dark">{{ $performancesName->name }}</label>

                                <select name="performances[{{ $performancesName->id }}]"
                                    class="form-select form-select-solid">
                                    <option value="0" selected disabled hidden></option>
                                    @foreach ($performancesStatuses as $status)
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Performance</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <x-slot name="script">
        <script>
            var element = document.getElementById("employee_work_calender");

            var todayDate = moment().startOf("day");
            var YM = todayDate.format("YYYY-MM");
            var YESTERDAY = todayDate.clone().subtract(1, "day").format("YYYY-MM-DD");
            var TODAY = todayDate.format("YYYY-MM-DD");
            var TOMORROW = todayDate.clone().add(1, "day").format("YYYY-MM-DD");

            var calendarEl = document.getElementById("employee_work_calender");
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: "prev,next",
                    center: "title",
                    right: "listMonth"
                },

                height: 500,
                contentHeight: 780,
                aspectRatio: 3, // see: https://fullcalendar.io/docs/aspectRatio

                nowIndicator: true,
                now: TODAY + "T09:25:00", // just for demo

                views: {
                    listMonth: {
                        buttonText: "list"
                    }
                },

                initialView: "listMonth",
                initialDate: TODAY,

                editable: true,
                dayMaxEvents: true, // allow "more" link when too many events
                navLinks: true,
                events: [{
                        title: "Event One",
                        start: "2022-03-14",
                        extendedProps: {
                            longTitle: "Default title"
                        }
                    },
                    {
                        title: "Event Two",
                        start: "2022-03-14",
                        extendedProps: {
                            longTitle: "<b>Custom Title</b>"
                        }
                    },
                    {
                        title: "Event Three",
                        start: "2022-03-14",
                        extendedProps: {
                            longTitle: "Default title"
                        }
                    },
                    {
                        title: "Event Four",
                        start: "2022-03-06",
                        extendedProps: {
                            longTitle: "<b>Custom Title</b>"
                        }
                    },
                    {
                        title: "Event Five",
                        start: "2022-03-06",
                        extendedProps: {
                            longTitle: "Default title"
                        }
                    },
                    {
                        title: "Event Six",
                        start: "2022-03-06",
                        extendedProps: {
                            longTitle: "<b>Custom Title</b>"
                        }
                    }
                ],

                eventContent: function(info) {
                    var element = $(info.el);

                    if (info.event.extendedProps && info.event.extendedProps.description) {
                        if (element.hasClass("fc-day-grid-event")) {
                            element.data("content", info.event.extendedProps.description);
                            element.data("placement", "top");
                            KTApp.initPopover(element);
                        } else if (element.hasClass("fc-time-grid-event")) {
                            element.find(".fc-title").append(
                                `<div class="${fc - description}"> ${info.event.extendedProps.description} </div>`
                            );
                        } else if (element.find(".fc-list-item-title").lenght !== 0) {
                            element.find(".fc-list-item-title").append(`<div class="
                                ${fc - description}"> ${info.event.extendedProps.description}</div>`);
                        }
                    }
                }
            });

            calendar.render();
        </script>
    </x-slot>
</x-app-layout>
