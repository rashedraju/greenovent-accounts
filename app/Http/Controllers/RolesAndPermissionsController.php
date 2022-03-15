<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsController extends Controller {
    public function index() {
        $permissions = Permission::all()->pluck( 'name' );
        $rules = Role::all()->pluck( 'name' );
        return view( 'permissions', compact( ['permissions', 'rules'] ) );
    }
}
