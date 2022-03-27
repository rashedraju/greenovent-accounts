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
            // employees
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            EmployeePerformanceStatusSeeder::class,
            PerformanceNameSeeder::class,
            EmployeePerformanceSeeder::class,

            // clients
            ClientSeeder::class,

            // bills
            BillStatusSeeder::class,

            // projects
            ProjectTypeSeeder::class,
            ProjectStatusSeeder::class,
            ProjectSeeder::class,
            InternalCostSeeder::class,
            ExternalCostSeeder::class,
            VendorCostSeeder::class,

            // accounts
            TransactionTypeSeeder::class,
            TransactionAprovalTypeSeeder::class,
            WithdrawalSeeder::class,
            ExpenseTypeSeeder::class,
            ExpenseSeeder::class,
            CreditCategorySeeder::class,
            CreditSeeder::class,
            CompanyLoanLenderSeeder::class,
            CompanyInvestorSeeder::class
        ] );
    }
}
