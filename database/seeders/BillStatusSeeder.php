<?php

namespace Database\Seeders;

use App\Models\BillStatus;
use Illuminate\Database\Seeder;

class BillStatusSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $statuses = ["Project Ongoing", "Not Done", "Bill submitted to Accounts", "Bill sent to client", "Bill received by client", "Bill in Client System"];

        foreach ( $statuses as $status ) {
            BillStatus::create( ['name' => $status] );
        }
    }
}
