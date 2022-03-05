<?php

namespace Database\Seeders;

use App\Models\ProjectType;
use Illuminate\Database\Seeder;

class ProjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Media buying/PR',
            'Events',
            'Activation',
            'HR Outsourcing',
            'Digital'
        ];

        foreach ($types as $type) {
            ProjectType::create(['name' => $type]);
        }
    }
}
