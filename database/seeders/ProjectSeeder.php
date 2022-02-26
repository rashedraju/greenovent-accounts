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
            'title'             => 'Accounts Website',
            'short_description' => 'Accounts Website to Bussiness Efficiency',
            'start_date'        => now(),
            'end_date'          => now()->addMonth(),
            'manager_id'        => '1',
            'status_id'         => 2,
            'budget'            => 750000
        ];

        Project::create( $data );
    }
}
