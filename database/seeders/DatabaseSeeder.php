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
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            EmployeePerformanceStatusSeeder::class,
            PerformanceNameSeeder::class,
            EmployeePerformanceSeeder::class,
            ProjectTypeSeeder::class,
            ProjectStatusSeeder::class,
            ProjectSeeder::class,
            InternalCostSeeder::class,
            ExternalCostSeeder::class,
            VendorCostSeeder::class,
            ClientSeeder::class,

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
