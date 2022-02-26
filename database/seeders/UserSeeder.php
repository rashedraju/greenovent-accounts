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
                'first_name'     => 'Rashedul',
                'last_name'      => 'Islam',
                'email'          => 'rashed.greenovent@gmail.com',
                'phone'          => '01626118847',
                'designation_id' => 4,
                'status_id'      => 1,
                'password'       => '12345678'
            ],
            [
                'first_name'     => 'Super',
                'last_name'      => 'Admin',
                'email'          => 'ceo@greenovent.com',
                'phone'          => '01234567890',
                'designation_id' => 1,
                'status_id'      => 1,
                'password'       => '12345678'
            ]
        ];

        foreach ($data as $user) {
            User::create($user);
        }
    }
}
