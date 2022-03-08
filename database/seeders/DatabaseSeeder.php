<?php

namespace Database\Seeders;

use App\Models\InternalCost;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {

        // Call all seeders
        $this->call( [
            UserDesignationSeeder::class,
            UserSeeder::class,
            ProjectTypeSeeder::class,
            ProjectStatusSeeder::class,
            ProjectSeeder::class,
            InternalCostSeeder::class,
            ExternalCostSeeder::class,
            ClientSeeder::class,
        ] );
    }
}
