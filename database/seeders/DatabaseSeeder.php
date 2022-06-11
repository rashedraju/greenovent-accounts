<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {

        // Call all seeders
        $this->call( [
            // approval
            ApprovalStatusSeeder::class,

            // employees
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            EmployeePerformanceStatusSeeder::class,
            PerformanceNameSeeder::class,
            EmployeePerformanceSeeder::class,

            // leave
            LeaveApprovalSeeder::class,

            // clients
            ClientSeeder::class,

            // bills
            BillTypeSeeder::class,
            BillStatusSeeder::class,

            // projects
            ProjectTypeSeeder::class,
            ProjectStatusSeeder::class,
            ProjectSeeder::class,

            // accounts
            AccountsExpenseTypeSeeder::class,
            TransactionTypeSeeder::class,
            TransactionAprovalTypeSeeder::class,
            WithdrawalSeeder::class,
            DepositSeeder::class,
            CreditCategorySeeder::class
        ] );
    }
}
