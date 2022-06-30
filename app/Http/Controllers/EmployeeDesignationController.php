<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class EmployeeDesignationController extends Controller {
    public function store( Request $request ) {
        $attrs = $request->validate( [
            'name' => 'required|string'
        ] );

        Role::create( $attrs );

        return redirect()->back()->with( 'success', 'New designation has been added.' );
    }
}
