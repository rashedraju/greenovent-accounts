<?php

namespace Database\Seeders;

use App\Models\AccountsExpenseType;
use Illuminate\Database\Seeder;

class AccountsExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            'Salary',
            'Office Rent',
            'Security Charge',
            'Electricity',
            'Internet',
            'Water',
            'Bazar',
            'Convayance',
            'Stationary',
            'VAT',
            'Office Expence',
            'Mail Expense',
            'Mobile Bill',
            'Entertainment',
            'Car Expense',
            'Fixed Asset',
        ];

        foreach ($items as $item) {
            AccountsExpenseType::create(['name' => $item]);
        }
    }
}
