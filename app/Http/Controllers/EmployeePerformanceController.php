<?php

namespace App\Http\Controllers;

use App\Models\EmployeePerformance;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeePerformanceController extends Controller {
    public function store( User $user, Request $request ) {
        foreach ( $request->get( 'performances' ) as $key => $value ) {
            EmployeePerformance::create( [
                'user_id'               => $user->id,
                'performance_name_id'   => $key,
                'performance_status_id' => $value,
                'created_at'            => $request->get( 'created_at' )
            ] );
        }

        return back()->with( 'success', 'Employee Performance Added.' );
    }
}
