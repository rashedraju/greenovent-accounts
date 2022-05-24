@props(['heads', 'projects', 'credits', 'employees', 'transactionTypes'])
<div class="table-responsive">
    <table class="table table-secondary table-striped">
        <thead>
            <tr class="fw-bolder fs-6">
                <th class="px-2 py-5">SL</th>
                <th class="px-2 py-5">Date</th>
                <th class="px-2 py-5">Head</th>
                <th class="px-2 py-5">description</th>
                <th class="px-2 py-5">Project Name</th>
                <th class="px-2 py-5">Amount</th>
                <th class="px-2 py-5">Transaction Type</th>
                <th class="px-2 py-5">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($credits as $credit)
                <tr class="fw-bold">
                    <td class="px-2 py-5">{{ $loop->iteration }}</td>
                    <td class="px-2 py-5">{{ date('d-m-yy', strtotime($credit->date)) }}</a>
                    <td class="px-2 py-5">{{ $credit->head }}</a>
                    <td class="px-2 py-5">{{ $credit->description }}</a>
                    <td class="px-2 py-5">{{ $credit->project->name }}</a>
                    <td class="px-2 py-5">{{ number_format($credit->amount) }}</a>
                    <td class="px-2 py-5">{{ $credit->transactionType->name }}</a>
                    <td class="px-2 py-5">
                        <div class="d-flex gap-3 cursor-pointer">
                            <div id="edit_project_drawer_btn_{{ $loop->iteration }}">
                                <x-utils.edit-icon />
                            </div>
                            <div id="delete_project_drawer_btn_{{ $loop->iteration }}">
                                <x-utils.delete-icon />
                            </div>
                        </div>
                    </td>
                </tr>
                <x-drawer btnId="edit_project_drawer_btn_{{ $loop->iteration }}"
                    drawerId="edit_project_credit_drawer_{{ $loop->iteration }}"
                    title="Edit project credit record">
                    <x-forms.accounts.credits.edit-project :heads="$heads" :projects="$projects" :credit="$credit"
                        :employees="$employees" :transactionTypes="$transactionTypes" />
                </x-drawer>

                <x-drawer btnId="delete_project_drawer_btn_{{ $loop->iteration }}"
                    drawerId="delete_project_drawer_{{ $loop->iteration }}" title="Delete project credit Record">
                    <form method="post" action="{{ route('accounts.credits.project.delete', $credit) }}">
                        @csrf
                        @method('delete')
                        <h2 class="mb-3">Are you sure you want to delete this?</h2>

                        <div class="d-flex my-3 gap-3">
                            <button type="button" class="btn btn-sm btn-light w-100"
                                data-kt-drawer-dismiss="true">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-danger w-100">Delete</button>
                        </div>
                    </form>
                </x-drawer>
            @endforeach
        </tbody>
    </table>
</div>
