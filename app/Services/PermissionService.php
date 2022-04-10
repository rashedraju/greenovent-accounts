<?php

namespace App\Services;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Request;
use Spatie\Permission\Models\Permission;

trait PermissionService {
    public function checkPermission() {
        $allPermissions = Permission::pluck( 'name' )->toArray();
        if ( Request::user()->cannot( $allPermissions ) ) {
            throw new AuthorizationException( "You can not access this page!" );
        }
    }
}
