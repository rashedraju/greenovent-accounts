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
                'name'                => 'Landmark Website',
                'business_manager_id' => 2,
                'client_id'           => 1,
                'type_id'             => 1,
                'po_number'           => 101,
                'po_value'            => 200000,
                'bill_type'           => 1,
                'start_date'          => now(),
                'closing_date'        => now()->addMonth(),
                'status_id'           => 2,
                'created_at'          => '2022-01-24 10:12:00'
            ],
            [
                'name'                => 'BAT Event',
                'business_manager_id' => 2,
                'client_id'           => 2,
                'type_id'             => 1,
                'po_number'           => 102,
                'po_value'            => 500000,
                'bill_type'           => 1,
                'start_date'          => now(),
                'closing_date'        => now()->addMonth(),
                'status_id'           => 2,
                'created_at'          => '2022-02-24 10:12:00'
            ],
            [
                'name'                => 'TVS Eid Campaign',
                'business_manager_id' => 3,
                'client_id'           => 3,
                'type_id'             => 1,
                'po_number'           => 103,
                'po_value'            => 100000,
                'bill_type'           => 1,
                'start_date'          => now(),
                'closing_date'        => now()->addMonth(),
                'status_id'           => 2,
                'created_at'          => '2022-03-24 10:12:00'
            ]
        ];

        foreach ( $projects as $project ) {
            Project::create( $project );
        }
    }
}
