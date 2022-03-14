<?php

namespace Database\Seeders;

use App\Models\EmployeePerformance;
use Illuminate\Database\Seeder;

class EmployeePerformanceSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $performances = [
            [
                'user_id'               => 1,
                'performance_name_id'        => 1,
                'performance_status_id' => 1,
                'created_at' => now()->addMonth()
            ],
            [
                'user_id'               => 1,
                'performance_name_id'        => 2,
                'performance_status_id' => 2
            ],
            [
                'user_id'               => 1,
                'performance_name_id'        => 3,
                'performance_status_id' => 3
            ],
            [
                'user_id'               => 1,
                'performance_name_id'        => 4,
                'performance_status_id' => 4
            ],
            [
                'user_id'               => 1,
                'performance_name_id'        => 5,
                'performance_status_id' => 5
            ],
            [
                'user_id'               => 1,
                'performance_name_id'        => 6,
                'performance_status_id' => 1
            ],
            [
                'user_id'               => 1,
                'performance_name_id'        => 7,
                'performance_status_id' => 2
            ],
            [
                'user_id'               => 1,
                'performance_name_id'        => 8,
                'performance_status_id' => 3
            ]
        ];

        foreach ( $performances as $performance ) {
            EmployeePerformance::create( $performance );
        }
    }
}
