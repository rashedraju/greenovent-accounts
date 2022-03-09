<?php

namespace Database\Seeders;

use App\Models\UserDesignation;
use Illuminate\Database\Seeder;

class UserDesignationSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $userDesignations = ['CEO', 'COO', 'Executive Director', 'Reporting Manager', 'Head of Operations',
            'HR', 'Accounts'];

        foreach ( $userDesignations as $value ) {
            UserDesignation::create( ['name' => $value] );
        }
    }
}
