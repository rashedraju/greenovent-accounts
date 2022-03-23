<?php

namespace Database\Seeders;

use App\Models\Credit;
use Illuminate\Database\Seeder;

class CreditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Credit::create([
            'date' => now(),
            'modified' => now(),
            'user_id' => 1,
            'category_id' => 1,
            'project_id' => 1,
            'amount' => 1000,
            'transaction_type_id' => 1,
            'note' => 'First withdrawal'
        ]);
    }
}
