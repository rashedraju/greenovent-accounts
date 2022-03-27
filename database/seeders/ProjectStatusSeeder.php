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
        $projectStatuses = [['name' => 'Complete', 'color' => '#28A745'], ['name' => 'In Progress', 'color' => '#0095e8'], ['name' => 'Pending', 'color' => '#FFC107'], ['name' => 'Cancel', 'color' => '#DC3545']];
        foreach ( $projectStatuses as $status ) {
            ProjectStatus::create( $status );
        }
    }
}
