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
            'date' => now(),
            'user_id' => 1,
            'amount' => 1000,
            'bank_name' => 'EBL',
            'slip_number' => '24571369875',
            'note' => 'First withdrawal'
        ]);
    }
}
