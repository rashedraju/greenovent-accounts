<?php

namespace App\Http\Controllers;

use App\Models\AccountsEmployeeLoan;
use App\Models\User;
use Illuminate\Http\Request;

class AccountsEmployeeLoanController extends Controller {
    public function index( $year, $month ) {
        $loans = AccountsEmployeeLoan::whereYear( 'created_at', $year )->whereMonth( 'created_at', $month )->orderBy( 'id', 'desc' )->paginate( 10 );
        $users = User::pluck( 'name', 'id' );
        return view( 'accounts.employee-loan.index', ['year' => $year, 'month' => $month, 'loans' => $loans, 'users' => $users] );
    }

    public function store( Request $request ) {
        $attrs = $request->validate( [
            'date'      => 'required|date',
            'user_id'   => 'required|exists:users,id',
            'amount'    => 'required|integer',
            'paid'      => 'nullable|integer',
            'paid_date' => 'nullable|date'
        ] );

        AccountsEmployeeLoan::create( array_merge( $attrs, ['paid' => $request->paid ?? 0] ) );

        return back()->with( 'success', 'Loan has been added.' );
    }

    public function update( $year, $month, AccountsEmployeeLoan $accountsEmployeeLoan, Request $request ) {
        $attrs = $request->validate( [
            'amount'    => 'required|integer',
            'paid'      => 'nullable|integer',
            'paid_date' => 'nullable|date'
        ] );

        $accountsEmployeeLoan->update( array_merge( $attrs, ['paid' => $request->paid ?? 0] ) );
        return back()->with( 'success', 'Loan has been updated.' );
    }

    public function delete( $year, $month, AccountsEmployeeLoan $accountsEmployeeLoan ) {
        $accountsEmployeeLoan->delete();
        return back()->with( 'success', 'Loan has been deleted.' );
    }
}
