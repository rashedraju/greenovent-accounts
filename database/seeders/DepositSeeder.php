<?php

namespace Database\Seeders;

use App\Models\Deposit;
use Illuminate\Database\Seeder;

class DepositSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Deposit::create( [
            'date'        => now(),
            'modified'    => now(),
            'user_id'     => 1,
            'amount'      => 7000,
            'bank_name'   => 'EBL',
            'slip_number' => '24571369875',
            'note'        => 'First deposit'
        ] );
    }
}
