<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;

class DashboardController extends Controller {
    public function index( Request $request ) {
        if ( $request->user()->cannot( 'show dashboard' ) ) {
            throw new AuthorizationException( "You can not access this page!" );
        }

        return view( 'dashboard' );
    }
}
