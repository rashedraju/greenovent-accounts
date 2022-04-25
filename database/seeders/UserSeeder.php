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
        // create ceo and asign role
        $ceoData = [
            'name'                       => 'John Doe',
            'profile_image'              => 'profile_images/user.jpg',
            'email'                      => 'admin@greenovent.com',
            'phone'                      => '01234567891',
            'joining_date'               => now(),
            'current_address'            => 'Dhanmondi, Dhaka',
            'permanent_address'          => 'Dhanmondi, Dhaka',
            'emergency_contact_name'     => 'John Doe',
            'emergency_contact_no'       => '01234567891',
            'emergency_contact_relation' => 'brother',
            'password'                   => '12345678'
        ];

        $ceo = User::create( $ceoData );
        $ceo->assignRole( 'CEO' );

        // create bussiness manager and asign role
        $bussinessManager1Data = [
            'name'                       => 'Jane Doe',
            'profile_image'              => 'profile_images/user.jpg',
            'email'                      => 'jane@greenovent.com',
            'phone'                      => '01234567891',
            'joining_date'               => now(),
            'current_address'            => 'Dhanmondi, Dhaka',
            'permanent_address'          => 'Dhanmondi, Dhaka',
            'emergency_contact_name'     => 'John Doe',
            'emergency_contact_no'       => '01234567891',
            'emergency_contact_relation' => 'brother',
            'password'                   => '12345678'
        ];

        $bussinessManager1 = User::create( $bussinessManager1Data );
        $bussinessManager1->assignRole( 'Bussiness Manager' );

        $bussinessManager2Data = [
            'name'                       => 'Mark Miller',
            'profile_image'              => 'profile_images/user.jpg',
            'email'                      => 'mark@greenovent.com',
            'phone'                      => '01234567891',
            'joining_date'               => now(),
            'current_address'            => 'Dhanmondi, Dhaka',
            'permanent_address'          => 'Dhanmondi, Dhaka',
            'emergency_contact_name'     => 'Mark Miller',
            'emergency_contact_no'       => '01234567891',
            'emergency_contact_relation' => 'brother',
            'password'                   => '12345678'
        ];

        $bussinessManager2 = User::create( $bussinessManager2Data );
        $bussinessManager2->assignRole( 'Bussiness Manager' );

        $bussinessManager3Data = [
            'name'                       => 'Joe Jonas ',
            'profile_image'              => 'profile_images/user.jpg',
            'email'                      => 'jonas@greenovent.com',
            'phone'                      => '01234567891',
            'joining_date'               => now(),
            'current_address'            => 'Dhanmondi, Dhaka',
            'permanent_address'          => 'Dhanmondi, Dhaka',
            'emergency_contact_name'     => 'Mark Miller',
            'emergency_contact_no'       => '01234567891',
            'emergency_contact_relation' => 'brother',
            'password'                   => '12345678'
        ];

        $bussinessManager3 = User::create( $bussinessManager3Data );
        $bussinessManager3->assignRole( 'Bussiness Manager' );
    }
}
