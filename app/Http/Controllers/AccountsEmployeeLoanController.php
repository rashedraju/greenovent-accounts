<?php

namespace App\Http\Controllers;

use App\Models\AccountsEmployeeLoan;
use App\Models\User;
use Illuminate\Http\Request;

class AccountsEmployeeLoanController extends Controller {
    public function index() {
        $loans = AccountsEmployeeLoan::orderBy( 'id', 'desc' )->paginate( 10 );
        $users = User::pluck( 'name', 'id' );
        return view( 'accounts.employee-loan.index', ['loans' => $loans, 'users' => $users] );
    }

    public function update() {

    }

    public function store( Request $request ) {
        $attrs = $request->validate( [
            'date'    => 'required|date',
            'user_id' => 'required|exists:users,id',
            'amount'  => 'required|integer'
        ] );

        AccountsEmployeeLoan::create( $attrs );

        return back()->with( 'success', 'Employee load added' );
    }

    public function delete( AccountsEmployeeLoan $accountsEmployeeLoan ) {
        $accountsEmployeeLoan->delete();
        return back()->with( 'success', 'Employee load deleted.' );
    }
}
