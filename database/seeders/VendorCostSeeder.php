<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\VendorCost;
use Illuminate\Database\Seeder;

class VendorCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VendorCost::create([
            'project_id'  => 1,
            'title'       => 'Domain Buy',
            'name' => 'John Doe',
            'advance' => 4000,
            'due' => 6000,
            'created_at'  => now()
        ]);
    }
}
