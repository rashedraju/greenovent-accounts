<?php

namespace Database\Seeders;

use App\Models\UserStatus;
use Illuminate\Database\Seeder;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userStatuses = ['Verified', 'Unverified', 'Suspended'];
        foreach ( $userStatuses as $value ) {
            UserStatus::create( ['name' => $value] );
        }
    }
}
