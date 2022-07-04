<div class="card my-3">
    <div class="card-header d-flex align-items-center">
        <h3> Sales </h3>
    </div>
    <div class="p-3 my-3">
        <form action="{{ $action }}" method="get">
            <div class="d-flex gap-3 align-items-center">
                <div>
                    <label for="year">Year</label>
                    <select class="form-select" aria-label="Default select example" name="year">
                        <option value="0" selected> All </option>
                        <option value="2022"
                            {{ request()->year == 2022 || $data['year'] == 2022 ? 'selected' : '' }}>2022</option>
                        <option value="2021"
                            {{ request()->year == 2021 || $data['year'] == 2021 ? 'selected' : '' }}>2021</option>
                    </select>
                </div>
                <div>
                    <label for="month">Month</label>
                    <select class="form-select" aria-label="Default select example" name="month">
                        <option value="0">All</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}"
                                {{ request()->month == $i || $data['month'] == $i ? 'selected' : '' }}>
                                {{ now()->month($i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label for="client">Client</label>
                    <select class="form-select" aria-label="Default select example" name="client">
                        <option value="0">All</option>
                        @foreach ($data['clients'] as $clientId => $clientName)
                            <option value="{{ $clientId }}"
                                {{ request()->client == $clientId ? 'selected' : '' }}>{{ $clientName }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="accounts_manager">Accounts Manager</label>
                    <select class="form-select" aria-label="Default select example" name="accounts_manager">
                        <option value="0">All
                        </option>
                        @foreach ($data['accountsManagers'] as $amId => $amName)
                            <option value="{{ $amId }}"
                                {{ request()->accounts_manager == $amId ? 'selected' : '' }}>{{ $amName }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="bill">Bill</label>
                    <select class="form-select" aria-label="Default select example" name="bill">
                        <option value="0" {{ request()->bill == 0 ? 'selected' : '' }}>All</option>
                        <option value="1" {{ request()->bill == 1 ? 'selected' : '' }}>Due</option>
                        <option value="2" {{ request()->bill == 2 ? 'selected' : '' }}>Paid</option>
                    </select>
                </div>
                <div>
                    <div>&nbsp;</div>
                    <button class="btn btn-secondary px-10">Sbumit</button>
                </div>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-secondary table-hover bs-table-bordered">
            <thead>
                <tr class="border border-dark">
                    <td class="px-2 py-5 fw-bolder fs-6">Date</td>
                    <td class="px-2 py-5 fw-bolder fs-6">Accounts Manager</td>
                    <td class="px-2 py-5 fw-bolder fs-6">Client Name</td>
                    <td class="px-2 py-5 fw-bolder fs-6">Description</td>
                    <td class="px-2 py-5 fw-bolder fs-6">Project Goal</td>
                    <td class="px-2 py-5 fw-bolder fs-6">Sales</td>
                    <td class="px-2 py-5 fw-bolder fs-6">ASF</td>
                    <td class="px-2 py-5 fw-bolder fs-6">Sub Total</td>
                    <td class="px-2 py-5 fw-bolder fs-6">Amount VAT</td>
                    <td class="px-2 py-5 fw-bolder fs-6">Client Advance</td>
                    <td class="px-2 py-5 fw-bolder fs-6">BP</td>
                    <td class="px-2 py-5 fw-bolder fs-6">AIT </td>
                    <td class="px-2 py-5 fw-bolder fs-6"> Expence </td>
                    <td class="px-2 py-5 fw-bolder fs-6"> Total Expense </td>
                    <td class="px-2 py-5 fw-bolder fs-6"> Due </td>
                    <td class="px-2 py-5 fw-bolder fs-6"> Gross Profit </td>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['projects'] as $project)
                    <tr
                        class="border border-gray-500 cursor-pointer {{ $project->due() == 0 ? '' : 'table-danger' }}">
                        <td class="px-2 py-5">{{ $project->start_date }}</td>
                        <td class="px-2 py-5"><a
                                href="{{ route('accounts-manager.show', $project->manager) }}">{{ $project->manager->name }}</a>
                        </td>
                        <td class="px-2 py-5"><a
                                href="{{ route('accounts-manager.client', ['user' => $project->manager, 'client' => $project->client]) }}">
                                {{ $project->client->company_name }} </a></td>
                        <td class="px-2 py-5"><a
                                href="{{ route('projects.show', $project) }}">{{ $project->name }}</a></td>
                        <td class="px-2 py-5">
                            {{ number_format((float) $project->external?->grandTotal(), 2, '.', ',') }}
                        </td>
                        <td class="px-2 py-5">
                            {{ number_format((float) $project->external?->total, 2, '.', ',') }}</td>
                        <td class="px-2 py-5">
                            {{ number_format((float) $project->external?->asfTotal(), 2, '.', ',') }}
                        </td>
                        <td class="px-2 py-5">
                            {{ number_format((float) $project->external?->asfSubTotal(), 2, '.', ',') }}
                        </td>
                        <td class="px-2 py-5">
                            {{ number_format((float) $project->external?->vatTotal(), 2, '.', ',') }}
                        </td>
                        <td class="px-2 py-5">
                            {{ number_format((float) $project->advance_paid, 2, '.', ',') }}</td>
                        <td class="px-2 py-5">
                            {{ number_format((float) $project->bp, 2, '.', ',') }}</td>
                        <td class="px-2 py-5">
                            {{ number_format((float) $project->ait(), 2, '.', ',') }}</td>
                        <td class="px-2 py-5">
                            {{ number_format((float) $project->internal?->total, 2, '.', ',') }}</td>
                        <td class="px-2 py-5">
                            {{ number_format((float) $project->totalExpense(), 2, '.', ',') }}</td>
                        <td class="px-2 py-5">
                            {{ number_format((float) $project->due(), 2, '.', ',') }}</td>
                        <td class="px-2 py-5">
                            {{ number_format((float) $project->grossProfit(), 2, '.', ',') }}</td>
                    </tr>
                @endforeach
                <tr class="border border-gray-500 cursor-pointer table-success">
                    <td class="px-2 py-5 fw-bolder"></td>
                    <td class="px-2 py-5 fw-bolder"></td>
                    <td class="px-2 py-5 fw-bolder"></td>
                    <td class="px-2 py-5 fw-bolder"></td>
                    <td class="px-2 py-5 fw-bolder">
                        {{ number_format((float) $data['projectGoal'], 2, '.', ',') }}</td>
                    <td class="px-2 py-5 fw-bolder">
                        {{ number_format((float) $data['sales'], 2, '.', ',') }}</td>
                    <td class="px-2 py-5 fw-bolder">
                        {{ number_format((float) $data['asfTotal'], 2, '.', ',') }}
                    </td>
                    <td class="px-2 py-5 fw-bolder">
                        {{ number_format((float) $data['asfSubTotal'], 2, '.', ',') }}
                    </td>
                    <td class="px-2 py-5 fw-bolder">
                        {{ number_format((float) $data['vatTotal'], 2, '.', ',') }}
                    </td>
                    <td class="px-2 py-5 fw-bolder"></td>
                    <td class="px-2 py-5 fw-bolder"></td>
                    <td class="px-2 py-5 fw-bolder">
                        {{ number_format((float) $data['ait'], 2, '.', ',') }}</td>
                    <td class="px-2 py-5 fw-bolder">
                        {{ number_format((float) $data['internalTotal'], 2, '.', ',') }}</td>
                    <td class="px-2 py-5 fw-bolder">
                        {{ number_format((float) $data['totalExpense'], 2, '.', ',') }}</td>
                    <td class="px-2 py-5 fw-bolder">
                        {{ number_format((float) $data['due'], 2, '.', ',') }}</td>
                    <td class="px-2 py-5 fw-bolder">
                        {{ number_format((float) $data['grossProfit'], 2, '.', ',') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
