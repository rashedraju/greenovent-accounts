<?php

namespace Database\Seeders;

use App\Models\TransactionAprovalType;
use Illuminate\Database\Seeder;

class TransactionAprovalTypeSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $types = [
            'pending',
            'aproved',
            'rejected',
            'recheck'
        ];

        foreach ( $types as $type ) {
            TransactionAprovalType::create( ['name' => $type] );
        }
    }
}
