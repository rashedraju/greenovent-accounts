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
        $user1Data = [
            'name'          => 'User 1',
            'profile_image' => 'profile_images/user.jpg',
            'email'         => 'user1@greenovent.com',
            'phone'         => '01234567891',
            'password'      => '12345678'
        ];

        $user1 = User::create( $user1Data );
        $user1->assignRole( 'Executive Director' );

        $user2Data = [
            'name'          => 'User 2',
            'profile_image' => 'profile_images/user.jpg',
            'email'         => 'user2@greenovent.com',
            'phone'         => '01234567891',
            'password'      => '12345678'
        ];

        $user2 = User::create( $user2Data );
        $user2->assignRole( 'COO' );

        $user3data = [
            'name'          => 'User 3',
            'profile_image' => 'profile_images/user.jpg',
            'email'         => 'user3@greenovent.com',
            'phone'         => '01234567891',
            'password'      => '12345678'
        ];

        $user3 = User::create( $user3data );
        $user3->assignRole( 'General Manager' );

        $user4Data = [
            'name'          => 'User 4',
            'profile_image' => 'profile_images/user.jpg',
            'email'         => 'user4@greenovent.com',
            'phone'         => '01234567891',
            'password'      => '12345678'
        ];

        $user4 = User::create( $user4Data );
        $user4->assignRole( 'Accounts Manager' );

        $user5Data = [
            'name'          => 'User 5',
            'profile_image' => 'profile_images/user.jpg',
            'email'         => 'user5@greenovent.com',
            'phone'         => '01234567891',
            'password'      => '12345678'
        ];

        $user5 = User::create( $user5Data );
        $user5->assignRole( 'Bussiness Manager' );

        $user6Data = [
            'name'          => 'User 6',
            'profile_image' => 'profile_images/user.jpg',
            'email'         => 'user6@greenovent.com',
            'phone'         => '01234567891',
            'password'      => '12345678'
        ];

        $user6 = User::create( $user6Data );
        $user6->assignRole( 'Accounts Executive' );
    }
}
