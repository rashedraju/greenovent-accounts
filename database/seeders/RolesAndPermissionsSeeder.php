<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create( ['name' => 'show dashboard'] );

        // create roles
        $roleCEO = Role::create( ['name' => 'CEO'] );
        $roleCOO = Role::create( ['name' => 'COO'] );
        $roleExecutiveDirector = Role::create( ['name' => 'Executive Director'] );
        $roleGeneralManager = Role::create( ['name' => 'General Manager'] );
        $roleHeadofOperations = Role::create( ['name' => 'Head of Operations'] );
        $roleHR = Role::create( ['name' => 'HR'] );
        $roleAccounts = Role::create( ['name' => 'Accounts'] );

        // permissions for roleCEO
        $roleCEO->givePermissionTo( 'show dashboard' );
    }
}
