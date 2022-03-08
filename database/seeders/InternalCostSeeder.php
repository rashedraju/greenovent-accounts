<?php

namespace Database\Seeders;

use App\Models\InternalCost;
use Illuminate\Database\Seeder;

class InternalCostSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        InternalCost::create( [
            'project_id'  => 1,
            'title'       => 'Domain Buy',
            'costs'       => 10000,
            'description' => 'Domain buy for example ltd.',
            'created_at'  => now()
        ] );
    }
}
