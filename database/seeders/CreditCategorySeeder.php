<?php

namespace Database\Seeders;

use App\Models\CreditCategory;
use Illuminate\Database\Seeder;

class CreditCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats = [
            'Bill',
            'Loan',
            'Investment'
        ];

        foreach ($cats as $cat) {
            CreditCategory::create(['name' => $cat]);
        }
    }
}
