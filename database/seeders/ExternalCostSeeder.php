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
            'total' => 150000,
            'asf' => 10,
            'vat' => 15,
            'note' => 'External costs.',
        ]);
    }
}
