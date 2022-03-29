<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $names = [
            'Cash',
            'Bank'
        ];

        foreach ( $names as $type ) {
            TransactionType::create( ['name' => $type] );
        }
    }
}
