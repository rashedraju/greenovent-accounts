<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDesignation;
use App\Models\UserStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {

        // User Designations Seeder
        $userDesignations = ['CEO', 'HR', 'Accounts', 'Jr. Software Engineer'];

        foreach ( $userDesignations as $value ) {
            UserDesignation::create( ['name' => $value] );
        }

        // User Status Seeder
        $userStatuses = ['Verified', 'Unverified', 'Suspended'];
        foreach ( $userStatuses as $value ) {
            UserStatus::create( ['name' => $value] );
        }

        // User Seeder
        User::create( [
            'first_name' => 'Rashedul',
            'last_name'  => 'Islam',
            'email'      => 'rashed.greenovent@gmail.com',
            'phone'      => '01626118847',
            'designation_id'    => 4,
            'status_id'  => 1,
            'password'   => '12345678'
        ] );
        User::create( [
            'first_name' => 'Super',
            'last_name'  => 'Admin',
            'email'      => 'ceo@greenovent.com',
            'phone'      => '01234567890',
            'designation_id'    => 1,
            'status_id'  => 1,
            'password'   => '12345678'
        ] );
    }
}
