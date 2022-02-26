<?php

namespace Database\Seeders;

use App\Models\UserDesignation;
use Illuminate\Database\Seeder;

class UserDesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userDesignations = ['CEO', 'HR', 'Accounts', 'Jr. Software Engineer'];

        foreach ( $userDesignations as $value ) {
            UserDesignation::create( ['name' => $value] );
        }
    }
}
