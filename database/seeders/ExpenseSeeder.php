<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Expense::create([
            'user_id' => 1,
            'project_id' => 1,
            'description' => 'description of first expense',
            'expense_type_id' => 1,
            'transaction_type_id' => 1,
            'amount' => 10000,
            'note' => 'note of first expense history'
        ]);
    }
}
