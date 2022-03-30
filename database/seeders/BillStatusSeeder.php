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
        $statuses = ["Not Done", "Bill sent to client", "Bill received by client", "Bill in Client System", "Bill submitted to Accounts", "Bill Done"];

        foreach ($statuses as $status) {
            BillStatus::create(['name' => $status]);
        }
    }
}
