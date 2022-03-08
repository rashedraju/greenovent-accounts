<?php

namespace Database\Seeders;

use App\Models\ExternalCost;
use Illuminate\Database\Seeder;

class ExternalCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExternalCost::create([
            'project_id' => 1,
            'title' => 'Domain Buy',
            'costs' => 120000,
            'description' => 'Domain buy for example ltd.',
            'created_at' => now()
        ]);
    }
}
