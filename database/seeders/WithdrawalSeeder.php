<?php

namespace Database\Seeders;

use App\Models\Withdrawal;
use Illuminate\Database\Seeder;

class WithdrawalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Withdrawal::create([
            'amount' => 10000,
            'user_id' => 1,
            'transaction_type_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
