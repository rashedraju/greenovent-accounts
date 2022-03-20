<?php

namespace Database\Seeders;

use App\Models\ExpenseType;
use Illuminate\Database\Seeder;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Selary',
            'Daily Conveyance',
            'Project/Event'
        ];

        foreach ($types as $type) {
            ExpenseType::create(['name' => $type]);
        }
    }
}
