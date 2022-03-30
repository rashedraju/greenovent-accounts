<?php

namespace Database\Seeders;

use App\Models\BillType;
use Illuminate\Database\Seeder;

class BillTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $billTypes = ['One of', 'Monthly'];

        foreach ($billTypes as $billType) {
            BillType::create(['name' => $billType]);
        }
    }
}
