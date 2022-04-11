<?php

namespace App\Http\Controllers;

use App\Models\EmployeeLeave;
use Illuminate\Http\Request;

class EmployeeLeaveController extends Controller {
    public function create() {

        return view( 'leave.create' );
    }

    public function store( Request $request ) {
        $attr = $request->validate( [
            'subject' => 'required|string',
            'details' => 'required|string'
        ] );

        $user = auth()->user();

        $leave = $user->leaves()->create( array_merge( $attr, ['approval_id' => 1] ) );

        if ( $leave ) {
            return redirect()->back()->with( 'success', 'Register for leave Successfully' );
        } else {
            return redirect()->back()->with( 'failed', 'Failed to register for leave' );
        }

    }

    public function update( EmployeeLeave $employeeLeave, Request $reqeust ) {
        $attr = $reqeust->validate( [
            'approval_id' => 'required|exists:leave_approvals,id'
        ] );

        $employeeLeave->update( $attr );

        return redirect()->back()->with( 'success', "Employe Leave {$employeeLeave->apporval->name}" );
    }
}
