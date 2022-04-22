<?php

namespace Database\Seeders;

use App\Models\ApprovalStatus;
use Illuminate\Database\Seeder;

class ApprovalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'pending',
                'color' => '#FFC107',
            ],
            [
                'name' => 'approved',
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
            ApprovalStatus::create( $type );
        }
    }
}
