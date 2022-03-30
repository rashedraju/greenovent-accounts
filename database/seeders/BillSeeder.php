<?php

namespace Database\Seeders;

use App\Models\Bill;
use Illuminate\Database\Seeder;

class BillSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Bill::create( [
            'project_id' => 1,
            'date'        => now(),
            'bill_no'     => 'alm/20220330',
            'subject'     => 'Bill for anwar landmark',
            'bill_status_id' => 1,
            'total'       => 10000,
            'asf'         => 10,
            'vat'         => 15
        ] );
    }
}
