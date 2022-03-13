<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $data = [
            [
                'name'                       => 'Admin',
                'designation_id'             => 4,
                'email'                      => 'admin@greenovent.com',
                'phone'                      => '01234567891',
                'joining_date'               => now(),
                'current_address'            => 'Dhanmondi, Dhaka',
                'permanent_address'          => 'Dhanmondi, Dhaka',
                'emergency_contact_name'     => 'John Doe',
                'emergency_contact_no'       => '01234567891',
                'emergency_contact_relation' => 'brother',
                'password'                   => '12345678'
            ]
        ];

        foreach ( $data as $user ) {
            User::create( $user );
        }
    }
}
