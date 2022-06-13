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
            'name'          => 'Tanzir Ahmed Rabby',
            'profile_image' => 'profile_images/user.jpg',
            'email'         => 'rabby@greenovent.com',
            'phone'         => '01234567891',
            'password'      => '12345678'
        ];

        $user1 = User::create( $user1Data );
        $user1->assignRole( 'Executive Director' );

        $user2Data = [
            'name'          => 'Mohammad Ashraful Islam',
            'profile_image' => 'profile_images/user.jpg',
            'email'         => 'islam.ashraful@greenovent.com',
            'phone'         => '01234567891',
            'password'      => '12345678'
        ];

        $user2 = User::create( $user2Data );
        $user2->assignRole( 'COO' );

        $user3data = [
            'name'          => 'Jakaria Ahmed Omi',
            'profile_image' => 'profile_images/user.jpg',
            'email'         => 'jakaria@greenovent.com',
            'phone'         => '01234567891',
            'password'      => '12345678'
        ];

        $user3 = User::create( $user3data );
        $user3->assignRole( 'General Manager', 'Accounts Manager' );

        $user5Data = [
            'name'          => 'Samiun Hyder',
            'profile_image' => 'profile_images/user.jpg',
            'email'         => 'samiun@greenovent.com',
            'phone'         => '01234567891',
            'password'      => '12345678'
        ];

        $user5 = User::create( $user5Data );
        $user5->assignRole( 'Accounts Manager' );

        $user6Data = [
            'name'          => 'Greenovents Accounts',
            'profile_image' => 'profile_images/user.jpg',
            'email'         => 'accounts@greenovent.com',
            'phone'         => '01234567891',
            'password'      => '12345678'
        ];

        $user6 = User::create( $user6Data );
        $user6->assignRole( 'Accounts Executive' );

        $user7Data = [
            'name'          => 'Ahmed Jahid',
            'profile_image' => 'profile_images/user.jpg',
            'email'         => 'ahmed.jahid@greenovent.com',
            'phone'         => '01234567891',
            'password'      => '12345678'
        ];

        $user7 = User::create( $user7Data );
        $user7->assignRole( 'CEO' );
    }
}
