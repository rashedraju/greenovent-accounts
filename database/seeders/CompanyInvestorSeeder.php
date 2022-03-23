<?php

namespace Database\Seeders;

use App\Models\CompanyInvestor;
use Illuminate\Database\Seeder;

class CompanyInvestorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyInvestor::create([
            'name' => 'Investor',
            'contact' => '01234567891',
            'address' => 'Niketon, Dhaka'
        ]);
    }
}
