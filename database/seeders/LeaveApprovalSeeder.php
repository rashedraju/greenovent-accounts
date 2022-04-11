<?php

namespace Database\Seeders;

use App\Models\LeaveApproval;
use Illuminate\Database\Seeder;

class LeaveApprovalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $approvals = [
            'Pending',
            'Approved',
            'Cancelled'
        ];

        foreach ($approvals as $approval) {
            LeaveApproval::create(['name' => $approval]);
        }
    }
}
