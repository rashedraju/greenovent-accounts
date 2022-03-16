<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRolesAndPermissionsRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsController extends Controller {
    // render all permissions
    public function index() {
        $permissions = Permission::all();
        $roles = Role::all();
        return view( 'permissions', compact( ['permissions', 'roles'] ) );
    }

    // assign roles to a permission
    public function update( UpdateRolesAndPermissionsRequest $request, Permission $permission ) {
        $attrs = $request->validated();
        $roles = array_keys( $attrs );
        $permission->syncRoles( $roles );

        return redirect()->route( 'permissions' )->with( 'success', 'Permission updated!' );
    }
}
