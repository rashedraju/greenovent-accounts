<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $projects = [
            [
                'name'                => 'Event 1',
                'business_manager_id' => 4,
                'client_id'           => 1,
                'type_id'             => 1,
                'po_number'           => 101,
                'po_value'            => 200000,
                'bill_type'           => 1,
                'start_date'          => now(),
                'closing_date'        => now()->addMonth(),
                'status_id'           => 2,
                'created_at'          => now()
            ],
            [
                'name'                => 'Event 2',
                'business_manager_id' => 4,
                'client_id'           => 2,
                'type_id'             => 1,
                'po_number'           => 102,
                'po_value'            => 500000,
                'bill_type'           => 1,
                'start_date'          => now(),
                'closing_date'        => now()->addMonth(),
                'status_id'           => 2,
                'created_at'          => now()
            ],
            [
                'name'                => 'Event 3',
                'business_manager_id' => 5,
                'client_id'           => 3,
                'type_id'             => 1,
                'po_number'           => 103,
                'po_value'            => 100000,
                'bill_type'           => 1,
                'start_date'          => now(),
                'closing_date'        => now()->addMonth(),
                'status_id'           => 2,
                'created_at'          => now()
            ],
            [
                'name'                => 'Event 4',
                'business_manager_id' => 5,
                'client_id'           => 4,
                'type_id'             => 1,
                'po_number'           => 103,
                'po_value'            => 100000,
                'bill_type'           => 1,
                'start_date'          => now(),
                'closing_date'        => now()->addMonth(),
                'status_id'           => 2,
                'created_at'          => now()
            ]
        ];

        foreach ( $projects as $project ) {
            Project::create( $project );
        }
    }
}
