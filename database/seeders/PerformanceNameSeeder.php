<?php

namespace Database\Seeders;

use App\Models\EmployeePerformance;
use App\Models\EmployeePerformanceName;
use Illuminate\Database\Seeder;

class PerformanceNameSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $performances = [
            ['name' => 'dedication'],
            ['name' => 'performance'],
            ['name' => 'cooperation'],
            ['name' => 'initiative'],
            ['name' => 'communication'],
            ['name' => 'teamwork'],
            ['name' => 'responsiveness'],
            ['name' => 'personality']
        ];

        foreach ( $performances as $performance ) {

            EmployeePerformanceName::create( $performance );
        }
    }
}
