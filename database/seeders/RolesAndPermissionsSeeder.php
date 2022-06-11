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
        Permission::create( ['name' => 'Dashboard'] );
        Permission::create( ['name' => 'Projects'] );
        Permission::create( ['name' => 'Employees'] );
        Permission::create( ['name' => 'Accounts'] );
        Permission::create( ['name' => 'Permissions'] );

        // create roles
        $roleExecutiveDirector = Role::create( ['name' => 'Executive Director'] );
        $roleExecutiveDirector = Role::create( ['name' => 'CEO'] );
        $roleCOO = Role::create( ['name' => 'COO'] );
        $roleGeneralManager = Role::create( ['name' => 'General Manager'] );
        $roleAccountsManager = Role::create( ['name' => 'Accounts Manager'] );
        $roleGeneralManager = Role::create( ['name' => 'Bussiness Manager'] );
        $roleAccountsExecutive = Role::create( ['name' => 'Accounts Executive'] );
        $roleHR = Role::create( ['name' => 'HR'] );

        // permissions for roles
        $roleExecutiveDirector->givePermissionTo( ['Dashboard', 'Clients', 'Projects', 'Employees', 'Accounts', 'Permissions'] );
        $roleCOO->givePermissionTo( ['Dashboard', 'Clients', 'Projects', 'Employees', 'Accounts', 'Permissions'] );
        $roleGeneralManager->givePermissionTo( ['Clients', 'Projects'] );
        $roleAccountsManager->givePermissionTo( ['Clients', 'Projects'] );
        $roleHR->givePermissionTo( ['Employees'] );
        $roleAccountsExecutive->givePermissionTo( ['Accounts'] );
    }
}
