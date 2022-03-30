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
        $data = [
            'name'                => 'Accounts Website',
            'business_manager_id' => '1',
            'client_id'           => 1,
            'type_id'             => 1,
            'po_number'           => 101,
            'po_value'            => 75000,
            'bill_type'           => 1,
            'start_date'          => now(),
            'closing_date'        => now()->addMonth(),
            'status_id'           => 2
        ];

        Project::create( $data );
    }
}
