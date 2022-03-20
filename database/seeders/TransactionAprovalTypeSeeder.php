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
            [
                'name' => 'pending',
                'color' => '#FFC107',
            ],
            [
                'name' => 'aproved',
                'color' => '#28A745',
            ],
            [
                'name' => 'rejected',
                'color' => '#DC3545',
            ],
            [
                'name' => 'recheck',
                'color' => '#007BFF',
            ],
        ];

        foreach ( $types as $type ) {
            TransactionAprovalType::create( $type );
        }
    }
}
