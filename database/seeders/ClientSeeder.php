<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $clients = [
            [
                'company_name'        => "Anwar Landmark",
                "office_address"      => "Baitul Hossain Building (13th floor), 27 Dilkusha C/A, Dhaka-1000",
                'business_manager_id' => 1
            ],
            [
                'company_name'        => "BAT",
                "office_address"      => "Mohakhali, Dhaka",
                'business_manager_id' => 1
            ],
            [
                'company_name'        => "TVS bangladesh",
                "office_address"      => "304, Industrial Area (2nd, 3rd & 4th Floor) Tejgaon, Dhaka- 1208.",
                'business_manager_id' => 1
            ]
        ];

        foreach ( $clients as $client ) {
            Client::create( $client );
        }
    }
}
