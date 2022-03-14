<?php

namespace Database\Seeders;

use App\Models\EmployeePerformanceStatus;
use Illuminate\Database\Seeder;

class EmployeePerformanceStatusSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $statuses = [
            [
                'name'  => 'Excellent',
                'value' => 50
            ],
            [
                'name'  => 'Good',
                'value' => 40
            ],
            [
                'name'  => 'Satisfactory',
                'value' => 30
            ],
            [
                'name' => 'Fair',
                'value' => 20
            ],
            [
                'name'  => 'Poor',
                'value' => 10
            ]
        ];

        foreach ( $statuses as $status ) {
            EmployeePerformanceStatus::create($status);
        }
    }
}
