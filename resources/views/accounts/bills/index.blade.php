<x-app-layout>
    <style>
        table {
            border-collapse: collapse;
        }

        tr:nth-child(3) {
            border: solid thin;
        }

    </style>
    <div class="p-2 py-5">
        <h1 class="text-center">Accounts</h1>
    </div>

    <x-accounts-navigation />

    <div class="card mt-3">
        <h3 class="border-bottom border-dark py-5 text-center">Bills</h3>
        <div class="card-body py-4">
            <div class="table-responsive py-5">
                <table class="table table-secondary table-striped">
                    <thead>
                        <tr class="fw-bolder fs-6 bg-gray-300">
                            <th scope="col" class="px-2 py-5"></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
