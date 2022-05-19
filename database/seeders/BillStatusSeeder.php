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
        $statuses = ["Not Done", "Project Ongoing", "Bill Under Process", "Bill submitted to Accounts", "Bill in Client System", "Bill Received", "Bill Done"];

        foreach ( $statuses as $status ) {
            BillStatus::create( ['name' => $status] );
        }
    }
}
