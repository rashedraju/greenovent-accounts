<?php

namespace Database\Seeders;

use App\Models\CompanyLoanLender;
use Illuminate\Database\Seeder;

class CompanyLoanLenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyLoanLender::create([
            'name' => 'loan lender',
            'contact' => '0123456789',
            'address' => 'Niketon, Dhaka'
        ]);
    }
}
