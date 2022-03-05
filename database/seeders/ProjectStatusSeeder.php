<?php

namespace Database\Seeders;

use App\Models\ProjectStatus;
use Illuminate\Database\Seeder;

class ProjectStatusSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $projectStatuses = ['Complete', 'In Progress', 'Pending'];
        foreach ( $projectStatuses as $name ) {
            ProjectStatus::create( ['name' => $name] );
        }
    }
}
